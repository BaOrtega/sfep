<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Análisis - PFEP</title>
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
        .report-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .top-products-table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .top-products-table th {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 15px;
        }
        .rank-badge {
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 20px;
            color: #fff;
        }
        .rank-1 { background-color: #ffc107; color: #333; }
        .rank-2 { background-color: #adb5bd; }
        .rank-3 { background-color: #cd7f32; }
        .estado-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-top: 4px solid;
            transition: all 0.3s ease;
        }
        .estado-card:hover {
            transform: translateY(-3px);
        }
        .estado-emitida { border-top-color: #ffc107; }
        .estado-pagada { border-top-color: #28a745; }
        .estado-anulada { border-top-color: #dc3545; }
        .estado-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .estado-title {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
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
                <h1 class="text-white mb-2">📊 Reportes y Análisis</h1>
                <p class="text-white opacity-90 mb-0">Métricas y análisis detallados de tu negocio</p>
            </div>
        </div>

        <!-- KPIs Principales -->
        <div class="row">
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-primary">
                        $<?= number_format($kpi_total_facturado ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Total Facturado (Pagado)</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-success">
                        <?= esc($kpi_total_clientes ?? 0) ?>
                    </div>
                    <div class="kpi-title">Total Clientes</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-info">
                        <?= count($topProductos ?? []) ?>
                    </div>
                    <div class="kpi-title">Productos Activos en Ranking</div>
                </div>
            </div>
        </div>

        <!-- Distribución por Estados -->
        <?php if (!empty($distribucionEstados)): ?>
        <div class="card-main mt-4">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Distribución por Estados</h3>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <?php foreach ($distribucionEstados as $estado): ?>
                        <div class="col-md-4 mb-3">
                            <div class="estado-card estado-<?= strtolower($estado['estado']) ?>">
                                <div class="estado-number 
                                    <?= $estado['estado'] == 'PAGADA' ? 'text-success' : 
                                       ($estado['estado'] == 'EMITIDA' ? 'text-warning' : 'text-danger') ?>">
                                    <?= $estado['cantidad'] ?>
                                </div>
                                <div class="estado-title">Facturas <?= $estado['estado'] ?></div>
                                <small class="text-muted">
                                    $<?= number_format($estado['monto_total'] ?? 0, 2, ',', '.') ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Estadísticas Mensuales -->
        <?php if (!empty($estadisticasMensuales)): ?>
        <div class="card-main mt-4">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-calendar-month me-2"></i>Estadísticas Mensuales</h3>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                        $<?= number_format($mes['total_ventas'], 2, ',', '.') ?>
                                    </td>
                                    <td class="text-end">
                                        $<?= number_format($mes['promedio_venta'], 2, ',', '.') ?>
                                    </td>
                                    <td class="text-end text-info">
                                        $<?= number_format($mes['total_impuestos'], 2, ',', '.') ?>
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
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-graph-up me-2"></i>Reportes Disponibles</h3>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="report-card">
                            <h5><i class="bi bi-currency-dollar me-2"></i>Reporte de Ventas</h5>
                            <p class="text-muted">Analiza las ventas por período, estado y cliente</p>
                            <a href="<?= url_to('reportes_ventas') ?>" class="btn btn-primary">Ver Reporte</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="report-card">
                            <h5><i class="bi bi-clock me-2"></i>Cuentas por Cobrar</h5>
                            <p class="text-muted">Facturas pendientes de pago y días de vencimiento</p>
                            <a href="<?= url_to('reportes_cxc') ?>" class="btn btn-warning">Ver Reporte</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="report-card">
                            <h5><i class="bi bi-people me-2"></i>Reporte de Clientes</h5>
                            <p class="text-muted">Top clientes y análisis de compras</p>
                            <a href="<?= url_to('reportes_clientes') ?>" class="btn btn-info">Ver Reporte</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="report-card">
                            <h5><i class="bi bi-box-seam me-2"></i>Reporte de Productos</h5>
                            <p class="text-muted">Inventario, rentabilidad y productos más vendidos</p>
                            <a href="<?= url_to('reportes_productos') ?>" class="btn btn-success">Ver Reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Productos -->
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-trophy me-2"></i>Top 5 Productos Más Vendidos</h3>
            </div>
            <div class="card-body p-4">
                <?php if (empty($topProductos)): ?>
                    <div class="alert alert-info">
                        No hay datos de ventas para mostrar el ranking de productos.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover top-products-table">
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
                                            $<?= number_format($producto['total_ingresos_generados'], 2, ',', '.') ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>