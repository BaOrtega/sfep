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
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Card */
        .header-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }
        
        .header-card::before {
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
        
        .header-card h1 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .header-card .subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 0;
        }
        
        /* Form Card */
        .form-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
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
        
        .form-header h3 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .form-header i {
            margin-right: 0.75rem;
        }
        
        .required-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }
        
        /* Form Sections */
        .form-body {
            padding: 2rem;
        }
        
        .form-section {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
            transition: var(--transition);
        }
        
        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
        }
        
        /* Form Controls */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .required-field::after {
            content: " *";
            color: var(--danger-color);
        }
        
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: var(--transition);
            background-color: white;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.1);
            transform: translateY(-1px);
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger-color);
        }
        
        .form-control.is-valid, .form-select.is-valid {
            border-color: var(--success-color);
        }
        
        .input-group-text {
            background-color: #f1f5f9;
            border: 2px solid #e2e8f0;
            color: #64748b;
            font-weight: 500;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group .input-group-text:first-child {
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        /* Validation */
        .invalid-feedback {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: var(--danger-color);
            font-weight: 500;
        }
        
        /* Alerts */
        .alert-modern {
            border-radius: var(--border-radius);
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
        }
        
        .alert-modern.alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            border-left: 4px solid var(--danger-color);
            color: var(--dark-color);
        }
        
        .alert-modern.alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-left: 4px solid var(--success-color);
            color: var(--dark-color);
        }
        
        /* Calculation Results */
        .calculation-card {
            background: linear-gradient(135deg, var(--success-color) 0%, #0d9c6d 100%);
            color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 1rem;
            display: none;
            animation: fadeIn 0.3s ease-out;
        }
        
        .calculation-card.show {
            display: block;
        }
        
        .calculation-item {
            text-align: center;
        }
        
        .calculation-label {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 0.25rem;
        }
        
        .calculation-value {
            font-size: 1.25rem;
            font-weight: 700;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }
        
        .btn-cancel {
            background: white;
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
            flex: 1;
        }
        
        .btn-cancel:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--dark-color);
            transform: translateY(-2px);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0c4a9e 100%);
            border: none;
            color: white;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
            flex: 1;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 95, 180, 0.25);
            color: white;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .header-card {
                padding: 1.5rem;
            }
            
            .form-body {
                padding: 1.5rem;
            }
            
            .form-section {
                padding: 1.25rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .calculation-item {
                margin-bottom: 1rem;
            }
            
            .calculation-item:last-child {
                margin-bottom: 0;
            }
        }
        
        @media (max-width: 576px) {
            .header-card h1 {
                font-size: 1.5rem;
            }
            
            .form-header h3 {
                font-size: 1.25rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
       
        <!-- Header Card -->
        <div class="header-card">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <h1 class="display-6 mb-2">
                        <i class="fas fa-<?= isset($producto) ? 'edit' : 'plus-circle' ?> me-2"></i>
                        <?= esc($title) ?>
                    </h1>
                    <p class="subtitle mb-0">
                        <?= isset($producto) ? 'Actualiza la información del producto existente' : 'Completa el formulario para registrar un nuevo producto en el inventario' ?>
                    </p>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                        <i class="fas fa-info-circle me-1"></i>
                        Campos marcados con * son obligatorios
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <!-- Form Header -->
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h3>
                        <i class="fas fa-<?= isset($producto) ? 'database' : 'file-alt' ?> me-2"></i>
                        Formulario de Producto
                    </h3>
                    <span class="required-badge d-none d-md-block">
                        <i class="fas fa-asterisk me-1"></i>
                        Campos requeridos
                    </span>
                </div>
            </div>

            <!-- Form Body -->
            <div class="form-body">
                <!-- Alertas de Error -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Por favor corrige los siguientes errores:</h5>
                                <ul class="mb-0 ps-3">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Alertas de Éxito -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">¡Operación exitosa!</h5>
                                <p class="mb-0"><?= session()->getFlashdata('success') ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= url_to('productos_save') ?>" method="post" id="productoForm" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    
                    <!-- Campo oculto para el ID si estamos editando -->
                    <?php if (isset($producto)): ?>
                        <input type="hidden" name="id" value="<?= esc($producto['id']) ?>">
                    <?php endif; ?>

                    <!-- Sección 1: Información Básica -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-info-circle"></i>
                            Información Básica del Producto
                        </h4>
                        
                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label required-field">Nombre del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control <?= session()->getFlashdata('errors.nombre') ? 'is-invalid' : '' ?>" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="<?= old('nombre', $producto['nombre'] ?? '') ?>" 
                                           placeholder="Ej: Martillo doble mazo"
                                           required
                                           maxlength="100"
                                           autofocus>
                                    <?php if (session()->getFlashdata('errors.nombre')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.nombre') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Nombre descriptivo del producto (máx. 100 caracteres)</small>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                <textarea class="form-control" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          placeholder="Descripción detallada del producto, características principales..."
                                          rows="3"
                                          maxlength="500"><?= old('descripcion', $producto['descripcion'] ?? '') ?></textarea>
                            </div>
                            <small class="form-text text-muted">Descripción opcional del producto (máx. 500 caracteres)</small>
                        </div>
                    </div>

                    <!-- Sección 2: Información Financiera -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-dollar-sign"></i>
                            Información Financiera
                        </h4>
                        
                        <div class="row">
                            <!-- Precio de Venta -->
                            <div class="col-md-6 mb-3">
                                <label for="precio_unitario" class="form-label required-field">Precio de Venta</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.precio_unitario') ? 'is-invalid' : '' ?>" 
                                           id="precio_unitario" 
                                           name="precio_unitario" 
                                           step="0.01" 
                                           min="0"
                                           value="<?= old('precio_unitario', $producto['precio_unitario'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required
                                           oninput="calculateMargins()">
                                    <?php if (session()->getFlashdata('errors.precio_unitario')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.precio_unitario') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Precio de venta al público (sin IVA)</small>
                            </div>

                            <!-- Costo Base -->
                            <div class="col-md-6 mb-3">
                                <label for="costo" class="form-label required-field">Costo del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.costo') ? 'is-invalid' : '' ?>" 
                                           id="costo" 
                                           name="costo" 
                                           step="0.01" 
                                           min="0"
                                           value="<?= old('costo', $producto['costo'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required
                                           oninput="calculateMargins()">
                                    <?php if (session()->getFlashdata('errors.costo')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.costo') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Costo de adquisición o producción</small>
                            </div>
                        </div>

                        <!-- Cálculos Automáticos -->
                        <div class="calculation-card" id="calculationResults">
                            <div class="row">
                                <div class="col-md-4 calculation-item">
                                    <div class="calculation-label">Margen de Ganancia</div>
                                    <div class="calculation-value" id="margenResult">$0.00</div>
                                </div>
                                <div class="col-md-4 calculation-item">
                                    <div class="calculation-label">Margen Porcentual</div>
                                    <div class="calculation-value" id="margenPorcentajeResult">0%</div>
                                </div>
                                <div class="col-md-4 calculation-item">
                                    <div class="calculation-label">Precio con IVA</div>
                                    <div class="calculation-value" id="precioConIvaResult">$0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 3: Inventario e Impuestos -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-warehouse"></i>
                            Inventario e Impuestos
                        </h4>
                        
                        <div class="row">
                            <!-- Stock -->
                            <div class="col-md-6 mb-3">
                                <label for="inventario" class="form-label required-field">Stock Disponible</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-box"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.inventario') ? 'is-invalid' : '' ?>" 
                                           id="inventario" 
                                           name="inventario" 
                                           step="1" 
                                           min="0"
                                           value="<?= old('inventario', $producto['inventario'] ?? 0) ?>" 
                                           placeholder="0"
                                           required>
                                    <?php if (session()->getFlashdata('errors.inventario')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.inventario') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Cantidad disponible en inventario</small>
                            </div>

                            <!-- IVA -->
                            <div class="col-md-6 mb-3">
                                <label for="tasa_impuesto" class="form-label required-field">Tasa de IVA</label>
                                <div class="input-group">
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.tasa_impuesto') ? 'is-invalid' : '' ?>" 
                                           id="tasa_impuesto" 
                                           name="tasa_impuesto" 
                                           step="0.01" 
                                           min="0"
                                           max="100"
                                           value="<?= old('tasa_impuesto', $producto['tasa_impuesto'] ?? ($iva_default ?? 19)) ?>" 
                                           placeholder="19"
                                           required
                                           oninput="calculateMargins()">
                                    <span class="input-group-text">%</span>
                                    <?php if (session()->getFlashdata('errors.tasa_impuesto')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.tasa_impuesto') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Porcentaje de impuesto al valor agregado</small>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="action-buttons">
                        <a href="<?= url_to('productos_index') ?>" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-<?= isset($producto) ? 'save' : 'plus-circle' ?> me-2"></i>
                            <?= isset($producto) ? 'Actualizar Producto' : 'Guardar Producto' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Cálculos en tiempo real
        function calculateMargins() {
            const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const costo = parseFloat(document.getElementById('costo').value) || 0;
            const iva = parseFloat(document.getElementById('tasa_impuesto').value) || 0;
            
            if (precio > 0 && costo > 0 && precio >= costo) {
                const margen = precio - costo;
                const margenPorcentaje = costo > 0 ? ((margen / costo) * 100).toFixed(2) : 0;
                const precioConIva = precio * (1 + (iva / 100));
                
                document.getElementById('margenResult').textContent = '$' + margen.toFixed(2);
                document.getElementById('margenPorcentajeResult').textContent = margenPorcentaje + '%';
                document.getElementById('precioConIvaResult').textContent = '$' + precioConIva.toFixed(2);
                document.getElementById('calculationResults').classList.add('show');
            } else {
                document.getElementById('calculationResults').classList.remove('show');
            }
        }

        // Validación del formulario
        document.getElementById('productoForm').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const costo = parseFloat(document.getElementById('costo').value) || 0;
            const inventario = document.getElementById('inventario').value;
            const iva = document.getElementById('tasa_impuesto').value;
            
            // Validación básica
            let errors = [];
            
            if (!nombre) errors.push('El nombre del producto es obligatorio');
            if (precio <= 0) errors.push('El precio debe ser mayor a 0');
            if (costo < 0) errors.push('El costo no puede ser negativo');
            if (precio < costo) errors.push('El precio no puede ser menor que el costo');
            if (inventario === '' || parseInt(inventario) < 0) errors.push('El stock debe ser un número válido');
            if (!iva || parseFloat(iva) < 0 || parseFloat(iva) > 100) errors.push('La tasa de IVA debe estar entre 0 y 100');
            
            if (errors.length > 0) {
                e.preventDefault();
                
                // Mostrar alerta de error
                let alertHTML = `
                    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Errores de validación:</h5>
                                <ul class="mb-0 ps-3">
                `;
                
                errors.forEach(error => {
                    alertHTML += `<li>${error}</li>`;
                });
                
                alertHTML += `
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                
                // Insertar alerta al inicio del formulario
                const formBody = document.querySelector('.form-body');
                const firstChild = formBody.firstChild;
                if (firstChild.classList && firstChild.classList.contains('alert')) {
                    formBody.removeChild(firstChild);
                }
                formBody.insertAdjacentHTML('afterbegin', alertHTML);
                
                // Desplazar al usuario al inicio del formulario
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                return false;
            }
        });

        // Validación Bootstrap
        (function () {
            'use strict'
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
            
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // Inicializar cálculos al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            calculateMargins();
            
            // Auto-focus en el primer campo
            document.getElementById('nombre').focus();
            
            // Prevenir envío con Enter en campos numéricos
            const numericInputs = document.querySelectorAll('input[type="number"]');
            numericInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                    }
                });
            });
        });

        // Manejo de errores específicos del servidor
        <?php if (session()->getFlashdata('errors')): ?>
        document.addEventListener('DOMContentLoaded', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        <?php endif; ?>
    </script>
</body>
</html>