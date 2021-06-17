<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

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

        $data = [
            'title' => 'Master Pengguna | Controlling Pallet',
            'sess' => $sess,
            'rows' => $model->find_many(['tipe' => 'admin-gudang'])
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
            // 'id_warehouse' => $this->request->get_post('id_warehouse'),
            'tipe' => 'admin-gudang'
        ];

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $model = new PenggunaModel();

        $res = $model->create($data);

        if($res==null)
        {
            $this->response->setStatusCode(400);
        }
        echo json_encode($res);
        
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

        $where = ['id' => $id];
        $res = $model->update_data($where, $data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
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

        $where = ['id' => $id];
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