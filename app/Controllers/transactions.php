<?php

namespace App\Controllers;

use App\Models\PalletModel;
use App\Models\TransactionsModel;
use App\Models\SiteModel;

class transactions extends BaseController
{
    protected $transactionsModel;

    public function index()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $transactions = new TransactionsModel();

        $rows = [];

        if($sess->data['tipe'] == 'superadmin')
        {
            $rows = $transactions->all_data();
        }
        else 
        {
            $id_wh = $sess->data['id_site'];
            $rows = $transactions->data_in_wh($id_wh);
        }

        $data = [
            'title' => 'Transaction | Controling Pallet',
            // 'tampildata' => $transactions->tampildata()->getResult(),
            'sess' => $sess,
            'rows' => $rows
        ];
        // print_r($data);
        // exit();
        return view('admin/transaction', $data);
    }

    public function output()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        helper('form');

        $m_site = new SiteModel();
        $model_pallet = new PalletModel();

        $data = [
            'title' => 'Output | Controling Pallet',
            'validation' => \Config\Services::validation(),
            'sess' => $sess,
            'list_pallet' => $model_pallet->find_many([]),
            'list_site' => $m_site->find_many([]),
        ];
        return view('admin/output', $data);
    }

    public function input()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $m_site = new SiteModel();
        $model_pallet = new PalletModel();

        $data = [
            'title' => 'Input | Controling Pallet',
            'validation' => \Config\Services::validation(),
            'sess' => $sess,
            'list_pallet' => $model_pallet->find_many([]),
            'list_site' => $m_site->find_many([]),
        ];
        return view('admin/input', $data);
    }

    public function create_output()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $skrg = date('Y-m-d H:i:s');

        $data = [
            'id_pallet' => $this->request->getPost('pallet'),
            'quantity' => $this->request->getPost('quantity'),
            'id_site_tujuan' => $this->request->getPost('site'),
            'information' => $this->request->getPost('information'),
            'created_by' => $sess->data['id'],
            'status' => 'waiting_approval',
            'created_at' => $skrg
        ];

        if($sess->data['tipe'] == 'superadmin')
        {
            $data['id_site_asal'] = $this->request->getPost('from_site');
        }
        else 
        {
            $data['id_site_asal'] = $sess->data['id_site'];
        }

        $err = [];

        if(empty($data['id_pallet']) == true)
        {
            $err['pallet'] = 'Pallet harus dipilih';
        }
        if(empty($data['quantity']) == true)
        {
            $err['quantity'] = 'Quantity harus diisi';
        }
        if(empty($data['id_site_tujuan']) == true)
        {
            $err['site'] = 'Site tujuan harus dipilih';
        }
        if(empty($data['id_site_asal']) == true)
        {
            $err['from_site'] = 'Site Asal harus dipilih';
        }

        if(count($err) > 0)
        {
            $this->response->setStatusCode(400);
            return json_encode(['fields' => $err]);
        }

        $model = new TransactionsModel();

        $res = $model->create($data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
            return json_encode($res);
        }
        return json_encode($res);
    }

    public function create_input()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $skrg = date('Y-m-d H:i:s');

        $data = [
            'id_pallet' => $this->request->getPost('pallet'),
            'quantity' => $this->request->getPost('quantity'),
            // 'id_site_tujuan' => $this->request->getPost('site'),
            'information' => $this->request->getPost('information'),
            'created_by' => $sess->data['id'],
            'status' => 'approved',
            'created_at' => $skrg,
            'approved_by' => $sess->data['id'],
            'approved_at' => $skrg,
            'id_site_asal' => $this->request->getPost('from_site'),
        ];

        if($sess->data['tipe'] == 'superadmin')
        {
            $data['id_site_tujuan'] = $this->request->getPost('site');
        }
        else 
        {
            $data['id_site_tujuan'] = $sess->data['id_site'];
        }

        $err = [];

        if(empty($data['id_pallet']) == true)
        {
            $err['pallet'] = 'Pallet harus dipilih';
        }
        if(empty($data['quantity']) == true)
        {
            $err['quantity'] = 'Quantity harus diisi';
        }
        if(empty($data['id_site_tujuan']) == true)
        {
            $err['site'] = 'Site tujuan harus dipilih';
        }
        if(empty($data['id_site_asal']) == true)
        {
            $err['from_site'] = 'Site Asal harus dipilih';
        }

        if(count($err) > 0)
        {
            $this->response->setStatusCode(400);
            return json_encode(['fields' => $err]);
        }

        $model = new TransactionsModel();

        $res = $model->create($data);

        if($res == null)
        {
            $this->response->setStatusCode(400);
            return json_encode($res);
        }
        return json_encode($res);
    }


    public function simpandata()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        //validasi input
        if (!$this->validate([
            'pallet_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pallet harus diisi.'
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi.'
                ]
            ],
            'site' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan harus diisi.'
                ]
            ],
            'information' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/transactions/input')->withInput();
        }
        $data = [
            'pallet_name' => $this->request->getPost('pallet_name'),
            'information' => $this->request->getPost('information'),
            'site' => $this->request->getPost('site'),
            'quantity' => $this->request->getPost('quantity')
        ];
        $transactions = new TransactionsModel();

        $simpan = $transactions->simpan($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        if ($simpan) {
            return redirect()->to('/transactions/index');
        }
    }

    public function simpandataoutput()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        // validasi output
        if (!$this->validate([
            'pallet_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pallet harus diisi.'
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi.'
                ]
            ],
            'site' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan harus diisi.'
                ]
            ],
            'information' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/transactions/output')->withInput();
        }
        $data = [
            'pallet_name' => $this->request->getPost('pallet_name'),
            'information' => $this->request->getPost('information'),
            'site' => $this->request->getPost('site'),
            'quantity' => $this->request->getPost('quantity')
        ];
        $transactions = new TransactionsModel();

        $simpan = $transactions->simpan($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        if ($simpan) {
            return redirect()->to('/transactions/index');
        }
    }
}
