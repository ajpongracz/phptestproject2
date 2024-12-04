<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\OtpController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('otp', [OtpController::class, 'index']);

// Store password
$routes->get('otp/store/storenewpassword', [OtpController::class, 'newPw']);
$routes->post('otp/store', [OtpController::class, 'storePw']);

// Dynamic generated URL route / retrieve pw
$routes->get('otp/retrieve/(:segment)', [OtpController::class, 'getPw/$1']);
$routes->post('otp/retrieve', [OtpController::class, 'showPw']);
$routes->get('otp/expired', [OtpController::class, 'expiredLink']);

// route testing
// ===========================================================
$routes->get('randomlink', [OtpController::class, 'randomLink']);
$routes->get('otp/(:segment)/(:segment)/(:segment)', [OtpController::class, 'testRoute/$1/$2/$3']);
// ===========================================================


?>