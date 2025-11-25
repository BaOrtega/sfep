<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PFEP</title>
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
        }
        .card-header-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        .btn-modern {
            background: linear-gradient(135deg, #28a745, #20c997);
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
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }
        .btn-edit {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 0.85em;
            transition: all 0.3s ease;
        }
        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
            color: white;
        }
        .btn-delete {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 0.85em;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
            color: white;
        }
        .table-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
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
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .alert-modern {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .badge-stock {
            font-size: 0.75em;
            padding: 6px 10px;
            border-radius: 12px;
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
                    <i class="bi bi-house me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos') ?>" class="active">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('facturas') ?>">
                    <i class="bi bi-receipt me-3"></i>Factura
                </a>
            </div>
            <div class="nav-item">
                <a href="/reportes">
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
        <div class="card-main">
            <!-- Header -->
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1"><i class="bi bi-box-seam me-2"></i><?= esc($title) ?></h2>
                        <p class="mb-0 opacity-75">Gestiona todos los productos de tu inventario</p>
                    </div>
                    <a href="<?= url_to('productos/new') ?>" class="btn-modern">
                        <i class="bi bi-plus-circle"></i>Nuevo Producto
                    </a>
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

                <!-- Estadísticas -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0"><?= count($productos) ?></h3>
                                    <p class="mb-0">Total Productos</p>
                                </div>
                                <i class="bi bi-box-seam fs-1 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0"><?= array_sum(array_column($productos, 'inventario')) ?></h3>
                                    <p class="mb-0">En Stock</p>
                                </div>
                                <i class="bi bi-check-circle fs-1 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #fd7e14, #e55a00);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="mb-0">
                                        <?= count(array_filter($productos, function($p) { return $p['inventario'] <= 5 && $p['inventario'] > 0; })) ?>
                                    </h3>
                                    <p class="mb-0">Stock Bajo</p>
                                </div>
                                <i class="bi bi-exclamation-triangle fs-1 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #6f42c1, #5a2d9c);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">
                                        $<?= number_format(array_sum(array_map(function($p) { 
                                            return $p['costo'] * $p['inventario']; 
                                        }, $productos)), 2, ',', '.') ?>
                                    </h5>
                                    <p class="mb-0">Valor Inventario</p>
                                </div>
                                <i class="bi bi-currency-dollar fs-1 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Productos -->
                <?php if (empty($productos)): ?>
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>No hay productos registrados</h4>
                        <p class="text-muted">Comienza agregando tu primer producto al inventario.</p>
                        <a href="<?= url_to('productos/new') ?>" class="btn-modern mt-3">
                            <i class="bi bi-plus-circle"></i>Agregar Primer Producto
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-tag me-2"></i>Nombre</th>
                                    <th><i class="bi bi-currency-dollar me-2"></i>Precio Venta</th>
                                    <th><i class="bi bi-currency-exchange me-2"></i>Costo</th>
                                    <th><i class="bi bi-percent me-2"></i>IVA</th>
                                    <th><i class="bi bi-box me-2"></i>Inventario</th>
                                    <th><i class="bi bi-gear me-2"></i>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= esc($producto['nombre']) ?></div>
                                            <?php if (!empty($producto['descripcion'])): ?>
                                                <small class="text-muted"><?= esc($producto['descripcion']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">$ <?= number_format(esc($producto['precio_unitario']), 2, ',', '.') ?></span>
                                        </td>
                                        <td>$ <?= number_format(esc($producto['costo']), 2, ',', '.') ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark"><?= esc($producto['tasa_impuesto']) ?>%</span>
                                        </td>
                                        <td>
                                            <?php 
                                                $stock = $producto['inventario'];
                                                $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning' : 'bg-danger');
                                                $stockText = $stock > 10 ? 'Alto' : ($stock > 0 ? 'Bajo' : 'Agotado');
                                            ?>
                                            <span class="badge <?= $badgeClass ?> badge-stock">
                                                <?= esc($stock) ?> unidades
                                            </span>
                                        </td>
                                       <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('productos/edit/' . esc($producto['id'])) ?>" class="btn-edit">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </a>
                                                <a href="<?= base_url('productos/delete/' . esc($producto['id'])) ?>" 
                                                class="btn-delete" 
                                                onclick="return confirm('¿Está seguro de eliminar este producto?');">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </a>
                                            </div>
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