<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\OTP_Controller;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');

 $routes->get('otp', [OTP_Controller::class, 'index']);
 $routes->get('otp/storenewpassword', [OTP_Controller::class, 'new']);
 $routes->post('otp', [OTP_Controller::class, 'store_pw_c']);

?>