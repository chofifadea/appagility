<?php

namespace App\Controllers;

use App\Models\TransactionsModel;

class Admin extends BaseController
{
    public function index()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Dashboard | Controling Pallet',
            'sess' => $sess
        ];
        return view('admin/index', $data);
    }

    public function inbox()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }

        $model = new TransactionsModel();

        $rows = [];

        $data = $sess->data;
        $is_superadmin = false;

        if($data['tipe'] == 'superadmin')
        {
            $rows = $model->find_many(['approved_by' => null]);
            $is_superadmin = true;
        }
        else 
        {
            $rows = $model->find_many(['approved_by' => null, 'id_warehouse_tujuan' => $data['id_warehouse']]);
        }

        $data = [
            'title' => 'Inbox | Controling Pallet',
            'sess' => $sess,
            'rows' => $rows,
            'is_superadmin' => $is_superadmin,
        ];
        return view('admin/inbox', $data);
    }
}
