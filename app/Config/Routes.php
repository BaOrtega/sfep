<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', 'Test::index');
$routes->get('demo', 'Demo::index');

// Rutas de Registro
$routes->get('register', 'Auth\AuthController::register', ['as' => 'register']);
$routes->post('attemptRegister', 'Auth\AuthController::attemptRegister', ['as' => 'attemptRegister']);

// Rutas de Atenticación
$routes->get('login', 'Auth\AuthController::login', ['as' => 'login']);
$routes->post('attemptLogin', 'Auth\AuthController::attemptLogin', ['as' => 'attemptLogin']);
$routes->get('logout', 'Auth\AuthController::logout', ['as' => 'logout']);

// Rutas de Dashboard
$routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard', 'filter' => 'auth']);

// RUTAS DEL MÓDULO DE CLIENTES (CRUD)
$routes->group('clientes', ['filter' => 'auth'], function($routes) {
    // Listar clientes (READ)
    $routes->get('/', 'ClienteController::index');
    // Formulario de nuevo cliente (CREATE)
    $routes->get('new', 'ClienteController::new');
    // Guardar (Crear o Actualizar)
    $routes->post('save', 'ClienteController::save');
    // Formulario de edición (UPDATE)
    $routes->get('edit/(:num)', 'ClienteController::edit/$1');
    // Eliminar (DELETE)
    $routes->get('delete/(:num)', 'ClienteController::delete/$1');
    // Cantidad de clientes
    $routes->get('cantidadClientes', 'ClienteController::cantidadClientes');
});

// RUTAS DEL MÓDULO DE PRODUCTOS (CRUD)
$routes->group('productos', ['filter' => 'auth'], function($routes) {
    // Listar
    $routes->get('/', 'ProductoController::index');
    // Formulario de nuevo
    $routes->get('new', 'ProductoController::new');
    // Guardar (Crear o Actualizar)
    $routes->post('save', 'ProductoController::save');
    // Formulario de edición
    $routes->get('edit/(:num)', 'ProductoController::edit/$1');
    // Eliminar
    $routes->get('delete/(:num)', 'ProductoController::delete/$1');
});
