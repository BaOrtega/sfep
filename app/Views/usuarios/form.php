<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($usuario) ? 'Editar Usuario' : 'Nuevo Usuario' ?> - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 20px;
        }
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            padding: 10px 25px;
        }
        .role-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i>
                            <?= isset($usuario) ? 'Editar Usuario' : 'Nuevo Usuario' ?>
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="<?= url_to('usuarios_save') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <?php if (isset($usuario) && !empty($usuario['id'])): ?>
                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                            <?php endif; ?>
                            
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-1"></i> Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="<?= isset($usuario) ? esc($usuario['nombre']) : old('nombre') ?>" 
                                       required
                                       placeholder="Ej: Juan Pérez">
                                <div class="form-text">Nombre completo del usuario</div>
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i> Correo Electrónico
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?= isset($usuario) ? esc($usuario['email']) : old('email') ?>" 
                                       required
                                       placeholder="ejemplo@correo.com">
                                <div class="form-text">El email será usado para iniciar sesión</div>
                            </div>
                            
                            <!-- Contraseña (solo para nuevo usuario o si se quiere cambiar) -->
                            <?php if (!isset($usuario) || empty($usuario['id'])): ?>
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-1"></i> Contraseña
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               required
                                               minlength="6"
                                               placeholder="Mínimo 6 caracteres">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">La contraseña debe tener al menos 6 caracteres</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock me-1"></i> Confirmar Contraseña
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               required
                                               minlength="6"
                                               placeholder="Repite la contraseña">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="passwordMatch" class="form-text text-danger d-none">
                                        <i class="fas fa-times-circle"></i> Las contraseñas no coinciden
                                    </div>
                                    <div id="passwordMatchOk" class="form-text text-success d-none">
                                        <i class="fas fa-check-circle"></i> Las contraseñas coinciden
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Si es edición, campo opcional para cambiar contraseña -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-1"></i> Cambiar Contraseña (opcional)
                                    </label>
                                    <div class="input-group mb-2">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               minlength="6"
                                               placeholder="Dejar vacío para no cambiar">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               minlength="6"
                                               placeholder="Confirmar nueva contraseña">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="passwordMatch" class="form-text text-danger d-none">
                                        <i class="fas fa-times-circle"></i> Las contraseñas no coinciden
                                    </div>
                                    <div id="passwordMatchOk" class="form-text text-success d-none">
                                        <i class="fas fa-check-circle"></i> Las contraseñas coinciden
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Rol -->
                            <div class="mb-4">
                                <label for="rol" class="form-label">
                                    <i class="fas fa-user-tag me-1"></i> Rol del Usuario
                                </label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="">Seleccionar rol</option>
                                    <option value="admin" <?= (isset($usuario) && $usuario['rol'] == 'admin') ? 'selected' : '' ?>>Administrador</option>
                                    <option value="vendedor" <?= (isset($usuario) && $usuario['rol'] == 'vendedor') || !isset($usuario) ? 'selected' : '' ?>>Vendedor</option>
                                </select>
                                <div class="form-text">
                                    <strong>Administrador:</strong> Acceso completo a todos los módulos<br>
                                    <strong>Vendedor:</strong> Solo acceso a clientes, productos y facturas
                                </div>
                            </div>
                            
                            <!-- Botones -->
                            <div class="d-flex justify-content-between">
                                <a href="<?= url_to('usuarios_index') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> 
                                    <?= isset($usuario) ? 'Actualizar Usuario' : 'Crear Usuario' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Información de seguridad -->
                <div class="alert alert-info mt-3">
                    <i class="fas fa-shield-alt me-2"></i>
                    <strong>Seguridad del Sistema:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Todos los usuarios son creados con estado "activo" por defecto</li>
                        <li>Las contraseñas se almacenan encriptadas</li>
                        <li>Solo los administradores pueden crear nuevos usuarios</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar contraseñas
            document.querySelectorAll('.password-toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.className = 'fas fa-eye-slash';
                    } else {
                        input.type = 'password';
                        icon.className = 'fas fa-eye';
                    }
                });
            });
            
            // Validar coincidencia de contraseñas
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            const matchError = document.getElementById('passwordMatch');
            const matchOk = document.getElementById('passwordMatchOk');
            
            function validatePasswords() {
                if (!passwordInput || !confirmInput) return;
                
                const password = passwordInput.value;
                const confirm = confirmInput.value;
                
                // Si ambos campos están vacíos (en edición), no mostrar nada
                if (!password && !confirm) {
                    matchError.classList.add('d-none');
                    matchOk.classList.add('d-none');
                    return;
                }
                
                // Si solo uno está lleno, no validar aún
                if ((password && !confirm) || (!password && confirm)) {
                    matchError.classList.add('d-none');
                    matchOk.classList.add('d-none');
                    return;
                }
                
                // Validar coincidencia
                if (password === confirm) {
                    matchError.classList.add('d-none');
                    matchOk.classList.remove('d-none');
                } else {
                    matchError.classList.remove('d-none');
                    matchOk.classList.add('d-none');
                }
            }
            
            if (passwordInput && confirmInput) {
                passwordInput.addEventListener('input', validatePasswords);
                confirmInput.addEventListener('input', validatePasswords);
            }
            
            // Validar formulario antes de enviar
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password')?.value;
                const confirm = document.getElementById('confirm_password')?.value;
                const rol = document.getElementById('rol').value;
                
                // Validar rol
                if (!rol) {
                    e.preventDefault();
                    alert('Por favor selecciona un rol para el usuario.');
                    return false;
                }
                
                // Validar contraseñas si se están ingresando
                if (password || confirm) {
                    if (password.length < 6) {
                        e.preventDefault();
                        alert('La contraseña debe tener al menos 6 caracteres.');
                        return false;
                    }
                    
                    if (password !== confirm) {
                        e.preventDefault();
                        alert('Las contraseñas no coinciden.');
                        return false;
                    }
                }
                
                // Si es nuevo usuario, la contraseña es obligatoria
                const isNewUser = !document.querySelector('input[name="id"]');
                if (isNewUser && (!password || password.length < 6)) {
                    e.preventDefault();
                    alert('Para crear un nuevo usuario, la contraseña es obligatoria y debe tener al menos 6 caracteres.');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>