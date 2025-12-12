<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <style>
        /* Estilos empresariales para el PDF */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            margin: 0; 
            padding: 25px; 
            font-size: 12pt; 
            color: #1e293b;
            background: white;
        }
        
        .header { 
            width: 100%; 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px solid #1a5fb4;
            padding-bottom: 20px;
        }
        
        .company-info { 
            width: 50%; 
            display: inline-block; 
            vertical-align: top;
            text-align: left;
        }
        
        .client-info { 
            width: 48%; 
            display: inline-block; 
            vertical-align: top;
            text-align: right;
        }
        
        h1 { 
            color: #1a5fb4; 
            font-size: 24pt; 
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        h2 { 
            font-size: 14pt; 
            margin-top: 20px;
            color: #2d3748;
            font-weight: 600;
        }
        
        .invoice-details {
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        
        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .details-label {
            font-weight: 600;
            color: #2d3748;
        }
        
        .details-value {
            color: #64748b;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 25px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td { 
            border: 1px solid #e2e8f0; 
            padding: 12px 15px; 
            text-align: left;
        }
        
        th { 
            background-color: #1a5fb4; 
            color: white;
            font-weight: 600;
            font-size: 11pt;
        }
        
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .text-right { 
            text-align: right; 
        }
        
        .totals-section { 
            margin-top: 30px; 
            border-top: 2px solid #1a5fb4; 
            padding-top: 15px; 
            text-align: right;
        }
        
        .totals-section div { 
            margin-bottom: 8px; 
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .total-label {
            font-weight: 600;
            color: #2d3748;
        }
        
        .total-value {
            font-weight: 600;
            color: #1e293b;
        }
        
        .grand-total {
            font-size: 16pt; 
            color: #1a5fb4; 
            font-weight: 700;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }
        
        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 10pt;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-paid { 
            background-color: #10b981; 
            color: white;
        }
        
        .status-emitted { 
            background-color: #f59e0b; 
            color: white;
        }
        
        .status-annulled { 
            background-color: #ef4444; 
            color: white;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 10pt;
        }
        
        .company-logo {
            font-size: 18pt;
            font-weight: 700;
            color: #1a5fb4;
            margin-bottom: 10px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                padding: 15px;
            }
            
            .header {
                margin-bottom: 20px;
            }
            
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="company-logo">PFEP S.A.S.</div>
        <h1>FACTURA DE VENTA</h1>
        <p style="color: #64748b; font-size: 11pt;">Sistema de Facturación Electrónica</p>
    </div>

    <div class="invoice-details">
        <div class="details-row">
            <div class="company-info">
                <h2>Datos de la Empresa</h2>
                <p><strong>PFEP S.A.S.</strong></p>
                <p>NIT: 900.123.456-7</p>
                <p>Dirección: Calle Falsa 123, Ciudad X</p>
                <p>Teléfono: (57) 300 123 4567</p>
                <p>Email: contacto@pfep.com</p>
            </div>

            <div class="client-info">
                <h2>Datos de la Factura</h2>
                <p><strong>N° FACTURA:</strong> <?= esc($factura['id']) ?></p>
                <p><strong>Fecha Emisión:</strong> <?= esc($factura['fecha_emision']) ?></p>
                <p><strong>Fecha Vencimiento:</strong> <?= esc($factura['fecha_vencimiento']) ?></p>
                <p><strong>Estado:</strong> 
                    <span class="status-badge <?= strtolower($factura['estado']) == 'pagada' ? 'status-paid' : (strtolower($factura['estado']) == 'emitida' ? 'status-emitted' : 'status-annulled') ?>">
                        <?= esc($factura['estado']) ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="invoice-details">
        <h2>Información del Cliente</h2>
        <div class="details-row">
            <div>
                <p><strong>Cliente:</strong> <?= esc($cliente['nombre']) ?></p>
                <p><strong>NIT/C.C.:</strong> <?= esc($cliente['nit']) ?></p>
            </div>
            <div>
                <p><strong>Dirección:</strong> <?= esc($cliente['direccion'] ?? 'No especificada') ?></p>
                <p><strong>Teléfono:</strong> <?= esc($cliente['telefono'] ?? 'No especificado') ?></p>
            </div>
        </div>
    </div>

    <h2>Detalle de Productos/Servicios</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto/Servicio</th>
                <th class="text-right">Cant.</th>
                <th class="text-right">Precio Unitario</th>
                <th class="text-right">IVA %</th>
                <th class="text-right">Total Línea</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?= $contador++ ?></td>
                <td><?= esc($detalle['nombre']) ?></td>
                <td class="text-right"><?= esc($detalle['cantidad']) ?></td>
                <td class="text-right">$ <?= number_format(esc($detalle['precio_unitario']), 2, ',', '.') ?></td>
                <td class="text-right"><?= esc($detalle['tasa_impuesto']) ?>%</td>
                <td class="text-right">$ <?= number_format(esc($detalle['total_linea']), 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totals-section">
        <div class="total-row">
            <span class="total-label">Subtotal General:</span>
            <span class="total-value">$ <?= number_format(esc($factura['subtotal']), 2, ',', '.') ?></span>
        </div>
        
        <div class="total-row">
            <span class="total-label">Total Impuestos (IVA):</span>
            <span class="total-value">$ <?= number_format(esc($factura['total_impuestos']), 2, ',', '.') ?></span>
        </div>
        
        <div class="total-row">
            <span class="total-label">Descuentos:</span>
            <span class="total-value">$ 0.00</span>
        </div>
        
        <div class="grand-total">
            <span>TOTAL A PAGAR:</span>
            <span>$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></span>
        </div>
    </div>
    
    <div class="footer">
        <p><strong>PFEP S.A.S.</strong> - Sistema de Facturación Electrónica</p>
        <p>Este documento es generado automáticamente y es válido sin firma manuscrita según la normativa vigente</p>
        <p>Factura generada el <?= date('d/m/Y H:i:s') ?> por <?= session()->get('user_name') ?></p>
    </div>

</body>
</html>