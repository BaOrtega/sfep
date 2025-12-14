<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * Archivo de configuración de rutas para el sistema de facturación
 * Organizado por módulos con filtros específicos
 */

// ============================================================
// RUTAS PÚBLICAS (No requieren autenticación)
// ============================================================

// Página de inicio y páginas de prueba
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('test', 'Test::index', ['as' => 'test']);
$routes->get('demo', 'Demo::index', ['as' => 'demo']);

// ============================================================
// RUTAS DE AUTENTICACIÓN (Públicas)
// ============================================================

// Login y logout
$routes->get('login', 'Auth\AuthController::login', ['as' => 'login']);
$routes->POST('attemptLogin', 'Auth\AuthController::attemptLogin', ['as' => 'attemptLogin']);
$routes->get('logout', 'Auth\AuthController::logout', ['as' => 'logout']);

// ============================================================
// RECUPERACIÓN DE CONTRASEÑA (Públicas)
// ============================================================

$routes->get('forgot-password', 'Auth\AuthController::forgotPassword', ['as' => 'forgot_password']);
$routes->POST('forgot-password/process', 'Auth\AuthController::processForgotPassword', 
    ['as' => 'process_forgot_password']);
$routes->get('reset-password/(:any)', 'Auth\AuthController::resetPassword/$1', 
    ['as' => 'reset_password']);
$routes->POST('reset-password/process', 'Auth\AuthController::processResetPassword', 
    ['as' => 'process_reset_password']);

// ============================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================

// Dashboard principal - Accesible para todos los usuarios autenticados
$routes->get('dashboard', 'DashboardController::index', 
    ['as' => 'dashboard', 'filter' => 'auth']);

// Perfil de usuario - Accesible para todos los usuarios autenticados
$routes->get('profile', 'Auth\AuthController::profile', 
    ['as' => 'profile', 'filter' => 'auth']);
$routes->POST('profile/update', 'Auth\AuthController::updateProfile', 
    ['as' => 'update_profile', 'filter' => 'auth']);

// ============================================================
// MÓDULO CLIENTES (Admin y Vendedor)
// ============================================================

$routes->group('clientes', ['filter' => 'auth'], function($routes) {
    // Todas estas rutas requieren autenticación
    $routes->get('/', 'ClienteController::index', ['as' => 'clientes_index']);
    $routes->get('new', 'ClienteController::new', ['as' => 'clientes_new']);
    $routes->POST('save', 'ClienteController::save', ['as' => 'clientes_save']);
    $routes->get('edit/(:num)', 'ClienteController::edit/$1', ['as' => 'clientes_edit']);
    $routes->get('delete/(:num)', 'ClienteController::delete/$1', ['as' => 'clientes_delete']);
    $routes->get('cantidadClientes', 'ClienteController::cantidadClientes');
    $routes->POST('clientes/verificar-nit', 'ClienteController::verificarNit');
});

// ============================================================
// MÓDULO PRODUCTOS (Admin y Vendedor - Eliminar solo Admin)
// ============================================================

$routes->group('productos', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ProductoController::index', ['as' => 'productos_index']);
    $routes->get('new', 'ProductoController::new', ['as' => 'productos_new']);
    $routes->POST('save', 'ProductoController::save', ['as' => 'productos_save']);
    $routes->get('edit/(:num)', 'ProductoController::edit/$1', ['as' => 'productos_edit']);
    
    // Eliminar producto: solo administradores
    $routes->get('delete/(:num)', 'ProductoController::delete/$1', 
        ['as' => 'productos_delete', 'filter' => 'admin']
    );
});

// ============================================================
// MÓDULO FACTURAS (Admin y Vendedor - Anular solo Admin)
// ============================================================

$routes->group('facturas', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'FacturaController::index', ['as' => 'facturas_index']);
    $routes->get('new', 'FacturaController::new', ['as' => 'facturas_new']);
    $routes->POST('save', 'FacturaController::save', ['as' => 'facturas_save']); 
    $routes->get('view/(:num)', 'FacturaController::view/$1', ['as' => 'facturas_view']);
    
    // Pagar factura: ambos roles
    $routes->get('pagar/(:num)', 'FacturaController::pagar/$1', 
        ['as' => 'facturas_pagar']
    );

    // Generar PDF: ambos roles
    $routes->get('pdf/(:num)', 'FacturaController::generatePdf/$1', 
        ['as' => 'facturas_pdf']
    );
});

// Anular factura: solo administradores (ruta separada para filtro específico)
$routes->get('facturas/anular/(:num)', 'FacturaController::anular/$1', 
    ['as' => 'facturas_anular', 'filter' => 'admin']
);

// MÓDULO REPORTES (Exclusivo para Administradores)
$routes->group('reportes', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'ReporteController::index', ['as' => 'reportes_index']);
    
    // Reportes específicos - SOLO UNA RUTA PARA GET/POST
    $routes->match(['GET', 'POST'], 'ventas', 'ReporteController::ventasPorPeriodo', ['as' => 'reportes_ventas']);
    
    $routes->get('exportar-ventas-pdf', 'ReporteController::exportarVentasPDF', 
        ['as' => 'exportar_ventas_pdf']
    );
    
    $routes->get('cuentas_por_cobrar', 'ReporteController::cuentasPorCobrar', 
        ['as' => 'reportes_cxc']
    );
    $routes->get('clientes', 'ReporteController::clientes', 
        ['as' => 'reportes_clientes']
    );
    $routes->get('productos', 'ReporteController::productos', 
        ['as' => 'reportes_productos']
    );
});

// ============================================================
// MÓDULO USUARIOS (Exclusivo para Administradores)
// ============================================================

$routes->group('usuarios', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'UsuarioController::index', ['as' => 'usuarios_index']);
    $routes->get('new', 'UsuarioController::new', ['as' => 'usuarios_new']);
    $routes->POST('save', 'UsuarioController::save', ['as' => 'usuarios_save']);
    $routes->get('edit/(:num)', 'UsuarioController::edit/$1', ['as' => 'usuarios_edit']);
    $routes->get('delete/(:num)', 'UsuarioController::delete/$1', ['as' => 'usuarios_delete']);
});

// ============================================================
// REGISTRO DE USUARIOS (Solo accesible por Administradores)
// ============================================================

$routes->get('register', 'Auth\AuthController::register', ['as' => 'register', 'filter' => 'admin']);
$routes->POST('attemptRegister', 'Auth\AuthController::attemptRegister', ['as' => 'attemptRegister', 'filter' => 'admin']);

// ============================================================
// RUTAS DE PRUEBA PARA MAILTRAP (Temporales)
// ============================================================

$routes->get('test-mailtrap', 'TestMailtrapSimple::index');
$routes->get('test-alt', 'TestMailtrapAlt::index');
$routes->get('verify-config', 'VerifyConfig::index');
$routes->get('test-ports', 'TestAllPorts::index');
$routes->get('check-php', 'CheckPHP::index');
$routes->get('test-new', 'TestNewCredentials::index');
// ============================================================
// RUTAS DE API (Descomentar si se necesitan)
// ============================================================

/*
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('clientes', 'ClienteController::index', ['filter' => 'auth']);
    $routes->get('productos', 'ProductoController::index', ['filter' => 'auth']);
});
*/