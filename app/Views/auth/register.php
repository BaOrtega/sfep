<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($esPrimerUsuario) && $esPrimerUsuario ? 'Registro Primer Administrador' : 'Registro PFEP' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .card-header {
            background: linear-gradient(135deg, 
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '#28a745' : '#007bff' ?>, 
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '#20c997' : '#0056b3' ?>);
            color: white;
            text-align: center;
            padding: 30px 20px;
            border-bottom: none;
        }
        .card-header h2 {
            margin: 0;
            font-weight: 600;
        }
        .card-header i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }
        .card-body {
            padding: 30px;
        }
        .form-floating {
            margin-bottom: 1.5rem;
        }
        .form-control:focus {
            border-color: <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '#28a745' : '#007bff' ?>;
            box-shadow: 0 0 0 0.2rem rgba(
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '40, 167, 69, 0.25' : '0, 123, 255, 0.25' ?>
            );
        }
        .btn-register {
            background: linear-gradient(135deg, 
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '#28a745' : '#007bff' ?>, 
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '#20c997' : '#0056b3' ?>);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(
                <?= isset($esPrimerUsuario) && $esPrimerUsuario ? '40, 167, 69, 0.4' : '0, 123, 255, 0.4' ?>
            );
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .first-user-info {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="card-header">
            <i class="bi <?= isset($esPrimerUsuario) && $esPrimerUsuario ? 'bi-shield-check' : 'bi-person-plus-fill' ?>"></i>
            <h2><?= isset($esPrimerUsuario) && $esPrimerUsuario ? 'Primer Administrador' : 'Registro de Usuario' ?></h2>
            <p class="mb-0 mt-2">
                <?= isset($esPrimerUsuario) && $esPrimerUsuario 
                    ? 'Configuración inicial del sistema' 
                    : 'Crear nueva cuenta' ?>
            </p>
        </div>
        
        <div class="card-body">
            <?php if (isset($esPrimerUsuario) && $esPrimerUsuario): ?>
                <div class="first-user-info">
                    <h5><i class="bi bi-info-circle me-2"></i>Configuración Inicial</h5>
                    <p class="mb-0">
                        Estás creando el primer usuario del sistema, que será <strong>Administrador</strong> 
                        y tendrá acceso completo a todas las funciones.
                    </p>
                </div>
            <?php endif; ?>
            
            <!-- Mensajes de error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="<?= url_to('attemptRegister') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Campo Nombre -->
                <div class="form-floating mb-3">
                    <input type="text" 
                           class="form-control" 
                           id="nombre" 
                           name="nombre" 
                           value="<?= old('nombre') ?>" 
                           placeholder="Nombre Completo"
                           required>
                    <label for="nombre">
                        <i class="bi bi-person me-2"></i>Nombre Completo
                    </label>
                </div>

                <!-- Campo Email -->
                <div class="form-floating mb-3">
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           value="<?= old('email') ?>" 
                           placeholder="ejemplo@correo.com"
                           required>
                    <label for="email">
                        <i class="bi bi-envelope me-2"></i>Email
                    </label>
                </div>

                <!-- Campo Contraseña -->
                <div class="form-floating mb-3">
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Contraseña"
                           required
                           minlength="6">
                    <label for="password">
                        <i class="bi bi-lock me-2"></i>Contraseña
                    </label>
                    <div class="form-text">Mínimo 6 caracteres</div>
                </div>

                <!-- Campo Confirmar Contraseña -->
                <div class="form-floating mb-4">
                    <input type="password" 
                           class="form-control" 
                           id="confirm_password" 
                           name="confirm_password" 
                           placeholder="Confirmar Contraseña"
                           required
                           minlength="6">
                    <label for="confirm_password">
                        <i class="bi bi-lock-fill me-2"></i>Confirmar Contraseña
                    </label>
                </div>

                <?php if (!isset($esPrimerUsuario) || !$esPrimerUsuario): ?>
                    <!-- Solo mostrar selector de rol si no es el primer usuario -->
                    <div class="mb-4">
                        <label for="rol" class="form-label">
                            <i class="bi bi-person-badge me-2"></i>Rol del Usuario
                        </label>
                        <select class="form-select" id="rol" name="rol" required>
                            <option value="">Seleccione un rol</option>
                            <option value="admin" <?= old('rol') == 'admin' ? 'selected' : '' ?>>Administrador</option>
                            <option value="vendedor" <?= (old('rol') == 'vendedor' || !old('rol')) ? 'selected' : '' ?>>Vendedor</option>
                        </select>
                        <div class="form-text">
                            <strong>Administrador:</strong> Acceso completo a todos los módulos<br>
                            <strong>Vendedor:</strong> Solo acceso a clientes, productos y facturas
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Para primer usuario, esconder campo rol (siempre será admin) -->
                    <input type="hidden" name="rol" value="admin">
                <?php endif; ?>

                <button type="submit" class="btn btn-success btn-register w-100 py-3 mb-4">
                    <i class="bi <?= isset($esPrimerUsuario) && $esPrimerUsuario ? 'bi-shield-check' : 'bi-person-plus' ?> me-2"></i>
                    <?= isset($esPrimerUsuario) && $esPrimerUsuario ? 'Crear Administrador' : 'Registrar Usuario' ?>
                </button>
            </form>

            <div class="login-link">
                <p class="mb-0">
                    ¿Ya tienes cuenta? 
                    <a href="<?= url_to('login') ?>" class="text-decoration-none fw-bold">
                        Iniciar Sesión
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validación de coincidencia de contraseñas
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const form = document.querySelector('form');
            
            function validatePassword() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Las contraseñas no coinciden');
                    return false;
                } else {
                    confirmPassword.setCustomValidity('');
                    return true;
                }
            }
            
            password.addEventListener('change', validatePassword);
            confirmPassword.addEventListener('keyup', validatePassword);
            
            form.addEventListener('submit', function(e) {
                if (!validatePassword()) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden');
                }
                
                // Deshabilitar botón para evitar doble envío
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Procesando...';
            });
        });
    </script>
</body>
</html>