<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        /* Estilos CSS (Iguales a los del mensaje anterior) */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background-color: #343a40; color: white; padding: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); }
        .main-content { margin-left: 270px; padding: 20px; }
        .logo { font-size: 1.5em; font-weight: bold; margin-bottom: 20px; }
        .nav-item a { color: white; text-decoration: none; display: block; padding: 10px 0; border-radius: 4px; transition: background-color 0.3s; }
        .nav-item a:hover { background-color: #495057; }
        .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-right: 5px; cursor: pointer; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-back { background-color: #6c757d; color: white; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-top: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="date"], input[type="number"], select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .input-group { display: flex; gap: 20px; }
        .input-group > div { flex: 1; }
        #detalle_factura th, #detalle_factura td { text-align: center; }
        #detalle_factura input { text-align: center; }
        .total-box { margin-top: 20px; background-color: #f8f9fa; padding: 15px; border-radius: 4px; text-align: right; }
        .total-box strong { font-size: 1.2em; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #495057;">
        <nav>
            <div class="nav-item"><a href="<?= url_to('dashboard') ?>">🏠 Dashboard</a></div>
            <div class="nav-item"><a href="<?= url_to('clientes') ?>">👥 Clientes</a></div>
            <div class="nav-item"><a href="<?= url_to('productos') ?>">📦 Productos</a></div>
            <div class="nav-item"><a href="<?= url_to('facturas') ?>" style="background-color: #495057;">🧾 Facturas</a></div>
            <div class="nav-item"><a href="/reportes">📊 Reportes y Análisis</a></div>
        </nav>
        <div style="position: absolute; bottom: 20px;">
            <p style="font-size: 0.9em;">Usuario: <?= esc(session()->get('user_name')) ?></p>
            <a href="<?= url_to('logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <div class="main-content">
        <h1><?= esc($title) ?></h1>
        
        <a href="<?= url_to('facturas') ?>" class="btn btn-back">← Volver a Facturas</a>
        
        <div class="card">
            <?php $action = url_to('facturas/save'); ?>
            <form action="<?= esc($action) ?>" method="post" id="facturaForm">
                <?= csrf_field() ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert-error"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <h2>Datos Principales</h2>
                <div class="input-group">
                    <div>
                        <label for="cliente_id">Cliente (*)</label>
                        <select id="cliente_id" name="cliente_id" required>
                            <option value="">Seleccione un Cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= esc($cliente['id']) ?>" <?= (old('cliente_id') == $cliente['id']) ? 'selected' : '' ?>>
                                    <?= esc($cliente['nombre']) ?> (NIT: <?= esc($cliente['nit']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <label for="fecha_emision">Fecha de Emisión (*)</label>
                        <input type="date" id="fecha_emision" name="fecha_emision" value="<?= old('fecha_emision', $fecha_emision) ?>" required>
                    </div>
                    <div>
                        <label for="fecha_vencimiento">Fecha de Vencimiento (*)</label>
                        <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" value="<?= old('fecha_vencimiento', $fecha_vencimiento) ?>" required>
                    </div>
                </div>

                <h2 style="margin-top: 30px;">Detalle de Productos/Servicios</h2>

                <div class="input-group">
                    <div>
                        <label for="producto_selector">Seleccionar Producto</label>
                        <select id="producto_selector">
                            <option value="">Añadir producto...</option>
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
                    <div style="flex: 0.2; display: flex; align-items: flex-end;">
                        <button type="button" class="btn btn-success" id="btnAddProducto" style="width: 100%;">Añadir</button>
                    </div>
                </div>

                <table id="detalle_factura" style="margin-top: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Producto/Servicio</th>
                            <th style="width: 10%;">Cant.</th>
                            <th style="width: 15%;">Precio Unitario</th>
                            <th style="width: 10%;">IVA %</th>
                            <th style="width: 15%;">Subtotal Línea</th>
                            <th style="width: 10%;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tbody>
                </table>
                
                <div class="total-box">
                    <p>Subtotal General: <span id="subtotal_display">$ 0.00</span></p>
                    <p>Total Impuestos: <span id="impuestos_display">$ 0.00</span></p>
                    <hr>
                    <p><strong>TOTAL FACTURA: <span id="total_factura_display">$ 0.00</span></strong></p>
                </div>
                
                <input type="hidden" name="detalles_json" id="detalles_json" value="">

                <button type="submit" class="btn btn-primary" style="margin-top: 20px; width: 100%; font-size: 1.1em;">
                    Generar y Guardar Factura
                </button>
            </form>
        </div>
    </div>

    <script>
        const productoSelector = document.getElementById('producto_selector');
        const btnAddProducto = document.getElementById('btnAddProducto');
        const detalleTableBody = document.querySelector('#detalle_factura tbody');
        const facturaForm = document.getElementById('facturaForm');
        
        let detalles = [];

        // ------------------------------------
        // FUNCIÓN DE CÁLCULO (Ajustada a precio_unitario y tasa_impuesto)
        // ------------------------------------
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
                
                // Cálculos de la línea
                const subtotalLinea = cantidad * precio;
                const impuestoLinea = subtotalLinea * (ivaPct / 100);
                const totalLinea = subtotalLinea + impuestoLinea;
                
                // Actualizar displays
                row.querySelector('.subtotal_linea_display').textContent = '$ ' + subtotalLinea.toFixed(2);
                
                // Sumar al total general
                subtotalGeneral += subtotalLinea;
                impuestosGeneral += impuestoLinea;

                // Guardar en el arreglo 'detalles' (Ajustado a la nomenclatura del Modelo/DB)
                detalles.push({
                    producto_id: productoId,
                    cantidad: cantidad,
                    precio_unitario_venta: precio, // Se usa para pasar el precio fijo al controlador
                    iva_porcentaje_venta: ivaPct,  // Se usa para pasar el impuesto fijo al controlador
                    subtotal_linea: subtotalLinea,
                    impuesto_linea: impuestoLinea,
                    total_linea: totalLinea // Necesario para la tabla detalle_factura
                });
            });

            const totalFactura = subtotalGeneral + impuestosGeneral;

            // Actualizar displays finales
            document.getElementById('subtotal_display').textContent = '$ ' + subtotalGeneral.toFixed(2);
            document.getElementById('impuestos_display').textContent = '$ ' + impuestosGeneral.toFixed(2);
            document.getElementById('total_factura_display').textContent = '$ ' + totalFactura.toFixed(2);
            
            // Llenar el campo JSON oculto para enviar al controlador
            document.getElementById('detalles_json').value = JSON.stringify(detalles);
        }

        // ------------------------------------
        // FUNCIÓN DE AÑADIR FILA
        // ------------------------------------
        btnAddProducto.addEventListener('click', () => {
            const selectedOption = productoSelector.options[productoSelector.selectedIndex];
            if (!selectedOption.value) return; 

            const productoId = selectedOption.value;
            
            if (detalleTableBody.querySelector(`tr[data-id="${productoId}"]`)) {
                alert('El producto ya fue agregado. Modifique la cantidad en la tabla.');
                return;
            }

            const nombre = selectedOption.dataset.nombre;
            // Usamos data-precio y data-iva, que cargan los nombres precio_unitario y tasa_impuesto
            const precio = selectedOption.dataset.precio; 
            const iva = selectedOption.dataset.iva;

            const newRow = detalleTableBody.insertRow();
            newRow.setAttribute('data-id', productoId);

            newRow.innerHTML = `
                <td>${nombre}</td>
                <td><input type="number" class="cantidad_input" value="1" min="1" step="1" style="width: 80px;"></td>
                <td><input type="number" class="precio_input" value="${precio}" min="0" step="0.01" style="width: 100px;"></td>
                <td><input type="number" class="iva_input" value="${iva}" min="0" step="0.01" style="width: 80px;"></td>
                <td class="subtotal_linea_display">$ 0.00</td>
                <td><button type="button" class="btn btn-danger btn-sm btn-eliminar">X</button></td>
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

        // ------------------------------------
        // VALIDACIÓN ANTES DE ENVIAR
        // ------------------------------------
        facturaForm.addEventListener('submit', (e) => {
            if (detalles.length === 0) {
                e.preventDefault();
                alert('Debe agregar al menos un producto/servicio a la factura antes de guardarla.');
            }
        });
        
        // Inicializar cálculos si hay datos antiguos del input (ej. después de un error)
        calcularTotales();

    </script>
</body>
</html>