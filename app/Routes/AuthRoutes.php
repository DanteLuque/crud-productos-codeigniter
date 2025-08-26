<?php

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'AuthController::registrarCliente');
    
    $routes->group('cliente', static function ($routes) {
        $routes->get('register', 'AuthController::registrarCliente');
        $routes->post('save_db', 'AuthController::saveClienteDB');
    });

    $routes->group('vendedor', static function ($routes) {
        $routes->get('register', 'AuthController::registrarVendedor');
        $routes->post('save_db', 'AuthController::saveVendedorDB');
    });
});
