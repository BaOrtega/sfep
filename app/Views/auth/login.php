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
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
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
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus + .input-group-text {
            border-color: #007bff;
            background-color: #e3f2fd;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card-header">
            <i class="bi bi-person-check-fill"></i>
            <h2>Acceso PFEP</h2>
            <p class="mb-0 mt-2">Inicia sesión en tu cuenta</p>
        </div>
        
        <div class="card-body">
            <!-- Mensajes de error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
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
                           required>
                    <label for="email">
                        <i class="bi bi-envelope me-2"></i>Email
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
                           required>
                    <label for="password">
                        <i class="bi bi-lock me-2"></i>Contraseña
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-login w-100 py-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                </button>
            </form>

            <div class="register-link">
                <p class="mb-0">
                    ¿No tienes cuenta? 
                    <a href="<?= url_to('register') ?>" class="text-decoration-none fw-bold">
                        Regístrate aquí
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>