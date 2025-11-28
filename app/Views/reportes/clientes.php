<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes - PFEP</title>
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
        .rank-badge {
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 20px;
            color: #fff;
        }
        .rank-1 { background-color: #ffc107; color: #333; }
        .rank-2 { background-color: #adb5bd; }
        .rank-3 { background-color: #cd7f32; }
        .progress {
            height: 8px;
            margin-top: 5px;
        }
        .client-segment {
            border-left: 4px solid;
            padding-left: 15px;
            margin-bottom: 15px;
        }
        .segment-premium { border-left-color: #ffc107; background-color: #fffbf0; }
        .segment-regular { border-left-color: #17a2b8; background-color: #f0f9ff; }
        .segment-ocasional { border-left-color: #6c757d; background-color: #f8f9fa; }
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
                    <i class="bi bi-speedometer2 me-3"></i>Dashboard
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
                <h1 class="text-white mb-2">👥 Reporte de Clientes</h1>
                <p class="text-white opacity-90 mb-0">Análisis de clientes y su comportamiento de compra</p>
            </div>
            <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver a Reportes
            </a>
        </div>

        <!-- KPIs Principales -->
        <div class="row">
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-primary">
                        <?= $totalClientes ?>
                    </div>
                    <div class="kpi-title">Total Clientes Registrados</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-success">
                        <?= count($topClientes) ?>
                    </div>
                    <div class="kpi-title">Clientes con Compras</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-info">
                        $<?= number_format(array_sum(array_column($topClientes, 'total_compras')) ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Ventas Totales Generadas</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-warning">
                        <?= $totalClientes - count($topClientes) ?>
                    </div>
                    <div class="kpi-title">Clientes sin Compras</div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Adicionales -->
        <?php if (!empty($topClientes)): ?>
        <?php
            $totalVentas = array_sum(array_column($topClientes, 'total_compras'));
            $promedioCompra = $totalVentas / count($topClientes);
            $clienteTop = $topClientes[0] ?? null;
            $clientesConUnaCompra = count(array_filter($topClientes, function($cliente) {
                return $cliente['total_facturas'] == 1;
            }));
        ?>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-primary">
                        $<?= number_format($promedioCompra, 2, ',', '.') ?>
                    </div>
                    <div class="stats-title">Ticket Promedio</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-success">
                        <?= $clientesConUnaCompra ?>
                    </div>
                    <div class="stats-title">Clientes con 1 Compra</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-info">
                        <?= $clienteTop ? number_format($clienteTop['total_compras'], 2, ',', '.') : '0' ?>
                    </div>
                    <div class="stats-title">Mejor Cliente ($)</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number text-warning">
                        <?= $clienteTop ? $clienteTop['total_facturas'] : '0' ?>
                    </div>
                    <div class="stats-title">Mejor Cliente (# Facturas)</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Segmentación de Clientes -->
        <?php if (!empty($topClientes)): ?>
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Segmentación de Clientes</h3>
            </div>
            <div class="card-body">
                <?php
                $segmentos = [
                    'premium' => ['min' => 1000000, 'clientes' => [], 'color' => 'warning'],
                    'regular' => ['min' => 500000, 'clientes' => [], 'color' => 'info'],
                    'ocasional' => ['min' => 0, 'clientes' => [], 'color' => 'secondary']
                ];

                foreach ($topClientes as $cliente) {
                    if ($cliente['total_compras'] >= $segmentos['premium']['min']) {
                        $segmentos['premium']['clientes'][] = $cliente;
                    } elseif ($cliente['total_compras'] >= $segmentos['regular']['min']) {
                        $segmentos['regular']['clientes'][] = $cliente;
                    } else {
                        $segmentos['ocasional']['clientes'][] = $cliente;
                    }
                }
                ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="client-segment segment-premium">
                            <h5 class="text-warning">
                                <i class="bi bi-star-fill me-2"></i>Clientes Premium
                            </h5>
                            <p class="mb-1"><strong><?= count($segmentos['premium']['clientes']) ?> clientes</strong></p>
                            <p class="mb-1 text-muted">Compras superiores a $1.000.000</p>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: <?= (count($segmentos['premium']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="client-segment segment-regular">
                            <h5 class="text-info">
                                <i class="bi bi-star me-2"></i>Clientes Regulares
                            </h5>
                            <p class="mb-1"><strong><?= count($segmentos['regular']['clientes']) ?> clientes</strong></p>
                            <p class="mb-1 text-muted">Compras entre $500.000 y $1.000.000</p>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: <?= (count($segmentos['regular']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="client-segment segment-ocasional">
                            <h5 class="text-secondary">
                                <i class="bi bi-person me-2"></i>Clientes Ocasionales
                            </h5>
                            <p class="mb-1"><strong><?= count($segmentos['ocasional']['clientes']) ?> clientes</strong></p>
                            <p class="mb-1 text-muted">Compras menores a $500.000</p>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" style="width: <?= (count($segmentos['ocasional']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Top Clientes -->
        <div class="card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="bi bi-trophy me-2"></i>Top 10 Clientes</h3>
                    <span class="badge bg-primary fs-6">Ordenado por valor total de compras</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($topClientes)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-people" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay datos de clientes</h4>
                        <p class="text-muted">No se encontraron clientes con compras registradas</p>
                        <a href="<?= url_to('clientes_index') ?>" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle me-2"></i>Gestionar Clientes
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Rank</th>
                                    <th>Cliente</th>
                                    <th>NIT/Identificación</th>
                                    <th class="text-center">Total Facturas</th>
                                    <th class="text-end">Total Compras</th>
                                    <th class="text-end">Promedio Compra</th>
                                    <th class="text-center">Última Compra</th>
                                    <th class="text-center">Segmento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rank = 1; ?>
                                <?php foreach ($topClientes as $cliente): ?>
                                    <?php
                                    // Determinar segmento
                                    if ($cliente['total_compras'] >= 1000000) {
                                        $segmento = 'Premium';
                                        $segmentoClass = 'bg-warning';
                                    } elseif ($cliente['total_compras'] >= 500000) {
                                        $segmento = 'Regular';
                                        $segmentoClass = 'bg-info';
                                    } else {
                                        $segmento = 'Ocasional';
                                        $segmentoClass = 'bg-secondary';
                                    }

                                    // Calcular porcentaje del total
                                    $porcentajeTotal = ($cliente['total_compras'] / $totalVentas) * 100;
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <span class="rank-badge 
                                                <?= ($rank == 1) ? 'rank-1' : (($rank == 2) ? 'rank-2' : (($rank == 3) ? 'rank-3' : 'bg-secondary')) ?>">
                                                <?= $rank++ ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold"><?= esc($cliente['nombre']) ?></div>
                                            <?php if (!empty($cliente['email'])): ?>
                                                <small class="text-muted"><?= esc($cliente['email']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <code><?= esc($cliente['nit']) ?></code>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary"><?= $cliente['total_facturas'] ?></span>
                                        </td>
                                        <td class="text-end">
                                            <div class="fw-bold text-success fs-6">
                                                $<?= number_format($cliente['total_compras'], 2, ',', '.') ?>
                                            </div>
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar bg-success" 
                                                     style="width: <?= min($porcentajeTotal * 2, 100) ?>%"
                                                     title="<?= number_format($porcentajeTotal, 1) ?>% del total">
                                                </div>
                                            </div>
                                            <small class="text-muted"><?= number_format($porcentajeTotal, 1) ?>% del total</small>
                                        </td>
                                        <td class="text-end fw-bold">
                                            $<?= number_format($cliente['promedio_compra'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($cliente['ultima_compra']): ?>
                                                <span class="badge bg-light text-dark">
                                                    <?= date('d/m/Y', strtotime($cliente['ultima_compra'])) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $segmentoClass ?>">
                                                <?= $segmento ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <td colspan="4" class="text-end fw-bold">TOTALES:</td>
                                    <td class="text-end fw-bold fs-5 text-success">
                                        $<?= number_format($totalVentas, 2, ',', '.') ?>
                                    </td>
                                    <td class="text-end fw-bold">
                                        $<?= number_format($promedioCompra, 2, ',', '.') ?>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Análisis y Recomendaciones -->
        <?php if (!empty($topClientes)): ?>
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-graph-up-arrow me-2"></i>Análisis y Recomendaciones</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-lightbulb me-2"></i>Oportunidades de Crecimiento</h6>
                            <p class="mb-2">
                                <strong><?= count($segmentos['premium']['clientes']) ?> clientes premium</strong> 
                                generan el 
                                <strong>
                                    $<?= number_format(array_sum(array_column($segmentos['premium']['clientes'], 'total_compras')), 2, ',', '.') ?>
                                </strong>
                                (<?= number_format((array_sum(array_column($segmentos['premium']['clientes'], 'total_compras')) / $totalVentas) * 100, 1) ?>% del total).
                            </p>
                            <small class="text-muted">Enfoca estrategias de fidelización en este segmento.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            <h6><i class="bi bi-arrow-repeat me-2"></i>Clientes por Reactivar</h6>
                            <p class="mb-2">
                                <strong><?= $totalClientes - count($topClientes) ?> clientes</strong> 
                                registrados no han realizado compras.
                            </p>
                            <small class="text-muted">Considera campañas de reactivación o contacto directo.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="bi bi-cash-coin me-2"></i>Estrategia de Ventas</h6>
                            <p class="mb-2">
                                El <strong>20% de tus clientes</strong> (<?= ceil(count($topClientes) * 0.2) ?> clientes) 
                                probablemente generan el <strong>80% de tus ingresos</strong>.
                            </p>
                            <small class="text-muted">Aplica el principio de Pareto para optimizar recursos.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-primary">
                            <h6><i class="bi bi-bar-chart me-2"></i>Análisis de Frecuencia</h6>
                            <p class="mb-2">
                                <strong><?= $clientesConUnaCompra ?> clientes</strong> 
                                han realizado solo una compra.
                            </p>
                            <small class="text-muted">Desarrolla programas de fidelización para aumentar la recurrencia.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para resaltar el cliente top
        document.addEventListener('DOMContentLoaded', function() {
            const primeraFila = document.querySelector('tbody tr');
            if (primeraFila) {
                primeraFila.style.backgroundColor = '#fffbf0';
                primeraFila.style.borderLeft = '4px solid #ffc107';
            }
        });

        // Tooltips para los progres bars
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>