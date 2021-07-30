<?php

namespace Config;

use App\Controllers\transactions;
use CodeIgniter\Router\Router;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AuthController::index');
$routes->post('/auth/login',  'AuthController::coba_login');
$routes->get('/auth/logout', 'AuthController::coba_logout');

$routes->get('/pengguna', 'PenggunaController::index');
$routes->post('/pengguna', 'PenggunaController::create');
$routes->post('/pengguna/update', 'PenggunaController::update');
$routes->post('/pengguna/hapus', 'PenggunaController::hapus');

$routes->get('/pallet', 'PalletController::index');
$routes->post('/pallet', 'PalletController::create');
$routes->post('/pallet/update', 'PalletController::update');
$routes->post('/pallet/hapus', 'PalletController::hapus');

$routes->get('/site', 'SiteController::index');
$routes->post('/site', 'SiteController::create');
$routes->post('/site/update', 'SiteController::update');
$routes->post('/site/hapus', 'SiteController::hapus');

$routes->get('/keterangan', 'TransactionInfoController::index');
$routes->post('/keterangan', 'TransactionInfoController::create');
$routes->post('/keterangan/update', 'TransactionInfoController::update');
$routes->post('/keterangan/hapus', 'TransactionInfoController::hapus');

$routes->get('/inbox', 'Admin::inbox');
$routes->post('/inbox/approve', 'Admin::approve_inbox');
$routes->post('/inbox/reject', 'Admin::reject_inbox');
// $routes->get('/', 'admin::index');
// $routes->get('/transactions/(:segment)', 'Transactions::detail/$1');

$routes->get('/dashboard', 'Admin::index');
// CRUD Transactions 
$routes->get('transactions', 'transactions::index');
// $routes->post('transactions-save', 'transactions::save');
$routes->get('/input', 'transactions::input');
$routes->post('/input', 'transactions::create_input');
// $routes->post('transactions-input', 'transactions::simpandata');
$routes->get('/output', 'transactions::output');
$routes->post('/output', 'transactions::create_output');
// $routes->post('transactions-output', 'transactions::simpandataoutput');

$routes->get('/user-guide', 'UserGuideController::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
