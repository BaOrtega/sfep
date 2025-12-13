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
        
        /* Header Card */
        .header-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }
        
        .header-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(26, 95, 180, 0.05) 0%, rgba(14, 165, 233, 0.05) 100%);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }
        
        .header-card h1 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .header-card .subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 0;
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
            padding: 1.5rem;
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
        
        .stat-card.emitted {
            border-top-color: var(--warning-color);
        }
        
        .stat-card.pending {
            border-top-color: var(--success-color);
        }
        
        .stat-card.annulled {
            border-top-color: var(--danger-color);
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
        
        /* Search Section */
        .search-section {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }
        
        /* Table Styles */
        .table-responsive {
            border-radius: 0 0 var(--border-radius) var(--border-radius);
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
        
        /* Status Badges */
        .status-badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
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
        
        /* Action Buttons */
        .btn-view {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 95, 180, 0.2);
            color: white;
        }
        
        .btn-create {
            background: linear-gradient(135deg, var(--success-color) 0%, #0da271 100%);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        
        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
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
            padding: 4rem 2rem;
            color: #64748b;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }
        
        /* Invoice Number */
        .invoice-number {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .invoice-total {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.1rem;
        }
        
        /* Date Badge */
        .date-badge {
            background: #f1f5f9;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            border-left: 3px solid var(--primary-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .header-card {
                padding: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .search-section {
                padding: 1rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .header-card h1 {
                font-size: 1.5rem;
            }
            
            .table {
                font-size: 0.85rem;
            }
            
            .status-badge {
                padding: 0.375rem 0.75rem;
                font-size: 0.75rem;
            }
            
            .btn-view {
                padding: 0.375rem 0.75rem;
                font-size: 0.75rem;
            }
        }
        
        /* Animations */
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
        
        .stat-card, .main-card {
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
        <!-- Header Card -->
        <div class="header-card">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <h1 class="display-6 mb-2">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Gestión de Facturas
                    </h1>
                    <p class="subtitle mb-0">
                        Administra y visualiza todas las facturas del sistema
                    </p>
                </div>
                <a href="<?= url_to('facturas_new') ?>" class="btn-create">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Factura
                </a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon text-primary">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-number text-primary"><?= $totalFacturas ?? '0' ?></div>
                <div class="stat-title">Total Facturas</div>
            </div>
            
            <div class="stat-card emitted">
                <div class="stat-icon text-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number text-warning"><?= $facturasEmitidas ?? '0' ?></div>
                <div class="stat-title">Emitidas</div>
            </div>
            
            <div class="stat-card pending">
                <div class="stat-icon text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number text-success"><?= $facturasPagadas ?? '0' ?></div>
                <div class="stat-title">Pagadas</div>
            </div>
            
            <div class="stat-card annulled">
                <div class="stat-icon text-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-number text-danger"><?= $facturasAnuladas ?? '0' ?></div>
                <div class="stat-title">Anuladas</div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="main-card">
            <!-- Card Header -->
            <div class="card-header-custom">
                <h3>
                    <i class="fas fa-list me-2"></i>
                    Lista de Facturas
                </h3>
            </div>

            <!-- Card Body -->
            <div class="card-body p-0">
                <!-- Search Section -->
                <div class="search-section">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Buscar facturas por cliente, número o estado...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <select class="form-select" id="statusFilter" style="max-width: 200px;">
                                    <option value="">Todos los estados</option>
                                    <option value="EMITIDA">Emitidas</option>
                                    <option value="PAGADA">Pagadas</option>
                                    <option value="ANULADA">Anuladas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

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

                <!-- Facturas Table -->
                <?php if (empty($facturas)): ?>
                    <div class="empty-state">
                        <i class="fas fa-file-invoice"></i>
                        <h4>No hay facturas registradas</h4>
                        <p class="text-muted">Comienza creando tu primera factura</p>
                        <a href="<?= url_to('facturas_new') ?>" class="btn-create mt-3">
                            <i class="fas fa-plus-circle me-2"></i>Crear Primera Factura
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>N° Factura</th>
                                    <th><i class="fas fa-user me-2"></i>Cliente</th>
                                    <th><i class="fas fa-calendar me-2"></i>Fecha Emisión</th>
                                    <th><i class="fas fa-dollar-sign me-2"></i>Total</th>
                                    <th><i class="fas fa-circle me-2"></i>Estado</th>
                                    <th><i class="fas fa-cog me-2"></i>Acciones</th>
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
                                                <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                                <?= esc($estado) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="<?= url_to('facturas_view', $factura['id']) ?>" class="btn-view">
                                                    <i class="fas fa-eye me-1"></i> Ver
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Results Info -->
                    <div class="d-flex justify-content-between align-items-center p-3 border-top">
                        <div class="text-muted">
                            Mostrando <?= $contador ?> facturas
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Funcionalidad de búsqueda
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
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
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const statusBadge = row.querySelector('.status-badge');
                if (!statusBadge) return;
                
                const statusText = statusBadge.textContent.trim().toUpperCase();
                const statusMatch = filterValue === '' || statusText === filterValue;
                
                if (statusMatch && row.textContent.toLowerCase().includes(document.getElementById('searchInput').value.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>