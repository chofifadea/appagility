<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $sess = session();
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
        $sess = session();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Inbox | Controling Pallet',
            'sess' => $sess
        ];
        return view('admin/inbox', $data);
    }
}
