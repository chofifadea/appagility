<?php

namespace App\Controllers;

use App\Models\TransactionsModel;

class transactions extends BaseController
{
    protected $transactionsModel;
    public function __construct()

    {
        $this->transactionsModel = new TransactionsModel();
    }

    public function index()
    {
        $transactions = $this->transactionsModel->findAll();

        $data = [
            'title' => 'Transaction | Controling Pallet',
            'transaction' => $transactions
        ];

        // $transactionsModel = new \App\Models\TransactionsModel();


        return view('admin/transaction', $data);
    }

    public function save()
    {
        dd($this->request->getVar());
    }
}
