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
        return view('admin/transaction', $data);
    }

    public function output()
    {
        session();
        helper('form');
        $data = [
            'title' => 'Output | Controling Pallet',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/output', $data);
    }

    public function input()
    {
        session();
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
            'pallet_name' => 'required|is_not_unique[transactions.pallet_name]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/transactions/input')->withInput()->with('validation', $validation);
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
        //validasi input
        if (!$this->validate([
            'pallet_name' => 'required|is_not_unique[transactions.pallet_name]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/transactions/output')->withInput()->with('validation', $validation);
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

    // public function simpandata_input()
    // {
    //     $data = [
    //         'pallet_name' => $this->request->getPost('pallet_name'),
    //         'information' => $this->request->getPost('information'),
    //         'site' => $this->request->getPost('site'),
    //         'quantity' => $this->request->getPost('quantity')
    //     ];
    //     $transactions = new TransactionsModel();

    //     $simpan = $transactions->simpan($data);

    //     if ($simpan) {
    //         return redirect()->to('/transactions/index');
    //     }
    // }
}
