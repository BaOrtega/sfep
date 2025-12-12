<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - PFEP</title>
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
        
        /* Header Styling */
        .page-header {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2.5rem;
            border-left: 5px solid var(--primary-color);
        }
        
        .page-header h1 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        /* Action Button */
        .btn-add-user {
            background: linear-gradient(135deg, var(--success-color), #0da65a);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-add-user:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
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
        
        /* User Avatar */
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.25rem;
            margin-right: 1rem;
        }
        
        /* Badges */
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .badge-admin {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
        }
        
        .badge-vendedor {
            background: linear-gradient(135deg, var(--accent-color), #0284c7);
            color: white;
        }
        
        .badge-you {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }
        
        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
        }
        
        .btn-edit {
            background: rgba(14, 165, 233, 0.1);
            color: var(--accent-color);
            border: 1px solid rgba(14, 165, 233, 0.2);
        }
        
        .btn-edit:hover {
            background: var(--accent-color);
            color: white;
        }
        
        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .btn-delete:hover {
            background: var(--danger-color);
            color: white;
        }
        
        .btn-disabled {
            background: #f1f5f9;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
            cursor: not-allowed;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: var(--transition);
            border-top: 4px solid transparent;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card:nth-child(1) { border-top-color: var(--primary-color); }
        .stat-card:nth-child(2) { border-top-color: var(--danger-color); }
        .stat-card:nth-child(3) { border-top-color: var(--accent-color); }
        .stat-card:nth-child(4) { border-top-color: var(--warning-color); }
        
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
        
        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }
        
        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(26, 95, 180, 0.1) 100%);
            border-radius: var(--border-radius);
            border-left: 4px solid var(--accent-color);
            padding: 1.5rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .page-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
            
            .user-avatar {
                width: 36px;
                height: 36px;
                font-size: 1rem;
                margin-right: 0.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .btn-action {
                width: 32px;
                height: 32px;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header {
                text-align: center;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
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
        
        .page-header, .stat-card, .card-main {
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
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1>👥 Gestión de Usuarios</h1>
                    <p class="mb-0">Administra los usuarios y permisos del sistema de facturación</p>
                </div>
                <a href="<?= url_to('usuarios_new') ?>" class="btn-add-user">
                    <i class="fas fa-user-plus"></i>
                    <span>Nuevo Usuario</span>
                </a>
            </div>
        </div>

        <!-- Mensajes de sesión -->
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-check-circle me-3 fa-lg"></i>
                <div class="flex-grow-1"><?= session('success') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                <div class="flex-grow-1"><?= session('error') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <?php if (!empty($usuarios)): ?>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number text-primary"><?= count($usuarios) ?></div>
                <div class="stat-title">Total Usuarios</div>
                <small class="text-muted">Sistema completo</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-number text-danger"><?= count(array_filter($usuarios, fn($u) => $u['rol'] == 'admin')) ?></div>
                <div class="stat-title">Administradores</div>
                <small class="text-muted">Acceso completo</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-number text-accent"><?= count(array_filter($usuarios, fn($u) => $u['rol'] == 'vendedor')) ?></div>
                <div class="stat-title">Vendedores</div>
                <small class="text-muted">Acceso limitado</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-number text-warning"><?= count(array_filter($usuarios, fn($u) => $u['id'] == session()->get('user_id'))) ?></div>
                <div class="stat-title">Tu Sesión</div>
                <small class="text-muted">Usuario actual</small>
            </div>
        </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="card card-main">
            <div class="card-header-custom">
                <h4><i class="fas fa-users me-2"></i>Lista de Usuarios</h4>
                <small class="opacity-75 position-relative z-1">Administra los permisos y accesos del personal</small>
            </div>
            
            <div class="card-body p-0">
                <?php if (empty($usuarios)): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="text-muted mb-3">No hay usuarios registrados</h4>
                        <p class="text-muted mb-4">Comienza agregando el primer usuario del sistema</p>
                        <a href="<?= url_to('usuarios_new') ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Agregar Primer Usuario
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Fecha Creación</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar">
                                                <?= strtoupper(substr(esc($usuario['nombre']), 0, 1)) ?>
                                            </div>
                                            <div>
                                                <strong><?= esc($usuario['nombre']) ?></strong>
                                                <?php if ($usuario['id'] == session()->get('user_id')): ?>
                                                    <div>
                                                        <span class="badge-you badge">
                                                            <i class="fas fa-user-circle me-1"></i> Tú
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td>
                                        <span class="badge <?= $usuario['rol'] == 'admin' ? 'badge-admin' : 'badge-vendedor' ?>">
                                            <i class="fas fa-user-tag me-1"></i>
                                            <?= $usuario['rol'] == 'admin' ? 'Administrador' : 'Vendedor' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (isset($usuario['creado_en'])): ?>
                                            <div><?= date('d/m/Y', strtotime($usuario['creado_en'])) ?></div>
                                            <small class="text-muted"><?= date('H:i', strtotime($usuario['creado_en'])) ?></small>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= url_to('usuarios_edit', $usuario['id']) ?>" 
                                               class="btn-action btn-edit" 
                                               title="Editar usuario">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <?php if ($usuario['id'] != session()->get('user_id')): ?>
                                                <a href="<?= url_to('usuarios_delete', $usuario['id']) ?>" 
                                                   class="btn-action btn-delete" 
                                                   title="Eliminar usuario"
                                                   onclick="return confirm('¿Estás seguro de eliminar al usuario <?= esc($usuario['nombre']) ?>? Esta acción no se puede deshacer.')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn-action btn-disabled" disabled title="No puedes eliminarte a ti mismo">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
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

        <!-- Information Card -->
        <div class="info-card">
            <h5 class="d-flex align-items-center mb-3">
                <i class="fas fa-info-circle me-2"></i> Información importante
            </h5>
            <ul class="mb-0">
                <li class="mb-2">Solo los usuarios con rol <strong>Administrador</strong> pueden gestionar otros usuarios.</li>
                <li class="mb-2">Los usuarios con rol <strong>Vendedor</strong> solo pueden ver y editar su perfil personal.</li>
                <li class="mb-0">Se recomienda mantener al menos dos administradores para evitar pérdida de acceso.</li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Add animation delays to table rows
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.style.animation = 'fadeInUp 0.3s ease-out forwards';
                row.style.opacity = '0';
            });
        });
    </script>
</body>
</html>