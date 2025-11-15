<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        /* Estilos base (Mismos que Dashboard) */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background-color: #343a40; color: white; padding: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); }
        .main-content { margin-left: 270px; padding: 20px; }
        .logo { font-size: 1.5em; font-weight: bold; margin-bottom: 20px; }
        .nav-item a { color: white; text-decoration: none; display: block; padding: 10px 0; border-radius: 4px; transition: background-color 0.3s; }
        .nav-item a:hover { background-color: #495057; }
        /* Estilos específicos de la tabla y botones */
        .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-right: 5px; cursor: pointer; display: inline-block; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f8f9fa; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #495057;">
        <nav>
            <div class="nav-item"><a href="<?= url_to('dashboard') ?>">🏠 Dashboard</a></div>
            <div class="nav-item"><a href="/clientes" style="background-color: #495057;">👥 Clientes (CRUD)</a></div>
            <div class="nav-item"><a href="/productos">📦 Productos (Inventario)</a></div>
            <div class="nav-item"><a href="/facturas/nueva">🧾 Nueva Factura (CU-001)</a></div>
            <div class="nav-item"><a href="/reportes">📊 Reportes y Análisis</a></div>
        </nav>
        <div style="position: absolute; bottom: 20px;">
            <p style="font-size: 0.9em;">Usuario: <?= esc(session()->get('user_name')) ?></p>
            <a href="<?= url_to('logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <div class="main-content">
        <h1><?= esc($title) ?></h1>

        <a href="/clientes/new" class="btn btn-success" style="margin-bottom: 20px;">+ Nuevo Cliente</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        
        <?php if (empty($clientes)): ?>
            <p>Aún no hay clientes registrados.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>NIT/Cédula</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= esc($cliente['id']) ?></td>
                            <td><?= esc($cliente['nombre']) ?></td>
                            <td><?= esc($cliente['nit']) ?></td>
                            <td><?= esc($cliente['email']) ?></td>
                            <td><?= esc($cliente['telefono']) ?></td>
                            <td>
                                <a href="/clientes/edit/<?= esc($cliente['id']) ?>" class="btn btn-primary">Editar</a>
                                <a href="/clientes/delete/<?= esc($cliente['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este cliente?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>