<?php

$routes->group('auth', static function ($routes) {
// Render views
$routes->get('register-cliente', 'AuthController::registrarCliente');
$routes->get('register-vendedor', 'AuthController::registrarVendedor');
});
