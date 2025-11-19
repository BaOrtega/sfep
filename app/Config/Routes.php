<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', 'Test::index');
$routes->get('demo', 'Demo::index');

// Rutas de Registro (Nuevas)
$routes->get('register', 'Auth\AuthController::register', ['as' => 'register']);
$routes->post('attemptRegister', 'Auth\AuthController::attemptRegister', ['as' => 'attemptRegister']);

// Login y autenticación
$routes->get('login', 'Auth\AuthController::login', ['as' => 'login']);
$routes->post('attemptLogin', 'Auth\AuthController::attemptLogin', ['as' => 'attemptLogin']);
$routes->get('logout', 'Auth\AuthController::logout', ['as' => 'logout']);

// Dashboard
$routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard', 'filter' => 'auth']);

// RUTAS DEL MÓDULO DE CLIENTES (CRUD) - Protegidas por el filtro 'auth'
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