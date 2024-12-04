<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\OtpController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('otp', [OtpController::class, 'index']);
$routes->get('otp/storenewpassword', [OtpController::class, 'new']);
$routes->post('otp', [OtpController::class, 'storePw']);

// Dynamic generated URL route
$routes->get('otp/(:segment)', [OtpController::class, 'showPw']);

// route testing
// ===========================================================
$routes->get('randomlink', [OtpController::class, 'randomLink']);
$routes->get('otp/(:segment)/(:segment)/(:segment)', [OtpController::class, 'testRoute/$1/$2/$3']);
// ===========================================================


?>