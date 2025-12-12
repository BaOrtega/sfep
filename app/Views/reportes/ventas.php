<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas - PFEP</title>
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
        
        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border-radius: var(--border-radius);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: var(--box-shadow);
        }
        
        .page-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-header .lead {
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }
        
        .filter-card h4 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
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
        
        .stat-card.invoices {
            border-top-color: var(--primary-color);
        }
        
        .stat-card.sales {
            border-top-color: var(--success-color);
        }
        
        .stat-card.taxes {
            border-top-color: var(--accent-color);
        }
        
        .stat-card.average {
            border-top-color: var(--warning-color);
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
        }
        
        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Main Card */
        .card-main {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2.5rem;
            transition: var(--transition);
        }
        
        .card-main:hover {
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
        
        .card-header-custom h4 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .card-header-custom i {
            margin-right: 0.75rem;
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
        
        .status-badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        
        /* Export Button */
        .export-btn {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c53030 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
        }
        
        .export-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #94a3b8;
            opacity: 0.5;
            margin-bottom: 1.5rem;
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
        
        .stat-card, .card-main, .filter-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
        
        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .page-header {
                padding: 1.5rem;
            }
            
            .filter-card {
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
            
            .page-header {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
            
            .filter-card .row > div {
                margin-bottom: 1rem;
            }
            
            .filter-card .row > div:last-child {
                margin-bottom: 0;
            }
        }
        
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .filter-card {
                padding: 1.25rem;
            }
            
            .export-btn {
                width: 100%;
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
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-chart-line me-2"></i>Reporte de Ventas por Período</h1>
                    <p class="lead mb-0">Filtra y analiza las ventas por fechas y estado</p>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <h4><i class="fas fa-filter me-2"></i>Filtros de Búsqueda</h4>
            <form method="post" action="<?= url_to('reportes_ventas') ?>">
                <div class="row g-3">
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
                            <i class="fas fa-search me-2"></i>Generar Reporte
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php if (isset($total_facturas) && $total_facturas > 0): ?>
        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card invoices">
                <div class="stat-icon text-primary">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-number text-primary"><?= $total_facturas ?></div>
                <div class="stat-title">Total Facturas</div>
                <small class="text-muted d-block mt-2">En el período seleccionado</small>
            </div>
            
            <div class="stat-card sales">
                <div class="stat-icon text-success">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-success">$<?= number_format($total_ventas ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Total Ventas</div>
                <small class="text-muted d-block mt-2">Ingresos generados</small>
            </div>
            
            <div class="stat-card taxes">
                <div class="stat-icon text-info">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="stat-number text-info">$<?= number_format($total_impuestos ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Total Impuestos</div>
                <small class="text-muted d-block mt-2">IVA recaudado</small>
            </div>
            
            <div class="stat-card average">
                <div class="stat-icon text-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="stat-number text-warning">$<?= number_format($total_ventas / $total_facturas, 0, ',', '.') ?></div>
                <div class="stat-title">Ticket Promedio</div>
                <small class="text-muted d-block mt-2">Por factura</small>
            </div>
        </div>

        <!-- Export Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="<?= url_to('exportar_ventas_pdf') ?>?fecha_inicio=<?= $filtros['fecha_inicio'] ?? '' ?>&fecha_fin=<?= $filtros['fecha_fin'] ?? '' ?>&estado=<?= $filtros['estado'] ?? '' ?>" 
               class="export-btn" target="_blank">
                <i class="fas fa-file-pdf me-2"></i>Exportar a PDF
            </a>
        </div>

        <!-- Lista de Facturas -->
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-list-ul me-2"></i>Facturas Encontradas</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>N° Factura</th>
                                <th>Cliente</th>
                                <th>Fecha Emisión</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-end">Impuestos</th>
                                <th class="text-end">Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($facturas as $factura): ?>
                                <tr>
                                    <td class="fw-bold">#<?= esc($factura['id']) ?></td>
                                    <td><?= esc($factura['cliente_nombre']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                    <td class="text-end">$ <?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></td>
                                    <td class="text-end">$ <?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></td>
                                    <td class="text-end fw-bold">$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></td>
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
                                            <i class="fas fa-eye me-1"></i> Ver
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
        <!-- Empty State -->
        <div class="card-main">
            <div class="card-body">
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h4 class="text-muted mt-3">No se encontraron facturas</h4>
                    <p class="text-muted">No hay facturas que coincidan con los criterios de búsqueda</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Efecto de carga suave para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Establecer fecha por defecto si no hay filtros
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin');
            
            if (!fechaInicio.value) {
                const firstDay = new Date();
                firstDay.setDate(1);
                fechaInicio.valueAsDate = firstDay;
            }
            
            if (!fechaFin.value) {
                fechaFin.valueAsDate = new Date();
            }
        });
    </script>
</body>
</html>