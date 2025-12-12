<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PFEP</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        /* Estilos generales */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Tarjeta de login */
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Animación de entrada */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Encabezado de la tarjeta */
        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            text-align: center;
            padding: 30px 20px;
            border-bottom: none;
        }
        
        .card-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        .card-header i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }
        
        /* Cuerpo de la tarjeta */
        .card-body {
            padding: 30px;
        }
        
        /* Campos de formulario */
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 1rem 0.75rem;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        /* Botón de login */
        .btn-login {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        
        /* Enlace de registro */
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        /* Alertas */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        /* Texto de ayuda */
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        /* Enlaces */
        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        /* Primer acceso info */
        .first-access-info {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                max-width: 100%;
            }
            
            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card-header">
            <i class="bi bi-person-check-fill"></i>
            <h2>Acceso PFEP</h2>
            <p class="mb-0 mt-2">Sistema de Facturación Electrónica</p>
        </div>
        
        <div class="card-body">
            <!-- Mensajes de error/success -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= esc(session()->getFlashdata('error')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= esc(session()->getFlashdata('success')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Errores encontrados:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Información para primer acceso -->
            <?php if (isset($userCount) && $userCount == 0): ?>
                <div class="first-access-info">
                    <h5><i class="bi bi-info-circle me-2"></i>Primer Acceso</h5>
                    <p class="mb-0">
                        Es la primera vez que accedes al sistema. Debes crear un usuario administrador.
                    </p>
                </div>
            <?php endif; ?>

            <!-- Formulario de login -->
            <form action="<?= url_to('attemptLogin') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Campo Email -->
                <div class="form-floating mb-3">
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           value="<?= old('email') ?>" 
                           placeholder="admin@pfep.com"
                           required
                           autocomplete="email">
                    <label for="email">
                        <i class="bi bi-envelope me-2"></i>Correo Electrónico
                    </label>
                    <div class="form-text">Ejemplo: admin@pfep.com</div>
                </div>

                <!-- Campo Contraseña -->
                <div class="form-floating mb-4">
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Contraseña"
                           required
                           autocomplete="current-password">
                    <label for="password">
                        <i class="bi bi-lock me-2"></i>Contraseña
                    </label>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-primary btn-login w-100 py-3 mb-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                </button>

                <!-- Enlace para recuperar contraseña -->
                <div class="text-center mb-3">
                    <a href="<?= url_to('forgot_password') ?>" class="text-decoration-none">
                        <i class="bi bi-key me-1"></i>¿Olvidaste tu contraseña?
                    </a>
                </div>
            </form>

            <!-- Enlace de registro solo si no hay usuarios -->
            <?php if (isset($userCount) && $userCount == 0): ?>
            <div class="register-link">
                <p class="mb-2 text-muted">
                    <small>¿Primer acceso al sistema?</small>
                </p>
                <p class="mb-0">
                    <a href="<?= url_to('register') ?>" class="text-decoration-none fw-bold">
                        <i class="bi bi-shield-check me-1"></i>Crear Usuario Administrador
                    </a>
                </p>
            </div>
            <?php endif; ?>
            
            <!-- Información del sistema -->
            <div class="mt-4 pt-3 border-top text-center">
                <p class="text-muted mb-0">
                    <small>
                        <i class="bi bi-shield-check me-1"></i>
                        Sistema Seguro v1.0 &copy; <?= date('Y') ?>
                    </small>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para manejar el autofocus y validaciones -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enfocar automáticamente el campo de email
            const emailField = document.getElementById('email');
            if (emailField && !emailField.value) {
                emailField.focus();
            }
            
            // Manejar cierre de alertas automáticamente después de 5 segundos
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
            
            // Validación básica del formulario
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                if (!email || !password) {
                    e.preventDefault();
                    alert('Por favor, completa todos los campos requeridos.');
                    return false;
                }
                
                // Validación básica de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Por favor, ingresa un correo electrónico válido.');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>