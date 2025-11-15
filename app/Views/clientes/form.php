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
        /* Estilos específicos del formulario */
        .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-right: 5px; cursor: pointer; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-back { background-color: #6c757d; color: white; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-top: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .error-list { color: #dc3545; list-style: none; padding: 0; margin-top: 10px; }
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
        
        <a href="/clientes" class="btn btn-back">← Volver a Clientes</a>
        
        <div class="card">
            <?php 
                // Define la acción del formulario: si existe $cliente, es Edición (UPDATE); si no, es Creación (CREATE).
                $action = '/clientes/save';
                if (isset($cliente)) {
                    $action = '/clientes/save/' . esc($cliente['id']);
                }
            ?>
            <form action="<?= $action ?>" method="post">
                <?= csrf_field() ?>
                
                <?php 
                    // Campo oculto para el ID si estamos editando
                    if (isset($cliente)): 
                ?>
                    <input type="hidden" name="id" value="<?= esc($cliente['id']) ?>">
                <?php endif; ?>

                <?php 
                    // Muestra errores de validación
                    if (session()->getFlashdata('errors')): 
                ?>
                    <ul class="error-list">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <label for="nombre">Nombre Completo (*)</label>
                <input type="text" id="nombre" name="nombre" value="<?= old('nombre', $cliente['nombre'] ?? '') ?>" required>

                <label for="nit">NIT/Cédula (*)</label>
                <input type="text" id="nit" name="nit" value="<?= old('nit', $cliente['nit'] ?? '') ?>" required>
                
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="<?= old('direccion', $cliente['direccion'] ?? '') ?>">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= old('email', $cliente['email'] ?? '') ?>">

                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?= old('telefono', $cliente['telefono'] ?? '') ?>">

                <button type="submit" class="btn btn-primary" style="margin-top: 20px; width: auto;">
                    <?= isset($cliente) ? 'Actualizar Cliente' : 'Guardar Nuevo Cliente' ?>
                </button>
            </form>
        </div>
    </div>
</body>
</html>