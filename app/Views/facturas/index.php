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
        :root {
            --sidebar-width: 280px;
            --main-padding: 30px;
            --primary-gradient: linear-gradient(135deg, #007bff, #0056b3);
            --success-gradient: linear-gradient(135deg, #28a745, #20c997);
            --warning-gradient: linear-gradient(135deg, #ffc107, #fd7e14);
            --danger-gradient: linear-gradient(135deg, #dc3545, #c82333);
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
            max-width: 1600px;
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
            background: var(--success-gradient);
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
        
        .btn-view {
            background: var(--primary-gradient);
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 0.85em;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-view:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
            color: white;
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
            text-align: center;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card.total {
            border-left-color: #007bff;
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
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.8;
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
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
        
        .search-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .invoice-number {
            font-weight: 700;
            color: #007bff;
            font-size: 1.1em;
        }
        
        .invoice-total {
            font-weight: 700;
            color: #28a745;
            font-size: 1.1em;
        }
        
        .date-badge {
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85em;
            font-weight: 500;
            color: #495057;
            border-left: 3px solid #007bff;
        }
        
        /* DEPURACIÓN TEMPORAL */
        .debug-info {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 0.9em;
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
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
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
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .table-modern th, 
            .table-modern td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
            
            .btn-view {
                padding: 6px 10px;
                font-size: 0.75em;
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
            <!-- DEPURACIÓN TEMPORAL -->
            <?php 
            // Verificar si hay duplicados
            $ids = array_column($facturas, 'id');
            $unique_ids = array_unique($ids);
            $has_duplicates = count($ids) !== count($unique_ids);
            
            if ($has_duplicates): 
                $duplicate_ids = array_diff_assoc($ids, $unique_ids);
            ?>
            <div class="debug-info">
                <strong>⚠️ DEPURACIÓN:</strong> Se encontraron <?= count($ids) - count($unique_ids) ?> duplicado(s)<br>
                <small>IDs únicos: <?= count($unique_ids) ?> | Total filas: <?= count($ids) ?></small>
            </div>
            <?php endif; ?>

            <!-- Tarjeta Principal -->
            <div class="card-main">
                <!-- Header -->
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1"><i class="bi bi-receipt me-2"></i>Gestión de Facturas</h2>
                            <p class="mb-0 opacity-75">Administra y visualiza todas las facturas del sistema</p>
                        </div>
                        <a href="<?= url_to('facturas_new') ?>" class="btn-modern">
                            <i class="bi bi-plus-circle"></i>Nueva Factura
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
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Estadísticas -->
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
                            <div class="stat-title">Pagadas</div>
                        </div>
                        
                        <div class="stat-card annulled">
                            <div class="stat-icon text-danger">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="stat-number text-danger"><?= $facturasAnuladas ?? '0' ?></div>
                            <div class="stat-title">Anuladas</div>
                        </div>
                    </div>

                    <!-- Barra de Búsqueda -->
                    <div class="search-section">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control border-0" placeholder="Buscar facturas por cliente, número o estado...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <select class="form-select" id="statusFilter" style="max-width: 150px;">
                                        <option value="">Todos los estados</option>
                                        <option value="EMITIDA">Emitidas</option>
                                        <option value="PAGADA">Pagadas</option>
                                        <option value="ANULADA">Anuladas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Facturas -->
                    <?php if (empty($facturas)): ?>
                        <div class="empty-state">
                            <i class="bi bi-receipt"></i>
                            <h4>No hay facturas registradas</h4>
                            <p class="text-muted">Comienza creando tu primera factura</p>
                            <a href="<?= url_to('facturas_new') ?>" class="btn-modern mt-3">
                                <i class="bi bi-plus-circle"></i>Crear Primera Factura
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-hash me-2"></i>N° Factura</th>
                                        <th><i class="bi bi-person me-2"></i>Cliente</th>
                                        <th><i class="bi bi-calendar me-2"></i>Fecha Emisión</th>
                                        <th><i class="bi bi-currency-dollar me-2"></i>Total</th>
                                        <th><i class="bi bi-circle-fill me-2"></i>Estado</th>
                                        <th><i class="bi bi-gear me-2"></i>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $contador = 0;
                                    foreach ($facturas as $factura): 
                                        $contador++;
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="invoice-number">#<?= esc($factura['id']) ?></div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold"><?= esc($factura['cliente_nombre'] ?? 'Cliente no encontrado') ?></div>
                                                <?php if (isset($factura['cliente_documento']) && !empty($factura['cliente_documento'])): ?>
                                                    <small class="text-muted"><?= esc($factura['cliente_documento']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="date-badge"><?= esc($factura['fecha_emision']) ?></div>
                                            </td>
                                            <td>
                                                <span class="invoice-total">$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></span>
                                            </td>
                                            <td>
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
                                                    <?= esc($estado) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="<?= url_to('facturas_view', $factura['id']) ?>" class="btn-view">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Información de resultados -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Mostrando <?= $contador ?> facturas
                            </div>
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

        // Funcionalidad de búsqueda
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.table-modern tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filtro por estado
        document.getElementById('statusFilter').addEventListener('change', function(e) {
            const filterValue = e.target.value;
            const rows = document.querySelectorAll('.table-modern tbody tr');
            
            rows.forEach(row => {
                const statusBadge = row.querySelector('.status-badge');
                const statusText = statusBadge ? statusBadge.textContent.trim() : '';
                let showRow = true;
                
                if (filterValue && statusText !== filterValue) {
                    showRow = false;
                }
                
                row.style.display = showRow ? '' : 'none';
            });
        });
    </script>
</body>
</html>