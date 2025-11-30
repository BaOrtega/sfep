<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos - PFEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .kpi-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .kpi-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .kpi-title {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .table th {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        .table td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        .alert-inventario {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-rentable {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .progress {
            height: 8px;
            margin-top: 5px;
        }
        .inventario-bajo { background-color: #fff5f5; border-left: 4px solid #dc3545; }
        .inventario-medio { background-color: #fffbf0; border-left: 4px solid #ffc107; }
        .inventario-alto { background-color: #f0f9ff; border-left: 4px solid #28a745; }
        .margen-excelente { color: #28a745; font-weight: bold; }
        .margen-bueno { color: #20c997; font-weight: bold; }
        .margen-regular { color: #ffc107; font-weight: bold; }
        .margen-bajo { color: #dc3545; font-weight: bold; }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-top: 4px solid #17a2b8;
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-3px);
        }
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stats-title {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
        }
        .producto-destacado {
            background: linear-gradient(135deg, #fffbf0, #fff5f5);
            border-left: 4px solid #ffc107;
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
                <a href="<?= url_to('dashboard') ?>">
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
                    <i class="bi bi-receipt me-3"></i>Facturas
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('reportes_index') ?>" class="active">
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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-white mb-2">📦 Reporte de Productos</h1>
                <p class="text-white opacity-90 mb-0">Análisis de inventario, rentabilidad y desempeño de productos</p>
            </div>
            <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver a Reportes
            </a>
        </div>

        <!-- Alertas Principales -->
        <?php if (!empty($bajoInventario)): ?>
        <div class="alert-inventario">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="mb-1">¡Alerta de Inventario Bajo!</h5>
                    <p class="mb-0">Tienes <strong><?= count($bajoInventario) ?> producto(s)</strong> con inventario crítico que necesitan reposición inmediata.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($productosRentables) && array_sum(array_column($productosRentables, 'utilidad_total')) > 0): ?>
        <div class="alert-rentable">
            <div class="d-flex align-items-center">
                <i class="bi bi-graph-up-arrow me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="mb-1">¡Desempeño Positivo!</h5>
                    <p class="mb-0">Tus productos han generado <strong>$<?= number_format(array_sum(array_column($productosRentables, 'utilidad_total')), 2, ',', '.') ?></strong> en utilidades totales.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- KPIs Principales -->
        <div class="row">
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-primary">
                        <?= $totalProductos ?>
                    </div>
                    <div class="kpi-title">Total Productos Activos</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-warning">
                        <?= count($bajoInventario) ?>
                    </div>
                    <div class="kpi-title">Productos con Bajo Inventario</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-success">
                        <?= count($productosRentables) ?>
                    </div>
                    <div class="kpi-title">Productos con Ventas</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-info">
                        $<?= number_format(array_sum(array_column($productosRentables, 'utilidad_total')) ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Utilidad Total Generada</div>
                </div>
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
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-primary">
                        <?= number_format(($totalUtilidad / $totalIngresos) * 100, 1) ?>%
                    </div>
                    <div class="stats-title">Margen Neto Promedio</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-success">
                        $<?= number_format($totalIngresos, 2, ',', '.') ?>
                    </div>
                    <div class="stats-title">Ingresos Totales</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-info">
                        <?= $productoMasVendido ? $productoMasVendido['total_vendido'] : '0' ?>
                    </div>
                    <div class="stats-title">Producto Más Vendido (und)</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-warning">
                        $<?= number_format($productoMasRentable ? $productoMasRentable['utilidad_total'] : 0, 2, ',', '.') ?>
                    </div>
                    <div class="stats-title">Producto Más Rentable ($)</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Productos con Bajo Inventario -->
        <div class="card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Productos con Bajo Inventario</h3>
                    <span class="badge bg-danger fs-6"><?= count($bajoInventario) ?> productos críticos</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($bajoInventario)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle" style="font-size: 4rem; color: #28a745; opacity: 0.5;"></i>
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
                                        } elseif ($producto['inventario'] <= 5) {
                                            $nivelAlerta = 'Bajo';
                                            $claseAlerta = 'bg-warning';
                                            $accion = 'Reponer pronto';
                                        } else {
                                            $nivelAlerta = 'Atención';
                                            $claseAlerta = 'bg-info';
                                            $accion = 'Monitorear';
                                        }

                                        // Clase para el margen
                                        if ($margenPorcentaje >= 50) {
                                            $claseMargen = 'margen-excelente';
                                        } elseif ($margenPorcentaje >= 30) {
                                            $claseMargen = 'margen-bueno';
                                        } elseif ($margenPorcentaje >= 15) {
                                            $claseMargen = 'margen-regular';
                                        } else {
                                            $claseMargen = 'margen-bajo';
                                        }
                                    ?>
                                    <tr class="inventario-bajo">
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
                                            <span class="badge <?= $claseAlerta ?>"><?= $nivelAlerta ?></span>
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
        <div class="card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="bi bi-graph-up-arrow me-2"></i>Análisis de Rentabilidad por Producto</h3>
                    <span class="badge bg-success fs-6"><?= count($productosRentables) ?> productos con ventas</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($productosRentables)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-box" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay datos de rentabilidad</h4>
                        <p class="text-muted">No se encontraron productos con ventas registradas</p>
                        <a href="<?= url_to('productos_index') ?>" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle me-2"></i>Gestionar Productos
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
                                            $claseRentabilidad = 'margen-excelente';
                                            $nivelRentabilidad = 'Excelente';
                                            $badgeRentabilidad = 'bg-success';
                                        } elseif ($producto['margen_porcentaje'] >= 30) {
                                            $claseRentabilidad = 'margen-bueno';
                                            $nivelRentabilidad = 'Bueno';
                                            $badgeRentabilidad = 'bg-info';
                                        } elseif ($producto['margen_porcentaje'] >= 15) {
                                            $claseRentabilidad = 'margen-regular';
                                            $nivelRentabilidad = 'Regular';
                                            $badgeRentabilidad = 'bg-warning';
                                        } else {
                                            $claseRentabilidad = 'margen-bajo';
                                            $nivelRentabilidad = 'Bajo';
                                            $badgeRentabilidad = 'bg-danger';
                                        }

                                        // Porcentaje de contribución a la utilidad total
                                        $porcentajeContribucion = $totalUtilidad > 0 ? ($producto['utilidad_total'] / $totalUtilidad) * 100 : 0;
                                    ?>
                                    <tr class="<?= $index == 0 ? 'producto-destacado' : '' ?>">
                                        <td>
                                            <div class="fw-bold"><?= esc($producto['nombre']) ?></div>
                                            <?php if ($index == 0): ?>
                                                <small class="text-warning"><i class="bi bi-trophy-fill"></i> Producto más rentable</small>
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
                                            <span class="badge <?= $badgeRentabilidad ?>">
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
                                            <span class="badge <?= $badgeRentabilidad ?>">
                                                <?= $nivelRentabilidad ?>
                                            </span>
                                            <div class="progress mt-1" style="height: 4px;">
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
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Análisis Estratégico y Recomendaciones</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-bar-chart me-2"></i>Análisis de Portafolio</h6>
                            <p class="mb-2">
                                El <strong>20% de tus productos</strong> (<?= ceil(count($productosRentables) * 0.2) ?> productos) 
                                generan aproximadamente el <strong>80% de tus utilidades</strong>.
                            </p>
                            <small class="text-muted">Enfoca tus esfuerzos en estos productos clave.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            <h6><i class="bi bi-exclamation-triangle me-2"></i>Gestión de Inventario</h6>
                            <p class="mb-2">
                                <strong><?= count($bajoInventario) ?> productos</strong> requieren atención inmediata 
                                en su inventario.
                            </p>
                            <small class="text-muted">Evita pérdidas por falta de stock en productos rentables.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="bi bi-arrow-up-circle me-2"></i>Oportunidades de Precio</h6>
                            <p class="mb-2">
                                Productos con margen superior al <strong>50%</strong> tienen potencial 
                                para estrategias de promoción.
                            </p>
                            <small class="text-muted">Considera bundling o descuentos estratégicos.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-primary">
                            <h6><i class="bi bi-graph-up me-2"></i>Optimización de Costos</h6>
                            <p class="mb-2">
                                Productos con margen inferior al <strong>15%</strong> necesitan revisión 
                                de costos o precios.
                            </p>
                            <small class="text-muted">Analiza alternativas de proveedores o ajusta precios.</small>
                        </div>
                    </div>
                </div>

                <!-- Resumen de Segmentos de Rentabilidad -->
                <h5 class="mt-4 mb-3">Distribución por Nivel de Rentabilidad:</h5>
                <div class="row text-center">
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
                        <div class="col-md-3 mb-3">
                            <div class="border rounded p-3">
                                <div class="text-<?= $data['color'] ?> fw-bold fs-4">
                                    <?= $data['count'] ?>
                                </div>
                                <div class="text-muted"><?= $segmento ?></div>
                                <small>> <?= $data['min'] ?>% margen</small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tooltips para las barras de progreso
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Resaltar productos críticos
        document.addEventListener('DOMContentLoaded', function() {
            const productosCriticos = document.querySelectorAll('.inventario-bajo');
            productosCriticos.forEach(producto => {
                const inventario = parseInt(producto.querySelector('.badge.bg-danger').textContent);
                if (inventario <= 2) {
                    producto.style.backgroundColor = '#fff5f5';
                    producto.style.borderLeft = '4px solid #dc3545';
                }
            });
        });
    </script>
</body>
</html>