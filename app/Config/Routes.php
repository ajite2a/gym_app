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

// Plans routes (CRUD)
$routes->get('/plans', 'Plans::index');                    // List all plans
$routes->get('/plans/form', 'Plans::form');               // Show create form
$routes->post('/plans/form', 'Plans::form');              // Store new plan
$routes->get('/plans/form/(:num)', 'Plans::form/$1');    // Show edit form
$routes->post('/plans/form/(:num)', 'Plans::form/$1');   // Update plan
$routes->delete('/plans/delete/(:num)', 'Plans::delete/$1'); // Delete plan
$routes->post('/plans/delete/(:num)', 'Plans::delete/$1'); // Delete plan (POST for forms)
