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
    <title>Mi Perfil - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .profile-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 0 0 15px 15px;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #007bff;
            margin: 0 auto 15px;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            padding: 15px 20px;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .btn-edit {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
        }
        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom: 3px solid #007bff;
        }
        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        .badge-role {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>
    
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="col-md-9">
                    <h1 class="h2 mb-2"><?= esc($user['user_name'] ?? $user['nombre'] ?? 'Usuario') ?></h1>
                    <p class="mb-1">
                        <i class="fas fa-envelope me-2"></i><?= esc($user['email'] ?? 'No disponible') ?>
                    </p>
                    <p class="mb-0">
                        <span class="badge <?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'bg-danger' : 'bg-info' ?> badge-role">
                            <i class="fas fa-user-tag me-1"></i>
                            <?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'Administrador' : 'Vendedor' ?>
                        </span>
                        <span class="badge bg-secondary badge-role ms-2">
                            <i class="fas fa-id-card me-1"></i>ID: <?= $session->get('user_id') ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Mensajes de sesión -->
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <!-- Columna izquierda - Información -->
            <div class="col-md-4">
                <!-- Estadísticas rápidas -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-2"></i>Estadísticas
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon text-primary">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <span class="stat-number"><?= $stats['total_facturas'] ?? '0' ?></span>
                                    <span class="stat-label">Facturas</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon text-success">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <span class="stat-number">$<?= number_format($stats['total_ventas'] ?? 0, 0, ',', '.') ?></span>
                                    <span class="stat-label">Ventas Totales</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Información de la cuenta -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>Información de la Cuenta
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong><i class="fas fa-user me-2"></i>Nombre:</strong><br>
                                <?= esc($user['user_name'] ?? $user['nombre'] ?? 'No disponible') ?>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-envelope me-2"></i>Email:</strong><br>
                                <?= esc($user['email'] ?? 'No disponible') ?>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-user-tag me-2"></i>Rol:</strong><br>
                                <?= ($user['rol'] ?? $session->get('rol')) === 'admin' ? 'Administrador' : 'Vendedor' ?>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-calendar-alt me-2"></i>Miembro desde:</strong><br>
                                <?= isset($user['creado_en']) ? date('d/m/Y', strtotime($user['creado_en'])) : 'No disponible' ?>
                            </li>
                            <li>
                                <strong><i class="fas fa-id-badge me-2"></i>ID Usuario:</strong><br>
                                #<?= $session->get('user_id') ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Columna derecha - Contenido principal -->
            <div class="col-md-8">
                <!-- Pestañas -->
                <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab">
                            <i class="fas fa-edit me-2"></i>Editar Perfil
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
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-edit me-2"></i>Información Personal
                            </div>
                            <div class="card-body">
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
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pestaña 2: Cambiar Contraseña -->
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-lock me-2"></i>Seguridad
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('profile/update') ?>" method="post" id="passwordForm">
                                    <?= csrf_field() ?>
                                    
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Contraseña Actual</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">Obligatorio para cambiar la contraseña.</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password" name="new_password" minlength="6">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">Mínimo 6 caracteres.</small>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div id="passwordMatch" class="mt-2"></div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <i class="fas fa-lightbulb me-2"></i>
                                        <strong>Recomendaciones de seguridad:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>Usa al menos 8 caracteres</li>
                                            <li>Combina mayúsculas, minúsculas y números</li>
                                            <li>No uses contraseñas obvias o repetidas</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-key me-1"></i> Cambiar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pestaña 3: Actividad -->
                    <div class="tab-pane fade" id="activity" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-history me-2"></i>Actividad Reciente
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
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No hay actividades recientes.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Facturas recientes -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <i class="fas fa-file-invoice-dollar me-2"></i>Facturas Recientes
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
                                    <div class="text-center py-4">
                                        <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No hay facturas recientes.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
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