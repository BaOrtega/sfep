<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?> - PFEP</title>
    <style>
        /* ESTILOS OPTIMIZADOS PARA PDF */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 15px;
        }
        
        /* CABECERA PRINCIPAL */
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0 0 5px 0;
            color: #007bff;
            font-size: 20px;
            font-weight: bold;
        }
        .header .subtitle {
            color: #6c757d;
            font-size: 12px;
            margin: 0;
        }
        .header .fecha {
            color: #495057;
            font-size: 10px;
            margin: 5px 0 0 0;
        }
        
        /* SECCIÓN DE FILTROS */
        .filtros {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #6c757d;
        }
        .filtros strong {
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }
        .filtro-item {
            display: inline-block;
            margin-right: 15px;
            font-size: 9px;
        }
        
        /* RESUMEN DE TOTALES */
        .resumen {
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
        }
        .resumen-item {
            text-align: center;
        }
        .resumen-valor {
            font-weight: bold;
            font-size: 11px;
            color: #007bff;
        }
        
        /* TABLA PRINCIPAL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 8px 5px;
            text-align: left;
            border: 1px solid #0056b3;
            font-size: 9px;
        }
        td {
            padding: 6px 5px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        /* ESTILOS PARA ESTADOS */
        .estado-emitida { 
            background-color: #fff3cd; 
            color: #856404;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 7px;
        }
        .estado-pagada { 
            background-color: #d1edff; 
            color: #004085;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 7px;
        }
        .estado-anulada { 
            background-color: #f8d7da; 
            color: #721c24;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 7px;
        }
        
        /* FILA DE TOTALES */
        .total-row {
            background-color: #e9ecef !important;
            font-weight: bold;
            border-top: 2px solid #007bff;
        }
        .total-row td {
            padding: 8px 5px;
            font-size: 9px;
        }
        
        /* PIE DE PÁGINA */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 8px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        /* NUMEROS Y MONEDAS */
        .numero {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        .moneda {
            text-align: right;
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        
        /* ENCABEZADOS DE COLUMNAS ESPECÍFICAS */
        .col-numero { width: 8%; }
        .col-cliente { width: 25%; }
        .col-fecha { width: 10%; }
        .col-monto { width: 12%; }
        .col-estado { width: 10%; }
        
        /* MEJORAS PARA PAGINACIÓN */
        .page-break {
            page-break-after: always;
        }
        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <!-- CABECERA DEL DOCUMENTO -->
    <div class="header no-break">
        <h1><?= esc($title) ?></h1>
        <p class="subtitle">Sistema de Facturación Electrónica - PFEP</p>
        <p class="fecha">Generado el: <?= date('d/m/Y H:i:s') ?></p>
    </div>

    <!-- SECCIÓN DE FILTROS APLICADOS -->
    <?php if (!empty($filtros['fecha_inicio']) || !empty($filtros['fecha_fin']) || !empty($filtros['estado'])): ?>
    <div class="filtros no-break">
        <strong>FILTROS APLICADOS:</strong>
        <div>
            <?php if (!empty($filtros['fecha_inicio'])): ?>
                <span class="filtro-item"><strong>Desde:</strong> <?= $filtros['fecha_inicio'] ?></span>
            <?php endif; ?>
            <?php if (!empty($filtros['fecha_fin'])): ?>
                <span class="filtro-item"><strong>Hasta:</strong> <?= $filtros['fecha_fin'] ?></span>
            <?php endif; ?>
            <?php if (!empty($filtros['estado']) && $filtros['estado'] !== 'TODOS'): ?>
                <span class="filtro-item"><strong>Estado:</strong> <?= $filtros['estado'] ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- RESUMEN DE TOTALES -->
    <?php if (!empty($facturas)): ?>
    <div class="resumen no-break">
        <div class="resumen-item">
            <div>Total Facturas</div>
            <div class="resumen-valor"><?= $total_facturas ?></div>
        </div>
        <div class="resumen-item">
            <div>Subtotal General</div>
            <div class="resumen-valor">$ <?= number_format(array_sum(array_column($facturas, 'subtotal')), 2, ',', '.') ?></div>
        </div>
        <div class="resumen-item">
            <div>Total Impuestos</div>
            <div class="resumen-valor">$ <?= number_format(array_sum(array_column($facturas, 'total_impuestos')), 2, ',', '.') ?></div>
        </div>
        <div class="resumen-item">
            <div>Total Ventas</div>
            <div class="resumen-valor">$ <?= number_format($total_ventas, 2, ',', '.') ?></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- TABLA DE FACTURAS -->
    <?php if (!empty($facturas)): ?>
        <table>
            <thead>
                <tr>
                    <th class="col-numero">N° Factura</th>
                    <th class="col-cliente">Cliente</th>
                    <th class="col-fecha">Fecha Emisión</th>
                    <th class="col-fecha">Fecha Vencimiento</th>
                    <th class="col-monto">Subtotal</th>
                    <th class="col-monto">Impuestos</th>
                    <th class="col-monto">Total</th>
                    <th class="col-estado">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturas as $factura): ?>
                    <tr>
                        <td class="numero"><strong>#<?= $factura['id'] ?></strong></td>
                        <td><?= esc($factura['cliente_nombre']) ?></td>
                        <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                        <td><?= $factura['fecha_vencimiento'] ? date('d/m/Y', strtotime($factura['fecha_vencimiento'])) : 'N/A' ?></td>
                        <td class="moneda">$ <?= number_format($factura['subtotal'], 2, ',', '.') ?></td>
                        <td class="moneda">$ <?= number_format($factura['total_impuestos'], 2, ',', '.') ?></td>
                        <td class="moneda"><strong>$ <?= number_format($factura['total_factura'], 2, ',', '.') ?></strong></td>
                        <td>
                            <span class="estado-<?= strtolower($factura['estado']) ?>">
                                <?= $factura['estado'] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <!-- FILA DE TOTALES -->
                <tr class="total-row">
                    <td colspan="4"><strong>TOTALES GENERALES</strong></td>
                    <td class="moneda"><strong>$ <?= number_format(array_sum(array_column($facturas, 'subtotal')), 2, ',', '.') ?></strong></td>
                    <td class="moneda"><strong>$ <?= number_format(array_sum(array_column($facturas, 'total_impuestos')), 2, ',', '.') ?></strong></td>
                    <td class="moneda"><strong>$ <?= number_format($total_ventas, 2, ',', '.') ?></strong></td>
                    <td><strong><?= $total_facturas ?> facturas</strong></td>
                </tr>
            </tbody>
        </table>
        
        <!-- DISTRIBUCIÓN POR ESTADOS -->
        <div class="no-break">
            <h3 style="font-size: 12px; color: #007bff; margin-bottom: 10px;">Distribución por Estados</h3>
            <?php
            $estados = [];
            foreach ($facturas as $factura) {
                $estado = $factura['estado'];
                if (!isset($estados[$estado])) {
                    $estados[$estado] = ['count' => 0, 'total' => 0];
                }
                $estados[$estado]['count']++;
                $estados[$estado]['total'] += $factura['total_factura'];
            }
            ?>
            <table style="width: 100%; font-size: 8px;">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th class="col-numero">Cantidad</th>
                        <th class="col-monto">Monto Total</th>
                        <th class="col-monto">Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estados as $estado => $datos): ?>
                        <tr>
                            <td>
                                <span class="estado-<?= strtolower($estado) ?>">
                                    <?= $estado ?>
                                </span>
                            </td>
                            <td class="numero"><?= $datos['count'] ?></td>
                            <td class="moneda">$ <?= number_format($datos['total'], 2, ',', '.') ?></td>
                            <td class="numero"><?= number_format(($datos['count'] / $total_facturas) * 100, 1) ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <!-- MENSAJE CUANDO NO HAY DATOS -->
        <div style="text-align: center; padding: 40px; color: #6c757d; font-style: italic;">
            <h3 style="color: #6c757d; margin-bottom: 10px;">No se encontraron facturas</h3>
            <p>No hay facturas que coincidan con los criterios de búsqueda aplicados.</p>
        </div>
    <?php endif; ?>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        <p><strong>PFEP - Sistema de Facturación Electrónica</strong></p>
        <p>Documento generado automáticamente. Este es un reporte de carácter informativo.</p>
        <p>Página 1 de 1</p>
    </div>
</body>
</html>