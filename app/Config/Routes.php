<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');

// Books routes
$routes->get('books', 'Books::index');
$routes->get('books/create', 'Books::create');
$routes->post('books/store', 'Books::store');
$routes->get('books/edit/(:num)', 'Books::edit/$1');
$routes->post('books/update/(:num)', 'Books::update/$1');
$routes->post('books/delete/(:num)', 'Books::delete/$1');
