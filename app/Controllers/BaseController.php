<?php

namespace App\Controllers;

use App\Models\RelPenggunaSite;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	private $sess = null;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->sess = session();
		date_default_timezone_set('Asia/Jakarta');
	}

	protected function getsess()
	{
		$sess = $this->sess;
		if ($sess->masuk == null) {
			$sess->set([
				'masuk' => 0,
				'data' => null
			]);
			$sess = session();
		}

		$data = $sess->data;
		if ($data == null) {
			return $sess;
		}
		$model = new RelPenggunaSite();
		$role = $model->find_one(['id_pengguna' => $data['id'], 'end_at' => null]);

		if ($role != null) {
			if ($data['id_site'] != $role['id_site']) {
				$data['id_site'] = $role['id_site'];
				$data['nama_site'] = $role['nama_site'];
				$this->sess->set([
					'data' => $data
				]);
				$this->sess = session();
			}
		}
		return $this->sess;
	}
}
