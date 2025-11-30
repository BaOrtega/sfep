<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas - PFEP</title>
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
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .stat-card.emitted {
            border-left-color: #28a745;
        }
        .stat-card.pending {
            border-left-color: #ffc107;
        }
        .stat-card.annulled {
            border-left-color: #dc3545;
        }
        .stat-card.total {
            border-left-color: #6f42c1;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.8;
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
        .btn-new-invoice {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-new-invoice:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 20px;
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
        <!-- Header con Estadísticas -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-white mb-2">📋 Gestión de Facturas</h1>
                <p class="text-white opacity-90 mb-0">Administra y visualiza todas las facturas del sistema</p>
            </div>
            <a href="<?= url_to('facturas_new') ?>" class="btn btn-new-invoice">
                <i class="bi bi-plus-circle me-2"></i>Nueva Factura
            </a>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon text-primary">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-number text-primary"><?= $totalFacturas ?? '0' ?></div>
                <div class="stat-title">Total Facturas</div>
            </div>
            
            <div class="stat-card emitted">
                <div class="stat-icon text-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-number text-success"><?= $facturasEmitidas ?? '0' ?></div>
                <div class="stat-title">Emitidas</div>
            </div>
            
            <div class="stat-card pending">
                <div class="stat-icon text-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-number text-warning"><?= $facturasPendientes ?? '0' ?></div>
                <div class="stat-title">Pendientes</div>
            </div>
            
            <div class="stat-card annulled">
                <div class="stat-icon text-danger">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-number text-danger"><?= $facturasAnuladas ?? '0' ?></div>
                <div class="stat-title">Anuladas</div>
            </div>
        </div>

        <!-- Lista de Facturas -->
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-list-ul me-2"></i>Listado de Facturas</h3>
            </div>
            <div class="card-body p-0">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-custom m-4">
                        <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-custom m-4">
                        <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($facturas)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-receipt" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
                        <h4 class="text-muted mt-3">No hay facturas registradas</h4>
                        <p class="text-muted">Comienza creando tu primera factura</p>
                        <a href="<?= url_to('facturas/new') ?>" class="btn btn-new-invoice">
                            <i class="bi bi-plus-circle me-2"></i>Crear Primera Factura
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>N° Factura</th>
                                    <th>Cliente</th>
                                    <th>Fecha Emisión</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturas as $factura): ?>
                                    <tr>
                                        <td class="fw-bold">#<?= esc($factura['id']) ?></td>
                                        <td><?= esc($factura['cliente_nombre'] ?? ' ' . $factura['nombre_cliente']) ?></td>
                                        <td><?= esc($factura['fecha_emision']) ?></td>
                                        <td class="fw-bold">$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></td>
                                        <td>
                                            <?php 
                                                $badgeClass = [
                                                    'EMITIDA' => 'bg-warning',
                                                    'PAGADA' => 'bg-success',
                                                    'ANULADA' => 'bg-danger'
                                                ][$factura['estado']] ?? 'bg-secondary';
                                            ?>
                                            <span class="status-badge <?= $badgeClass ?> text-white">
                                                <?= esc($factura['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= url_to('facturas_view', $factura['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> Ver
                                            </a>
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

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>