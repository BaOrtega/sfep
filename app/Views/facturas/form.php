<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Factura - PFEP</title>
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
            margin-bottom: 25px;
        }
        .card-header-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        .form-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        .btn-success-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        .table-custom th {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        .table-custom td {
            padding: 12px;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        .total-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            margin-top: 25px;
            text-align: right;
        }
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 20px;
            margin-bottom: 25px;
        }
        .input-group-custom {
            border-radius: 10px;
            overflow: hidden;
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
                    <i class="bi bi-speedometer2 me-3"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('clientes_index') ?>">
                    <i class="bi bi-people me-3"></i>Clientes
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('productos_index') ?>">
                    <i class="bi bi-box-seam me-3"></i>Productos
                </a>
            </div>
            <div class="nav-item">
                <a href="<?= url_to('facturas_index') ?>" class="active">
                    <i class="bi bi-receipt me-3"></i>Facturas
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
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-white mb-2">🧾 Crear Nueva Factura</h1>
                <p class="text-white opacity-90 mb-0">Complete los datos para generar una nueva factura</p>
            </div>
            <a href="<?= url_to('facturas_index') ?>" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Volver a Facturas
            </a>
        </div>

        <div class="card-main">
            <div class="card-header-custom">
                <h3 class="mb-0"><i class="bi bi-file-text me-2"></i>Datos de la Factura</h3>
            </div>
            <div class="card-body p-4">
                <?php $action = url_to('facturas_save'); ?>
                <form action="<?= esc($action) ?>" method="post" id="facturaForm">
                    <?= csrf_field() ?>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-custom">
                            <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Sección Datos Principales -->
                    <div class="form-section">
                        <h4 class="mb-4"><i class="bi bi-info-circle me-2"></i>Información Principal</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cliente_id" class="form-label">Cliente *</label>
                                <select id="cliente_id" name="cliente_id" class="form-select" required>
                                    <option value="">Seleccione un Cliente</option>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?= esc($cliente['id']) ?>" <?= (old('cliente_id') == $cliente['id']) ? 'selected' : '' ?>>
                                            <?= esc($cliente['nombre']) ?> (NIT: <?= esc($cliente['nit']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_emision" class="form-label">Fecha Emisión *</label>
                                <input type="date" id="fecha_emision" name="fecha_emision" class="form-control" 
                                       value="<?= old('fecha_emision', $fecha_emision) ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento *</label>
                                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" 
                                       value="<?= old('fecha_vencimiento', $fecha_vencimiento) ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Detalle de Productos -->
                    <div class="form-section">
                        <h4 class="mb-4"><i class="bi bi-cart-plus me-2"></i>Detalle de Productos/Servicios</h4>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label for="producto_selector" class="form-label">Seleccionar Producto</label>
                                <select id="producto_selector" class="form-select">
                                    <option value="">Seleccione un producto...</option>
                                    <?php foreach ($productos as $producto): ?>
                                        <option 
                                            value="<?= esc($producto['id']) ?>" 
                                            data-precio="<?= esc($producto['precio_unitario']) ?>"
                                            data-iva="<?= esc($producto['tasa_impuesto']) ?>"
                                            data-nombre="<?= esc($producto['nombre']) ?>"
                                        >
                                            <?= esc($producto['nombre']) ?> 
                                            (IVA: <?= esc($producto['tasa_impuesto']) ?>%) 
                                            - $<?= number_format(esc($producto['precio_unitario']), 0, ',', '.') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-success-custom w-100" id="btnAddProducto">
                                    <i class="bi bi-plus-circle me-2"></i>Añadir Producto
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-custom" id="detalle_factura">
                                <thead>
                                    <tr>
                                        <th>Producto/Servicio</th>
                                        <th style="width: 100px;">Cantidad</th>
                                        <th style="width: 120px;">Precio Unitario</th>
                                        <th style="width: 90px;">IVA %</th>
                                        <th style="width: 130px;">Subtotal Línea</th>
                                        <th style="width: 80px;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas se añadirán dinámicamente aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Totales -->
                    <div class="total-box">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-muted mb-3">Resumen de Factura</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Subtotal General: <span id="subtotal_display" class="fw-bold">$ 0.00</span></p>
                                <p class="mb-2">Total Impuestos: <span id="impuestos_display" class="fw-bold">$ 0.00</span></p>
                                <hr>
                                <h4 class="mb-0">TOTAL FACTURA: <span id="total_factura_display" class="text-primary">$ 0.00</span></h4>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="detalles_json" id="detalles_json" value="">

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Generar y Guardar Factura
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const productoSelector = document.getElementById('producto_selector');
        const btnAddProducto = document.getElementById('btnAddProducto');
        const detalleTableBody = document.querySelector('#detalle_factura tbody');
        const facturaForm = document.getElementById('facturaForm');
        
        let detalles = [];

        function calcularTotales() {
            let subtotalGeneral = 0;
            let impuestosGeneral = 0;
            
            detalles = []; 
            
            detalleTableBody.querySelectorAll('tr').forEach(row => {
                const productoId = row.dataset.id;
                const cantidadInput = row.querySelector('.cantidad_input');
                const precioInput = row.querySelector('.precio_input');
                const ivaInput = row.querySelector('.iva_input');

                const cantidad = parseFloat(cantidadInput.value) || 0;
                const precio = parseFloat(precioInput.value) || 0;
                const ivaPct = parseFloat(ivaInput.value) || 0;
                
                const subtotalLinea = cantidad * precio;
                const impuestoLinea = subtotalLinea * (ivaPct / 100);
                const totalLinea = subtotalLinea + impuestoLinea;
                
                row.querySelector('.subtotal_linea_display').textContent = '$ ' + subtotalLinea.toFixed(2);
                
                subtotalGeneral += subtotalLinea;
                impuestosGeneral += impuestoLinea;

                detalles.push({
                    producto_id: productoId,
                    cantidad: cantidad,
                    precio_unitario_venta: precio,
                    iva_porcentaje_venta: ivaPct,
                    subtotal_linea: subtotalLinea,
                    impuesto_linea: impuestoLinea,
                    total_linea: totalLinea
                });
            });

            const totalFactura = subtotalGeneral + impuestosGeneral;

            document.getElementById('subtotal_display').textContent = '$ ' + subtotalGeneral.toFixed(2);
            document.getElementById('impuestos_display').textContent = '$ ' + impuestosGeneral.toFixed(2);
            document.getElementById('total_factura_display').textContent = '$ ' + totalFactura.toFixed(2);
            
            document.getElementById('detalles_json').value = JSON.stringify(detalles);
        }

        btnAddProducto.addEventListener('click', () => {
            const selectedOption = productoSelector.options[productoSelector.selectedIndex];
            if (!selectedOption.value) {
                alert('Por favor seleccione un producto.');
                return;
            }

            const productoId = selectedOption.value;
            
            if (detalleTableBody.querySelector(`tr[data-id="${productoId}"]`)) {
                alert('Este producto ya fue agregado. Modifique la cantidad en la tabla.');
                return;
            }

            const nombre = selectedOption.dataset.nombre;
            const precio = selectedOption.dataset.precio; 
            const iva = selectedOption.dataset.iva;

            const newRow = detalleTableBody.insertRow();
            newRow.setAttribute('data-id', productoId);

            newRow.innerHTML = `
                <td>${nombre}</td>
                <td>
                    <input type="number" class="form-control cantidad_input" value="1" min="1" step="1">
                </td>
                <td>
                    <input type="number" class="form-control precio_input" value="${precio}" min="0" step="0.01">
                </td>
                <td>
                    <input type="number" class="form-control iva_input" value="${iva}" min="0" step="0.01">
                </td>
                <td class="subtotal_linea_display fw-bold">$ 0.00</td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-eliminar">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            
            const inputs = newRow.querySelectorAll('.cantidad_input, .precio_input, .iva_input');
            inputs.forEach(input => input.addEventListener('input', calcularTotales));

            newRow.querySelector('.btn-eliminar').addEventListener('click', function() {
                this.closest('tr').remove();
                calcularTotales();
            });

            calcularTotales(); 
            productoSelector.value = ""; 
        });

        facturaForm.addEventListener('submit', (e) => {
            if (detalles.length === 0) {
                e.preventDefault();
                alert('Debe agregar al menos un producto/servicio a la factura antes de guardarla.');
            }
        });
        
        calcularTotales();
    </script>
</body>
</html>