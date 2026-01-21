<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('api/register', 'Api\Register::create');
$routes->post('api/login', 'Api\Login::index');

// used auth middleware to verify jwt token then a user can update or delete
$routes->group('api', ['filter' => 'auth'], function($routes) {
    $routes->put('user/(:num)', 'Api\Login::update/$1');
    $routes->delete('user/(:num)', 'Api\Login::deleteUser/$1'); 
});




// $routes->match(['get','post'], 'api/register', 'Api\Register::create');
