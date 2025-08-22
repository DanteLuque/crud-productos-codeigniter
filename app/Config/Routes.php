<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Productos - RENDER VIEWS
$routes->get('/', 'ProductoController::index');
$routes->get('/productos/crear', 'ProductoController::crear');
$routes->get('/productos/editar/(:num)', 'ProductoController::editar/$1');

// Productos - LOGIC
$routes->post('/productos/save_db', 'ProductoController::saveDB');
$routes->get('/productos/eliminar_db/(:num)', 'ProductoController::deleteDB/$1');
$routes->post('/productos/update_db/(:num)', 'ProductoController::updateDB/$1');

