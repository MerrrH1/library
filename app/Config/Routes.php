<?php

use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');
$routes->post('/login', 'UserController::processLogin');
$routes->get('/register', 'UserController::register');
$routes->post('/register', 'UserController::processRegister');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/visits', 'VisitController::index');
    $routes->post('/visits/checkin', 'VisitController::checkIn');
    $routes->post('/visits/checkout', 'VisitController::checkOut');
});
