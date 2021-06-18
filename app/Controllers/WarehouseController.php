<?php

namespace App\Controllers;

use App\Models\WarehouseModel;

class WarehouseController extends BaseController
{
    public function index()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $model = new WarehouseModel();

        $data = [
            'title' => 'Master Warehouse | Controlling Pallet',
            'sess' => $sess,
            'rows' => $model->find_many([]),
        ];

        return view('warehouse/index', $data);
    }

    public function create()
    {
        $sess = $this->getsess();
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

        $model = new WarehouseModel();

        $res = $model->create($data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }

    public function update()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        if($sess->data['tipe'] != 'superadmin')
        {
            return redirect()->to(base_url() . '/dashboard');
        }

        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        $id = $this->request->getPost('id');

        $where = ['id' => $id];

        $model = new WarehouseModel();

        $res = $model->update_data($where, $data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }

    public function hapus()
    {
        $sess = $this->getsess();
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

        $model = new WarehouseModel();

        $res = $model->flag_hapus($where);

        if($res==null)
        {
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }
}