<?php

/** @var \CodeIgniter\Router\RouteCollection $routes */
$routes->group('productos', static function ($routes) {
    // Render views
    $routes->get('crear', 'ProductoController::crear');
    $routes->get('editar/(:num)', 'ProductoController::editar/$1');

    // Logic
    $routes->post('save_db', 'ProductoController::saveDB');
    $routes->get('eliminar_db/(:num)', 'ProductoController::softDeleteDB/$1');
    $routes->post('update_db/(:num)', 'ProductoController::updateDB/$1');
});
