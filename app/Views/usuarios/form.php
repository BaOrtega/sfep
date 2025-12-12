<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($usuario) ? 'Editar Usuario' : 'Nuevo Usuario' ?> - PFEP</title>
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
            max-width: 1000px;
            margin: 0 auto;
        }
        
        /* Page Header */
        .page-header {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2.5rem;
            border-left: 5px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
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
        
        .page-header h1 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        /* Form Card */
        .form-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2.5rem;
            transition: var(--transition);
        }
        
        .form-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .form-header::before {
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
        
        .form-header h4 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
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
        
        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
            font-size: 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            transform: translateY(-1px);
        }
        
        .form-text {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        
        /* Password Input Group */
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
        
        .password-toggle i {
            font-size: 1rem;
        }
        
        /* Role Badges */
        .role-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .role-option:hover {
            border-color: var(--accent-color);
            background-color: #f8fafc;
        }
        
        .role-option.selected {
            border-color: var(--primary-color);
            background-color: rgba(26, 95, 180, 0.05);
        }
        
        .role-badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .badge-admin {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
        }
        
        .badge-vendedor {
            background: linear-gradient(135deg, var(--accent-color), #0284c7);
            color: white;
        }
        
        .role-info {
            font-size: 0.875rem;
            color: #64748b;
            margin-left: 2.5rem;
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
        
        /* Password Match Indicators */
        .password-match {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            opacity: 0;
            transform: translateY(-5px);
            transition: var(--transition);
        }
        
        .password-match.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .match-success {
            color: var(--success-color);
        }
        
        .match-error {
            color: var(--danger-color);
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
            
            .page-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .form-header {
                padding: 1.25rem 1.5rem;
            }
            
            .role-option {
                padding: 0.75rem;
            }
            
            .btn-submit, .btn-cancel {
                width: 100%;
                justify-content: center;
            }
            
            .button-group {
                flex-direction: column;
                gap: 1rem;
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
        
        .page-header, .form-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        /* Form Field Animation */
        .form-group {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
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
            <h1>
                <?php if (isset($usuario)): ?>
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                <?php else: ?>
                    <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
                <?php endif; ?>
            </h1>
            <p>
                <?php if (isset($usuario)): ?>
                    Actualiza la información del usuario en el sistema
                <?php else: ?>
                    Completa el formulario para agregar un nuevo usuario al sistema
                <?php endif; ?>
            </p>
        </div>

        <!-- Session Messages -->
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

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-header">
                <h4>
                    <i class="fas fa-user-circle me-2"></i>
                    <?= isset($usuario) ? 'Información del Usuario' : 'Datos del Nuevo Usuario' ?>
                </h4>
                <small class="opacity-75 position-relative z-1">
                    Todos los campos marcados con * son obligatorios
                </small>
            </div>
            
            <div class="card-body p-4">
                <form action="<?= url_to('usuarios_save') ?>" method="post" id="userForm">
                    <?= csrf_field() ?>
                    
                    <?php if (isset($usuario) && !empty($usuario['id'])): ?>
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <?php endif; ?>
                    
                    <!-- Name Field -->
                    <div class="form-group mb-4">
                        <label for="nombre" class="form-label">
                            <i class="fas fa-user"></i>
                            <span>Nombre Completo *</span>
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               value="<?= isset($usuario) ? esc($usuario['nombre']) : old('nombre') ?>" 
                               required
                               placeholder="Ej: Juan Pérez Rodríguez"
                               autocomplete="name">
                        <div class="form-text">Nombre completo del usuario tal como aparecerá en el sistema</div>
                    </div>
                    
                    <!-- Email Field -->
                    <div class="form-group mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            <span>Correo Electrónico *</span>
                        </label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="<?= isset($usuario) ? esc($usuario['email']) : old('email') ?>" 
                               required
                               placeholder="ejemplo@empresa.com"
                               autocomplete="email">
                        <div class="form-text">Este email será utilizado para iniciar sesión en el sistema</div>
                    </div>
                    
                    <!-- Password Fields -->
                    <div class="row mb-4">
                        <?php if (!isset($usuario) || empty($usuario['id'])): ?>
                            <!-- New User Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        <span>Contraseña *</span>
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               required
                                               minlength="6"
                                               placeholder="Mínimo 6 caracteres"
                                               autocomplete="new-password">
                                        <button type="button" class="password-toggle" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">La contraseña debe tener al menos 6 caracteres</div>
                                    <div class="password-match" id="passwordStrength">
                                        <i class="fas fa-circle" style="color: #e2e8f0;"></i>
                                        <span>Seguridad de la contraseña</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        <span>Confirmar Contraseña *</span>
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               required
                                               minlength="6"
                                               placeholder="Repite la contraseña"
                                               autocomplete="new-password">
                                        <button type="button" class="password-toggle" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-match" id="passwordMatch">
                                        <i class="fas fa-circle" style="color: #e2e8f0;"></i>
                                        <span>Las contraseñas coinciden</span>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Edit User Password (Optional) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        <span>Cambiar Contraseña</span>
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               minlength="6"
                                               placeholder="Dejar vacío para no cambiar"
                                               autocomplete="new-password">
                                        <button type="button" class="password-toggle" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">Deja vacío si no deseas cambiar la contraseña</div>
                                    <div class="password-match" id="passwordStrength">
                                        <i class="fas fa-circle" style="color: #e2e8f0;"></i>
                                        <span>Seguridad de la contraseña</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        <span>Confirmar Nueva Contraseña</span>
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               minlength="6"
                                               placeholder="Confirmar nueva contraseña"
                                               autocomplete="new-password">
                                        <button type="button" class="password-toggle" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-match" id="passwordMatch">
                                        <i class="fas fa-circle" style="color: #e2e8f0;"></i>
                                        <span>Las contraseñas coinciden</span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="form-group mb-4">
                        <label class="form-label">
                            <i class="fas fa-user-tag"></i>
                            <span>Rol del Usuario *</span>
                        </label>
                        
                        <div class="role-option <?= (isset($usuario) && $usuario['rol'] == 'admin') || old('rol') == 'admin' ? 'selected' : '' ?>" 
                             onclick="selectRole('admin')">
                            <input type="radio" 
                                   id="role_admin" 
                                   name="rol" 
                                   value="admin" 
                                   <?= (isset($usuario) && $usuario['rol'] == 'admin') || old('rol') == 'admin' ? 'checked' : '' ?> 
                                   required
                                   hidden>
                            <div class="role-badge badge-admin">
                                <i class="fas fa-user-shield"></i>
                                Administrador
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Acceso completo a todos los módulos del sistema</small>
                            </div>
                        </div>
                        
                        <div class="role-option <?= (isset($usuario) && $usuario['rol'] == 'vendedor') || old('rol') == 'vendedor' || (!isset($usuario) && !old('rol')) ? 'selected' : '' ?>" 
                             onclick="selectRole('vendedor')">
                            <input type="radio" 
                                   id="role_vendedor" 
                                   name="rol" 
                                   value="vendedor" 
                                   <?= (isset($usuario) && $usuario['rol'] == 'vendedor') || old('rol') == 'vendedor' || (!isset($usuario) && !old('rol')) ? 'checked' : '' ?> 
                                   required
                                   hidden>
                            <div class="role-badge badge-vendedor">
                                <i class="fas fa-user-tie"></i>
                                Vendedor
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted">Solo acceso a clientes, productos y facturas</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="d-flex justify-content-between align-items-center pt-4 border-top button-group">
                        <a href="<?= url_to('usuarios_index') ?>" class="btn btn-cancel">
                            <i class="fas fa-arrow-left me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>
                            <?= isset($usuario) ? 'Actualizar Usuario' : 'Crear Usuario' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Security Information -->
        <div class="security-info">
            <h5 class="d-flex align-items-center mb-3">
                <i class="fas fa-shield-alt me-2"></i> Seguridad del Sistema
            </h5>
            <ul class="mb-0">
                <li class="mb-2">Todas las contraseñas se almacenan utilizando <strong>encriptación de última generación</strong></li>
                <li class="mb-2">Los usuarios reciben un <strong>correo de bienvenida</strong> con sus credenciales de acceso</li>
                <li class="mb-2">Se recomienda <strong>cambiar la contraseña periódicamente</strong> para mayor seguridad</li>
                <li class="mb-0">Cada usuario tiene acceso solo a los módulos permitidos según su rol</li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.className = 'fas fa-eye-slash';
                        this.setAttribute('title', 'Ocultar contraseña');
                    } else {
                        input.type = 'password';
                        icon.className = 'fas fa-eye';
                        this.setAttribute('title', 'Mostrar contraseña');
                    }
                });
            });
            
            // Password validation
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            const matchIndicator = document.getElementById('passwordMatch');
            const strengthIndicator = document.getElementById('passwordStrength');
            
            function validatePasswordStrength(password) {
                if (!password) return 'empty';
                
                let strength = 0;
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                
                return strength;
            }
            
            function updatePasswordStrength() {
                if (!passwordInput || !strengthIndicator) return;
                
                const password = passwordInput.value;
                const strength = validatePasswordStrength(password);
                const icon = strengthIndicator.querySelector('i');
                const text = strengthIndicator.querySelector('span');
                
                if (password === '') {
                    icon.style.color = '#e2e8f0';
                    icon.className = 'fas fa-circle';
                    text.textContent = 'Seguridad de la contraseña';
                    strengthIndicator.classList.remove('show');
                    return;
                }
                
                strengthIndicator.classList.add('show');
                
                if (strength < 2) {
                    icon.style.color = '#ef4444';
                    icon.className = 'fas fa-exclamation-circle';
                    text.textContent = 'Contraseña débil';
                    strengthIndicator.className = 'password-match match-error show';
                } else if (strength < 4) {
                    icon.style.color = '#f59e0b';
                    icon.className = 'fas fa-check-circle';
                    text.textContent = 'Contraseña moderada';
                    strengthIndicator.className = 'password-match show';
                } else {
                    icon.style.color = '#10b981';
                    icon.className = 'fas fa-check-double';
                    text.textContent = 'Contraseña segura';
                    strengthIndicator.className = 'password-match match-success show';
                }
            }
            
            function updatePasswordMatch() {
                if (!passwordInput || !confirmInput || !matchIndicator) return;
                
                const password = passwordInput.value;
                const confirm = confirmInput.value;
                const icon = matchIndicator.querySelector('i');
                const text = matchIndicator.querySelector('span');
                
                if (!password && !confirm) {
                    icon.style.color = '#e2e8f0';
                    icon.className = 'fas fa-circle';
                    text.textContent = 'Las contraseñas coinciden';
                    matchIndicator.classList.remove('show');
                    return;
                }
                
                matchIndicator.classList.add('show');
                
                if (password === confirm) {
                    icon.style.color = '#10b981';
                    icon.className = 'fas fa-check-circle';
                    text.textContent = 'Las contraseñas coinciden';
                    matchIndicator.className = 'password-match match-success show';
                } else {
                    icon.style.color = '#ef4444';
                    icon.className = 'fas fa-times-circle';
                    text.textContent = 'Las contraseñas no coinciden';
                    matchIndicator.className = 'password-match match-error show';
                }
            }
            
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    updatePasswordStrength();
                    updatePasswordMatch();
                });
            }
            
            if (confirmInput) {
                confirmInput.addEventListener('input', updatePasswordMatch);
            }
            
            // Form validation
            const form = document.getElementById('userForm');
            form.addEventListener('submit', function(e) {
                const nombre = document.getElementById('nombre').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = passwordInput?.value;
                const confirm = confirmInput?.value;
                const rol = document.querySelector('input[name="rol"]:checked');
                
                // Validate name
                if (!nombre) {
                    e.preventDefault();
                    showError('nombre', 'Por favor ingresa el nombre del usuario');
                    return false;
                }
                
                // Validate email
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    e.preventDefault();
                    showError('email', 'Por favor ingresa un correo electrónico válido');
                    return false;
                }
                
                // Validate role
                if (!rol) {
                    e.preventDefault();
                    alert('Por favor selecciona un rol para el usuario');
                    return false;
                }
                
                // Validate passwords for new user
                const isNewUser = !document.querySelector('input[name="id"]');
                if (isNewUser) {
                    if (!password || password.length < 6) {
                        e.preventDefault();
                        showError('password', 'La contraseña debe tener al menos 6 caracteres');
                        return false;
                    }
                    
                    if (password !== confirm) {
                        e.preventDefault();
                        showError('confirm_password', 'Las contraseñas no coinciden');
                        return false;
                    }
                } else {
                    // For existing users, if password is provided, validate it
                    if (password || confirm) {
                        if (password.length < 6) {
                            e.preventDefault();
                            showError('password', 'La contraseña debe tener al menos 6 caracteres');
                            return false;
                        }
                        
                        if (password !== confirm) {
                            e.preventDefault();
                            showError('confirm_password', 'Las contraseñas no coinciden');
                            return false;
                        }
                    }
                }
                
                return true;
            });
            
            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                field.focus();
                field.classList.add('is-invalid');
                
                // Remove existing error message
                const existingError = field.parentElement.querySelector('.invalid-feedback');
                if (existingError) existingError.remove();
                
                // Add new error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-block';
                errorDiv.textContent = message;
                field.parentElement.appendChild(errorDiv);
                
                // Auto remove error on input
                field.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                    const error = this.parentElement.querySelector('.invalid-feedback');
                    if (error) error.remove();
                }, { once: true });
            }
            
            // Initialize password indicators
            updatePasswordStrength();
            updatePasswordMatch();
        });
        
        // Role selection function
        function selectRole(role) {
            const adminOption = document.querySelector('.role-option:first-child');
            const vendedorOption = document.querySelector('.role-option:last-child');
            
            if (role === 'admin') {
                document.getElementById('role_admin').checked = true;
                adminOption.classList.add('selected');
                vendedorOption.classList.remove('selected');
            } else {
                document.getElementById('role_vendedor').checked = true;
                vendedorOption.classList.add('selected');
                adminOption.classList.remove('selected');
            }
        }
    </script>
</body>
</html>