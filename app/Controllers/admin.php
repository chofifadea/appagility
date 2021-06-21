<?php

namespace App\Controllers;

use App\Models\PalletModel;
use App\Models\TransactionsModel;

class Admin extends BaseController
{
    public function index()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        $model = new TransactionsModel();
        $m_pallet = new PalletModel();

        $sites = $m_pallet->find_many([]);

        $rows = [];
        $area_labels_data = [];
        $pie_labels_data = [];
        if($sess->data['tipe'] == 'superadmin')
        {
            $rows = $model->all_data();
            $area_labels_data = $this->area_chart($rows);
            $pie_labels_data = $this->pie_chart($sites, $rows);
        }
        else 
        {
            $id = $sess->data['id_site'];
            $rows = $model->data_in_site($id);
            $area_labels_data = $this->area_chart($rows, $id);
            $pie_labels_data = $this->pie_chart($sites, $rows, $id);
        }
        // print_r($rows);
        // exit();
        
        $data = [
            'title' => 'Dashboard | Controling Pallet',
            'sess' => $sess,
            'area' => $area_labels_data,
            'pie' => $pie_labels_data,
            'notifs' => $this->get_notif()
        ];
        return view('admin/index', $data);
    }

    public function inbox()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $model = new TransactionsModel();

        $rows = [];

        $data = $sess->data;
        $is_superadmin = false;

        $where = [
            'approved_by' => null,
            'status' => 'waiting_approval'
        ];

        if($data['tipe'] == 'superadmin')
        {
            $is_superadmin = true;
        }
        else 
        {
            $where['id_site_tujuan'] = $sess->data['id_site'];
        }

        $rows = $model->find_many($where);

        $data = [
            'title' => 'Inbox | Controling Pallet',
            'sess' => $sess,
            'rows' => $rows,
            'is_superadmin' => $is_superadmin,
            'notifs' => $this->get_notif()
        ];
        return view('admin/inbox', $data);
    }

    public function approve_inbox()
    {
        $id = $this->request->getPost('id');

        return $this->process_inbox($id, 'approved');
    }

    public function reject_inbox()
    {
        $id = $this->request->getPost('id');

        return $this->process_inbox($id, 'rejected');
    }

    public function process_inbox($id, $status)
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $model = new TransactionsModel();

        $where = [
            '_.id' => $id,
            'approved_by' => null,
            'status' => 'waiting_approval'
        ];

        if($sess->data['tipe'] == 'superadmin')
        {

        }
        else
        {
            $where['id_site_tujuan'] = $sess->data['id_site'];
        }

        $target = $model->find_one($where);

        if($target == null)
        {
            $this->response->setStatusCode(404);
            return 'data tidak ditemukan';
        }

        $skrg = date('Y-m-d H:i:s');

        $where = ['_.id' => $target['id']];
        $upd = [
            'approved_at' => $skrg, 
            'approved_by' => $sess->data['id'],
            'status' => $status,
        ];

        $res = $model->update_data($where, $upd);

        if($res == null)
        {
            $this->response->setStatusCode(400);
        }

        return json_encode($res);
    }

    protected function pie_chart($sites, $rows, $id=null)
    {
        $labels_data = [];
        foreach($sites as $site)
        {
            $labels_data[$site['nama']] = 0;
        }

        $total_current = 0;
        foreach($rows as $row)
        {
            // hanya olah data yg statusnya telah di-approve
            if(in_array($row['status'], ['approved']) == false)
            {
                continue;
            }

            $nama_pallet = $row['nama_pallet'];

            if(array_key_exists($nama_pallet, $labels_data) == false)
            {
                continue;
            }

            $qty = intval($row['quantity']);
                        
            if($id == null)
            {
                if($row['from_tipe'] == 'vendor' && $row['to_tipe'] == 'warehouse')
                {
                    $labels_data[$nama_pallet] += $qty;
                }
                else if($row['from_tipe'] == 'warehouse' && $row['to_tipe'] == 'vendor')
                {
                    $labels_data[$nama_pallet] -= $qty;
                }
                else 
                {
                    
                }
            }
            else 
            {
                if($row['id_site_asal'] == $id)
                {
                    $labels_data[$nama_pallet] -= $qty;
                }
                else if($row['id_site_tujuan'] == $id)
                {
                    $labels_data[$nama_pallet] += $qty;
                }
            }

            // $labels_data[$tgl] = $total_current;
        }

        // return $area_labels_data;
        $labels = [];
        $values = [];
        foreach($labels_data as $key => $item)
        {
            $labels[] = $key;
            $values[] = $item;
        }

        return [
            'labels' => $labels,
            'data' => $values,
        ];
    }

    protected function area_chart($rows, $id=null)
    {
        $labels_data = [];
        $counter = 0;
        $total_current = 0;
        foreach($rows as $row)
        {
            // hanya olah data yg statusnya telah di-approve
            if(in_array($row['status'], ['approved']) == false)
            {
                continue;
            }

            $tgl = $row['tgl_trans'];
            $qty = intval($row['quantity']);
            
            $counter++;
            
            if($id == null)
            {
                if($row['from_tipe'] == 'vendor' && $row['to_tipe'] == 'warehouse')
                {
                    $total_current += $qty;
                }
                else if($row['from_tipe'] == 'warehouse' && $row['to_tipe'] == 'vendor')
                {
                    $total_current -= $qty;
                }
                else 
                {
                    
                }
            }
            else 
            {
                if($row['id_site_asal'] == $id)
                {
                    $total_current -= $qty;
                }
                else if($row['id_site_tujuan'] == $id)
                {
                    $total_current += $qty;
                }
            }

            $labels_data[$tgl] = $total_current;
        }

        // return $area_labels_data;
        $labels = [];
        $values = [];
        foreach($labels_data as $key => $item)
        {
            $labels[] = $key;
            $values[] = $item;
        }

        return [
            'labels' => $labels,
            'data' => $values,
        ];
    }
}
