<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas - PFEP</title>
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
                <h1 class="text-white mb-2">💰 Reporte de Ventas por Período</h1>
                <p class="text-white opacity-90 mb-0">Filtra y analiza las ventas por fechas y estado</p>
            </div>
            <a href="<?= url_to('reportes_index') ?>" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver a Reportes
            </a>
        </div>

        <!-- Filtros -->
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-funnel me-2"></i>Filtros de Búsqueda</h3>
            </div>
            <div class="card-body p-4">
                <form method="post" action="<?= url_to('reportes_ventas') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                   value="<?= $filtros['fecha_inicio'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                                   value="<?= $filtros['fecha_fin'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="TODOS" <?= ($filtros['estado'] ?? 'TODOS') == 'TODOS' ? 'selected' : '' ?>>Todos los estados</option>
                                <option value="EMITIDA" <?= ($filtros['estado'] ?? '') == 'EMITIDA' ? 'selected' : '' ?>>Emitida</option>
                                <option value="PAGADA" <?= ($filtros['estado'] ?? '') == 'PAGADA' ? 'selected' : '' ?>>Pagada</option>
                                <option value="ANULADA" <?= ($filtros['estado'] ?? '') == 'ANULADA' ? 'selected' : '' ?>>Anulada</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-2"></i>Generar Reporte
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resumen de Totales -->
        <?php if (isset($total_facturas) && $total_facturas > 0): ?>
        <div class="row">
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-primary">
                        <?= $total_facturas ?>
                    </div>
                    <div class="kpi-title">Total Facturas</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-success">
                        $<?= number_format($total_ventas ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Total Ventas</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kpi-card">
                    <div class="kpi-number text-info">
                        $<?= number_format($total_impuestos ?? 0, 2, ',', '.') ?>
                    </div>
                    <div class="kpi-title">Total Impuestos</div>
                </div>
            </div>
        </div>

        <!-- Botón Exportar PDF -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?= url_to('exportar_ventas_pdf') ?>?fecha_inicio=<?= $filtros['fecha_inicio'] ?? '' ?>&fecha_fin=<?= $filtros['fecha_fin'] ?? '' ?>&estado=<?= $filtros['estado'] ?? '' ?>" 
               class="btn btn-danger" target="_blank">
                <i class="bi bi-file-pdf me-2"></i>Exportar a PDF
            </a>
        </div>

        <!-- Lista de Facturas -->
        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-list-ul me-2"></i>Facturas Encontradas</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-container">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>N° Factura</th>
                                <th>Cliente</th>
                                <th>Fecha Emisión</th>
                                <th>Subtotal</th>
                                <th>Impuestos</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas as $factura): ?>
                                <tr>
                                    <td class="fw-bold">#<?= esc($factura['id']) ?></td>
                                    <td><?= esc($factura['cliente_nombre']) ?></td>
                                    <td><?= esc($factura['fecha_emision']) ?></td>
                                    <td>$ <?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></td>
                                    <td>$ <?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></td>
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
            </div>
        </div>
        <?php elseif (isset($total_facturas) && $total_facturas === 0): ?>
        <div class="card-main">
            <div class="card-body text-center py-5">
                <i class="bi bi-search" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
                <h4 class="text-muted mt-3">No se encontraron facturas</h4>
                <p class="text-muted">No hay facturas que coincidan con los criterios de búsqueda</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>