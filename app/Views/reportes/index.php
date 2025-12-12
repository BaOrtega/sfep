<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Análisis - PFEP</title>
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
        
        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border-radius: var(--border-radius);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: var(--box-shadow);
        }
        
        .page-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-header .lead {
            opacity: 0.9;
            margin-bottom: 0;
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
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card.revenue {
            border-top-color: var(--primary-color);
        }
        
        .stat-card.clients {
            border-top-color: var(--success-color);
        }
        
        .stat-card.products {
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
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Distribution Cards */
        .distribution-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .distribution-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            box-shadow: var(--box-shadow);
            border-top: 4px solid;
            transition: var(--transition);
        }
        
        .distribution-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .distribution-card.paid {
            border-top-color: var(--success-color);
        }
        
        .distribution-card.issued {
            border-top-color: var(--warning-color);
        }
        
        .distribution-card.cancelled {
            border-top-color: var(--danger-color);
        }
        
        .distribution-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .distribution-title {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        /* Main Card */
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
        
        /* Report Cards Grid */
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .report-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border-left: 4px solid;
            height: 100%;
        }
        
        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .report-card.sales {
            border-left-color: var(--primary-color);
        }
        
        .report-card.receivables {
            border-left-color: var(--warning-color);
        }
        
        .report-card.clients {
            border-left-color: var(--accent-color);
        }
        
        .report-card.products {
            border-left-color: var(--success-color);
        }
        
        .report-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .report-card p {
            color: #64748b;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        
        .report-card .btn {
            width: 100%;
        }
        
        /* Rank Badges */
        .rank-badge {
            padding: 0.5rem 1rem;
            font-weight: 700;
            border-radius: 6px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
        
        .rank-1 {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: #333;
        }
        
        .rank-2 {
            background: linear-gradient(135deg, #adb5bd 0%, #868e96 100%);
            color: white;
        }
        
        .rank-3 {
            background: linear-gradient(135deg, #cd7f32 0%, #b06c2c 100%);
            color: white;
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
        
        .stat-card, .distribution-card, .card-main, .report-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .distribution-card:nth-child(2) { animation-delay: 0.1s; }
        .distribution-card:nth-child(3) { animation-delay: 0.2s; }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .reports-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .page-header {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            :root {
                --main-padding: 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .page-header {
                padding: 1.25rem;
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
            
            .distribution-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .reports-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .report-card {
                padding: 1.5rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .distribution-grid {
                grid-template-columns: 1fr;
            }
            
            .card-header-custom h4 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-chart-bar me-2"></i>Reportes y Análisis</h1>
            <p class="lead mb-0">Métricas y análisis detallados de tu negocio</p>
        </div>

        <!-- KPIs Principales -->
        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-icon text-primary">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-primary">$<?= number_format($kpi_total_facturado ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Total Facturado (Pagado)</div>
                <small class="text-muted d-block mt-2">Ingresos confirmados</small>
            </div>
            
            <div class="stat-card clients">
                <div class="stat-icon text-success">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number text-success"><?= esc($kpi_total_clientes ?? 0) ?></div>
                <div class="stat-title">Total Clientes</div>
                <small class="text-muted d-block mt-2">Registrados en el sistema</small>
            </div>
            
            <div class="stat-card products">
                <div class="stat-icon text-info">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-number text-info"><?= count($topProductos ?? []) ?></div>
                <div class="stat-title">Productos Activos en Ranking</div>
                <small class="text-muted d-block mt-2">Con ventas registradas</small>
            </div>
        </div>

        <!-- Distribución por Estados -->
        <?php if (!empty($distribucionEstados)): ?>
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-chart-pie me-2"></i>Distribución por Estados</h4>
            </div>
            <div class="card-body p-4">
                <div class="distribution-grid">
                    <?php foreach ($distribucionEstados as $estado): ?>
                        <div class="distribution-card <?= strtolower($estado['estado']) ?>">
                            <div class="distribution-number 
                                <?= $estado['estado'] == 'PAGADA' ? 'text-success' : 
                                   ($estado['estado'] == 'EMITIDA' ? 'text-warning' : 'text-danger') ?>">
                                <?= $estado['cantidad'] ?>
                            </div>
                            <div class="distribution-title">Facturas <?= $estado['estado'] ?></div>
                            <small class="text-muted">
                                $<?= number_format($estado['monto_total'] ?? 0, 0, ',', '.') ?>
                            </small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Estadísticas Mensuales -->
        <?php if (!empty($estadisticasMensuales)): ?>
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-calendar-alt me-2"></i>Estadísticas Mensuales</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Mes/Año</th>
                                <th class="text-center">Total Facturas</th>
                                <th class="text-end">Total Ventas</th>
                                <th class="text-end">Promedio Venta</th>
                                <th class="text-end">Total Impuestos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($estadisticasMensuales as $mes): ?>
                                <tr>
                                    <td class="fw-bold">
                                        <?= 
                                            [
                                                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                            ][$mes['mes']] . ' ' . $mes['año'] 
                                        ?>
                                    </td>
                                    <td class="text-center"><?= $mes['total_facturas'] ?></td>
                                    <td class="text-end fw-bold text-success">
                                        $<?= number_format($mes['total_ventas'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-end">
                                        $<?= number_format($mes['promedio_venta'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-end text-info">
                                        $<?= number_format($mes['total_impuestos'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Reportes Disponibles -->
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-chart-line me-2"></i>Reportes Disponibles</h4>
            </div>
            <div class="card-body p-4">
                <div class="reports-grid">
                    <div class="report-card sales">
                        <h5><i class="fas fa-dollar-sign me-2"></i>Reporte de Ventas</h5>
                        <p class="text-muted">Analiza las ventas por período, estado y cliente con filtros avanzados y exportación a PDF.</p>
                        <a href="<?= url_to('reportes_ventas') ?>" class="btn btn-primary">
                            <i class="fas fa-chart-bar me-2"></i>Ver Reporte
                        </a>
                    </div>
                    
                    <div class="report-card receivables">
                        <h5><i class="fas fa-clock me-2"></i>Cuentas por Cobrar</h5>
                        <p class="text-muted">Facturas pendientes de pago, alertas de vencimiento y análisis de cartera de cobros.</p>
                        <a href="<?= url_to('reportes_cxc') ?>" class="btn btn-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>Ver Reporte
                        </a>
                    </div>
                    
                    <div class="report-card clients">
                        <h5><i class="fas fa-users me-2"></i>Reporte de Clientes</h5>
                        <p class="text-muted">Top clientes, segmentación por valor de compras y análisis de comportamiento.</p>
                        <a href="<?= url_to('reportes_clientes') ?>" class="btn btn-info">
                            <i class="fas fa-user-chart me-2"></i>Ver Reporte
                        </a>
                    </div>
                    
                    <div class="report-card products">
                        <h5><i class="fas fa-box me-2"></i>Reporte de Productos</h5>
                        <p class="text-muted">Inventario, rentabilidad, productos más vendidos y alertas de stock bajo.</p>
                        <a href="<?= url_to('reportes_productos') ?>" class="btn btn-success">
                            <i class="fas fa-box-open me-2"></i>Ver Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Productos -->
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-trophy me-2"></i>Top 5 Productos Más Vendidos</h4>
            </div>
            <div class="card-body p-0">
                <?php if (empty($topProductos)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-chart-bar" style="font-size: 4rem; color: #94a3b8; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay datos disponibles</h4>
                        <p class="text-muted">No hay datos de ventas para mostrar el ranking de productos.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Rank</th>
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad Vendida</th>
                                    <th class="text-end">Ingresos Generados</th>
                                    <th class="text-center">Facturas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rank = 1; ?>
                                <?php foreach ($topProductos as $producto): ?>
                                    <tr>
                                        <td class="text-center">
                                            <span class="rank-badge 
                                                <?= ($rank == 1) ? 'rank-1' : (($rank == 2) ? 'rank-2' : (($rank == 3) ? 'rank-3' : 'bg-secondary')) ?>">
                                                <?= $rank++ ?>
                                            </span>
                                        </td>
                                        <td class="fw-bold"><?= esc($producto['nombre_producto']) ?></td>
                                        <td class="text-center fw-bold text-success">
                                            <?= number_format($producto['total_cantidad_vendida'], 0, ',', '.') ?> und.
                                        </td>
                                        <td class="text-end fw-bold text-primary">
                                            $<?= number_format($producto['total_ingresos_generados'], 0, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info"><?= $producto['total_facturas'] ?? 0 ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Efecto de carga suave para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card, .distribution-card, .report-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Efecto hover para las tarjetas de reportes
            const reportCards = document.querySelectorAll('.report-card');
            reportCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const btn = this.querySelector('.btn');
                    if (btn) {
                        btn.style.transform = 'translateY(-2px)';
                        btn.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    const btn = this.querySelector('.btn');
                    if (btn) {
                        btn.style.transform = 'translateY(0)';
                        btn.style.boxShadow = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>