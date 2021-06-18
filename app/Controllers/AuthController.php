<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class AuthController extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Login | Control Pallet'
		];
		$sess = $this->getsess();
		if($sess->masuk == 1)
		{
			return redirect()->to(base_url() . '/dashboard');
		}
		return view('auth/login', $data);
	}

	public function coba_logout()
	{
		$sess = $this->getsess();
		$sess->set(['masuk' => 0]);
		$sess->remove('data');
		return redirect()->to(base_url());
	}

	public function coba_login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		// print_r([$username, $password, 'wkwk']);
		$model = new PenggunaModel();
		// cari user dengan username ini
		$pengguna = $model->find_one(['username'=>$username]);

		// print_r($pengguna);
		// tidak ada user dengan username ini
		if($pengguna == null)
		{
			// belum ada user admin, otomatis buat user admin
			if($username == 'admin')
			{
				$pengguna = $model->create_super_admin($password);

				$this->ok($pengguna);
				// if(key_exists('password', $pengguna))
				// {
				// 	unset($pengguna['password']);
				// }
				// echo json_encode($pengguna);
			}
			// bukan user admin, beri respon not found
			else 
			{
				$this->response->setStatusCode(404);
				echo json_encode(['fields' => ['username' => 'Username tidak ditemukan']]);
			}
		}
		// user dicari ditemukan
		else 
		{
			// $hashed_pass = $model->hash_pass($password);
			// password nya cocok
			// if($pengguna['password'] == $hashed_pass)
			if(password_verify($password, $pengguna['password']))
			{
				$this->ok($pengguna);
				// if(key_exists('password', $pengguna))
				// {
				// 	unset($pengguna['password']);
				// }
				// echo json_encode($pengguna);
			}
			// password nya tidak cocok
			else 
			{
				$this->response->setStatusCode(401);
				// print_r($hashed_pass);
				echo json_encode([
					'fields' => [
						'password' => 'Password tidak cocok', 
						// 'p1' => $pengguna['password'],
						// 'p2' => $hashed_pass
					]
				]);
			}
		}
	}

	public function ok($pengguna)
	{
		$sess = $this->getsess();
		$sess->set([
			'masuk' => 1,
			'data' => $pengguna,
		]);
		if(key_exists('password', $pengguna))
		{
			unset($pengguna['password']);
		}
		echo json_encode($pengguna);
	}
}
