<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// rutas por módulos
require APPPATH . 'Routes/AuthRoutes.php';
require APPPATH . 'Routes/UbigeoRoutes.php';
require APPPATH . 'Routes/HomeRoutes.php';
require APPPATH . 'Routes/ProductoRoutes.php';