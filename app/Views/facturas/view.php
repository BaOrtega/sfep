<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Factura - PFEP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
        .info-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        .table-custom th {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        .table-custom td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        .total-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            margin-top: 25px;
            text-align: right;
        }
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
        }
        .btn-success-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .btn-danger-custom {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .invoice-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-white mb-2">👁️ Visualizar Factura</h1>
                <p class="text-white opacity-90 mb-0">Detalles completos de la factura seleccionada</p>
            </div>
            <a href="<?= url_to('facturas_index') ?>" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Volver al Listado
            </a>
            <a href="<?= url_to('facturas_pdf', $factura['id']) ?>" class="btn btn-success" target="_blank">
    📥 Generar PDF
</a>
        </div>

        <!-- Encabezado de Factura -->
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">Factura #<?= esc($factura['id']) ?></h1>
                    <p class="mb-0 opacity-90">
                        <i class="bi bi-calendar me-2"></i>Emitida el <?= esc($factura['fecha_emision']) ?> | 
                        <i class="bi bi-person me-2"></i>Por: <?= esc(session()->get('user_name')) ?>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <?php 
                        $badgeClass = [
                            'EMITIDA' => 'bg-warning',
                            'PAGADA' => 'bg-success',
                            'ANULADA' => 'bg-danger'
                        ][$factura['estado']] ?? 'bg-secondary';
                    ?>
                    <span class="status-badge <?= $badgeClass ?>">
                        <?= esc($factura['estado']) ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h3>
            </div>
            <div class="card-body p-4">
                <!-- Información del Cliente -->
                <div class="info-section">
                    <h4 class="mb-4"><i class="bi bi-person-badge me-2"></i>Datos del Cliente</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> <?= esc($cliente['nombre']) ?></p>
                            <p><strong>NIT/Identificación:</strong> <?= esc($cliente['nit']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Dirección:</strong> <?= esc($cliente['direccion'] ?? 'No especificada') ?></p>
                            <p><strong>Teléfono:</strong> <?= esc($cliente['telefono'] ?? 'No especificado') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Información de Fechas -->
                <div class="info-section">
                    <h4 class="mb-4"><i class="bi bi-calendar-event me-2"></i>Fechas de la Factura</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Fecha de Emisión:</strong><br><?= esc($factura['fecha_emision']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Fecha de Vencimiento:</strong><br><?= esc($factura['fecha_vencimiento']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Usuario Emisor:</strong><br><?= esc(session()->get('user_name')) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Detalle de Productos -->
                <div class="info-section">
                    <h4 class="mb-4"><i class="bi bi-list-check me-2"></i>Detalle de Productos/Servicios</h4>
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">Producto/Servicio</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>IVA %</th>
                                    <th>Total Línea</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalles as $detalle): ?>
                                <tr>
                                    <td style="text-align: left;"><?= esc($detalle['nombre']) ?></td>
                                    <td><?= esc($detalle['cantidad']) ?></td>
                                    <td>$ <?= number_format(esc($detalle['precio_unitario']), 2, ',', '.') ?></td>
                                    <td><?= esc($detalle['tasa_impuesto']) ?>%</td>
                                    <td class="fw-bold">$ <?= number_format(esc($detalle['total_linea']), 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totales -->
                <div class="total-box">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-muted mb-3">Resumen Financiero</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2 fs-5">Subtotal General: <span class="fw-bold">$ <?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></span></p>
                            <p class="mb-2 fs-5">Total Impuestos: <span class="fw-bold">$ <?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></span></p>
                            <hr>
                            <h3 class="mb-0 text-primary">TOTAL FACTURA: $ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <?php if ($factura['estado'] == 'EMITIDA'): ?>
                    <div class="info-section mt-4">
                        <h4 class="mb-4"><i class="bi bi-lightning me-2"></i>Acciones Disponibles</h4>
                        <div class="d-flex gap-3">
                            <a href="<?= url_to('facturas_pagar', $factura['id']) ?>" class="btn btn-success-custom">
                                <i class="bi bi-check-circle me-2"></i>Marcar como Pagada
                            </a>
                            <a href="<?= url_to('facturas_anular', $factura['id']) ?>" class="btn btn-danger-custom" 
                               onclick="return confirm('¿Está seguro de que desea ANULAR esta factura? Esta acción no se puede deshacer.');">
                                <i class="bi bi-x-circle me-2"></i>Anular Factura
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>