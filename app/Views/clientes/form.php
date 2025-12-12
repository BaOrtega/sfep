<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PFEP</title>
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
        
        /* Back Button */
        .back-button {
            margin-bottom: 1.5rem;
        }
        
        .btn-back {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: var(--dark-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-back:hover {
            background: #e2e8f0;
            color: var(--primary-color);
            transform: translateX(-5px);
        }
        
        /* Form Container */
        .form-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: var(--transition);
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            color: white;
            padding: 2rem;
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
        
        .required-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Form Content */
        .form-content {
            padding: 2rem;
        }
        
        /* Form Sections */
        .form-section {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-color);
            transition: var(--transition);
        }
        
        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
        }
        
        /* Form Controls */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .required-field::after {
            content: " *";
            color: var(--danger-color);
        }
        
        .form-control {
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: var(--transition);
            background-color: white;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.1);
            outline: none;
        }
        
        .form-control.is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .form-control.is-valid {
            border-color: var(--success-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        
        /* Error Messages */
        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--danger-color);
            font-weight: 500;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn-cancel {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: var(--dark-color);
            padding: 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-cancel:hover {
            background: #e2e8f0;
            color: var(--dark-color);
            transform: translateY(-2px);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border: none;
            color: white;
            padding: 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 95, 180, 0.3);
        }
        
        /* Alert Styles */
        .alert-custom {
            border-radius: var(--border-radius);
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            :root {
                --main-padding: 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .form-header {
                padding: 1.5rem;
            }
            
            .form-content {
                padding: 1.5rem;
            }
            
            .form-section {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .action-buttons {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .required-badge {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .form-header .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .section-title {
                font-size: 1.1rem;
            }
        }
        
        /* Loading Animation */
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
        
        .form-container {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Back Button -->
        <div class="back-button">
            <a href="<?= url_to('clientes_index') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i>Volver a Clientes
            </a>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Form Header -->
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h2 mb-2">
                            <i class="fas fa-user-plus me-2"></i><?= esc($title) ?>
                        </h1>
                        <p class="mb-0 opacity-75">
                            <?= isset($cliente) ? 'Actualiza la información del cliente' : 'Completa los datos para registrar un nuevo cliente' ?>
                        </p>
                    </div>
                    <div class="required-badge">
                        <i class="fas fa-info-circle"></i>
                        Campos marcados con * son obligatorios
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="form-content">
                <!-- Alertas de Error -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Alertas de Éxito -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= url_to('clientes_save') ?>" method="post" id="clienteForm">
                    <?= csrf_field() ?>
                    
                    <!-- Campo oculto para el ID si estamos editando -->
                    <?php if (isset($cliente)): ?>
                        <input type="hidden" name="id" value="<?= esc($cliente['id']) ?>">
                    <?php endif; ?>

                    <!-- Sección Información Básica -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-id-card"></i>Información Básica
                        </h4>
                        
                        <div class="row">
                            <!-- Nombre Completo -->
                            <div class="col-md-6 form-group">
                                <label for="nombre" class="form-label required-field">
                                    <i class="fas fa-user text-primary"></i>Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control <?= session()->getFlashdata('errors.nombre') ? 'is-invalid' : '' ?>" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="<?= old('nombre', $cliente['nombre'] ?? '') ?>" 
                                       placeholder="Ej: Juan Pérez"
                                       required
                                       maxlength="100">
                                <?php if (session()->getFlashdata('errors.nombre')): ?>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('errors.nombre') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- NIT/Cédula -->
                            <div class="col-md-6 form-group">
                                <label for="nit" class="form-label required-field">
                                    <i class="fas fa-address-card text-primary"></i>NIT/Cédula
                                </label>
                                <input type="text" 
                                       class="form-control <?= session()->getFlashdata('errors.nit') ? 'is-invalid' : '' ?>" 
                                       id="nit" 
                                       name="nit" 
                                       value="<?= old('nit', $cliente['nit'] ?? '') ?>" 
                                       placeholder="Ej: 123456789"
                                       required
                                       maxlength="20">
                                <?php if (session()->getFlashdata('errors.nit')): ?>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('errors.nit') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Información de Contacto -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-address-book"></i>Información de Contacto
                        </h4>
                        
                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-6 form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope text-primary"></i>Correo Electrónico
                                </label>
                                <input type="email" 
                                       class="form-control <?= session()->getFlashdata('errors.email') ? 'is-invalid' : '' ?>" 
                                       id="email" 
                                       name="email" 
                                       value="<?= old('email', $cliente['email'] ?? '') ?>" 
                                       placeholder="Ej: cliente@empresa.com"
                                       maxlength="100">
                                <?php if (session()->getFlashdata('errors.email')): ?>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('errors.email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6 form-group">
                                <label for="telefono" class="form-label">
                                    <i class="fas fa-phone text-primary"></i>Teléfono
                                </label>
                                <input type="text" 
                                       class="form-control <?= session()->getFlashdata('errors.telefono') ? 'is-invalid' : '' ?>" 
                                       id="telefono" 
                                       name="telefono" 
                                       value="<?= old('telefono', $cliente['telefono'] ?? '') ?>" 
                                       placeholder="Ej: 3001234567"
                                       maxlength="15">
                                <?php if (session()->getFlashdata('errors.telefono')): ?>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('errors.telefono') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker-alt text-primary"></i>Dirección
                            </label>
                            <input type="text" 
                                   class="form-control <?= session()->getFlashdata('errors.direccion') ? 'is-invalid' : '' ?>" 
                                   id="direccion" 
                                   name="direccion" 
                                   value="<?= old('direccion', $cliente['direccion'] ?? '') ?>" 
                                   placeholder="Ej: Calle 123 # 45-67, Ciudad"
                                   maxlength="200">
                            <?php if (session()->getFlashdata('errors.direccion')): ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors.direccion') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="action-buttons">
                        <a href="<?= url_to('clientes_index') ?>" class="btn-cancel">
                            <i class="fas fa-times"></i>Cancelar
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-check-circle"></i>
                            <?= isset($cliente) ? 'Actualizar Cliente' : 'Guardar Cliente' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Formatear automáticamente el teléfono
        const telefonoInput = document.getElementById('telefono');
        if (telefonoInput) {
            telefonoInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 3) {
                    e.target.value = value;
                } else if (value.length <= 6) {
                    e.target.value = value.slice(0, 3) + ' ' + value.slice(3);
                } else {
                    e.target.value = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6, 10);
                }
            });
        }

        // Validación del formulario antes de enviar
        document.getElementById('clienteForm').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const nit = document.getElementById('nit').value.trim();
            
            if (!nombre) {
                e.preventDefault();
                alert('Por favor ingrese el nombre del cliente');
                document.getElementById('nombre').focus();
                return false;
            }
            
            if (!nit) {
                e.preventDefault();
                alert('Por favor ingrese el NIT/Cédula del cliente');
                document.getElementById('nit').focus();
                return false;
            }
        });

        // Auto-focus en el primer campo
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nombre').focus();
        });

        // Efecto de carga suave
        document.addEventListener('DOMContentLoaded', function() {
            const formContainer = document.querySelector('.form-container');
            formContainer.style.animationDelay = '0.1s';
        });
    </script>
</body>
</html>