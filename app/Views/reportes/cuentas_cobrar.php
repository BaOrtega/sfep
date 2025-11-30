<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas por Cobrar - PFEP</title>
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
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .alert-vencida {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-proxima {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-action {
            margin: 2px;
            padding: 6px 12px;
            font-size: 0.85rem;
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
                <h1 class="text-white mb-2">⏰ Cuentas por Cobrar</h1>
                <p class="text-white opacity-90 mb-0">Facturas emitidas pendientes de pago</p>
            </div>
            <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver a Reportes
            </a>
        </div>

        <!-- Alertas de Vencimiento -->
        <?php 
        $facturasVencidas = array_filter($facturasPendientes, function($factura) {
            return ($factura['dias_para_vencer'] ?? 0) < 0;
        });
        $facturasPorVencer = array_filter($facturasPendientes, function($factura) {
            $dias = $factura['dias_para_vencer'] ?? 0;
            return $dias >= 0 && $dias <= 7;
        });
        ?>

        <?php if (!empty($facturasVencidas)): ?>
        <div class="alert-vencida">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="mb-1">¡Alerta! Facturas Vencidas</h5>
                    <p class="mb-0">Tienes <strong><?= count($facturasVencidas) ?> factura(s)</strong> que han superado su fecha de vencimiento.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($facturasPorVencer)): ?>
        <div class="alert-proxima">
            <div class="d-flex align-items-center">
                <i class="bi bi-clock-fill me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="mb-1">Facturas por Vencer</h5>
                    <p class="mb-0">Tienes <strong><?= count($facturasPorVencer) ?> factura(s)</strong> que vencerán en los próximos 7 días.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Resumen de KPIs -->
        <div class="row">
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-warning">
                        <?= count($facturasPendientes) ?>
                    </div>
                    <div class="kpi-title">Facturas Pendientes</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-danger">
                        $<?= number_format($total_pendiente ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Total por Cobrar</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-info">
                        <?= count($facturasVencidas) ?>
                    </div>
                    <div class="kpi-title">Facturas Vencidas</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kpi-card">
                    <div class="kpi-number text-warning">
                        <?= count($facturasPorVencer) ?>
                    </div>
                    <div class="kpi-title">Por Vencer (7 días)</div>
                </div>
            </div>
        </div>

        <!-- Lista de Facturas Pendientes -->
        <div class="card-main">
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="bi bi-clock me-2"></i>Facturas Pendientes de Pago</h3>
                    <span class="badge bg-warning fs-6"><?= count($facturasPendientes) ?> facturas</span>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($facturasPendientes)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle" style="font-size: 4rem; color: #28a745; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">¡Excelente!</h4>
                        <p class="text-muted">No tienes facturas pendientes de pago</p>
                        <a href="<?= url_to('reportes_index') ?>" class="btn btn-primary mt-3">
                            <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
                        </a>
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
                                            $icon = 'bi-exclamation-triangle';
                                        } elseif ($diasParaVencer <= 7) {
                                            $badgeClass = 'bg-warning';
                                            $texto = $diasParaVencer . ' días';
                                            $icon = 'bi-clock';
                                        } else {
                                            $badgeClass = 'bg-success';
                                            $texto = $diasParaVencer . ' días';
                                            $icon = 'bi-calendar-check';
                                        }
                                    ?>
                                    <tr class="<?= $diasParaVencer < 0 ? 'table-danger' : ($diasParaVencer <= 7 ? 'table-warning' : '') ?>">
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
                                                <i class="bi <?= $icon ?> me-1"></i>
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
                                                   class="btn btn-sm btn-outline-primary btn-action" 
                                                   title="Ver detalle de factura">
                                                    <i class="bi bi-eye"></i> Ver
                                                </a>
                                                <a href="<?= url_to('facturas_pagar', $factura['id']) ?>" 
                                                   class="btn btn-sm btn-success btn-action"
                                                   title="Marcar como pagada"
                                                   onclick="return confirm('¿Estás seguro de marcar la factura #<?= $factura['id'] ?> como PAGADA?')">
                                                    <i class="bi bi-check-circle"></i> Pagar
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
                                        $ <?= number_format($total_pendiente, 2, ',', '.') ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Resumen por Estados de Vencimiento -->
                    <div class="p-4 border-top">
                        <h5 class="mb-3">Resumen por Estado de Vencimiento:</h5>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <div class="text-success fw-bold fs-4">
                                        <?= count(array_filter($facturasPendientes, function($f) { 
                                            return ($f['dias_para_vencer'] ?? 0) > 7; 
                                        })) ?>
                                    </div>
                                    <div class="text-muted">Al Día</div>
                                    <small>> 7 días para vencer</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <div class="text-warning fw-bold fs-4">
                                        <?= count($facturasPorVencer) ?>
                                    </div>
                                    <div class="text-muted">Por Vencer</div>
                                    <small>0-7 días para vencer</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <div class="text-danger fw-bold fs-4">
                                        <?= count($facturasVencidas) ?>
                                    </div>
                                    <div class="text-muted">Vencidas</div>
                                    <small>Fecha vencida</small>
                                </div>
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
                <h3 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Recomendaciones</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($facturasVencidas)): ?>
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            <h6><i class="bi bi-exclamation-triangle me-2"></i>Acción Prioritaria</h6>
                            <p class="mb-1">Contacta inmediatamente a los clientes con facturas vencidas.</p>
                            <small>Considera enviar recordatorios de pago.</small>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($facturasPorVencer)): ?>
                    <div class="col-md-6">
                        <div class="alert alert-warning">
                            <h6><i class="bi bi-clock me-2"></i>Acción Preventiva</h6>
                            <p class="mb-1">Envía recordatorios a clientes con facturas por vencer.</p>
                            <small>La comunicación anticipada mejora la cobranza.</small>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-graph-up me-2"></i>Análisis de Cartera</h6>
                            <p class="mb-1">Tu cartera de cuentas por cobrar es de <strong>$<?= number_format($total_pendiente, 2, ',', '.') ?></strong>.</p>
                            <small>Monitorea regularmente este reporte.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="bi bi-cash-coin me-2"></i>Mejora Continua</h6>
                            <p class="mb-1">Considera establecer políticas de cobro más estrictas.</p>
                            <small>Plazos más cortos pueden mejorar tu flujo de caja.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para actualizar automáticamente los días de vencimiento
        function actualizarEstadosVencimiento() {
            const filas = document.querySelectorAll('tbody tr');
            filas.forEach(fila => {
                const badge = fila.querySelector('.status-badge');
                if (badge) {
                    const texto = badge.textContent;
                    if (texto.includes('días') && !texto.includes('Vencida')) {
                        const dias = parseInt(texto);
                        if (dias <= 1) {
                            badge.className = 'status-badge bg-danger text-white';
                            badge.innerHTML = '<i class="bi bi-exclamation-triangle me-1"></i>Vence hoy';
                            fila.className = 'table-danger';
                        }
                    }
                }
            });
        }

        // Actualizar cada minuto (opcional)
        // setInterval(actualizarEstadosVencimiento, 60000);

        // Ejecutar al cargar la página
        document.addEventListener('DOMContentLoaded', actualizarEstadosVencimiento);
    </script>
</body>
</html>