<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');

$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/loginAuth', 'AuthController::loginAuth');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/products', 'JewelleryProductController::index');
$routes->post('/products/getProducts', 'JewelleryProductController::getProducts');
$routes->get('/products/create', 'JewelleryProductController::create');
$routes->post('/products/store', 'JewelleryProductController::store');
$routes->get('/products/edit/(:num)', 'JewelleryProductController::edit/$1');
$routes->post('/products/update/(:num)', 'JewelleryProductController::update/$1');
$routes->get('/products/delete/(:num)', 'JewelleryProductController::delete/$1');
