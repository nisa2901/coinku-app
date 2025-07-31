<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman awal (landing page)
$routes->get('/', 'Auth::start');

// Autentikasi
$routes->get('/login', 'Auth::loginForm');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::registerForm');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

// Dashboard setelah login
$routes->get('/dashboard', 'Dashboard::index');

// Reset password
$routes->get('/reset-password', 'Auth::resetPasswordForm');
$routes->post('/reset-password', 'Auth::resetPassword');
$routes->get('transactions/create', 'Transaction::create');
$routes->post('transactions/store', 'Transaction::store');
$routes->get('transaction/create', 'Transaction::create');

$route['default_controller'] = 'rekap';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routes untuk aplikasi rekap keuangan
$routes->get('rekap', 'Rekap::index');
$route['rekap/ajax'] = 'Rekap/get_rekap_ajax';
$routes->get('/', 'Rekap::index');

// Routes untuk halaman lain (jika akan dibuat nanti)
$routes->get('dashboard', 'Dashboard::index');
$routes->get('transfer', 'Transfer::index');
$routes->get('more', 'More::index');
$routes->get('settings', 'Settings::index');
$routes->get('/rekap', 'Rekap::index');

$routes->group('financial', function($routes) {
    $routes->get('/', 'FinancialController::index');
    $routes->get('dashboard', 'FinancialController::index');
    $routes->get('data', 'FinancialController::getReportData');
    $routes->post('transaction', 'FinancialController::addTransaction');
    $routes->put('transaction/(:num)', 'FinancialController::updateTransaction/$1');
    $routes->delete('transaction/(:num)', 'FinancialController::deleteTransaction/$1');
});
$routes->get('FinancialController', 'FinancialController::index');
$routes->get('FinancialController/(:any)', 'FinancialController::$1');
$routes->post('financial/update', 'FinancialController::update');

$routes->get('transaction/create', 'Transaction::create');
$routes->post('transaction/store', 'Transaction::store');
$routes->get('dashboard', 'Dashboard::index');


