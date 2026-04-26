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

// Users routes (CRUD) - Trainers and Members
$routes->get('/users/(:alpha)', 'Users::index/$1', ['as' => 'users']);                          // List users by role
$routes->get('/users/(:alpha)/form', 'Users::form/$1', ['as' => 'users.form.create']);        // Show create form
$routes->post('/users/(:alpha)/form', 'Users::form/$1');                                       // Store new user
$routes->get('/users/(:alpha)/form/(:num)', 'Users::form/$1/$2', ['as' => 'users.form.edit']); // Show edit form
$routes->post('/users/(:alpha)/form/(:num)', 'Users::form/$1/$2');                             // Update user
$routes->delete('/users/(:alpha)/delete/(:num)', 'Users::delete/$1/$2', ['as' => 'users.delete']); // Delete user
$routes->post('/users/(:alpha)/delete/(:num)', 'Users::delete/$1/$2');                         // Delete user (POST for forms)

// Convenience routes for trainers and members
$routes->get('/trainers', 'Users::index/trainer');                                             // Redirect to trainers list
$routes->get('/members', 'Users::index/member');                                               // Redirect to members list

// Subscriptions routes (CRUD)
$routes->get('/subscriptions', 'Subscriptions::index', ['as' => 'subscriptions']);             // List all subscriptions
$routes->get('/subscriptions/form', 'Subscriptions::form', ['as' => 'subscriptions.form.create']); // Show create form
$routes->post('/subscriptions/form', 'Subscriptions::form');                                   // Store new subscription
$routes->get('/subscriptions/form/(:num)', 'Subscriptions::form/$1', ['as' => 'subscriptions.form.edit']); // Show edit form
$routes->post('/subscriptions/form/(:num)', 'Subscriptions::form/$1');                        // Update subscription
$routes->delete('/subscriptions/delete/(:num)', 'Subscriptions::delete/$1');                   // Delete subscription
$routes->post('/subscriptions/delete/(:num)', 'Subscriptions::delete/$1');                     // Delete subscription (POST for forms)
