<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');

// Login routes
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');

// Dashboard routes
$routes->get('/dashboard', 'Dashboard::index');
