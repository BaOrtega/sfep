<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes - PFEP</title>
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
        
        .stat-card.total {
            border-top-color: var(--primary-color);
        }
        
        .stat-card.active {
            border-top-color: var(--success-color);
        }
        
        .stat-card.revenue {
            border-top-color: var(--accent-color);
        }
        
        .stat-card.inactive {
            border-top-color: var(--warning-color);
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
        
        /* Segmentation Cards */
        .segmentation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .segmentation-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            border-left: 4px solid;
        }
        
        .segmentation-card.premium {
            border-left-color: var(--warning-color);
            background-color: #fffbeb;
        }
        
        .segmentation-card.regular {
            border-left-color: var(--accent-color);
            background-color: #f0f9ff;
        }
        
        .segmentation-card.ocasional {
            border-left-color: #94a3b8;
            background-color: #f8fafc;
        }
        
        .segmentation-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        /* Progress Bars */
        .progress {
            height: 8px;
            border-radius: 4px;
            margin: 0.5rem 0;
            background-color: #e2e8f0;
        }
        
        .progress-bar {
            border-radius: 4px;
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
        
        /* Segment Badges */
        .segment-badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
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
        
        .recommendation-card.growth {
            border-left-color: var(--accent-color);
        }
        
        .recommendation-card.reactivation {
            border-left-color: var(--warning-color);
        }
        
        .recommendation-card.strategy {
            border-left-color: var(--success-color);
        }
        
        .recommendation-card.frequency {
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
        
        .stat-card, .secondary-stat-card, .card-main, .segmentation-card, .recommendation-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .segmentation-grid {
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
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .segmentation-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .recommendations-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .secondary-stats {
                grid-template-columns: 1fr;
            }
            
            .card-header-custom h4 {
                font-size: 1.1rem;
            }
            
            .rank-badge {
                width: 35px;
                height: 35px;
                font-size: 0.8rem;
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
                    <h1><i class="fas fa-users me-2"></i>Reporte de Clientes</h1>
                    <p class="lead mb-0">Análisis de clientes y su comportamiento de compra</p>
                </div>
                <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Reportes
                </a>
            </div>
        </div>

        <!-- KPIs Principales -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon text-primary">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="stat-number text-primary"><?= $totalClientes ?? 0 ?></div>
                <div class="stat-title">Total Clientes Registrados</div>
                <small class="text-muted d-block mt-2">En la base de datos</small>
            </div>
            
            <div class="stat-card active">
                <div class="stat-icon text-success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-number text-success"><?= count($topClientes ?? []) ?></div>
                <div class="stat-title">Clientes con Compras</div>
                <small class="text-muted d-block mt-2">Clientes activos</small>
            </div>
            
            <div class="stat-card revenue">
                <div class="stat-icon text-info">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-info">$<?= number_format(array_sum(array_column($topClientes ?? [], 'total_compras')) ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Ventas Totales Generadas</div>
                <small class="text-muted d-block mt-2">Por clientes activos</small>
            </div>
            
            <div class="stat-card inactive">
                <div class="stat-icon text-warning">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-number text-warning"><?= ($totalClientes ?? 0) - count($topClientes ?? []) ?></div>
                <div class="stat-title">Clientes sin Compras</div>
                <small class="text-muted d-block mt-2">Por reactivar</small>
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
        <div class="secondary-stats">
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-primary">
                    $<?= number_format($promedioCompra, 0, ',', '.') ?>
                </div>
                <div class="secondary-stat-title">Ticket Promedio</div>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-success">
                    <?= $clientesConUnaCompra ?>
                </div>
                <div class="secondary-stat-title">Clientes con 1 Compra</div>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-info">
                    $<?= $clienteTop ? number_format($clienteTop['total_compras'], 0, ',', '.') : '0' ?>
                </div>
                <div class="secondary-stat-title">Mejor Cliente ($)</div>
            </div>
            <div class="secondary-stat-card">
                <div class="secondary-stat-number text-warning">
                    <?= $clienteTop ? $clienteTop['total_facturas'] : '0' ?>
                </div>
                <div class="secondary-stat-title">Mejor Cliente (# Facturas)</div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Segmentación de Clientes -->
        <?php if (!empty($topClientes)): ?>
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-chart-pie me-2"></i>Segmentación de Clientes</h4>
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

                <div class="segmentation-grid">
                    <div class="segmentation-card premium">
                        <h5 class="text-warning">
                            <i class="fas fa-star me-2"></i>Clientes Premium
                        </h5>
                        <p class="mb-1"><strong><?= count($segmentos['premium']['clientes']) ?> clientes</strong></p>
                        <p class="mb-2 text-muted">Compras superiores a $1.000.000</p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: <?= (count($segmentos['premium']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                        </div>
                        <small class="text-muted"><?= number_format((count($segmentos['premium']['clientes']) / count($topClientes)) * 100, 1) ?>% del total</small>
                    </div>
                    
                    <div class="segmentation-card regular">
                        <h5 class="text-info">
                            <i class="fas fa-user-tie me-2"></i>Clientes Regulares
                        </h5>
                        <p class="mb-1"><strong><?= count($segmentos['regular']['clientes']) ?> clientes</strong></p>
                        <p class="mb-2 text-muted">Compras entre $500.000 y $1.000.000</p>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: <?= (count($segmentos['regular']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                        </div>
                        <small class="text-muted"><?= number_format((count($segmentos['regular']['clientes']) / count($topClientes)) * 100, 1) ?>% del total</small>
                    </div>
                    
                    <div class="segmentation-card ocasional">
                        <h5 class="text-secondary">
                            <i class="fas fa-user me-2"></i>Clientes Ocasionales
                        </h5>
                        <p class="mb-1"><strong><?= count($segmentos['ocasional']['clientes']) ?> clientes</strong></p>
                        <p class="mb-2 text-muted">Compras menores a $500.000</p>
                        <div class="progress">
                            <div class="progress-bar bg-secondary" style="width: <?= (count($segmentos['ocasional']['clientes']) / count($topClientes)) * 100 ?>%"></div>
                        </div>
                        <small class="text-muted"><?= number_format((count($segmentos['ocasional']['clientes']) / count($topClientes)) * 100, 1) ?>% del total</small>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Top Clientes -->
        <div class="card card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-trophy me-2"></i>Top 10 Clientes</h4>
                    <span class="badge bg-primary fs-6">Ordenado por valor total de compras</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($topClientes)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users" style="font-size: 4rem; color: #94a3b8; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay datos de clientes</h4>
                        <p class="text-muted">No se encontraron clientes con compras registradas</p>
                        <a href="<?= url_to('clientes_index') ?>" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle me-2"></i>Gestionar Clientes
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
                                                $<?= number_format($cliente['total_compras'], 0, ',', '.') ?>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" 
                                                     style="width: <?= min($porcentajeTotal * 2, 100) ?>%"
                                                     title="<?= number_format($porcentajeTotal, 1) ?>% del total">
                                                </div>
                                            </div>
                                            <small class="text-muted"><?= number_format($porcentajeTotal, 1) ?>% del total</small>
                                        </td>
                                        <td class="text-end fw-bold">
                                            $<?= number_format($cliente['promedio_compra'], 0, ',', '.') ?>
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
                                            <span class="segment-badge <?= $segmentoClass ?>">
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
                                        $<?= number_format($totalVentas, 0, ',', '.') ?>
                                    </td>
                                    <td class="text-end fw-bold">
                                        $<?= number_format($promedioCompra, 0, ',', '.') ?>
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
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-lightbulb me-2"></i>Análisis y Recomendaciones</h4>
            </div>
            <div class="card-body">
                <div class="recommendations-grid">
                    <div class="recommendation-card growth">
                        <h6><i class="fas fa-chart-line me-2"></i>Oportunidades de Crecimiento</h6>
                        <p class="mb-2">
                            <strong><?= count($segmentos['premium']['clientes']) ?> clientes premium</strong> 
                            generan el 
                            <strong>
                                $<?= number_format(array_sum(array_column($segmentos['premium']['clientes'], 'total_compras')), 0, ',', '.') ?>
                            </strong>
                            (<?= number_format((array_sum(array_column($segmentos['premium']['clientes'], 'total_compras')) / $totalVentas) * 100, 1) ?>% del total).
                        </p>
                        <small class="text-muted">Enfoca estrategias de fidelización en este segmento.</small>
                    </div>
                    
                    <div class="recommendation-card reactivation">
                        <h6><i class="fas fa-redo me-2"></i>Clientes por Reactivar</h6>
                        <p class="mb-2">
                            <strong><?= ($totalClientes ?? 0) - count($topClientes) ?> clientes</strong> 
                            registrados no han realizado compras.
                        </p>
                        <small class="text-muted">Considera campañas de reactivación o contacto directo.</small>
                    </div>
                    
                    <div class="recommendation-card strategy">
                        <h6><i class="fas fa-chess-board me-2"></i>Estrategia de Ventas</h6>
                        <p class="mb-2">
                            El <strong>20% de tus clientes</strong> (<?= ceil(count($topClientes) * 0.2) ?> clientes) 
                            probablemente generan el <strong>80% de tus ingresos</strong>.
                        </p>
                        <small class="text-muted">Aplica el principio de Pareto para optimizar recursos.</small>
                    </div>
                    
                    <div class="recommendation-card frequency">
                        <h6><i class="fas fa-chart-bar me-2"></i>Análisis de Frecuencia</h6>
                        <p class="mb-2">
                            <strong><?= $clientesConUnaCompra ?> clientes</strong> 
                            han realizado solo una compra.
                        </p>
                        <small class="text-muted">Desarrolla programas de fidelización para aumentar la recurrencia.</small>
                    </div>
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
            const elements = document.querySelectorAll('.stat-card, .secondary-stat-card, .segmentation-card, .recommendation-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Resaltar el cliente top
            const primeraFila = document.querySelector('tbody tr');
            if (primeraFila) {
                primeraFila.style.backgroundColor = '#fffbeb';
                primeraFila.style.borderLeft = '4px solid #f59e0b';
            }
            
            // Tooltips para las barras de progreso
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>