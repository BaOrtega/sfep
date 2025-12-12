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
        
        /* Stats Card */
        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border-top: 4px solid var(--primary-color);
            transition: var(--transition);
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-title {
            font-size: 1rem;
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
            
            .header-card, .stats-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
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
            
            .search-section .row {
                flex-direction: column;
                gap: 1rem;
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
        
        .header-card, .stats-card, .table-container {
            animation: fadeInUp 0.5s ease-out forwards;
        }
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
                    <h1 class="h2 mb-2"><i class="fas fa-users me-2 text-primary"></i><?= esc($title) ?></h1>
                    <p class="text-muted mb-0">Gestiona todos los clientes de tu empresa</p>
                </div>
                <a href="<?= url_to('clientes_new') ?>" class="btn-primary-custom">
                    <i class="fas fa-plus-circle"></i>Nuevo Cliente
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
        <div class="stats-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="stat-number"><?= count($clientes) ?></div>
                    <div class="stat-title">Clientes Registrados</div>
                    <p class="text-muted mb-0 mt-2">Total de clientes en el sistema</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="bg-primary bg-opacity-10 d-inline-block p-4 rounded-circle">
                        <i class="fas fa-user-friends fa-3x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barra de Búsqueda -->
        <div class="search-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control search-input border-start-0" 
                               placeholder="Buscar clientes por nombre, NIT o email..." 
                               id="searchInput">
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <button class="btn btn-outline-secondary" id="clearSearch">
                        <i class="fas fa-times me-2"></i>Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabla de Clientes -->
        <div class="table-container">
            <!-- Table Header -->
            <div class="table-header">
                <h4 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Clientes</h4>
                <small class="opacity-75">Clientes registrados en el sistema</small>
            </div>

            <!-- Table Content -->
            <?php if (empty($clientes)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h4 class="mb-3">No hay clientes registrados</h4>
                    <p class="text-muted mb-4">Comienza agregando tu primer cliente al sistema.</p>
                    <a href="<?= url_to('clientes_new') ?>" class="btn-primary-custom">
                        <i class="fas fa-plus-circle"></i>Agregar Primer Cliente
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="clientsTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Nombre</th>
                                <th><i class="fas fa-id-card me-2"></i>NIT/Cédula</th>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th><i class="fas fa-phone me-2"></i>Teléfono</th>
                                <th><i class="fas fa-calendar me-2"></i>Registro</th>
                                <th><i class="fas fa-cog me-2"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= esc($cliente['nombre']) ?></div>
                                        <?php if (!empty($cliente['direccion'])): ?>
                                            <small class="text-muted"><?= esc($cliente['direccion']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-light"><?= esc($cliente['nit']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($cliente['email'])): ?>
                                            <a href="mailto:<?= esc($cliente['email']) ?>" class="text-decoration-none d-flex align-items-center">
                                                <i class="fas fa-envelope text-primary me-2"></i>
                                                <?= esc($cliente['email']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No especificado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($cliente['telefono'])): ?>
                                            <a href="tel:<?= esc($cliente['telefono']) ?>" class="text-decoration-none d-flex align-items-center">
                                                <i class="fas fa-phone text-primary me-2"></i>
                                                <?= esc($cliente['telefono']) ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No especificado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            <?= date('d/m/Y', strtotime($cliente['created_at'] ?? 'now')) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="<?= url_to('clientes_edit', $cliente['id']) ?>" class="btn-action btn-edit">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-md-inline">Editar</span>
                                            </a>
                                            <a href="<?= url_to('clientes_delete', $cliente['id']) ?>" class="btn-action btn-delete" 
                                               onclick="return confirm('¿Está seguro de eliminar este cliente?');">
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
                        Mostrando <?= count($clientes) ?> clientes
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
            const rows = document.querySelectorAll('#clientsTable tbody tr');
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
                counter.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando ${visibleCount} de <?= count($clientes) ?> clientes`;
            }
        });
        
        // Limpiar búsqueda
        document.getElementById('clearSearch').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            const rows = document.querySelectorAll('#clientsTable tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
            
            // Restaurar contador
            const counter = document.querySelector('.text-muted i.fa-info-circle').parentElement;
            if (counter) {
                counter.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando <?= count($clientes) ?> clientes`;
            }
        });
        
        // Efecto de carga suave
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.header-card, .stats-card, .table-container');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>