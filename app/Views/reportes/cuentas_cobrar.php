<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas por Cobrar - PFEP</title>
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
        
        .alert-card.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
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
        
        .stat-card.pending {
            border-top-color: var(--warning-color);
        }
        
        .stat-card.total {
            border-top-color: var(--danger-color);
        }
        
        .stat-card.overdue {
            border-top-color: var(--danger-color);
        }
        
        .stat-card.upcoming {
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
        
        .table tbody tr.overdue {
            background-color: #fef2f2;
        }
        
        .table tbody tr.upcoming {
            background-color: #fffbeb;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
        }
        
        /* Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .summary-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 3px solid;
        }
        
        .summary-card.good {
            border-top-color: var(--success-color);
        }
        
        .summary-card.warning {
            border-top-color: var(--warning-color);
        }
        
        .summary-card.danger {
            border-top-color: var(--danger-color);
        }
        
        /* Recommendations */
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
        
        .recommendation-card.priority {
            border-left-color: var(--danger-color);
        }
        
        .recommendation-card.preventive {
            border-left-color: var(--warning-color);
        }
        
        .recommendation-card.analysis {
            border-left-color: var(--accent-color);
        }
        
        .recommendation-card.improvement {
            border-left-color: var(--success-color);
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
        
        .stat-card, .alert-card, .card-main {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .summary-grid {
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
            
            .summary-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
            
            .alert-card {
                flex-direction: column;
                text-align: center;
            }
            
            .alert-card i {
                margin-right: 0;
                margin-bottom: 1rem;
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
                    <h1><i class="fas fa-clock me-2"></i>Cuentas por Cobrar</h1>
                    <p class="lead mb-0">Facturas emitidas pendientes de pago</p>
                </div>
            </div>
        </div>

        <!-- Alertas de Vencimiento -->
        <?php 
        $facturasVencidas = array_filter($facturasPendientes ?? [], function($factura) {
            return ($factura['dias_para_vencer'] ?? 0) < 0;
        });
        $facturasPorVencer = array_filter($facturasPendientes ?? [], function($factura) {
            $dias = $factura['dias_para_vencer'] ?? 0;
            return $dias >= 0 && $dias <= 7;
        });
        ?>

        <?php if (!empty($facturasVencidas)): ?>
        <div class="alert-card danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="flex-grow-1">
                <h5 class="mb-1">¡Alerta! Facturas Vencidas</h5>
                <p class="mb-0">Tienes <strong><?= count($facturasVencidas) ?> factura(s)</strong> que han superado su fecha de vencimiento.</p>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($facturasPorVencer)): ?>
        <div class="alert-card warning">
            <i class="fas fa-clock"></i>
            <div class="flex-grow-1">
                <h5 class="mb-1">Facturas por Vencer</h5>
                <p class="mb-0">Tienes <strong><?= count($facturasPorVencer) ?> factura(s)</strong> que vencerán en los próximos 7 días.</p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card pending">
                <div class="stat-icon text-warning">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-number text-warning"><?= count($facturasPendientes ?? []) ?></div>
                <div class="stat-title">Facturas Pendientes</div>
                <small class="text-muted d-block mt-2">Total general</small>
            </div>
            
            <div class="stat-card total">
                <div class="stat-icon text-danger">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-danger">$<?= number_format($total_pendiente ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Total por Cobrar</div>
                <small class="text-muted d-block mt-2">Monto pendiente</small>
            </div>
            
            <div class="stat-card overdue">
                <div class="stat-icon text-danger">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="stat-number text-danger"><?= count($facturasVencidas) ?></div>
                <div class="stat-title">Facturas Vencidas</div>
                <small class="text-muted d-block mt-2">Requieren acción inmediata</small>
            </div>
            
            <div class="stat-card upcoming">
                <div class="stat-icon text-warning">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-number text-warning"><?= count($facturasPorVencer) ?></div>
                <div class="stat-title">Por Vencer (7 días)</div>
                <small class="text-muted d-block mt-2">Próximas a vencer</small>
            </div>
        </div>

        <!-- Lista de Facturas Pendientes -->
        <div class="card card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-clock me-2"></i>Facturas Pendientes de Pago</h4>
                    <span class="badge bg-warning fs-6"><?= count($facturasPendientes ?? []) ?> facturas</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($facturasPendientes)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle" style="font-size: 4rem; color: #28a745; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">¡Excelente!</h4>
                        <p class="text-muted">No tienes facturas pendientes de pago</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>N° Factura</th>
                                    <th>Cliente</th>
                                    <th>NIT</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Días Estado</th>
                                    <th class="text-end">Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturasPendientes as $factura): ?>
                                    <?php
                                        $diasParaVencer = $factura['dias_para_vencer'] ?? 0;
                                        $diasTranscurridos = $factura['dias_transcurridos'] ?? 0;
                                        
                                        if ($diasParaVencer < 0) {
                                            $badgeClass = 'bg-danger';
                                            $texto = 'Vencida hace ' . abs($diasParaVencer) . ' días';
                                            $icon = 'fas fa-exclamation-triangle';
                                            $rowClass = 'overdue';
                                        } elseif ($diasParaVencer <= 7) {
                                            $badgeClass = 'bg-warning';
                                            $texto = $diasParaVencer . ' días';
                                            $icon = 'fas fa-clock';
                                            $rowClass = 'upcoming';
                                        } else {
                                            $badgeClass = 'bg-success';
                                            $texto = $diasParaVencer . ' días';
                                            $icon = 'fas fa-calendar-check';
                                            $rowClass = '';
                                        }
                                    ?>
                                    <tr class="<?= $rowClass ?>">
                                        <td class="fw-bold">#<?= esc($factura['id']) ?></td>
                                        <td>
                                            <div class="fw-bold"><?= esc($factura['cliente_nombre']) ?></div>
                                            <?php if (!empty($factura['telefono'])): ?>
                                                <small class="text-muted"><?= esc($factura['telefono']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <code><?= esc($factura['cliente_nit']) ?></code>
                                        </td>
                                        <td>
                                            <?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?>
                                        </td>
                                        <td>
                                            <?= date('d/m/Y', strtotime($factura['fecha_vencimiento'])) ?>
                                        </td>
                                        <td>
                                            <span class="status-badge <?= $badgeClass ?> text-white">
                                                <i class="<?= $icon ?> me-1"></i>
                                                <?= $texto ?>
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                Emitida hace <?= $diasTranscurridos ?> días
                                            </small>
                                        </td>
                                        <td class="text-end fw-bold fs-6">
                                            $ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="<?= url_to('facturas_view', $factura['id']) ?>" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Ver detalle de factura">
                                                    <i class="fas fa-eye me-1"></i>Ver
                                                </a>
                                                <a href="<?= url_to('facturas_pagar', $factura['id']) ?>" 
                                                   class="btn btn-sm btn-success"
                                                   title="Marcar como pagada"
                                                   onclick="return confirm('¿Estás seguro de marcar la factura #<?= $factura['id'] ?> como PAGADA?')">
                                                    <i class="fas fa-check-circle me-1"></i>Pagar
                                                </a>
                                                <?php if ($diasParaVencer < 0): ?>
                                                <span class="badge bg-danger mt-1">¡VENCIDA!</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <td colspan="6" class="text-end fw-bold">TOTAL GENERAL:</td>
                                    <td class="text-end fw-bold fs-5 text-danger">
                                        $ <?= number_format($total_pendiente ?? 0, 2, ',', '.') ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Resumen por Estados de Vencimiento -->
                    <div class="p-4 border-top">
                        <h5 class="mb-3">Resumen por Estado de Vencimiento:</h5>
                        <div class="summary-grid">
                            <div class="summary-card good">
                                <div class="fw-bold fs-4 text-success">
                                    <?= count(array_filter($facturasPendientes, function($f) { 
                                        return ($f['dias_para_vencer'] ?? 0) > 7; 
                                    })) ?>
                                </div>
                                <div class="text-muted">Al Día</div>
                                <small>> 7 días para vencer</small>
                            </div>
                            <div class="summary-card warning">
                                <div class="fw-bold fs-4 text-warning">
                                    <?= count($facturasPorVencer) ?>
                                </div>
                                <div class="text-muted">Por Vencer</div>
                                <small>0-7 días para vencer</small>
                            </div>
                            <div class="summary-card danger">
                                <div class="fw-bold fs-4 text-danger">
                                    <?= count($facturasVencidas) ?>
                                </div>
                                <div class="text-muted">Vencidas</div>
                                <small>Fecha vencida</small>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recomendaciones -->
        <?php if (!empty($facturasPendientes)): ?>
        <div class="card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-lightbulb me-2"></i>Recomendaciones Estratégicas</h4>
            </div>
            <div class="card-body">
                <div class="recommendations-grid">
                    <?php if (!empty($facturasVencidas)): ?>
                    <div class="recommendation-card priority">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Acción Prioritaria</h6>
                        <p class="mb-1">Contacta inmediatamente a los clientes con facturas vencidas.</p>
                        <small class="text-muted">Considera enviar recordatorios de pago.</small>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($facturasPorVencer)): ?>
                    <div class="recommendation-card preventive">
                        <h6><i class="fas fa-clock me-2"></i>Acción Preventiva</h6>
                        <p class="mb-1">Envía recordatorios a clientes con facturas por vencer.</p>
                        <small class="text-muted">La comunicación anticipada mejora la cobranza.</small>
                    </div>
                    <?php endif; ?>

                    <div class="recommendation-card analysis">
                        <h6><i class="fas fa-chart-line me-2"></i>Análisis de Cartera</h6>
                        <p class="mb-1">Tu cartera de cuentas por cobrar es de <strong>$<?= number_format($total_pendiente ?? 0, 2, ',', '.') ?></strong>.</p>
                        <small class="text-muted">Monitorea regularmente este reporte.</small>
                    </div>

                    <div class="recommendation-card improvement">
                        <h6><i class="fas fa-cash-register me-2"></i>Mejora Continua</h6>
                        <p class="mb-1">Considera establecer políticas de cobro más estrictas.</p>
                        <small class="text-muted">Plazos más cortos pueden mejorar tu flujo de caja.</small>
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
            const elements = document.querySelectorAll('.stat-card, .alert-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Actualizar estados de vencimiento
            const filas = document.querySelectorAll('tbody tr');
            filas.forEach(fila => {
                const badge = fila.querySelector('.status-badge');
                if (badge) {
                    const texto = badge.textContent.trim();
                    if (texto.includes('días') && !texto.includes('Vencida')) {
                        const dias = parseInt(texto);
                        if (dias <= 1) {
                            badge.className = 'status-badge bg-danger text-white';
                            badge.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Vence hoy';
                            fila.className += ' table-danger';
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>