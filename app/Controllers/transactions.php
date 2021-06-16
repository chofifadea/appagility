<?php

namespace App\Controllers;

use App\Models\TransactionsModel;

class transactions extends BaseController
{
    protected $transactionsModel;

    public function index()
    {
        $transactions = new TransactionsModel();

        $data = [
            'title' => 'Transaction | Controling Pallet',
            'tampildata' => $transactions->tampildata()->getResult()
        ];
        // print_r($data);
        // exit();
        return view('admin/transaction', $data);
    }

    public function output()
    {
        helper('form');
        $data = [
            'title' => 'Output | Controling Pallet',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/output', $data);
    }

    public function input()
    {
        // session();
        $data = [
            'title' => 'Input | Controling Pallet',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/input', $data);
    }


    public function simpandata()
    {
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
