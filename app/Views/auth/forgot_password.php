<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 40px 0 rgba(0,0,0,0.2);
            border: none;
        }
        .card-header {
            background: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #004085);
            transform: translateY(-2px);
            transition: all 0.3s;
        }
        .back-link {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #007bff;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .illustration {
            text-align: center;
            margin-bottom: 20px;
        }
        .illustration i {
            font-size: 80px;
            color: #007bff;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-lock me-2"></i>Recuperar Contraseña
                        </h3>
                    </div>
                    
                    <div class="card-body p-4">
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
                        
                        <?php if (isset($errors) && !empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <div class="illustration">
                            <i class="fas fa-key"></i>
                        </div>
                        
                        <p class="text-muted text-center mb-4">
                            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                        </p>
                        
                        <form action="<?= base_url('forgot-password/process') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Correo Electrónico
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                           id="email" 
                                           name="email" 
                                           value="<?= old('email') ?>" 
                                           placeholder="ejemplo@correo.com" 
                                           required>
                                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">
                                    Debe ser el correo con el que te registraste.
                                </small>
                            </div>
                            
                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Enviar Enlace de Recuperación
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <a href="<?= base_url('login') ?>" class="back-link">
                                    <i class="fas fa-arrow-left me-1"></i>Volver al Inicio de Sesión
                                </a>
                            </div>
                        </form>
                        
                        <div class="mt-4 pt-3 border-top">
                            <p class="text-center text-muted small mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                El enlace de recuperación expirará en 1 hora.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Información adicional -->
                <div class="text-center mt-4">
                    <p class="text-white">
                        ¿No tienes una cuenta? 
                        <?php if (session()->has('isLoggedIn') && session('rol') === 'admin'): ?>
                            <a href="<?= base_url('register') ?>" class="text-white fw-bold">Registrar nuevo usuario</a>
                        <?php else: ?>
                            <span class="text-white-50">Contacta al administrador</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Validación del formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const emailInput = document.getElementById('email');
            
            form.addEventListener('submit', function(e) {
                if (!emailInput.value.trim()) {
                    e.preventDefault();
                    alert('Por favor ingresa tu correo electrónico.');
                    emailInput.focus();
                    return false;
                }
                
                // Validación básica de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    e.preventDefault();
                    alert('Por favor ingresa un correo electrónico válido.');
                    emailInput.focus();
                    return false;
                }
            });
        });
    </script>
</body>
</html>