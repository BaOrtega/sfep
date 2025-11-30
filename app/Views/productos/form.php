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
    <style>
        :root {
            --sidebar-width: 280px;
            --main-padding: 30px;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: var(--main-padding);
            min-height: 100vh;
        }
        
        .logo {
            font-size: 1.8em;
            font-weight: 700;
            background: linear-gradient(135deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .nav-item a {
            color: #495057;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .nav-item a:hover {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-item a.active {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        
        .user-info {
            position: absolute;
            bottom: 30px;
            width: calc(100% - 50px);
        }
        
        .card-main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        
        .btn-modern {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }
        
        .btn-back {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
            color: white;
        }
        
        .form-modern {
            padding: 30px;
        }
        
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.3rem rgba(0, 123, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        .alert-modern {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }
        
        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            color: #007bff;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 123, 255, 0.4);
        }
        
        .input-group-text {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            border-radius: 10px 0 0 10px;
        }
        
        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .badge-info {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .form-modern {
                padding: 20px;
            }
            
            .form-section {
                padding: 20px;
            }
            
            .menu-toggle {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1001;
                background: rgba(255, 255, 255, 0.9);
                border: none;
                border-radius: 8px;
                padding: 8px 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .card-header-custom .d-flex {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .badge-info {
                font-size: 0.8rem;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }

        /* Validación visual */
        .is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.3rem rgba(220, 53, 69, 0.1);
        }

        .is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.3rem rgba(40, 167, 69, 0.1);
        }

        .invalid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .calculation-results {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            display: none;
        }

        .calculation-results.show {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Menu Toggle Mobile -->
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #e9ecef; margin: 20px 0;">
        <nav>
            <div class="nav-item">
                <a href="<?= url_to('dashboard') ?>">
                    <i class="bi bi-house me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes_index') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos_index') ?>" class="active">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('facturas_index') ?>">
                    <i class="bi bi-receipt me-3"></i>Factura
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('reportes_index') ?>">
                    <i class="bi bi-bar-chart me-3"></i>Reportes y Análisis
                </a>
            </div>
        </nav>
        
        <div class="user-info">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <p class="mb-1 fw-bold"><?= esc(session()->get('user_name')) ?></p>
                    <small class="text-muted">Usuario activo</small>
                </div>
                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <a href="<?= url_to('logout') ?>" class="btn btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Botón Volver -->
        <a href="<?= url_to('productos_index') ?>" class="btn-back">
            <i class="bi bi-arrow-left"></i>Volver a Productos
        </a>

        <div class="card-main">
            <!-- Header -->
            <div class="card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">
                            <i class="bi bi-<?= isset($producto) ? 'pencil' : 'plus-circle' ?> me-2"></i><?= esc($title) ?>
                        </h2>
                        <p class="mb-0 opacity-75">
                            <?= isset($producto) ? 'Actualiza la información del producto' : 'Completa los datos para registrar un nuevo producto' ?>
                        </p>
                    </div>
                    <div class="badge badge-info fs-6 p-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Campos marcados con * son obligatorios
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <div class="form-modern">
                <!-- Alertas de Error -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Alertas de Éxito -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= url_to('productos_save') ?>" method="post" id="productoForm">
                    <?= csrf_field() ?>
                    
                    <!-- Campo oculto para el ID si estamos editando -->
                    <?php if (isset($producto)): ?>
                        <input type="hidden" name="id" value="<?= esc($producto['id']) ?>">
                    <?php endif; ?>

                    <!-- Sección Información Básica -->
                    <div class="form-section">
                        <h4 class="form-title">
                            <i class="bi bi-info-circle"></i>Información Básica
                        </h4>
                        
                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" 
                                           class="form-control <?= session()->getFlashdata('errors.nombre') ? 'is-invalid' : '' ?>" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="<?= old('nombre', $producto['nombre'] ?? '') ?>" 
                                           placeholder="Nombre del producto"
                                           required
                                           maxlength="100">
                                    <label for="nombre" class="required-field">
                                        <i class="bi bi-tag me-2"></i>Nombre del Producto
                                    </label>
                                    <?php if (session()->getFlashdata('errors.nombre')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.nombre') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-floating mt-3">
                            <textarea class="form-control" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      placeholder="Descripción del producto"
                                      style="height: 100px"
                                      maxlength="500"><?= old('descripcion', $producto['descripcion'] ?? '') ?></textarea>
                            <label for="descripcion">
                                <i class="bi bi-text-paragraph me-2"></i>Descripción
                            </label>
                        </div>
                    </div>

                    <!-- Sección Precios y Costos -->
                    <div class="form-section">
                        <h4 class="form-title">
                            <i class="bi bi-currency-dollar"></i>Información de Precios
                        </h4>
                        
                        <div class="row">
                            <!-- Precio de Venta -->
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label required-field">Precio de Venta</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.precio_unitario') ? 'is-invalid' : '' ?>" 
                                           id="precio_unitario" 
                                           name="precio_unitario" 
                                           step="0.01" 
                                           min="0"
                                           value="<?= old('precio_unitario', $producto['precio_unitario'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required>
                                    <?php if (session()->getFlashdata('errors.precio_unitario')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.precio_unitario') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Costo Base -->
                            <div class="col-md-6">
                                <label for="costo" class="form-label required-field">Costo Base</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.costo') ? 'is-invalid' : '' ?>" 
                                           id="costo" 
                                           name="costo" 
                                           step="0.01" 
                                           min="0"
                                           value="<?= old('costo', $producto['costo'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required>
                                    <?php if (session()->getFlashdata('errors.costo')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.costo') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Cálculo de Margen -->
                        <div class="calculation-results" id="calculationResults">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <small>Margen</small>
                                    <div class="fw-bold" id="margenResult">$0.00</div>
                                </div>
                                <div class="col-md-4">
                                    <small>Margen %</small>
                                    <div class="fw-bold" id="margenPorcentajeResult">0%</div>
                                </div>
                                <div class="col-md-4">
                                    <small>Precio con IVA</small>
                                    <div class="fw-bold" id="precioConIvaResult">$0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Impuestos e Inventario -->
                    <div class="form-section">
                        <h4 class="form-title">
                            <i class="bi bi-calculator"></i>Impuestos e Inventario
                        </h4>
                        
                        <div class="row">
                            <!-- IVA -->
                            <div class="col-md-6">
                                <label for="tasa_impuesto" class="form-label required-field">IVA %</label>
                                <div class="input-group mb-3">
                                    <input type="number" 
                                           class="form-control <?= session()->getFlashdata('errors.tasa_impuesto') ? 'is-invalid' : '' ?>" 
                                           id="tasa_impuesto" 
                                           name="tasa_impuesto" 
                                           step="0.01" 
                                           min="0"
                                           max="100"
                                           value="<?= old('tasa_impuesto', $producto['tasa_impuesto'] ?? ($iva_default ?? 19)) ?>" 
                                           placeholder="19"
                                           required>
                                    <span class="input-group-text">%</span>
                                    <?php if (session()->getFlashdata('errors.tasa_impuesto')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.tasa_impuesto') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Inventario -->
                            <div class="col-md-6">
                                <label for="inventario" class="form-label required-field">Stock</label>
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
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <a href="<?= url_to('productos_index') ?>" class="btn btn-outline-secondary w-100 py-3">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= isset($producto) ? 'Actualizar Producto' : 'Guardar Nuevo Producto' ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle menu para móviles
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Cerrar menú al hacer clic fuera en móviles
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // Cálculos en tiempo real
        function calculateMargins() {
            const precio = parseFloat(document.getElementById('precio_unitario').value) || 0;
            const costo = parseFloat(document.getElementById('costo').value) || 0;
            const iva = parseFloat(document.getElementById('tasa_impuesto').value) || 0;
            
            if (precio > 0 && costo > 0) {
                const margen = precio - costo;
                const margenPorcentaje = ((margen / costo) * 100).toFixed(2);
                const precioConIva = precio * (1 + (iva / 100));
                
                document.getElementById('margenResult').textContent = '$' + margen.toFixed(2);
                document.getElementById('margenPorcentajeResult').textContent = margenPorcentaje + '%';
                document.getElementById('precioConIvaResult').textContent = '$' + precioConIva.toFixed(2);
                document.getElementById('calculationResults').classList.add('show');
            } else {
                document.getElementById('calculationResults').classList.remove('show');
            }
        }

        // Event listeners para cálculos
        document.getElementById('precio_unitario').addEventListener('input', calculateMargins);
        document.getElementById('costo').addEventListener('input', calculateMargins);
        document.getElementById('tasa_impuesto').addEventListener('input', calculateMargins);

        // Validación del formulario
        document.getElementById('productoForm').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const precio = document.getElementById('precio_unitario').value;
            const costo = document.getElementById('costo').value;
            const inventario = document.getElementById('inventario').value;
            
            if (!nombre || !precio || !costo || inventario === '') {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
            
            if (parseFloat(precio) < parseFloat(costo)) {
                e.preventDefault();
                alert('El precio de venta no puede ser menor que el costo');
                return false;
            }
        });

        // Auto-focus en el primer campo
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nombre').focus();
            calculateMargins(); // Calcular márgenes al cargar la página
        });
    </script>
</body>
</html>