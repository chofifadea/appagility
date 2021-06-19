<?php

namespace App\Controllers;

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
        $data = [
            'title' => 'Dashboard | Controling Pallet',
            'sess' => $sess
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
            $where['id_warehouse_tujuan'] = $sess->data['id_warehouse'];
        }

        $rows = $model->find_many($where);

        $data = [
            'title' => 'Inbox | Controling Pallet',
            'sess' => $sess,
            'rows' => $rows,
            'is_superadmin' => $is_superadmin,
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
            $where['id_warehouse_tujuan'] = $sess->data['id_warehouse'];
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
}
