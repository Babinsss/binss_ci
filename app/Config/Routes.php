<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/user/add', 'UserController::addUser');
$routes->post('/user/add', 'UserController::addUser');
