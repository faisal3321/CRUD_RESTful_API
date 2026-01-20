<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('api/register', 'Api\Register::create');
$routes->post('api/login', 'Api\Login::index');
$routes->put('api/user/(:num)', 'Api\Login::update/$1');
$routes->delete('api/user/(:num)', 'Api\Login::delete/$1');

// $routes->match(['get','post'], 'api/register', 'Api\Register::create');
