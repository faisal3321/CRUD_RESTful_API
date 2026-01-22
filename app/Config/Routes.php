<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// CORS preflight fix
$routes->options('(:any)', function () {
    return service('response')->setStatusCode(200);
});


// Home
$routes->get('/', 'Home::index');

// Register
$routes->post('api/register', 'Api\Register::create');
$routes->get('/register', 'AuthView::register');

// Login
$routes->post('api/login', 'Api\Login::index');
$routes->get('/login', 'AuthView::login');

// Dashboard view
$routes->get('/dashboard', 'AuthView::dashboard');

// used auth middleware to verify jwt token then a user can update or delete
$routes->group('api', ['filter' => 'auth'], function($routes) {
    $routes->put('user/(:num)', 'Api\Login::update/$1');
    $routes->delete('user/(:num)', 'Api\Login::deleteUser/$1'); 
});