<?php

$routes->group('clientes', static function ($routes) {
    $routes->post('save_db', 'ClienteController::saveDB');
});
