<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        /* Estilos base */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background-color: #343a40; color: white; padding: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); }
        .main-content { margin-left: 270px; padding: 20px; }
        .logo { font-size: 1.5em; font-weight: bold; margin-bottom: 20px; }
        .nav-item a { color: white; text-decoration: none; display: block; padding: 10px 0; border-radius: 4px; transition: background-color 0.3s; }
        .nav-item a:hover { background-color: #495057; }
        .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-right: 5px; cursor: pointer; display: inline-block; }
        .btn-success { background-color: #28a745; color: white; }
        .alert-success, .alert-error { padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f8f9fa; }
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

        <a href="<?= url_to('facturas/new') ?>" class="btn btn-success" style="margin-bottom: 20px;">+ Crear Nueva Factura</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        
        <?php if (empty($facturas)): ?>
            <p>Aún no hay facturas generadas. ¡Crea la primera!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>N° Factura</th>
                        <th>Cliente ID</th>
                        <th>Fecha Emisión</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facturas as $factura): ?>
                        <tr>
                            <td><?= esc($factura['id']) ?></td>
                            <td><?= esc($factura['cliente_id']) ?></td>
                            <td><?= esc($factura['fecha_emision']) ?></td>
                            <td>$ <?= number_format(esc($factura['total_factura']), 2, ',', '.') ?></td>
                            <td><?= esc($factura['estado']) ?></td>
                            <td>
                                <a href="/facturas/view/<?= esc($factura['id']) ?>" class="btn btn-primary">Ver</a>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>