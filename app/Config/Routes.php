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

?>