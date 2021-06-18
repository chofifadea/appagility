<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\RelPenggunaWarehouse;
use App\Models\WarehouseModel;

class PenggunaController extends BaseController
{
    public function index()
    {
        $sess = session();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $model = new PenggunaModel();
        $m_wh = new WarehouseModel();

        $data = [
            'title' => 'Master Pengguna | Controlling Pallet',
            'sess' => $sess,
            'rows' => $model->find_many(['tipe' => 'admin-gudang']),
            'list_warehouse' => $m_wh->find_many([]),
        ];

        return view('pengguna/index', $data);
    }

    public function create()
    {
        $sess = session();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'password' => $this->request->getPost('password'),
            'tipe' => 'admin-gudang'
        ];
        
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        $model = new PenggunaModel();
        
        $res = $model->create($data);
        
        if($res==null)
        {
            $this->response->setStatusCode(400);
            return json_encode($res);
        }
        
        $id_warehouse = $this->request->getPost('id_warehouse');

        $m_rpw = new RelPenggunaWarehouse();
        $nrpw = [
            'id_pengguna' => $res['id'],
            'id_warehouse' => $id_warehouse
        ];

        $m_rpw->create($nrpw);
        
        return json_encode($res);
        
    }

    public function update()
    {
        $sess = session();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama')
        ];

        $password = $this->request->getPost('password');
        if(empty($password) == false)
        {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $model = new PenggunaModel();

        $id = $this->request->getPost('id');

        $where = ['_.id' => $id];
        $res = $model->update_data($where, $data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
            return json_encode($res);
        }

        $id_warehouse = $this->request->getPost('id_warehouse');

        if($id_warehouse != $res['id_warehouse'])
        {
            $m_rpw = new RelPenggunaWarehouse();
            $upd = [
                'id_pengguna' => $res['id'],
                'id_warehouse' => $id_warehouse,
            ];
            $m_rpw->create($upd);
        }

        echo json_encode($res);
    }

    public function hapus()
    {
        $sess = session();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $id = $this->request->getPost('id');

        $model = new PenggunaModel();

        // $skrg = date('Y-m-d H:i:s');

        $where = ['_.id' => $id];
        // $data = ['deleted_at' => $skrg];

        $res = $model->flag_hapus($where);

        if($res == null)
        {
            // echo 'nool';
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }
}