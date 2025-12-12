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
            max-width: 1400px;
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
        
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .section-header h4 {
            margin: 0;
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .section-header i {
            color: var(--primary-color);
            margin-right: 0.75rem;
            font-size: 1.2rem;
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
        
        .input-group-text {
            background-color: #f1f5f9;
            border: 2px solid #e2e8f0;
            color: #64748b;
            font-weight: 500;
        }
        
        /* Product Selector */
        .product-selector-card {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(14, 165, 233, 0.05) 100%);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px dashed #cbd5e1;
        }
        
        /* Table Styles */
        .table-modern {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .table-modern th {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-modern td {
            border: none;
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table-modern tbody tr {
            transition: var(--transition);
        }
        
        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }
        
        /* Quantity Input */
        .input-number {
            width: 80px;
            text-align: center;
        }
        
        /* Delete Button */
        .btn-delete-line {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: white;
            transition: var(--transition);
        }
        
        .btn-delete-line:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
            color: white;
        }
        
        /* Total Box */
        .total-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-top: 1.5rem;
            border: 2px solid #e2e8f0;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .total-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .total-label {
            font-size: 1rem;
            color: #64748b;
            font-weight: 500;
        }
        
        .total-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .grand-total {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 700;
        }
        
        /* Empty Table Message */
        .empty-table-message {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }
        
        .empty-table-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }
        
        .btn-back {
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
        
        .btn-back:hover {
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
            
            .table-modern th,
            .table-modern td {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .product-selector-card {
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .header-card h1 {
                font-size: 1.5rem;
            }
            
            .form-header h3 {
                font-size: 1.25rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .input-number {
                width: 60px;
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
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Crear Nueva Factura
                    </h1>
                    <p class="subtitle mb-0">
                        Complete los datos para generar una nueva factura
                    </p>
                </div>
                <a href="<?= url_to('facturas_index') ?>" class="btn-back" style="flex: 0 0 auto; width: auto;">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver a Facturas
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <!-- Form Header -->
            <div class="form-header">
                <h3>
                    <i class="fas fa-file-alt me-2"></i>
                    Datos de la Factura
                </h3>
            </div>

            <!-- Form Body -->
            <div class="form-body">
                <?php $action = url_to('facturas_save'); ?>
                <form action="<?= esc($action) ?>" method="post" id="facturaForm">
                    <?= csrf_field() ?>
                    
                    <!-- Alertas -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                                <div>
                                    <h5 class="alert-heading mb-1">Error</h5>
                                    <p class="mb-0"><?= session()->getFlashdata('error') ?></p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Sección Datos Principales -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-info-circle"></i>
                            <h4>Información Principal</h4>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cliente_id" class="form-label required-field">Cliente</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <select id="cliente_id" name="cliente_id" class="form-select" required>
                                        <option value="">Seleccione un Cliente</option>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <option value="<?= esc($cliente['id']) ?>" <?= (old('cliente_id') == $cliente['id']) ? 'selected' : '' ?>>
                                                <?= esc($cliente['nombre']) ?> (NIT: <?= esc($cliente['nit']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_emision" class="form-label required-field">Fecha Emisión</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                    <input type="date" id="fecha_emision" name="fecha_emision" class="form-control" 
                                           value="<?= old('fecha_emision', $fecha_emision) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_vencimiento" class="form-label required-field">Fecha Vencimiento</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-times"></i>
                                    </span>
                                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" 
                                           value="<?= old('fecha_vencimiento', $fecha_vencimiento) ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección Detalle de Productos -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-cart-plus"></i>
                            <h4>Detalle de Productos/Servicios</h4>
                        </div>
                        
                        <!-- Selector de Productos -->
                        <div class="product-selector-card">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="producto_selector" class="form-label">Seleccionar Producto</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-box"></i>
                                        </span>
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
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" class="btn-submit" id="btnAddProducto" style="flex: 1;">
                                        <i class="fas fa-plus-circle me-2"></i>Añadir Producto
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Detalles -->
                        <div class="table-responsive">
                            <table class="table table-modern" id="detalle_factura">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-box me-2"></i>Producto</th>
                                        <th><i class="fas fa-hashtag me-2"></i>Cantidad</th>
                                        <th><i class="fas fa-dollar-sign me-2"></i>Precio Unitario</th>
                                        <th><i class="fas fa-percent me-2"></i>IVA %</th>
                                        <th><i class="fas fa-calculator me-2"></i>Subtotal</th>
                                        <th><i class="fas fa-trash me-2"></i>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mensaje cuando no hay productos -->
                                    <tr id="emptyTableMessage" style="display: none;">
                                        <td colspan="6" class="text-center">
                                            <div class="empty-table-message">
                                                <i class="fas fa-inbox"></i>
                                                <p>No hay productos añadidos</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Totales -->
                    <div class="total-box">
                        <div class="section-header">
                            <i class="fas fa-calculator"></i>
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
                    <div class="action-buttons">
                        <a href="<?= url_to('facturas_index') ?>" class="btn-back">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-check-circle me-2"></i>Generar Factura
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
                        <i class="fas fa-trash"></i>
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
            submitBtn.innerHTML = '<i class="fas fa-hourglass-half me-2"></i>Procesando...';
            submitBtn.disabled = true;
            
            // Rehabilitar después de 5 segundos (por si hay error)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                isSubmitting = false;
            }, 5000);
            
            return true;
        });

        // Calcular totales iniciales
        calcularTotales();
    </script>
</body>
</html>