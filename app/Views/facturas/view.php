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
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Invoice Header */
        .invoice-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
            border-radius: var(--border-radius);
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
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
            transform: translate(30%, -30%);
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
            transform: translate(-20%, 30%);
        }
        
        .invoice-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .invoice-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }
        
        /* Status Badge */
        .status-badge {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .status-emitida {
            background: linear-gradient(135deg, var(--warning-color) 0%, #e3a008 100%);
            color: white;
        }
        
        .status-pagada {
            background: linear-gradient(135deg, var(--success-color) 0%, #0da271 100%);
            color: white;
        }
        
        .status-anulada {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            color: white;
        }
        
        /* Main Card */
        .main-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: var(--transition);
        }
        
        .main-card:hover {
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
        
        .card-header-custom h3 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .card-header-custom i {
            margin-right: 0.75rem;
        }
        
        /* Info Cards */
        .info-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        
        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
        }
        
        .info-header h5 {
            margin: 0;
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .info-header i {
            color: var(--primary-color);
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            flex: 0 0 200px;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .info-value {
            flex: 1;
            color: #64748b;
        }
        
        /* Table Styles */
        .table-modern {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .table-modern th {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-modern td {
            border: none;
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table-modern tbody tr {
            transition: var(--transition);
        }
        
        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }
        
        /* Total Section */
        .total-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-top: 1.5rem;
            border: 2px solid #e2e8f0;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .total-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .total-label {
            font-size: 1rem;
            color: #64748b;
            font-weight: 500;
        }
        
        .total-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .grand-total {
            font-size: 1.8rem;
            color: var(--primary-color);
            font-weight: 700;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }
        
        .btn-back {
            background: white;
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-back:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--dark-color);
            transform: translateY(-2px);
        }
        
        .btn-pdf {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }
        
        .btn-success-custom {
            background: linear-gradient(135deg, var(--success-color) 0%, #0da271 100%);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }
        
        .btn-danger-custom {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }
        
        /* Alerts */
        .alert-modern {
            border-radius: var(--border-radius);
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
        }
        
        .alert-modern.alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-left: 4px solid var(--success-color);
            color: var(--dark-color);
        }
        
        .alert-modern.alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            border-left: 4px solid var(--danger-color);
            color: var(--dark-color);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .invoice-header {
                padding: 1.5rem;
            }
            
            .invoice-title {
                font-size: 1.8rem;
            }
            
            .info-card {
                padding: 1.25rem;
            }
            
            .info-row {
                flex-direction: column;
            }
            
            .info-label {
                flex: 0 0 auto;
                margin-bottom: 0.5rem;
            }
            
            .total-section {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .invoice-title {
                font-size: 1.5rem;
            }
            
            .status-badge {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
            
            .card-header-custom h3 {
                font-size: 1.25rem;
            }
            
            .total-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .grand-total {
                font-size: 1.5rem;
            }
        }
        
        @media print {
            .action-buttons,
            .btn-back,
            .btn-pdf {
                display: none !important;
            }
            
            body {
                background: white !important;
            }
            
            .main-content {
                padding: 0 !important;
                max-width: none !important;
            }
            
            .invoice-header {
                background: #1a5fb4 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .main-card {
                box-shadow: none !important;
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
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="invoice-title">
                        <i class="fas fa-file-invoice-dollar me-3"></i>Factura #<?= esc($factura['id']) ?>
                    </h1>
                    <p class="invoice-subtitle mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Emitida: <?= esc($factura['fecha_emision']) ?> | 
                        <i class="fas fa-user me-2"></i>Emisor: <?= esc(session()->get('user_name')) ?>
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
                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i><?= esc($estado) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="main-card">
            <!-- Card Header -->
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h3>
                        <i class="fas fa-file-alt me-2"></i>
                        Detalles de la Factura
                    </h3>
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <a href="<?= url_to('facturas_pdf', $factura['id']) ?>" class="btn-pdf" target="_blank">
                            <i class="fas fa-file-pdf me-2"></i>Generar PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-3">
                <!-- Alerts -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-modern alert-dismissible fade show mx-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">¡Éxito!</h5>
                                <p class="mb-0"><?= session()->getFlashdata('success') ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-modern alert-dismissible fade show mx-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Error</h5>
                                <p class="mb-0"><?= session()->getFlashdata('error') ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Client Information -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-user-tag"></i>
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

                <!-- Invoice Information -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-calendar-check"></i>
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

                <!-- Product Details -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-boxes"></i>
                        <h5>Detalle de Productos</h5>
                    </div>
                    
                    <?php if (empty($detalles)): ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>No hay productos en esta factura</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-2"></i>#</th>
                                        <th><i class="fas fa-box me-2"></i>Producto</th>
                                        <th><i class="fas fa-hashtag me-2"></i>Cantidad</th>
                                        <th><i class="fas fa-dollar-sign me-2"></i>Precio Unitario</th>
                                        <th><i class="fas fa-percent me-2"></i>IVA</th>
                                        <th><i class="fas fa-calculator me-2"></i>Total Línea</th>
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

                <!-- Totals -->
                <div class="total-section">
                    <div class="info-header">
                        <i class="fas fa-calculator"></i>
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

                <!-- Actions -->
                <?php if ($factura['estado'] == 'EMITIDA'): ?>
                    <div class="info-card mt-4">
                        <div class="info-header">
                            <i class="fas fa-bolt"></i>
                            <h5>Acciones Disponibles</h5>
                        </div>
                        <div class="action-buttons">
                            <a href="<?= url_to('facturas_pagar', $factura['id']) ?>" class="btn-success-custom">
                                <i class="fas fa-check-circle me-2"></i>Marcar como Pagada
                            </a>
                            <a href="<?= url_to('facturas_anular', $factura['id']) ?>" class="btn-danger-custom" 
                               onclick="return confirm('¿Está seguro de que desea ANULAR esta factura?\n\n⚠️ Esta acción revertirá el inventario y no se puede deshacer.');">
                                <i class="fas fa-times-circle me-2"></i>Anular Factura
                            </a>
                        </div>
                    </div>
                <?php elseif ($factura['estado'] == 'PAGADA'): ?>
                    <div class="alert alert-success alert-modern mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Factura Pagada</h5>
                                <p class="mb-0">Esta factura fue marcada como pagada el <?= date('d/m/Y') ?></p>
                            </div>
                        </div>
                    </div>
                <?php elseif ($factura['estado'] == 'ANULADA'): ?>
                    <div class="alert alert-danger alert-modern mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-times-circle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Factura Anulada</h5>
                                <p class="mb-0">Esta factura fue anulada y el inventario ha sido revertido</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Función para imprimir la factura
        function printInvoice() {
            window.print();
        }

        // Agregar botón de impresión
        document.addEventListener('DOMContentLoaded', function() {
            const actionButtons = document.querySelector('.action-buttons');
            if (actionButtons) {
                const printBtn = document.createElement('a');
                printBtn.className = 'btn-back';
                printBtn.innerHTML = '<i class="fas fa-print me-2"></i>Imprimir';
                printBtn.onclick = printInvoice;
                printBtn.style.cursor = 'pointer';
                actionButtons.insertBefore(printBtn, actionButtons.firstChild);
            }
        });

        // Confirmación para acciones importantes
        document.querySelectorAll('a[onclick]').forEach(link => {
            const originalOnclick = link.getAttribute('onclick');
            if (!originalOnclick || !originalOnclick.includes('confirm')) {
                if (link.href.includes('pagar') || link.href.includes('anular')) {
                    link.addEventListener('click', function(e) {
                        if (!confirm('¿Está seguro de realizar esta acción?')) {
                            e.preventDefault();
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>