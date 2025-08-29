<?php

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('doLogin', 'AuthController::doLogin');
    $routes->get('register_cliente', 'AuthController::registrarCliente');
    $routes->get('register_vendedor', 'AuthController::registrarVendedor');
});
