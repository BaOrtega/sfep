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
        :root {
            --sidebar-width: 280px;
            --main-padding: 30px;
            --primary-gradient: linear-gradient(135deg, #007bff, #0056b3);
            --success-gradient: linear-gradient(135deg, #28a745, #20c997);
            --warning-gradient: linear-gradient(135deg, #ffc107, #fd7e14);
            --danger-gradient: linear-gradient(135deg, #dc3545, #c82333);
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
            transition: transform 0.3s ease;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: var(--main-padding);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-center {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }
        
        .logo {
            font-size: 1.8em;
            font-weight: 700;
            background: var(--primary-gradient);
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
            background: var(--primary-gradient);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-item a.active {
            background: var(--primary-gradient);
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
            background: var(--primary-gradient);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        
        .btn-modern {
            background: var(--success-gradient);
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
        
        .btn-primary-custom {
            background: var(--primary-gradient);
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
            color: white;
        }
        
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        .form-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }
        
        .section-header h4 {
            margin: 0;
            color: #495057;
            font-weight: 600;
        }
        
        .section-header i {
            color: #007bff;
            margin-right: 10px;
            font-size: 1.2em;
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
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }
        
        .input-group-custom {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 0;
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        
        .table-modern th {
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .table-modern td {
            border: none;
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .table-modern tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-modern tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .alert-modern {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .total-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 30px;
            margin-top: 25px;
            border: 2px solid #e9ecef;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .total-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .total-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
        }
        
        .grand-total {
            font-size: 1.5rem;
            color: #007bff;
            font-weight: 700;
        }
        
        .product-selector-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border: 2px dashed #dee2e6;
        }
        
        .input-number {
            width: 80px;
            text-align: center;
        }
        
        .btn-delete-line {
            background: var(--danger-gradient);
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-delete-line:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .empty-table-message {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .empty-table-message i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .table-modern th, 
            .table-modern td {
                padding: 10px 8px;
                font-size: 0.85rem;
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
            
            .total-box {
                padding: 20px;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .form-section {
                padding: 15px;
            }
            
            .btn-modern, 
            .btn-primary-custom {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            
            .table-modern {
                font-size: 0.85rem;
            }
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
        <div class="content-center">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="text-white mb-2">🧾 Crear Nueva Factura</h1>
                    <p class="text-white opacity-90 mb-0">Complete los datos para generar una nueva factura</p>
                </div>
                <a href="<?= url_to('facturas_index') ?>" class="btn-back">
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
                        
                        <!-- Alertas -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Sección Datos Principales -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-info-circle"></i>
                                <h4>Información Principal</h4>
                            </div>
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
                            <div class="section-header">
                                <i class="bi bi-cart-plus"></i>
                                <h4>Detalle de Productos/Servicios</h4>
                            </div>
                            
                            <!-- Selector de Productos -->
                            <div class="product-selector-card">
                                <div class="row g-3">
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
                                        <button type="button" class="btn-modern w-100" id="btnAddProducto">
                                            <i class="bi bi-plus-circle"></i>Añadir Producto
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de Detalles -->
                            <div class="table-responsive">
                                <table class="table table-modern" id="detalle_factura">
                                    <thead>
                                        <tr>
                                            <th><i class="bi bi-box me-2"></i>Producto</th>
                                            <th><i class="bi bi-hash me-2"></i>Cantidad</th>
                                            <th><i class="bi bi-currency-dollar me-2"></i>Precio Unitario</th>
                                            <th><i class="bi bi-percent me-2"></i>IVA %</th>
                                            <th><i class="bi bi-calculator me-2"></i>Subtotal</th>
                                            <th><i class="bi bi-trash me-2"></i>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Mensaje cuando no hay productos -->
                                        <tr id="emptyTableMessage" style="display: none;">
                                            <td colspan="6" class="text-center">
                                                <div class="empty-table-message">
                                                    <i class="bi bi-inbox"></i>
                                                    <p>No hay productos añadidos</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Las filas se añadirán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Totales -->
                        <div class="total-box">
                            <div class="section-header">
                                <i class="bi bi-calculator"></i>
                                <h4>Resumen de Factura</h4>
                            </div>
                            
                            <div class="total-row">
                                <span class="total-label">Subtotal General:</span>
                                <span id="subtotal_display" class="total-value">$ 0.00</span>
                            </div>
                            
                            <div class="total-row">
                                <span class="total-label">Total Impuestos (IVA):</span>
                                <span id="impuestos_display" class="total-value">$ 0.00</span>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="total-row">
                                <span class="total-label">TOTAL FACTURA:</span>
                                <span id="total_factura_display" class="grand-total">$ 0.00</span>
                            </div>
                        </div>
                        
                        <!-- Campo oculto para detalles -->
                        <input type="hidden" name="detalles_json" id="detalles_json" value="">

                        <!-- Botones de acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?= url_to('facturas_index') ?>" class="btn-back me-2">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn-primary-custom">
                                <i class="bi bi-check-circle me-2"></i>Generar Factura
                            </button>
                        </div>
                    </form>
                </div>
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
        const emptyTableMessage = document.getElementById('emptyTableMessage');
        
        let detalles = [];
        let isSubmitting = false; // Prevenir doble envío

        // Función para formatear números como moneda
        function formatCurrency(amount) {
            return '$ ' + parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        function calcularTotales() {
            let subtotalGeneral = 0;
            let impuestosGeneral = 0;
            
            detalles = []; 
            
            const rows = detalleTableBody.querySelectorAll('tr[data-id]');
            
            rows.forEach(row => {
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
                
                // Actualizar display de subtotal en la fila
                row.querySelector('.subtotal_linea_display').textContent = formatCurrency(subtotalLinea);
                
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

            // Actualizar displays de totales
            document.getElementById('subtotal_display').textContent = formatCurrency(subtotalGeneral);
            document.getElementById('impuestos_display').textContent = formatCurrency(impuestosGeneral);
            document.getElementById('total_factura_display').textContent = formatCurrency(totalFactura);
            
            // Actualizar campo oculto con los detalles
            document.getElementById('detalles_json').value = JSON.stringify(detalles);
            
            // Mostrar/ocultar mensaje de tabla vacía
            if (rows.length === 0) {
                emptyTableMessage.style.display = '';
            } else {
                emptyTableMessage.style.display = 'none';
            }
        }

        btnAddProducto.addEventListener('click', () => {
            const selectedOption = productoSelector.options[productoSelector.selectedIndex];
            if (!selectedOption.value) {
                alert('Por favor seleccione un producto.');
                return;
            }

            const productoId = selectedOption.value;
            
            // Verificar si el producto ya fue agregado
            if (detalleTableBody.querySelector(`tr[data-id="${productoId}"]`)) {
                // Si ya existe, incrementar la cantidad
                const existingRow = detalleTableBody.querySelector(`tr[data-id="${productoId}"]`);
                const cantidadInput = existingRow.querySelector('.cantidad_input');
                cantidadInput.value = parseInt(cantidadInput.value) + 1;
                
                // Recalcular totales
                calcularTotales();
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
                    <input type="number" class="form-control cantidad_input input-number" value="1" min="1" step="1">
                </td>
                <td>
                    <input type="number" class="form-control precio_input" value="${precio}" min="0" step="0.01">
                </td>
                <td>
                    <input type="number" class="form-control iva_input" value="${iva}" min="0" step="0.01">
                </td>
                <td class="subtotal_linea_display fw-bold">${formatCurrency(0)}</td>
                <td>
                    <button type="button" class="btn-delete-line">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            
            // Agregar event listeners a los inputs
            const inputs = newRow.querySelectorAll('.cantidad_input, .precio_input, .iva_input');
            inputs.forEach(input => {
                input.addEventListener('input', calcularTotales);
                input.addEventListener('change', calcularTotales);
            });

            // Agregar evento al botón de eliminar
            newRow.querySelector('.btn-delete-line').addEventListener('click', function() {
                this.closest('tr').remove();
                calcularTotales();
            });

            // Recalcular totales
            calcularTotales();
            
            // Limpiar selector
            productoSelector.value = "";
        });

        // Validar formulario antes de enviar
        facturaForm.addEventListener('submit', (e) => {
            // Prevenir doble envío
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            
            if (detalles.length === 0) {
                e.preventDefault();
                alert('❌ Debe agregar al menos un producto/servicio a la factura antes de guardarla.');
                return false;
            }
            
            // Validar cliente seleccionado
            const clienteSelect = document.getElementById('cliente_id');
            if (!clienteSelect.value) {
                e.preventDefault();
                alert('❌ Debe seleccionar un cliente.');
                clienteSelect.focus();
                return false;
            }
            
            // Validar fechas
            const fechaEmision = document.getElementById('fecha_emision').value;
            const fechaVencimiento = document.getElementById('fecha_vencimiento').value;
            
            if (!fechaEmision) {
                e.preventDefault();
                alert('❌ Debe seleccionar una fecha de emisión.');
                return false;
            }
            
            if (!fechaVencimiento) {
                e.preventDefault();
                alert('❌ Debe seleccionar una fecha de vencimiento.');
                return false;
            }
            
            // Mostrar confirmación
            if (!confirm('¿Está seguro de generar esta factura?')) {
                e.preventDefault();
                return false;
            }
            
            // Marcar como enviando
            isSubmitting = true;
            
            // Deshabilitar botón temporalmente
            const submitBtn = facturaForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Procesando...';
            submitBtn.disabled = true;
            
            // Rehabilitar después de 5 segundos (por si hay error)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                isSubmitting = false;
            }, 5000);
            
            return true;
        });

        // Menu toggle para móviles
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

        // Calcular totales iniciales
        calcularTotales();
    </script>
</body>
</html>