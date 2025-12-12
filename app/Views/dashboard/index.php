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
        :root {
            --sidebar-width: 280px;
            --main-padding: 30px;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: var(--main-padding);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-center {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid;
            transition: all 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 180px;
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
        
        .stat-card.sales {
            border-left-color: #6f42c1;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1;
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .quick-actions-horizontal {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 25px;
        }
        
        .btn-action-horizontal {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 20px 15px;
            border-radius: 15px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }
        
        .btn-action-horizontal:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn-action-horizontal i {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .btn-action-horizontal span {
            font-weight: 600;
            font-size: 1rem;
        }
        
        /* Opciones de admin en sidebar */
        .admin-only {
            border-left: 3px solid #dc3545;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }
        
        .admin-only-title {
            color: #dc3545;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            padding-left: 15px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .quick-actions-horizontal {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .welcome-card {
                padding: 25px;
            }
            
            .quick-actions-horizontal {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .menu-toggle {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1001;
                background: rgba(255, 255, 255, 0.9);
                border: none;
                border-radius: 8px;
                padding: 8px 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Menu Toggle Mobile -->
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #e9ecef; margin: 20px 0;">
        <nav>
            <div class="nav-item">
                <a href="<?= url_to('dashboard') ?>" class="active">
                    <i class="bi bi-house me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes_index') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos_index') ?>">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('facturas_index') ?>">
                    <i class="bi bi-receipt me-3"></i>Factura
                </a>
            </div>
            
            <?php if (session()->get('rol') === 'admin'): ?>
            <!-- Sección solo para administradores -->
            <div class="admin-only">
                <div class="admin-only-title">
                    <i class="bi bi-shield-lock me-1"></i> Administración
                </div>
                <div class="nav-item">
                    <a href="<?= url_to('reportes_index') ?>">
                        <i class="bi bi-bar-chart me-3"></i>Reportes y Análisis
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?= url_to('usuarios_index') ?>">
                        <i class="bi bi-people-fill me-3"></i>Usuarios
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </nav>
        
        <div class="user-info">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <p class="mb-1 fw-bold"><?= esc(session()->get('user_name')) ?></p>
                    <small class="text-muted">
                        <?= session()->get('rol') === 'admin' ? 'Administrador' : 'Vendedor' ?>
                    </small>
                </div>
                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="d-grid gap-2">
                <a href="<?= url_to('profile') ?>" class="btn btn-outline-primary">
                    <i class="bi bi-person-circle me-2"></i>Mi Perfil
                </a>
                <a href="<?= url_to('logout') ?>" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-center">
            <!-- Tarjeta de Bienvenida -->
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-3">👋 ¡Bienvenido, <?= esc(session()->get('user_name')) ?>!</h1>
                        <p class="mb-4 opacity-90">
                            <?php if (session()->get('rol') === 'admin'): ?>
                                Administrador del Sistema de Facturación Electrónica
                            <?php else: ?>
                                Vendedor del Sistema de Facturación Electrónica
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-<?= session()->get('rol') === 'admin' ? 'shield-check' : 'person-badge' ?>" 
                           style="font-size: 6rem; opacity: 0.8;"></i>
                    </div>
                </div>
                
                <!-- Acciones Rápidas en Fila -->
                <div class="quick-actions-horizontal">
                    <a href="<?= url_to('clientes_index') ?>" class="btn-action-horizontal">
                        <i class="bi bi-people"></i>
                        <span>Gestionar Clientes</span>
                    </a>
                    <a href="<?= url_to('facturas_index') ?>" class="btn-action-horizontal">
                        <i class="bi bi-receipt"></i>
                        <span>Crear Factura</span>
                    </a>
                    <a href="<?= url_to('productos_index') ?>" class="btn-action-horizontal">
                        <i class="bi bi-box-seam"></i>
                        <span>Ver Productos</span>
                    </a>
                    
                    <?php if (session()->get('rol') === 'admin'): ?>
                    <a href="<?= url_to('reportes_index') ?>" class="btn-action-horizontal">
                        <i class="bi bi-bar-chart"></i>
                        <span>Ver Reportes</span>
                    </a>
                    <?php else: ?>
                    <a href="<?= url_to('profile') ?>" class="btn-action-horizontal">
                        <i class="bi bi-person-circle"></i>
                        <span>Mi Perfil</span>
                    </a>
                    <?php endif; ?>
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
                    <div class="stat-number text-warning"><?= $totalProductos ?></div>
                    <div class="stat-title">Productos en Inventario</div>
                </div>
                
                <div class="stat-card invoices">
                    <div class="stat-icon text-danger">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="stat-number text-danger"><?= $totalFacturas ?? 0 ?></div>
                    <div class="stat-title">Facturas Emitidas</div>
                </div>
                
                <div class="stat-card sales">
                    <div class="stat-icon text-primary">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="stat-number text-primary">$<?= number_format($totalVentas ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-title">Ventas Totales</div>
                </div>
            </div>

            <!-- Facturas Recientes -->
            <?php if (isset($facturasRecientes) && !empty($facturasRecientes)): ?>
            <div class="card card-main">
                <div class="card-header-custom">
                    <h4><i class="bi bi-clock-history me-2"></i>Facturas Recientes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturasRecientes as $factura): ?>
                                <tr>
                                    <td>#<?= $factura['id'] ?></td>
                                    <td><?= esc($factura['cliente_nombre'] ?? 'N/A') ?></td>
                                    <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                    <td>$<?= number_format($factura['total_factura'], 2, ',', '.') ?></td>
                                    <td>
                                        <span class="badge bg-<?= 
                                            $factura['estado'] == 'PAGADA' ? 'success' : 
                                            ($factura['estado'] == 'EMITIDA' ? 'warning' : 'danger')
                                        ?>">
                                            <?= $factura['estado'] ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle menu para móviles
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Cerrar menú al hacer clic fuera en móviles
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>