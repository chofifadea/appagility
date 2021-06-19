<?php

namespace App\Controllers;

class TransactionInfoController extends BaseController
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

        // $model 

        $data = [
            'title' => 'Master Keterangan | Controlling Pallet',
            'sess' => $sess,
            // 'rows' => 
        ];

        return view('keterangan/index', $data);
    }
}