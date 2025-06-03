<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
///signup => gọi Home controller => gọi hàm signup
$routes->get('/signup', 'Home::signup');

$routes->post('/create', 'Home::create');
