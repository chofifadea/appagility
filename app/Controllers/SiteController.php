<?php

namespace App\Controllers;

use App\Models\SiteModel;

class SiteController extends BaseController
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

        $model = new SiteModel();

        $data = [
            'title' => 'Master Site | Controlling Pallet',
            'sess' => $sess,
            'rows' => $model->find_many([]),
        ];

        return view('site/index', $data);
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
            'tipe' => $this->request->getPost('tipe'),
        ];

        if(in_array($data['tipe'], ['warehouse', 'vendor']) == false)
        {
            $data['tipe'] = 'warehouse';
        }

        $model = new SiteModel();

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
            'nama' => $this->request->getPost('nama'),
            'tipe' => $this->request->getPost('tipe'),
        ];

        if(in_array($data['tipe'], ['warehouse', 'vendor']) == false)
        {
            $data['tipe'] = 'warehouse';
        }

        $id = $this->request->getPost('id');

        $where = ['id' => $id];

        $model = new SiteModel();

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

        $model = new SiteModel();

        $res = $model->flag_hapus($where);

        if($res==null)
        {
            $this->response->setStatusCode(400);
        }

        echo json_encode($res);
    }
}