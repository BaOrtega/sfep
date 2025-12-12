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
        
        /* Header Card */
        .header-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
            transition: var(--transition);
        }
        
        .header-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
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
        
        .stat-card.stock {
            border-top-color: var(--success-color);
        }
        
        .stat-card.low-stock {
            border-top-color: var(--warning-color);
        }
        
        .stat-card.value {
            border-top-color: #8b5cf6;
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
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Table Container */
        .table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .table-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
            padding: 1.5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .table-header::before {
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
        
        /* Table Styles */
        .table-responsive {
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
        
        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 95, 180, 0.3);
            color: white;
        }
        
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            border: none;
            text-decoration: none;
        }
        
        .btn-edit {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-edit:hover {
            background: #0c4a9e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 95, 180, 0.2);
        }
        
        .btn-delete {
            background: var(--danger-color);
            color: white;
        }
        
        .btn-delete:hover {
            background: #b91c1c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }
        
        /* Search Section */
        .search-section {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }
        
        .search-input {
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }
        
        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.1);
            outline: none;
        }
        
        .filter-select {
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            background-color: white;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.1);
            outline: none;
        }
        
        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: #64748b;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: #cbd5e1;
        }
        
        /* Badges */
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        
        .badge-stock {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
            font-weight: 700;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-light {
            background-color: #f1f5f9;
            color: var(--dark-color);
        }
        
        /* Pagination */
        .pagination-custom .page-link {
            border: none;
            color: var(--dark-color);
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .pagination-custom .page-link:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }
        
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
        }
        
        /* Alert */
        .alert-custom {
            border-radius: var(--border-radius);
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
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
            
            .header-card, .stat-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
            
            .table-header {
                padding: 1.25rem;
            }
            
            .btn-action {
                padding: 0.5rem;
                font-size: 0.8rem;
            }
            
            .search-section .row {
                flex-direction: column;
                gap: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .header-card .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .action-buttons .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .search-section .d-flex {
                flex-direction: column;
                gap: 1rem;
            }
            
            .filter-select, .search-input {
                width: 100%;
            }
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
        
        .header-card, .stat-card, .table-container {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header Section -->
        <div class="header-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-2"><i class="fas fa-boxes me-2 text-primary"></i><?= esc($title) ?></h1>
                    <p class="text-muted mb-0">Gestiona todos los productos de tu inventario</p>
                </div>
                <a href="<?= url_to('productos_new') ?>" class="btn-primary-custom">
                    <i class="fas fa-plus-circle"></i>Nuevo Producto
                </a>
            </div>
        </div>

        <!-- Alertas -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon text-primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-number"><?= count($productos) ?></div>
                <div class="stat-title">Total Productos</div>
                <small class="text-muted d-block mt-2">Productos en el sistema</small>
            </div>
            
            <div class="stat-card stock">
                <div class="stat-icon text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number"><?= array_sum(array_column($productos, 'inventario')) ?></div>
                <div class="stat-title">En Stock</div>
                <small class="text-muted d-block mt-2">Unidades disponibles</small>
            </div>
            
            <div class="stat-card low-stock">
                <div class="stat-icon text-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-number">
                    <?= count(array_filter($productos, function($p) { return $p['inventario'] <= 5 && $p['inventario'] > 0; })) ?>
                </div>
                <div class="stat-title">Stock Bajo</div>
                <small class="text-muted d-block mt-2">Menos de 5 unidades</small>
            </div>
            
            <div class="stat-card value">
                <div class="stat-icon" style="color: #8b5cf6;">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-number" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    $<?= number_format(array_sum(array_map(function($p) { 
                        return $p['costo'] * $p['inventario']; 
                    }, $productos)), 0, ',', '.') ?>
                </div>          
                <div class="stat-title">Valor Inventario</div>
                <small class="text-muted d-block mt-2">Valor total en stock</small>
            </div>
        </div>

        <!-- Barra de Búsqueda y Filtros -->
        <div class="search-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control search-input border-start-0" 
                               placeholder="Buscar productos por nombre o descripción..." 
                               id="searchInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <select class="filter-select" id="stockFilter" style="max-width: 150px;">
                            <option value="">Todos los stocks</option>
                            <option value="high">Stock Alto</option>
                            <option value="low">Stock Bajo</option>
                            <option value="out">Agotados</option>
                        </select>
                        <button class="btn btn-outline-secondary" id="clearFilters">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Productos -->
        <div class="table-container">
            <!-- Table Header -->
            <div class="table-header">
                <h4 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Productos</h4>
                <small class="opacity-75">Productos registrados en el inventario</small>
            </div>

            <!-- Table Content -->
            <?php if (empty($productos)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h4 class="mb-3">No hay productos registrados</h4>
                    <p class="text-muted mb-4">Comienza agregando tu primer producto al inventario.</p>
                    <a href="<?= url_to('productos_new') ?>" class="btn-primary-custom">
                        <i class="fas fa-plus-circle"></i>Agregar Primer Producto
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="productsTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-tag me-2"></i>Nombre</th>
                                <th><i class="fas fa-tag me-2"></i>Descripción</th>
                                <th><i class="fas fa-money-bill-wave me-2"></i>Precio Venta</th>
                                <th><i class="fas fa-money-bill me-2"></i>Costo</th>
                                <th><i class="fas fa-percentage me-2"></i>IVA</th>
                                <th><i class="fas fa-box me-2"></i>Inventario</th>
                                <th><i class="fas fa-cog me-2"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <?php 
                                    $stock = $producto['inventario'];
                                    $badgeClass = $stock > 10 ? 'badge-success' : ($stock > 0 ? 'badge-warning' : 'badge-danger');
                                    $stockText = $stock > 10 ? 'Alto' : ($stock > 0 ? 'Bajo' : 'Agotado');
                                ?>
                                <tr data-stock="<?= $stockText ?>">
                                    <td>
                                        <div class="fw-semibold"><?= esc($producto['nombre']) ?></div>
                                        <small class="text-muted">Código: <?= $producto['id'] ?></small>
                                    </td>
                                    <td>
                                        <?php if (!empty($producto['descripcion'])): ?>
                                            <span class="text-muted"><?= esc($producto['descripcion']) ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Sin descripción</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">$<?= number_format(esc($producto['precio_unitario']), 2, ',', '.') ?></span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">$<?= number_format(esc($producto['costo']), 2, ',', '.') ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light"><?= esc($producto['tasa_impuesto']) ?>%</span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $badgeClass ?> badge-stock">
                                            <i class="fas fa-<?= $stock > 10 ? 'check' : ($stock > 0 ? 'exclamation' : 'times') ?> me-1"></i>
                                            <?= esc($stock) ?> unidades
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="<?= url_to('productos_edit', $producto['id']) ?>" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-md-inline">Editar</span>
                                            </a>
                                            <a href="<?= url_to('productos_delete', $producto['id']) ?>" class="btn-action btn-delete" 
                                               onclick="return confirm('¿Está seguro de eliminar este producto?');">
                                                <i class="fas fa-trash"></i>
                                                <span class="d-none d-md-inline">Eliminar</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Mostrando <?= count($productos) ?> productos
                    </div>
                    <nav>
                        <ul class="pagination pagination-custom mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Funcionalidad de búsqueda
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#productsTable tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Actualizar contador si es necesario
            const counter = document.querySelector('.text-muted i.fa-info-circle').parentElement;
            if (counter) {
                counter.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando ${visibleCount} de <?= count($productos) ?> productos`;
            }
        });
        
        // Filtro por stock
        document.getElementById('stockFilter').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            const rows = document.querySelectorAll('#productsTable tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const stockAttribute = row.getAttribute('data-stock').toLowerCase();
                let showRow = true;
                
                if (filterValue === 'high' && stockAttribute !== 'alto') {
                    showRow = false;
                } else if (filterValue === 'low' && stockAttribute !== 'bajo') {
                    showRow = false;
                } else if (filterValue === 'out' && stockAttribute !== 'agotado') {
                    showRow = false;
                } else if (filterValue === '') {
                    showRow = true;
                }
                
                if (showRow && row.style.display !== 'none') {
                    visibleCount++;
                }
                row.style.display = showRow ? '' : 'none';
            });
            
            // Actualizar contador
            const counter = document.querySelector('.text-muted i.fa-info-circle').parentElement;
            if (counter) {
                counter.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando ${visibleCount} de <?= count($productos) ?> productos`;
            }
        });
        
        // Limpiar filtros
        document.getElementById('clearFilters').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            document.getElementById('stockFilter').value = '';
            
            const rows = document.querySelectorAll('#productsTable tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
            
            // Restaurar contador
            const counter = document.querySelector('.text-muted i.fa-info-circle').parentElement;
            if (counter) {
                counter.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando <?= count($productos) ?> productos`;
            }
        });
        
        // Efecto de carga suave
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.header-card, .stat-card, .table-container');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>