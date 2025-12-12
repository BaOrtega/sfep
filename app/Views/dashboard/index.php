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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a5fb4;
            --secondary-color: #2d3748;
            --accent-color: #0ea5e9;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --main-padding: 2rem;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--dark-color);
            min-height: 100vh;
        }
        
        /* Main Content */
        .main-content {
            padding: var(--main-padding);
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Welcome Card */
        .welcome-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            border-left: 5px solid var(--primary-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(26, 95, 180, 0.05) 0%, rgba(14, 165, 233, 0.05) 100%);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }
        
        .welcome-card h1 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .welcome-card .lead {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        /* User Info in Welcome Card */
        .user-welcome-info {
            background: linear-gradient(135deg, rgba(26, 95, 180, 0.1) 0%, rgba(14, 165, 233, 0.1) 100%);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .user-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }
        
        .user-badge {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
        }
        
        /* Quick Actions */
        .quick-actions-horizontal {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }
        
        .btn-action-horizontal {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 1.75rem 1.25rem;
            text-decoration: none;
            text-align: center;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .btn-action-horizontal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .btn-action-horizontal:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(26, 95, 180, 0.15);
        }
        
        .btn-action-horizontal:hover::before {
            transform: scaleX(1);
        }
        
        .btn-action-horizontal i {
            font-size: 2.25rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            transition: var(--transition);
        }
        
        .btn-action-horizontal:hover i {
            color: var(--accent-color);
            transform: scale(1.1);
        }
        
        .btn-action-horizontal span {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1rem;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-top: 4px solid transparent;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(26, 95, 180, 0.02) 100%);
            opacity: 0;
            transition: var(--transition);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card:hover::before {
            opacity: 1;
        }
        
        .stat-card.clients {
            border-top-color: var(--success-color);
        }
        
        .stat-card.products {
            border-top-color: var(--warning-color);
        }
        
        .stat-card.invoices {
            border-top-color: var(--danger-color);
        }
        
        .stat-card.sales {
            border-top-color: var(--accent-color);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1.25rem;
            opacity: 0.9;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Recent Invoices Card */
        .card-main {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2.5rem;
            transition: var(--transition);
        }
        
        .card-main:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }
        
        .card-header-custom h4 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .card-header-custom i {
            margin-right: 0.75rem;
        }
        
        /* Table Styles */
        .table-responsive {
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            overflow: hidden;
        }
        
        .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            transition: var(--transition);
        }
        
        .table tbody tr {
            transition: var(--transition);
        }
        
        .table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        .table tbody tr:hover td {
            transform: translateX(5px);
        }
        
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .quick-actions-horizontal {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .welcome-card {
                padding: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            :root {
                --main-padding: 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .welcome-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .quick-actions-horizontal {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-top: 1.5rem;
            }
            
            .btn-action-horizontal {
                padding: 1.25rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .welcome-card h1 {
                font-size: 1.5rem;
            }
            
            .user-badges {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-badge {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .welcome-card, .stat-card, .card-main {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Card with User Info -->
        <div class="welcome-card">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h1 class="display-6 mb-3">👋 ¡Bienvenido, <?= esc(session()->get('user_name')) ?>!</h1>
                    <p class="lead mb-0">
                        <?php if (session()->get('rol') === 'admin'): ?>
                            Panel de Control Administrativo - Sistema de Facturación Electrónica
                        <?php else: ?>
                            Panel de Vendedor - Sistema de Facturación Electrónica
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                    <div class="bg-primary bg-opacity-10 d-inline-block p-4 rounded-circle">
                        <i class="fas fa-<?= session()->get('rol') === 'admin' ? 'shield-alt' : 'user-tie' ?> fa-3x text-primary"></i>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions-horizontal">
                <a href="<?= url_to('clientes_index') ?>" class="btn-action-horizontal">
                    <i class="fas fa-users"></i>
                    <span>Gestionar Clientes</span>
                </a>
                <a href="<?= url_to('facturas_index') ?>" class="btn-action-horizontal">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Crear Factura</span>
                </a>
                <a href="<?= url_to('productos_index') ?>" class="btn-action-horizontal">
                    <i class="fas fa-boxes"></i>
                    <span>Ver Productos</span>
                </a>
                
                <?php if (session()->get('rol') === 'admin'): ?>
                <a href="<?= url_to('reportes_index') ?>" class="btn-action-horizontal">
                    <i class="fas fa-chart-bar"></i>
                    <span>Ver Reportes</span>
                </a>
                <?php else: ?>
                <a href="<?= url_to('profile') ?>" class="btn-action-horizontal">
                    <i class="fas fa-user-cog"></i>
                    <span>Mi Perfil</span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card clients">
                <div class="stat-icon text-success">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="stat-number text-success"><?= $totalClientes ?></div>
                <div class="stat-title">Clientes Registrados</div>
                <small class="text-muted d-block mt-2">Últimos 30 días</small>
            </div>
            
            <div class="stat-card products">
                <div class="stat-icon text-warning">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-number text-warning"><?= $totalProductos ?></div>
                <div class="stat-title">Productos en Inventario</div>
                <small class="text-muted d-block mt-2">Stock disponible</small>
            </div>
            
            <div class="stat-card invoices">
                <div class="stat-icon text-danger">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-number text-danger"><?= $totalFacturas ?? 0 ?></div>
                <div class="stat-title">Facturas Emitidas</div>
                <small class="text-muted d-block mt-2">Este mes</small>
            </div>
            
            <div class="stat-card sales">
                <div class="stat-icon text-primary">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number text-primary">$<?= number_format($totalVentas ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Ventas Totales</div>
                <small class="text-muted d-block mt-2">Ingresos acumulados</small>
            </div>
        </div>

        <!-- Recent Invoices -->
        <?php if (isset($facturasRecientes) && !empty($facturasRecientes)): ?>
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-history me-2"></i>Facturas Recientes</h4>
                <small class="opacity-75 position-relative z-1">Últimas 10 facturas emitidas</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>N° Factura</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturasRecientes as $factura): ?>
                            <tr>
                                <td><strong>#<?= $factura['id'] ?></strong></td>
                                <td><?= esc($factura['cliente_nombre'] ?? 'N/A') ?></td>
                                <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                <td><strong>$<?= number_format($factura['total_factura'], 2, ',', '.') ?></strong></td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $factura['estado'] == 'PAGADA' ? 'success' : 
                                        ($factura['estado'] == 'EMITIDA' ? 'warning' : 'danger')
                                    ?> px-3 py-2">
                                        <i class="fas fa-<?= 
                                            $factura['estado'] == 'PAGADA' ? 'check-circle' : 
                                            ($factura['estado'] == 'EMITIDA' ? 'clock' : 'exclamation-circle')
                                        ?> me-1"></i>
                                        <?= $factura['estado'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="<?= url_to('facturas_index') ?>" class="btn btn-link text-decoration-none">
                    <i class="fas fa-arrow-right me-1"></i> Ver todas las facturas
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Efecto de carga suave para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card, .btn-action-horizontal');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>