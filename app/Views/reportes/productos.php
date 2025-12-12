<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos - PFEP</title>
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
        
        /* Alert Cards */
        .alert-card {
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            animation: fadeInUp 0.4s ease-out;
        }
        
        .alert-card.danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c53030 100%);
            color: white;
        }
        
        .alert-card.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
            color: white;
        }
        
        .alert-card i {
            font-size: 2rem;
            margin-right: 1.5rem;
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
        
        .stat-card.products {
            border-top-color: var(--primary-color);
        }
        
        .stat-card.low-stock {
            border-top-color: var(--warning-color);
        }
        
        .stat-card.selling {
            border-top-color: var(--success-color);
        }
        
        .stat-card.profit {
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
        
        /* Secondary Stats */
        .secondary-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .secondary-stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 3px solid var(--accent-color);
            transition: var(--transition);
        }
        
        .secondary-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .secondary-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .secondary-stat-title {
            font-size: 0.8rem;
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
        
        .table tbody tr.low-stock {
            background-color: #fef2f2;
        }
        
        .table tbody tr.high-profit {
            background-color: #f0fdf4;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
        }
        
        /* Profit Margins */
        .margin-excellent { color: var(--success-color); font-weight: bold; }
        .margin-good { color: #0ea5e9; font-weight: bold; }
        .margin-regular { color: var(--warning-color); font-weight: bold; }
        .margin-low { color: var(--danger-color); font-weight: bold; }
        
        /* Progress Bars */
        .progress {
            height: 6px;
            border-radius: 3px;
            margin-top: 5px;
        }
        
        .progress-bar {
            border-radius: 3px;
        }
        
        /* Recommendations Grid */
        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .recommendation-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            border-left: 4px solid;
        }
        
        .recommendation-card.portfolio {
            border-left-color: var(--accent-color);
        }
        
        .recommendation-card.inventory {
            border-left-color: var(--warning-color);
        }
        
        .recommendation-card.pricing {
            border-left-color: var(--success-color);
        }
        
        .recommendation-card.costs {
            border-left-color: var(--primary-color);
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
        
        .stat-card, .alert-card, .card-main, .secondary-stat-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .secondary-stats {
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
            
            .secondary-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
                font-size: 0.9rem;
            }
            
            .alert-card {
                flex-direction: column;
                text-align: center;
            }
            
            .alert-card i {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .recommendations-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
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
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-boxes me-2"></i>Reporte de Productos</h1>
                    <p class="lead mb-0">Análisis de inventario, rentabilidad y desempeño de productos</p>
                </div>
                <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Reportes
                </a>
            </div>
        </div>

        <!-- Alertas Principales -->
        <?php if (!empty($bajoInventario)): ?>
        <div class="alert-card danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="flex-grow-1">
                <h5 class="mb-1">¡Alerta de Inventario Bajo!</h5>
                <p class="mb-0">Tienes <strong><?= count($bajoInventario) ?> producto(s)</strong> con inventario crítico que necesitan reposición inmediata.</p>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($productosRentables) && array_sum(array_column($productosRentables, 'utilidad_total')) > 0): ?>
        <div class="alert-card success">
            <i class="fas fa-chart-line"></i>
            <div class="flex-grow-1">
                <h5 class="mb-1">¡Desempeño Positivo!</h5>
                <p class="mb-0">Tus productos han generado <strong>$<?= number_format(array_sum(array_column($productosRentables, 'utilidad_total')), 2, ',', '.') ?></strong> en utilidades totales.</p>
            </div>
        </div>
        <?php endif; ?>

        <!-- KPIs Principales -->
        <div class="stats-grid">
            <div class="stat-card products">
                <div class="stat-icon text-primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-number text-primary"><?= $totalProductos ?? 0 ?></div>
                <div class="stat-title">Total Productos Activos</div>
                <small class="text-muted d-block mt-2">En inventario</small>
            </div>
            
            <div class="stat-card low-stock">
                <div class="stat-icon text-warning">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="stat-number text-warning"><?= count($bajoInventario ?? []) ?></div>
                <div class="stat-title">Productos con Bajo Inventario</div>
                <small class="text-muted d-block mt-2">Requieren atención</small>
            </div>
            
            <div class="stat-card selling">
                <div class="stat-icon text-success">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="stat-number text-success"><?= count($productosRentables ?? []) ?></div>
                <div class="stat-title">Productos con Ventas</div>
                <small class="text-muted d-block mt-2">Con historial de ventas</small>
            </div>
            
            <div class="stat-card profit">
                <div class="stat-icon text-info">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-info">$<?= number_format(array_sum(array_column($productosRentables ?? [], 'utilidad_total')) ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Utilidad Total Generada</div>
                <small class="text-muted d-block mt-2">Beneficio neto</small>
            </div>
        </div>

        <!-- Estadísticas Adicionales -->
        <?php if (!empty($productosRentables)): ?>
        <?php
            $totalUtilidad = array_sum(array_column($productosRentables, 'utilidad_total'));
            $totalIngresos = array_sum(array_column($productosRentables, 'total_ingresos'));
            $productoMasRentable = $productosRentables[0] ?? null;
            $productoMasVendido = null;
            $maxVendido = 0;
            
            foreach ($productosRentables as $producto) {
                if ($producto['total_vendido'] > $maxVendido) {
                    $maxVendido = $producto['total_vendido'];
                    $productoMasVendido = $producto;
                }
            }
        ?>
        <div class="secondary-stats">
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-primary">
                    <?= number_format(($totalUtilidad / $totalIngresos) * 100, 1) ?>%
                </div>
                <div class="secondary-stat-title">Margen Neto Promedio</div>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-success">
                    $<?= number_format($totalIngresos, 0, ',', '.') ?>
                </div>
                <div class="secondary-stat-title">Ingresos Totales</div>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-info">
                    <?= $productoMasVendido ? $productoMasVendido['total_vendido'] : '0' ?>
                </div>
                <div class="secondary-stat-title">Producto Más Vendido</div>
                <small class="text-muted">(unidades)</small>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-warning">
                    $<?= number_format($productoMasRentable ? $productoMasRentable['utilidad_total'] : 0, 0, ',', '.') ?>
                </div>
                <div class="secondary-stat-title">Producto Más Rentable</div>
                <small class="text-muted">(beneficio)</small>
            </div>
        </div>
        <?php endif; ?>

        <!-- Productos con Bajo Inventario -->
        <div class="card card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-exclamation-triangle me-2"></i>Productos con Bajo Inventario</h4>
                    <span class="badge bg-danger fs-6"><?= count($bajoInventario ?? []) ?> productos críticos</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($bajoInventario)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle" style="font-size: 4rem; color: #28a745; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">¡Inventario Saludable!</h4>
                        <p class="text-muted">Todos los productos tienen inventario suficiente</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Inventario Actual</th>
                                    <th class="text-center">Nivel de Alerta</th>
                                    <th class="text-end">Precio Unitario</th>
                                    <th class="text-end">Costo</th>
                                    <th class="text-end">Margen Unitario</th>
                                    <th class="text-center">Estado</th>
                                    <th>Acción Recomendada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bajoInventario as $producto): ?>
                                    <?php
                                        $margenUnitario = $producto['precio_unitario'] - $producto['costo'];
                                        $margenPorcentaje = ($margenUnitario / $producto['precio_unitario']) * 100;
                                        
                                        // Determinar nivel de inventario
                                        if ($producto['inventario'] <= 2) {
                                            $nivelAlerta = 'Crítico';
                                            $claseAlerta = 'bg-danger';
                                            $accion = 'Reposición URGENTE';
                                            $rowClass = 'low-stock';
                                        } elseif ($producto['inventario'] <= 5) {
                                            $nivelAlerta = 'Bajo';
                                            $claseAlerta = 'bg-warning';
                                            $accion = 'Reponer pronto';
                                            $rowClass = 'low-stock';
                                        } else {
                                            $nivelAlerta = 'Atención';
                                            $claseAlerta = 'bg-info';
                                            $accion = 'Monitorear';
                                            $rowClass = '';
                                        }

                                        // Clase para el margen
                                        if ($margenPorcentaje >= 50) {
                                            $claseMargen = 'margin-excellent';
                                        } elseif ($margenPorcentaje >= 30) {
                                            $claseMargen = 'margin-good';
                                        } elseif ($margenPorcentaje >= 15) {
                                            $claseMargen = 'margin-regular';
                                        } else {
                                            $claseMargen = 'margin-low';
                                        }
                                    ?>
                                    <tr class="<?= $rowClass ?>">
                                        <td>
                                            <div class="fw-bold"><?= esc($producto['nombre']) ?></div>
                                            <?php if (!empty($producto['descripcion'])): ?>
                                                <small class="text-muted"><?= esc($producto['descripcion']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-danger fs-6"><?= $producto['inventario'] ?> und.</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge <?= $claseAlerta ?>"><?= $nivelAlerta ?></span>
                                        </td>
                                        <td class="text-end fw-bold">
                                            $<?= number_format($producto['precio_unitario'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-end">
                                            $<?= number_format($producto['costo'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-end">
                                            <span class="<?= $claseMargen ?>">
                                                $<?= number_format($margenUnitario, 2, ',', '.') ?>
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                (<?= number_format($margenPorcentaje, 1) ?>%)
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-warning">Necesita reposición</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger"><?= $accion ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Productos Más Rentables -->
        <div class="card card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-chart-line me-2"></i>Análisis de Rentabilidad por Producto</h4>
                    <span class="badge bg-success fs-6"><?= count($productosRentables ?? []) ?> productos con ventas</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($productosRentables)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-box" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay datos de rentabilidad</h4>
                        <p class="text-muted">No se encontraron productos con ventas registradas</p>
                        <a href="<?= url_to('productos_index') ?>" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle me-2"></i>Gestionar Productos
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end">Costo</th>
                                    <th class="text-center">Margen Bruto</th>
                                    <th class="text-center">Margen %</th>
                                    <th class="text-center">Total Vendido</th>
                                    <th class="text-end">Ingresos Totales</th>
                                    <th class="text-end">Utilidad Total</th>
                                    <th class="text-center">Rentabilidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productosRentables as $index => $producto): ?>
                                    <?php
                                        // Determinar clasificación de rentabilidad
                                        if ($producto['margen_porcentaje'] >= 50) {
                                            $claseRentabilidad = 'margin-excellent';
                                            $nivelRentabilidad = 'Excelente';
                                            $badgeRentabilidad = 'bg-success';
                                        } elseif ($producto['margen_porcentaje'] >= 30) {
                                            $claseRentabilidad = 'margin-good';
                                            $nivelRentabilidad = 'Bueno';
                                            $badgeRentabilidad = 'bg-info';
                                        } elseif ($producto['margen_porcentaje'] >= 15) {
                                            $claseRentabilidad = 'margin-regular';
                                            $nivelRentabilidad = 'Regular';
                                            $badgeRentabilidad = 'bg-warning';
                                        } else {
                                            $claseRentabilidad = 'margin-low';
                                            $nivelRentabilidad = 'Bajo';
                                            $badgeRentabilidad = 'bg-danger';
                                        }

                                        // Porcentaje de contribución a la utilidad total
                                        $porcentajeContribucion = $totalUtilidad > 0 ? ($producto['utilidad_total'] / $totalUtilidad) * 100 : 0;
                                    ?>
                                    <tr class="<?= $index == 0 ? 'high-profit' : '' ?>">
                                        <td>
                                            <div class="fw-bold"><?= esc($producto['nombre']) ?></div>
                                            <?php if ($index == 0): ?>
                                                <small class="text-warning"><i class="fas fa-trophy"></i> Producto más rentable</small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end fw-bold">
                                            $<?= number_format($producto['precio_unitario'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-end">
                                            $<?= number_format($producto['costo'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center fw-bold <?= $claseRentabilidad ?>">
                                            $<?= number_format($producto['margen_bruto'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge <?= $badgeRentabilidad ?>">
                                                <?= number_format($producto['margen_porcentaje'], 1) ?>%
                                            </span>
                                        </td>
                                        <td class="text-center fw-bold text-primary">
                                            <?= number_format($producto['total_vendido'], 0, ',', '.') ?> und.
                                        </td>
                                        <td class="text-end">
                                            $<?= number_format($producto['total_ingresos'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-end fw-bold fs-6 text-success">
                                            $<?= number_format($producto['utilidad_total'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="status-badge <?= $badgeRentabilidad ?>">
                                                <?= $nivelRentabilidad ?>
                                            </span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" 
                                                     style="width: <?= min($porcentajeContribucion * 3, 100) ?>%"
                                                     title="<?= number_format($porcentajeContribucion, 1) ?>% de la utilidad total">
                                                </div>
                                            </div>
                                            <small class="text-muted"><?= number_format($porcentajeContribucion, 1) ?>%</small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <td colspan="6" class="text-end fw-bold">TOTALES:</td>
                                    <td class="text-end fw-bold">
                                        $<?= number_format($totalIngresos, 2, ',', '.') ?>
                                    </td>
                                    <td class="text-end fw-bold fs-5 text-success">
                                        $<?= number_format($totalUtilidad, 2, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">100%</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Análisis y Recomendaciones -->
        <?php if (!empty($productosRentables)): ?>
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-lightbulb me-2"></i>Análisis Estratégico y Recomendaciones</h4>
            </div>
            <div class="card-body">
                <div class="recommendations-grid">
                    <div class="recommendation-card portfolio">
                        <h6><i class="fas fa-chart-pie me-2"></i>Análisis de Portafolio</h6>
                        <p class="mb-2">
                            El <strong>20% de tus productos</strong> (<?= ceil(count($productosRentables) * 0.2) ?> productos) 
                            generan aproximadamente el <strong>80% de tus utilidades</strong>.
                        </p>
                        <small class="text-muted">Enfoca tus esfuerzos en estos productos clave.</small>
                    </div>
                    
                    <div class="recommendation-card inventory">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Gestión de Inventario</h6>
                        <p class="mb-2">
                            <strong><?= count($bajoInventario ?? []) ?> productos</strong> requieren atención inmediata 
                            en su inventario.
                        </p>
                        <small class="text-muted">Evita pérdidas por falta de stock en productos rentables.</small>
                    </div>
                    
                    <div class="recommendation-card pricing">
                        <h6><i class="fas fa-tags me-2"></i>Oportunidades de Precio</h6>
                        <p class="mb-2">
                            Productos con margen superior al <strong>50%</strong> tienen potencial 
                            para estrategias de promoción.
                        </p>
                        <small class="text-muted">Considera bundling o descuentos estratégicos.</small>
                    </div>
                    
                    <div class="recommendation-card costs">
                        <h6><i class="fas fa-calculator me-2"></i>Optimización de Costos</h6>
                        <p class="mb-2">
                            Productos con margen inferior al <strong>15%</strong> necesitan revisión 
                            de costos o precios.
                        </p>
                        <small class="text-muted">Analiza alternativas de proveedores o ajusta precios.</small>
                    </div>
                </div>

                <!-- Resumen de Segmentos de Rentabilidad -->
                <h5 class="mt-4 mb-3">Distribución por Nivel de Rentabilidad:</h5>
                <div class="secondary-stats">
                    <?php
                    $segmentosRentabilidad = [
                        'Excelente' => ['min' => 50, 'count' => 0, 'color' => 'success'],
                        'Bueno' => ['min' => 30, 'count' => 0, 'color' => 'info'],
                        'Regular' => ['min' => 15, 'count' => 0, 'color' => 'warning'],
                        'Bajo' => ['min' => 0, 'count' => 0, 'color' => 'danger']
                    ];

                    foreach ($productosRentables as $producto) {
                        if ($producto['margen_porcentaje'] >= 50) {
                            $segmentosRentabilidad['Excelente']['count']++;
                        } elseif ($producto['margen_porcentaje'] >= 30) {
                            $segmentosRentabilidad['Bueno']['count']++;
                        } elseif ($producto['margen_porcentaje'] >= 15) {
                            $segmentosRentabilidad['Regular']['count']++;
                        } else {
                            $segmentosRentabilidad['Bajo']['count']++;
                        }
                    }
                    ?>

                    <?php foreach ($segmentosRentabilidad as $segmento => $data): ?>
                        <div class="secondary-stat-card">
                            <div class="secondary-stat-number text-<?= $data['color'] ?>">
                                <?= $data['count'] ?>
                            </div>
                            <div class="secondary-stat-title"><?= $segmento ?></div>
                            <small class="text-muted">> <?= $data['min'] ?>% margen</small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Efecto de carga suave para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card, .alert-card, .secondary-stat-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Tooltips para las barras de progreso
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Resaltar productos críticos
            const productosCriticos = document.querySelectorAll('.low-stock');
            productosCriticos.forEach(producto => {
                const inventario = parseInt(producto.querySelector('.badge.bg-danger').textContent);
                if (inventario <= 2) {
                    producto.style.backgroundColor = '#fef2f2';
                    producto.style.borderLeft = '4px solid #dc3545';
                }
            });
        });
    </script>
</body>
</html>