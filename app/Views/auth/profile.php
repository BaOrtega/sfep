<?php
$session = session();
$user = isset($user) ? $user : $session;
$isEdit = isset($isEdit) ? $isEdit : false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - PFEP</title>
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
        
        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border-radius: var(--border-radius);
            padding: 3rem 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
            color: white;
            box-shadow: var(--box-shadow);
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, white, #e2e8f0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: var(--primary-color);
            border: 5px solid white;
            box-shadow: var(--box-shadow);
            margin-right: 2rem;
            position: relative;
            z-index: 1;
            transition: var(--transition);
        }
        
        .profile-avatar:hover {
            transform: scale(1.05);
        }
        
        .profile-info h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .profile-info p {
            opacity: 0.9;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        /* Badges */
        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 50px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .badge-role {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        .badge-id {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        
        /* Cards */
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
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--dark-color);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }
        
        .card-header-custom h4 {
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
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
            padding: 2rem;
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: var(--transition);
            border-top: 4px solid transparent;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card:nth-child(1) { border-top-color: var(--accent-color); }
        .stat-card:nth-child(2) { border-top-color: var(--success-color); }
        .stat-card:nth-child(3) { border-top-color: var(--warning-color); }
        .stat-card:nth-child(4) { border-top-color: var(--primary-color); }
        
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
        
        /* Tabs - FIXED: All tabs should have the same blue color when active */
        .profile-tabs {
            background:  #2563ceff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .nav-tabs-custom {
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .nav-tabs-custom .nav-link {
            border: none;
            color: #64748b;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-tabs-custom .nav-link:hover {
            background-color: #2563ceff;
            color: var(--dark-color);
        }
        
        /* FIXED: All active tabs have the same blue color */
        .nav-tabs-custom .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), #0c4a9e);
            color: white;
            box-shadow: 0 4px 15px rgba(26, 95, 180, 0.3);
        }
        
        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-label i {
            color: var(--primary-color);
            width: 20px;
        }
        
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            transform: translateY(-1px);
        }
        
        .form-control:disabled {
            background-color: #f8fafc;
            color: #94a3b8;
        }
        
        /* Password Input */
        .password-input-group {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: var(--transition);
            z-index: 2;
        }
        
        .password-toggle:hover {
            background-color: #f1f5f9;
            color: var(--dark-color);
        }
        
        /* Activity Items */
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .activity-item {
            padding: 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: var(--transition);
        }
        
        .activity-item:hover {
            background-color: #f8fafc;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        
        .activity-content {
            flex-grow: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }
        
        .activity-time {
            font-size: 0.875rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Table Styles */
        .table-responsive {
            border-radius: var(--border-radius);
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
        }
        
        .table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        /* Buttons */
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), #0c4a9e);
            border: none;
            color: white;
            padding: 0.75rem 2.5rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 95, 180, 0.3);
        }
        
        .btn-cancel {
            background: #64748b;
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .btn-cancel:hover {
            background: #475569;
            transform: translateY(-2px);
        }
        
        /* Empty States */
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }
        
        /* Security Info */
        .security-info {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(14, 165, 233, 0.1) 100%);
            border-radius: var(--border-radius);
            border-left: 4px solid var(--success-color);
            padding: 1.5rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .profile-header {
                padding: 2rem 1.5rem;
                text-align: center;
            }
            
            .profile-avatar {
                margin: 0 auto 1.5rem;
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .nav-tabs-custom {
                flex-direction: column;
            }
            
            .nav-tabs-custom .nav-link {
                justify-content: center;
            }
            
            .table thead th,
            .table tbody td {
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-header h1 {
                font-size: 1.5rem;
            }
            
            .button-group {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn-submit, .btn-cancel {
                width: 100%;
                justify-content: center;
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
        
        .profile-header, .stat-card, .card-main {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start">
                <div class="profile-avatar mb-3 mb-md-0">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info text-center text-md-start">
                    <h1 class="h2 mb-2"><?= esc($user['user_name'] ?? $user['nombre'] ?? 'Usuario') ?></h1>
                    <p class="mb-3">
                        <i class="fas fa-envelope me-2"></i><?= esc($user['email'] ?? 'No disponible') ?>
                    </p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        <span class="badge <?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'bg-danger' : 'bg-info' ?> badge-role">
                            <i class="fas fa-user-tag me-1"></i>
                            <?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'Administrador' : 'Vendedor' ?>
                        </span>
                        <span class="badge bg-secondary badge-id">
                            <i class="fas fa-id-card me-1"></i>ID: <?= $session->get('user_id') ?>
                        </span>
                    </div>
                </div>
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

        <!-- CORRECCIÓN: Restaurar las estadísticas originales de facturas y ventas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon text-primary">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-number text-primary"><?= $stats['total_facturas'] ?? '0' ?></div>
                <div class="stat-title">Facturas</div>
                <small class="text-muted d-block mt-2">Total histórico</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon text-success">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number text-success">$<?= number_format($stats['total_ventas'] ?? 0, 0, ',', '.') ?></div>
                <div class="stat-title">Ventas Totales</div>
                <small class="text-muted d-block mt-2">Ingresos acumulados</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon text-warning">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number text-warning"><?= $stats['actividad_mes'] ?? '0' ?></div>
                <div class="stat-title">Actividad Este Mes</div>
                <small class="text-muted d-block mt-2">Registros del mes actual</small>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon text-accent">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number text-accent"><?= $stats['facturas_mes'] ?? '0' ?></div>
                <div class="stat-title">Facturas Este Mes</div>
                <small class="text-muted d-block mt-2">Período actual</small>
            </div>
        </div>

        <!-- Profile Tabs -->
        <div class="profile-tabs">
            <ul class="nav nav-tabs-custom mb-4" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab">
                        <i class="fas fa-user-edit me-2"></i>Editar Perfil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                        <i class="fas fa-key me-2"></i>Cambiar Contraseña
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab">
                        <i class="fas fa-history me-2"></i>Actividad Reciente
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="profileTabContent">
                <!-- Pestaña 1: Editar Perfil -->
                <div class="tab-pane fade show active" id="edit" role="tabpanel">
                    <div class="card card-main">
                        <div class="card-header-custom">
                            <h4><i class="fas fa-user-edit me-2"></i>Información Personal</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="<?= base_url('profile/update') ?>" method="post">
                                <?= csrf_field() ?>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label">Nombre Completo *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" 
                                               value="<?= esc($user['user_name'] ?? $user['nombre'] ?? '') ?>" 
                                               required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" 
                                               value="<?= esc($user['email'] ?? '') ?>" 
                                               disabled>
                                        <small class="form-text text-muted">El email no se puede modificar.</small>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Rol</label>
                                    <input type="text" class="form-control" 
                                           value="<?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'Administrador' : 'Vendedor' ?>" 
                                           disabled>
                                    <small class="form-text text-muted">El rol solo puede ser cambiado por un administrador.</small>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('dashboard') ?>" class="btn btn-cancel">
                                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn-submit">
                                        <i class="fas fa-save me-1"></i> Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Pestaña 2: Cambiar Contraseña -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card card-main">
                        <div class="card-header-custom">
                            <h4><i class="fas fa-lock me-2"></i>Seguridad</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="<?= base_url('profile/update') ?>" method="post" id="passwordForm">
                                <?= csrf_field() ?>
                                
                                <input type="hidden" name="nombre" value="<?= esc($user['user_name'] ?? $user['nombre'] ?? '') ?>">
                                    
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Nueva Contraseña</label>
                                    <div class="password-input-group">
                                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="6">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="new_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Mínimo 6 caracteres.</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                                    <div class="password-input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="passwordMatch" class="mt-2"></div>
                                </div>
                                
                                <div class="security-info">
                                    <i class="fas fa-lightbulb me-2"></i>
                                    <strong>Recomendaciones de seguridad:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Usa al menos 8 caracteres</li>
                                        <li>Combina mayúsculas, minúsculas y números</li>
                                        <li>No uses contraseñas obvias o repetidas</li>
                                    </ul>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn-submit">
                                        <i class="fas fa-key me-1"></i> Cambiar Contraseña
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Pestaña 3: Actividad -->
                <div class="tab-pane fade" id="activity" role="tabpanel">
                    <div class="card card-main">
                        <div class="card-header-custom">
                            <h4><i class="fas fa-history me-2"></i>Actividad Reciente</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($actividades) && !empty($actividades)): ?>
                                <?php foreach ($actividades as $actividad): ?>
                                    <div class="activity-item d-flex">
                                        <div class="activity-icon">
                                            <i class="fas fa-<?= $actividad['icono'] ?? 'check' ?>"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?= esc($actividad['accion']) ?></h6>
                                            <p class="mb-0 text-muted small">
                                                <i class="far fa-clock me-1"></i>
                                                <?= date('d/m/Y H:i', strtotime($actividad['fecha'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <p class="text-muted">No hay actividades recientes.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Facturas recientes -->
                    <div class="card card-main mt-4">
                        <div class="card-header-custom">
                            <h4><i class="fas fa-file-invoice-dollar me-2"></i>Facturas Recientes</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($facturas_recientes) && !empty($facturas_recientes)): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($facturas_recientes as $factura): ?>
                                            <tr>
                                                <td><?= $factura['id'] ?></td>
                                                <td><?= esc($factura['cliente_nombre'] ?? 'N/A') ?></td>
                                                <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                                <td>$<?= number_format($factura['total_factura'], 2, ',', '.') ?></td>
                                                <td>
                                                    <span class="badge bg-<?= 
                                                        $factura['estado'] == 'PAGADA' ? 'success' : 
                                                        ($factura['estado'] == 'EMITIDA' ? 'warning' : 'danger')
                                                    ?>">
                                                        <?= $factura['estado'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <p class="text-muted">No hay facturas recientes.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar contraseñas
            const toggleButtons = [
                { button: 'toggleCurrentPassword', input: 'current_password' },
                { button: 'toggleNewPassword', input: 'new_password' },
                { button: 'toggleConfirmPassword', input: 'confirm_password' }
            ];
            
            toggleButtons.forEach(function(item) {
                const btn = document.getElementById(item.button);
                const input = document.getElementById(item.input);
                
                if (btn && input) {
                    btn.addEventListener('click', function() {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    });
                }
            });
            
            // Validación de coincidencia de contraseñas
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');
            const passwordMatch = document.getElementById('passwordMatch');
            const passwordForm = document.getElementById('passwordForm');
            
            function checkPasswordMatch() {
                if (!newPassword.value || !confirmPassword.value) {
                    passwordMatch.innerHTML = '';
                    return;
                }
                
                if (newPassword.value === confirmPassword.value) {
                    passwordMatch.innerHTML = '<div class="text-success small"><i class="fas fa-check-circle me-1"></i>Las contraseñas coinciden</div>';
                } else {
                    passwordMatch.innerHTML = '<div class="text-danger small"><i class="fas fa-times-circle me-1"></i>Las contraseñas no coinciden</div>';
                }
            }
            
            if (newPassword && confirmPassword) {
                newPassword.addEventListener('input', checkPasswordMatch);
                confirmPassword.addEventListener('input', checkPasswordMatch);
            }
            
            // Validación del formulario de contraseña
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                    if (newPassword.value && newPassword.value.length < 6) {
                        e.preventDefault();
                        alert('La nueva contraseña debe tener al menos 6 caracteres.');
                        newPassword.focus();
                        return false;
                    }
                    
                    if (newPassword.value !== confirmPassword.value) {
                        e.preventDefault();
                        alert('Las contraseñas no coinciden.');
                        confirmPassword.focus();
                        return false;
                    }
                    
                    if (newPassword.value && !document.getElementById('current_password').value) {
                        e.preventDefault();
                        alert('Debes ingresar tu contraseña actual para cambiarla.');
                        document.getElementById('current_password').focus();
                        return false;
                    }
                });
            }
            
            // Inicializar pestañas
            const triggerTabList = [].slice.call(document.querySelectorAll('#profileTab button'));
            triggerTabList.forEach(function (triggerEl) {
                const tabTrigger = new bootstrap.Tab(triggerEl);
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });
        });
    </script>
</body>
</html>