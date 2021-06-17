<?php

namespace App\Controllers;

use App\Models\PalletModel;

class PalletController extends BaseController
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

        $model = new PalletModel();

        $data = [
            'title' => 'Master Pallet | Controlling Pallet',
            'sess' => $sess,
            'rows' => $model->find_many([]),
        ];

        return view('pallet/index', $data);
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
            'nama' => $this->request->getPost('nama'),
        ];

        $model = new PalletModel();

        $res = $model->create($data);

        if($res == null)
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
            'nama' => $this->request->getPost('nama'),
        ];

        $id = $this->request->getPost('id');

        $where = ['id' => $id];

        $model = new PalletModel();

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

        $where = ['id' => $id];

        $model = new PalletModel();

        $res = $model->flag_hapus($where);

        if($res == null)
        {
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }
}