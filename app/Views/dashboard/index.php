<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PFEP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            margin-left: 300px;
            padding: 30px;
            min-height: 100vh;
        }
        .logo {
            font-size: 1.8em;
            font-weight: 700;
            background: linear-gradient(135deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
        }
        .nav-item a {
            color: #495057;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .nav-item a:hover {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            transform: translateX(5px);
        }
        .nav-item a.active {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        .user-info {
            position: absolute;
            bottom: 30px;
            width: calc(100% - 50px);
        }
        .card-main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            margin-bottom: 25px;
        }
        .card-header-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .stat-card.clients {
            border-left-color: #28a745;
        }
        .stat-card.products {
            border-left-color: #ffc107;
        }
        .stat-card.invoices {
            border-left-color: #dc3545;
        }
        .stat-card.reports {
            border-left-color: #6f42c1;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        .status-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .status-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f3f4;
        }
        .status-item:last-child {
            border-bottom: none;
        }
        .status-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.9rem;
        }
        .status-icon.success {
            background-color: #d4edda;
            color: #155724;
        }
        .status-icon.warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-icon.danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-text {
            flex: 1;
        }
        .module-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .module-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: #007bff;
        }
        .module-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .welcome-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }
        .btn-action {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .btn-action:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #e9ecef; margin: 20px 0;">
        <nav>
            <div class="nav-item">
                <a href="<?= url_to('dashboard') ?>" class="active">
                    <i class="bi bi-speedometer2 me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos') ?>">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="/facturas/nueva">
                    <i class="bi bi-receipt me-3"></i>Nueva Factura
                </a>
            </div>
            <div class="nav-item">
                <a href="/reportes">
                    <i class="bi bi-bar-chart me-3"></i>Reportes y Análisis
                </a>
            </div>
        </nav>
        
        <div class="user-info">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <p class="mb-1 fw-bold"><?= esc(session()->get('user_name')) ?></p>
                    <small class="text-muted">Usuario activo</small>
                </div>
                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <a href="<?= url_to('logout') ?>" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Tarjeta de Bienvenida -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-3">👋 ¡Bienvenido, <?= esc(session()->get('user_name')) ?>!</h1>
                    <p class="mb-4 opacity-90">La seguridad del sistema está operativa. La precondición de autenticación para la creación de facturas (CU-001) ya está cubierta. Ahora podemos construir los módulos de gestión.</p>
                    
                    <div class="quick-actions">
                        <a href="<?= url_to('clientes') ?>" class="btn-action">
                            <i class="bi bi-people me-2"></i>Gestionar Clientes
                        </a>
                        <a href="/facturas/nueva" class="btn-action">
                            <i class="bi bi-receipt me-2"></i>Nueva Factura
                        </a>
                        <a href="<?= url_to('productos') ?>" class="btn-action">
                            <i class="bi bi-box-seam me-2"></i>Ver Productos
                        </a>
                        <a href="/reportes" class="btn-action">
                            <i class="bi bi-bar-chart me-2"></i>Ver Reportes
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-shield-check" style="font-size: 6rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="stats-grid">
            <div class="stat-card clients">
                <div class="stat-icon text-success">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-number text-success"><?= $totalClientes ?></div>
                <div class="stat-title">Clientes Registrados</div>
            </div>
            
            <div class="stat-card products">
                <div class="stat-icon text-warning">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stat-number text-warning">0</div>
                <div class="stat-title">Productos en Inventario</div>
            </div>
            
            <div class="stat-card invoices">
                <div class="stat-icon text-danger">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-number text-danger">0</div>
                <div class="stat-title">Facturas Emitidas</div>
            </div>
            
            <div class="stat-card reports">
                <div class="stat-icon text-primary">
                    <i class="bi bi-bar-chart"></i>
                </div>
                <div class="stat-number text-primary">0</div>
                <div class="stat-title">Reportes Generados</div>
            </div>
        </div>

        <div class="row">
            <!-- Estado del Sistema -->
            <div class="col-md-8">
                <div class="card-main">
                    <div class="card-header-custom">
                        <h3 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Estado del Sistema</h3>
                    </div>
                    <div class="card-body p-4">
                        <ul class="status-list">
                            <li class="status-item">
                                <div class="status-icon success">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="status-text">
                                    <strong>Seguridad (Auth Filter)</strong>
                                    <div class="text-muted">Sistema de autenticación operativo</div>
                                </div>
                                <span class="badge bg-success">Operativo</span>
                            </li>
                            <li class="status-item">
                                <div class="status-icon success">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="status-text">
                                    <strong>Clientes (CRUD)</strong>
                                    <div class="text-muted">Gestión completa de clientes</div>
                                </div>
                                <span class="badge bg-success">Completado</span>
                            </li>
                            <li class="status-item">
                                <div class="status-icon warning">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="status-text">
                                    <strong>Productos/Servicios</strong>
                                    <div class="text-muted">Módulo en desarrollo</div>
                                </div>
                                <span class="badge bg-warning">En Progreso</span>
                            </li>
                            <li class="status-item">
                                <div class="status-icon danger">
                                    <i class="bi bi-x-lg"></i>
                                </div>
                                <div class="status-text">
                                    <strong>Reportes Avanzados</strong>
                                    <div class="text-muted">Análisis y estadísticas</div>
                                </div>
                                <span class="badge bg-danger">Pendiente</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Módulos del Sistema -->
            <div class="col-md-4">
                <div class="card-main">
                    <div class="card-header-custom">
                        <h3 class="mb-0"><i class="bi bi-grid me-2"></i>Módulos</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="<?= url_to('clientes') ?>" class="module-card text-decoration-none text-dark d-block">
                                    <div class="module-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Clientes</h6>
                                    <small class="text-muted">Gestión CRUD</small>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/productos" class="module-card text-decoration-none text-dark d-block">
                                    <div class="module-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Productos</h6>
                                    <small class="text-muted">Inventario</small>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/facturas/nueva" class="module-card text-decoration-none text-dark d-block">
                                    <div class="module-icon">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Facturas</h6>
                                    <small class="text-muted">CU-001</small>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/reportes" class="module-card text-decoration-none text-dark d-block">
                                    <div class="module-icon">
                                        <i class="bi bi-bar-chart"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Reportes</h6>
                                    <small class="text-muted">Análisis</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>