<?php
namespace App\Controllers;


use App\Controllers\BaseController;

class UserGuideController extends BaseController{

    public function index()
    {
        $sess = $this->getsess();
        if($sess->masuk == 0)
        {
            return redirect()->to(base_url());
        }
        $view = "site/ug_adminsite";
        if($sess->data['tipe'] == 'superadmin')
        {
            $view = 'site/ug_superadmin';
        }
        // echo "user guide";
        $view_data = [
            'title' => 'User Guide | Controlling Pallet',
            'sess' => $sess,
            'notifs' => $this->get_notif(),
        ];
        return view($view, $view_data);
    }
}