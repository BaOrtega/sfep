<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
        }
        .card-header {
            background: linear-gradient(90deg, #28a745, #20c997);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
        .btn-success {
            background: linear-gradient(90deg, #28a745, #20c997);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-success:hover {
            background: linear-gradient(90deg, #218838, #1e9e7e);
            transform: translateY(-2px);
            transition: all 0.3s;
        }
        .password-strength {
            height: 5px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s;
        }
        .strength-0 { background: #dc3545; width: 25%; }
        .strength-1 { background: #fd7e14; width: 50%; }
        .strength-2 { background: #ffc107; width: 75%; }
        .strength-3 { background: #28a745; width: 100%; }
        .requirement {
            font-size: 0.9rem;
            margin-bottom: 3px;
        }
        .requirement.met {
            color: #28a745;
        }
        .requirement.unmet {
            color: #6c757d;
        }
        .requirement i {
            margin-right: 5px;
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
                            <i class="fas fa-key me-2"></i>Nueva Contraseña
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
                        
                        <?php if (!isset($token) || empty($token)): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Token no válido o expirado.
                            </div>
                            <div class="text-center">
                                <a href="<?= base_url('forgot-password') ?>" class="btn btn-primary">
                                    <i class="fas fa-redo me-1"></i>Solicitar nuevo enlace
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center mb-4">
                                Crea una nueva contraseña para tu cuenta.
                            </p>
                            
                            <form action="<?= base_url('reset-password/process') ?>" method="post" id="resetForm">
                                <?= csrf_field() ?>
                                <input type="hidden" name="token" value="<?= esc($token) ?>">
                                
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Nueva Contraseña
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Mínimo 6 caracteres" 
                                               required
                                               minlength="6">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Indicador de fortaleza -->
                                    <div class="password-strength mt-2" id="passwordStrength"></div>
                                    
                                    <!-- Requisitos -->
                                    <div class="mt-2" id="passwordRequirements">
                                        <div class="requirement unmet" id="reqLength">
                                            <i class="fas fa-circle"></i> Al menos 6 caracteres
                                        </div>
                                        <div class="requirement unmet" id="reqUppercase">
                                            <i class="fas fa-circle"></i> Al menos una mayúscula
                                        </div>
                                        <div class="requirement unmet" id="reqLowercase">
                                            <i class="fas fa-circle"></i> Al menos una minúscula
                                        </div>
                                        <div class="requirement unmet" id="reqNumber">
                                            <i class="fas fa-circle"></i> Al menos un número
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Confirmar Contraseña
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               placeholder="Repite la contraseña" 
                                               required
                                               minlength="6">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="mt-2" id="passwordMatch">
                                        <!-- Mensaje de coincidencia -->
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-success btn-lg" id="submitBtn" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Restablecer Contraseña
                                    </button>
                                </div>
                                
                                <div class="text-center">
                                    <a href="<?= base_url('login') ?>" class="text-decoration-none">
                                        <i class="fas fa-arrow-left me-1"></i>Volver al Inicio de Sesión
                                    </a>
                                </div>
                            </form>
                        <?php endif; ?>
                        
                        <div class="mt-4 pt-3 border-top">
                            <p class="text-center text-muted small mb-0">
                                <i class="fas fa-shield-alt me-1"></i>
                                Tu contraseña se almacena de forma segura y encriptada.
                            </p>
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
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordStrength = document.getElementById('passwordStrength');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('resetForm');
            
            // Elementos de requisitos
            const reqLength = document.getElementById('reqLength');
            const reqUppercase = document.getElementById('reqUppercase');
            const reqLowercase = document.getElementById('reqLowercase');
            const reqNumber = document.getElementById('reqNumber');
            const passwordMatch = document.getElementById('passwordMatch');
            
            let passwordValid = false;
            let passwordsMatch = false;
            
            // Mostrar/ocultar contraseña
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Validar fortaleza de contraseña
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                
                // Verificar requisitos
                const hasLength = password.length >= 6;
                const hasUppercase = /[A-Z]/.test(password);
                const hasLowercase = /[a-z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                
                // Actualizar indicadores
                updateRequirement(reqLength, hasLength);
                updateRequirement(reqUppercase, hasUppercase);
                updateRequirement(reqLowercase, hasLowercase);
                updateRequirement(reqNumber, hasNumber);
                
                // Calcular fortaleza
                let strength = 0;
                if (hasLength) strength++;
                if (hasUppercase) strength++;
                if (hasLowercase) strength++;
                if (hasNumber) strength++;
                
                // Actualizar barra de fortaleza
                passwordStrength.className = 'password-strength strength-' + strength;
                
                // Validar si la contraseña es válida
                passwordValid = hasLength && hasUppercase && hasLowercase && hasNumber;
                updateSubmitButton();
                
                // Verificar coincidencia si ya hay confirmación
                if (confirmInput.value) {
                    checkPasswordMatch();
                }
            });
            
            // Verificar coincidencia de contraseñas
            confirmInput.addEventListener('input', checkPasswordMatch);
            
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirm = confirmInput.value;
                
                if (!password) {
                    passwordMatch.innerHTML = '';
                    passwordsMatch = false;
                } else if (password === confirm) {
                    passwordMatch.innerHTML = '<div class="text-success small"><i class="fas fa-check-circle me-1"></i>Las contraseñas coinciden</div>';
                    passwordsMatch = true;
                } else {
                    passwordMatch.innerHTML = '<div class="text-danger small"><i class="fas fa-times-circle me-1"></i>Las contraseñas no coinciden</div>';
                    passwordsMatch = false;
                }
                
                updateSubmitButton();
            }
            
            function updateRequirement(element, met) {
                if (met) {
                    element.classList.remove('unmet');
                    element.classList.add('met');
                    element.innerHTML = element.innerHTML.replace('fa-circle', 'fa-check-circle');
                } else {
                    element.classList.remove('met');
                    element.classList.add('unmet');
                    element.innerHTML = element.innerHTML.replace('fa-check-circle', 'fa-circle');
                }
            }
            
            function updateSubmitButton() {
                if (passwordValid && passwordsMatch) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }
            
            // Validación final del formulario
            form.addEventListener('submit', function(e) {
                if (!passwordValid) {
                    e.preventDefault();
                    alert('La contraseña no cumple con todos los requisitos.');
                    return false;
                }
                
                if (!passwordsMatch) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden.');
                    return false;
                }
                
                // Todo correcto
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>