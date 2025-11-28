<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <style>
        /* Estilos generales para el PDF */
        body { font-family: sans-serif; margin: 0; padding: 20px; font-size: 10pt; }
        .header, .footer { width: 100%; text-align: center; margin-bottom: 20px; }
        .company-info, .client-info { width: 48%; display: inline-block; vertical-align: top; }
        .company-info { text-align: left; }
        .client-info { text-align: right; }
        h1 { color: #343a40; border-bottom: 2px solid #343a40; padding-bottom: 5px; font-size: 16pt; }
        h2 { font-size: 12pt; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .totals-box { margin-top: 30px; border-top: 2px solid #343a40; padding-top: 10px; text-align: right; }
        .totals-box div { margin-bottom: 5px; }
        .totals-box strong { font-size: 12pt; color: #000; }
        .text-right { text-align: right; }
        .status-paid { color: green; font-weight: bold; }
        .status-annulled { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>FACTURA DE VENTA</h1>
    </div>

    <div style="border: 1px solid #ccc; padding: 15px;">
        <div class="company-info">
            <h2>PFEP S.A.S.</h2>
            <p>NIT: 900.123.456-7</p>
            <p>Dirección: Calle Falsa 123, Ciudad X</p>
            <p>Teléfono: (57) 300 123 4567</p>
        </div>

        <div class="client-info">
            <p><strong>N° FACTURA:</strong> <?= esc($factura['id']) ?></p>
            <p><strong>Fecha Emisión:</strong> <?= esc($factura['fecha_emision']) ?></p>
            <p><strong>Fecha Vencimiento:</strong> <?= esc($factura['fecha_vencimiento']) ?></p>
        </div>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc;">
        <h2>Información del Cliente</h2>
        <p><strong>Cliente:</strong> <?= esc($cliente['nombre']) ?></p>
        <p><strong>NIT/C.C.:</strong> <?= esc($cliente['nit']) ?></p>
        <p><strong>Dirección:</strong> <?= esc($cliente['direccion']) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto/Servicio</th>
                <th class="text-right">Cant.</th>
                <th class="text-right">Precio Unitario</th>
                <th class="text-right">IVA %</th>
                <th class="text-right">Total Línea</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?= esc($detalle['nombre']) ?></td>
                <td class="text-right"><?= esc($detalle['cantidad']) ?></td>
                <td class="text-right">$ <?= number_format(esc($detalle['precio_unitario']), 2, ',', '.') ?></td>
                <td class="text-right"><?= esc($detalle['tasa_impuesto']) ?>%</td>
                <td class="text-right">$ <?= number_format(esc($detalle['total_linea']), 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totals-box">
        <div>Subtotal General: <span>$ <?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></span></div>
        <div>Total Impuestos: <span>$ <?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></span></div>
        <hr style="border-top: 1px dashed #ccc; margin: 10px 0;">
        <div><strong>TOTAL A PAGAR: <span>$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></span></strong></div>
    </div>
    
    <div style="margin-top: 30px; text-align: center;">
        Estado de la Factura: 
        <span class="<?= strtolower($factura['estado']) == 'pagada' ? 'status-paid' : (strtolower($factura['estado']) == 'anulada' ? 'status-annulled' : '') ?>">
            <?= esc($factura['estado']) ?>
        </span>
    </div>

</body>
</html>