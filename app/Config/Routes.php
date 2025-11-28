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
    $routes->get('/', 'ClienteController::index', ['as' => 'clientes_index']);
    // Formulario de nuevo cliente (CREATE)
    $routes->get('new', 'ClienteController::new', ['as' => 'clientes_new']);
    // Guardar (Crear o Actualizar)
    $routes->post('save', 'ClienteController::save', ['as' => 'clientes_save']);
    // Formulario de edición (UPDATE)
    $routes->get('edit/(:num)', 'ClienteController::edit/$1', ['as' => 'clientes_edit']);
    // Eliminar (DELETE)
    $routes->get('delete/(:num)', 'ClienteController::delete/$1', ['as' => 'clientes_delete']);
    // Cantidad de clientes
    $routes->get('cantidadClientes', 'ClienteController::cantidadClientes');
});

// RUTAS DEL MÓDULO DE PRODUCTOS (CRUD)
$routes->group('productos', ['filter' => 'auth'], function($routes) {
    // Listar
    $routes->get('/', 'ProductoController::index', ['as' => 'productos_index']);
    // Formulario de nuevo
    $routes->get('new', 'ProductoController::new', ['as' => 'productos_new']);
    // Guardar (Crear o Actualizar)
    $routes->post('save', 'ProductoController::save', ['as' => 'productos_save']);
    // Formulario de edición
    $routes->get('edit/(:num)', 'ProductoController::edit/$1', ['as' => 'productos_edit']);
    // Eliminar
    $routes->get('delete/(:num)', 'ProductoController::delete/$1', ['as' => 'productos_delete']);
});

// RUTAS DEL MÓDULO DE FACTURACIÓN (CU-001)
$routes->group('facturas', ['filter' => 'auth'], function($routes) {
    // Listar Facturas (READ)
    $routes->get('/', 'FacturaController::index', ['as' => 'facturas_index']);
    // Formulario de nueva factura (CREATE)
    $routes->get('new', 'FacturaController::new', ['as' => 'facturas_new']);
    // Guardar Factura y Detalle
    $routes->post('save', 'FacturaController::save', ['as' => 'facturas_save']); 
    
    // Vista Detalle de la Factura (READ ONE)
    $routes->get('view/(:num)', 'FacturaController::view/$1', ['as' => 'facturas_view']);
    
    // Acciones de Gestión de Estado (UPDATE)
    $routes->get('anular/(:num)', 'FacturaController::anular/$1', ['as' => 'facturas_anular']);
    $routes->get('pagar/(:num)', 'FacturaController::pagar/$1', ['as' => 'facturas_pagar']);

    // Generar PDF de la Factura
    $routes->get('pdf/(:num)', 'FacturaController::generatePdf/$1', ['as' => 'facturas_pdf']);
});

// RUTAS DEL MÓDULO DE REPORTES Y ANÁLISIS
$routes->group('reportes', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ReporteController::index', ['as' => 'reportes_index']);
    
    // Reportes específicos
    $routes->get('ventas', 'ReporteController::ventasPorPeriodo', ['as' => 'reportes_ventas']);
    $routes->post('ventas', 'ReporteController::ventasPorPeriodo');
    $routes->get('exportar-ventas-pdf', 'ReporteController::exportarVentasPDF', ['as' => 'exportar_ventas_pdf']);
    
    $routes->get('cuentas_por_cobrar', 'ReporteController::cuentasPorCobrar', ['as' => 'reportes_cxc']);
    $routes->get('clientes', 'ReporteController::clientes', ['as' => 'reportes_clientes']);
    $routes->get('productos', 'ReporteController::productos', ['as' => 'reportes_productos']);
});
