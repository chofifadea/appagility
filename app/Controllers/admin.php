<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $sess = session();
        $data = [
            'title' => 'Dashboard | Controling Pallet',
            'sess' => $sess
        ];
        return view('admin/index', $data);
    }

    public function inbox()
    {
        $data = [
            'title' => 'Inbox | Controling Pallet'
        ];
        return view('admin/inbox', $data);
    }
}
