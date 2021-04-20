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
        helper('form');
        $data = [
            'title' => 'Output | Controling Pallet'
        ];
        return view('admin/output', $data);
    }


    public function simpandata()
    {
        $data = [
            'pallet_name' => $this->request->getPost('pallet_name'),
            'information' => $this->request->getPost('information'),
            'site' => $this->request->getPost('site'),
            'quantity' => $this->request->getPost('quantity')
        ];
        $transactions = new TransactionsModel();

        $simpan = $transactions->simpan($data);

        if ($simpan) {
            return redirect()->to('/transactions/index');
        }
    }
}
