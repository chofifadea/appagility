<?php

namespace App\Controllers;

class admin extends BaseController
{
    public function admin()
    {
        $data = [
            'title' => 'Dashboard | Controling Pallet'
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

    public function output()
    {
        $data = [
            'title' => 'Output | Controling Pallet'
        ];
        return view('admin/output', $data);
    }


    public function input()
    {
        $data = [
            'title' => 'Input | Controling Pallet'
        ];
        return view('admin/input', $data);
    }
}
