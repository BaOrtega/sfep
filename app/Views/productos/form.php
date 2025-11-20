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
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            margin-left: 300px;
            padding: 30px;
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
            padding: 10px 20px;
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #e9ecef; margin: 20px 0;">
        <nav>
            <div class="nav-item">
                <a href="<?= url_to('dashboard') ?>">
                    <i class="bi bi-house me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos') ?>" class="active">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="/facturas/nueva">
                    <i class="bi bi-receipt me-3"></i>Nueva Factura
                </a>
            </div>
            <div class="nav-item">
                <a href="/reportes">
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
        <a href="<?= url_to('productos') ?>" class="btn-back">
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
                    <div class="badge bg-light text-dark fs-6 p-3">
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

                <form action="<?= base_url('productos/save') ?>" method="post">
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
                                           class="form-control" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="<?= old('nombre', $producto['nombre'] ?? '') ?>" 
                                           placeholder="Nombre del producto"
                                           required>
                                    <label for="nombre" class="required-field">
                                        <i class="bi bi-tag me-2"></i>Nombre del Producto
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-floating mt-3">
                            <textarea class="form-control" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      placeholder="Descripción del producto"
                                      style="height: 100px"><?= old('descripcion', $producto['descripcion'] ?? '') ?></textarea>
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
                                <label for="precio" class="form-label required-field">Precio de Venta</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control" 
                                           id="precio" 
                                           name="precio_unitario" 
                                           step="0.01" 
                                           value="<?= old('precio_unitario', $producto['precio_unitario'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required>
                                </div>
                            </div>

                            <!-- Costo Base -->
                            <div class="col-md-6">
                                <label for="costo" class="form-label required-field">Costo Base</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control" 
                                           id="costo" 
                                           name="costo" 
                                           step="0.01" 
                                           value="<?= old('costo', $producto['costo'] ?? '') ?>" 
                                           placeholder="0.00"
                                           required>
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
                                <label for="iva_porcentaje" class="form-label required-field">IVA %</label>
                                <div class="input-group mb-3">
                                    <input type="number" 
                                           class="form-control" 
                                           id="iva_porcentaje" 
                                           name="tasa_impuesto" 
                                           step="0.01" 
                                           value="<?= old('tasa_impuesto', $producto['tasa_impuesto'] ?? $iva_default ?? 19) ?>" 
                                           placeholder="19"
                                           required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <!-- Inventario -->
                            <div class="col-md-6">
                                <label for="inventario" class="form-label required-field">Inventario/Stock</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="inventario" 
                                       name="inventario" 
                                       step="1" 
                                       value="<?= old('inventario', $producto['inventario'] ?? 0) ?>" 
                                       placeholder="0"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Envío -->
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= isset($producto) ? 'Actualizar Producto' : 'Guardar Nuevo Producto' ?>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>