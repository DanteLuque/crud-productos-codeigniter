<?php

$routes->group('ubigeo', static function ($routes) {
    $routes->get('departamentos', 'UbigeoController::departamentos');
    $routes->get('provincias/(:num)', 'UbigeoController::provincias/$1');
    $routes->get('distritos/(:num)', 'UbigeoController::distritos/$1');
});
