<?php

$routes->group('vendedores', static function ($routes) {
    $routes->post('save_db', 'VendedorController::saveDB');
});
