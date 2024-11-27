<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\OTP;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');
 $routes->get('otp', [OTP::class, 'index']);
 $routes->get('otp/new', [OTP::class, 'new']);
 $routes->post('storenewpassword', [OTP::class, 'storenewpassword']);

 //$routes->post('otp/store', [OTP::class, 'storenewpassword']);

?>