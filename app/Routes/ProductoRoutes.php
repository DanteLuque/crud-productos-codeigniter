<?php

$routes->group('productos', static function ($routes) {
    // Render views
    $routes->get('crear','ProductoController::crear', [ 
                    'filter' => ['auth', 'role:VENDEDOR'] 
            ]);

    $routes->get('editar/(:num)', 'ProductoController::editar/$1');

    // Logic
    $routes->post('save_db', 'ProductoController::saveDB');
    $routes->get('eliminar_db/(:num)', 'ProductoController::deleteDB/$1');
    $routes->post('update_db/(:num)', 'ProductoController::updateDB/$1');
});
