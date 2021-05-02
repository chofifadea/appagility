<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Login | Control Pallet'
		];
		return view('auth/login', $data);
	}
}
