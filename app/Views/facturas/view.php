<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #<?= esc($factura['id']) ?> - PFEP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 280px;
            --main-padding: 30px;
            --primary-gradient: linear-gradient(135deg, #007bff, #0056b3);
            --success-gradient: linear-gradient(135deg, #28a745, #20c997);
            --warning-gradient: linear-gradient(135deg, #ffc107, #fd7e14);
            --danger-gradient: linear-gradient(135deg, #dc3545, #c82333);
            --purple-gradient: linear-gradient(135deg, #6f42c1, #5a2d9c);
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
            transition: transform 0.3s ease;
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
            background: var(--primary-gradient);
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
            background: var(--primary-gradient);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-item a.active {
            background: var(--primary-gradient);
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border: none;
            overflow: hidden;
            margin-bottom: 25px;
        }
        
        .card-header-custom {
            background: var(--primary-gradient);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        
        .btn-modern {
            background: var(--primary-gradient);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            color: white;
        }
        
        .btn-success-custom {
            background: var(--success-gradient);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }
        
        .btn-danger-custom {
            background: var(--danger-gradient);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
        }
        
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        
        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }
        
        .info-header h5 {
            margin: 0;
            color: #495057;
            font-weight: 600;
        }
        
        .info-header i {
            color: #007bff;
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            flex: 0 0 180px;
            font-weight: 600;
            color: #495057;
        }
        
        .info-value {
            flex: 1;
            color: #6c757d;
        }
        
        .table-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 0;
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        
        .table-modern th {
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .table-modern td {
            border: none;
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .table-modern tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-modern tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .total-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 30px;
            margin-top: 25px;
            border: 2px solid #e9ecef;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .total-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .total-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
        }
        
        .grand-total {
            font-size: 1.8rem;
            color: #007bff;
            font-weight: 700;
        }
        
        .invoice-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .invoice-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50px, -50px);
        }
        
        .invoice-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50px, 50px);
        }
        
        .invoice-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }
        
        .invoice-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .status-badge {
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }
        
        .status-emitida {
            background: var(--warning-gradient);
            color: white;
        }
        
        .status-pagada {
            background: var(--success-gradient);
            color: white;
        }
        
        .status-anulada {
            background: var(--danger-gradient);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .company-logo {
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .alert-modern {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .table-modern th, 
            .table-modern td {
                padding: 10px 8px;
                font-size: 0.85rem;
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
            
            .action-buttons {
                flex-direction: column;
            }
            
            .invoice-title {
                font-size: 1.8rem;
            }
            
            .info-row {
                flex-direction: column;
            }
            
            .info-label {
                flex: 0 0 auto;
                margin-bottom: 5px;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .info-card {
                padding: 15px;
            }
            
            .total-section {
                padding: 20px;
            }
            
            .btn-modern, 
            .btn-success-custom, 
            .btn-danger-custom {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            
            .table-modern {
                font-size: 0.85rem;
            }
            
            .invoice-header {
                padding: 20px;
            }
        }
        
        @media print {
            .sidebar, .menu-toggle, .btn-back, .action-buttons {
                display: none !important;
            }
            
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            
            body {
                background: white !important;
            }
            
            .card-main {
                box-shadow: none !important;
                border-radius: 0 !important;
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
                <a href="<?= url_to('facturas_index') ?>" class="active">
                    <i class="bi bi-receipt me-3"></i>Facturas
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('reportes_index') ?>">
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
        <div class="content-center">
            <!-- Encabezado de la Factura -->
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="invoice-title">
                            <i class="bi bi-receipt me-3"></i>Factura #<?= esc($factura['id']) ?>
                        </h1>
                        <p class="invoice-subtitle mb-0">
                            <i class="bi bi-calendar me-2"></i>Emitida: <?= esc($factura['fecha_emision']) ?> | 
                            <i class="bi bi-person me-2"></i>Emisor: <?= esc(session()->get('user_name')) ?>
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php 
                            $estado = $factura['estado'];
                            $badgeClass = 'status-emitida';
                            if ($estado === 'PAGADA') {
                                $badgeClass = 'status-pagada';
                            } elseif ($estado === 'ANULADA') {
                                $badgeClass = 'status-anulada';
                            }
                        ?>
                        <span class="status-badge <?= $badgeClass ?>">
                            <i class="bi bi-circle-fill me-1"></i><?= esc($estado) ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Principal -->
            <div class="card-main">
                <!-- Header -->
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1"><i class="bi bi-file-text me-2"></i>Detalles de la Factura</h2>
                            <p class="mb-0 opacity-75">Información completa de la factura #<?= esc($factura['id']) ?></p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="<?= url_to('facturas_index') ?>" class="btn-back">
                                <i class="bi bi-arrow-left me-2"></i>Volver
                            </a>
                            <a href="<?= url_to('facturas_pdf', $factura['id']) ?>" class="btn-modern" target="_blank">
                                <i class="bi bi-file-earmark-pdf me-2"></i>Generar PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Alertas -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Información del Cliente -->
                    <div class="info-card">
                        <div class="info-header">
                            <i class="bi bi-person-badge"></i>
                            <h5>Información del Cliente</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-row">
                                    <span class="info-label">Nombre:</span>
                                    <span class="info-value"><?= esc($cliente['nombre']) ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">NIT/Identificación:</span>
                                    <span class="info-value"><?= esc($cliente['nit']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-row">
                                    <span class="info-label">Dirección:</span>
                                    <span class="info-value"><?= esc($cliente['direccion'] ?? 'No especificada') ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Teléfono:</span>
                                    <span class="info-value"><?= esc($cliente['telefono'] ?? 'No especificado') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de la Factura -->
                    <div class="info-card">
                        <div class="info-header">
                            <i class="bi bi-calendar-event"></i>
                            <h5>Información de la Factura</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-row">
                                    <span class="info-label">Fecha de Emisión:</span>
                                    <span class="info-value"><?= esc($factura['fecha_emision']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-row">
                                    <span class="info-label">Fecha de Vencimiento:</span>
                                    <span class="info-value"><?= esc($factura['fecha_vencimiento']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-row">
                                    <span class="info-label">Moneda:</span>
                                    <span class="info-value"><?= esc($factura['moneda'] ?? 'COP') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detalle de Productos -->
                    <div class="info-card">
                        <div class="info-header">
                            <i class="bi bi-cart-check"></i>
                            <h5>Detalle de Productos</h5>
                        </div>
                        
                        <?php if (empty($detalles)): ?>
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>No hay productos en esta factura</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th><i class="bi bi-hash me-2"></i>Lista</th>
                                            <th><i class="bi bi-box me-2"></i>Producto</th>
                                            <th><i class="bi bi-hash me-2"></i>Cantidad</th>
                                            <th><i class="bi bi-currency-dollar me-2"></i>Precio Unitario</th>
                                            <th><i class="bi bi-percent me-2"></i>IVA</th>
                                            <th><i class="bi bi-calculator me-2"></i>Total Línea</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 1; ?>
                                        <?php foreach ($detalles as $detalle): ?>
                                            <tr>
                                                <td class="text-muted"><?= $contador++ ?></td>
                                                <td>
                                                    <div class="fw-semibold"><?= esc($detalle['nombre']) ?></div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark"><?= esc($detalle['cantidad']) ?> unidades</span>
                                                </td>
                                                <td class="fw-bold text-success">
                                                    $<?= number_format(esc($detalle['precio_unitario']), 2, ',', '.') ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark"><?= esc($detalle['tasa_impuesto']) ?>%</span>
                                                </td>
                                                <td class="fw-bold text-primary">
                                                    $<?= number_format(esc($detalle['total_linea']), 2, ',', '.') ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Totales -->
                    <div class="total-section">
                        <div class="info-header">
                            <i class="bi bi-calculator"></i>
                            <h5>Resumen Financiero</h5>
                        </div>
                        
                        <div class="total-row">
                            <span class="total-label">Subtotal General:</span>
                            <span class="total-value">$<?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></span>
                        </div>
                        
                        <div class="total-row">
                            <span class="total-label">Total Impuestos (IVA):</span>
                            <span class="total-value">$<?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></span>
                        </div>
                        
                        <div class="total-row">
                            <span class="total-label">Descuentos:</span>
                            <span class="total-value">$0.00</span>
                        </div>
                        
                        <hr class="my-3">
                        
                        <div class="total-row">
                            <span class="total-label">TOTAL FACTURA:</span>
                            <span class="grand-total">$<?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></span>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <?php if ($factura['estado'] == 'EMITIDA'): ?>
                        <div class="info-card mt-4">
                            <div class="info-header">
                                <i class="bi bi-lightning-charge"></i>
                                <h5>Acciones Disponibles</h5>
                            </div>
                            <div class="action-buttons">
                                <a href="<?= url_to('facturas_pagar', $factura['id']) ?>" class="btn-success-custom">
                                    <i class="bi bi-check-circle me-2"></i>Marcar como Pagada
                                </a>
                                <a href="<?= url_to('facturas_anular', $factura['id']) ?>" class="btn-danger-custom" 
                                   onclick="return confirm('¿Está seguro de que desea ANULAR esta factura?\n\n⚠️ Esta acción revertirá el inventario y no se puede deshacer.');">
                                    <i class="bi bi-x-circle me-2"></i>Anular Factura
                                </a>
                            </div>
                        </div>
                    <?php elseif ($factura['estado'] == 'PAGADA'): ?>
                        <div class="alert alert-success alert-modern mt-4">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>Factura Pagada</strong> - Esta factura fue marcada como pagada el <?= date('d/m/Y') ?>
                        </div>
                    <?php elseif ($factura['estado'] == 'ANULADA'): ?>
                        <div class="alert alert-danger alert-modern mt-4">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            <strong>Factura Anulada</strong> - Esta factura fue anulada y el inventario ha sido revertido
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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

        // Función para imprimir la factura
        function printInvoice() {
            window.print();
        }

        // Agregar botón de impresión si se necesita
        document.addEventListener('DOMContentLoaded', function() {
            const actionButtons = document.querySelector('.action-buttons');
            if (actionButtons) {
                const printBtn = document.createElement('button');
                printBtn.className = 'btn-modern';
                printBtn.innerHTML = '<i class="bi bi-printer me-2"></i>Imprimir';
                printBtn.onclick = printInvoice;
                actionButtons.appendChild(printBtn);
            }
        });

        // Confirmación para acciones importantes
        document.querySelectorAll('a[onclick]').forEach(link => {
            const originalOnclick = link.getAttribute('onclick');
            if (originalOnclick && originalOnclick.includes('confirm')) {
                // Ya tiene confirmación, no hacer nada
            } else if (link.href.includes('pagar') || link.href.includes('anular')) {
                link.addEventListener('click', function(e) {
                    if (!confirm('¿Está seguro de realizar esta acción?')) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>