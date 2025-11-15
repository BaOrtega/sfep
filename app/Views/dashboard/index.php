<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PFEP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f2f5; margin: 0; padding: 0; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background-color: #343a40; color: white; padding: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); }
        .main-content { margin-left: 270px; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #ccc; margin-bottom: 20px; }
        .logo { font-size: 1.5em; font-weight: bold; margin-bottom: 20px; }
        .nav-item a { color: white; text-decoration: none; display: block; padding: 10px 0; border-radius: 4px; transition: background-color 0.3s; }
        .nav-item a:hover { background-color: #495057; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 20px; }
        .logout-btn { background: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 4px; text-decoration: none; cursor: pointer; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">PFEP</div>
        <hr style="border-color: #495057;">
        <nav>
            <div class="nav-item"><a href="<?= url_to('dashboard') ?>" style="background-color: #495057;">🏠 Dashboard</a></div>
            <div class="nav-item"><a href="/clientes">👥 Clientes (CRUD)</a></div>
            <div class="nav-item"><a href="/productos">📦 Productos (Inventario)</a></div>
            <div class="nav-item"><a href="/facturas/nueva">🧾 Nueva Factura (CU-001)</a></div>
            <div class="nav-item"><a href="/reportes">📊 Reportes y Análisis</a></div>
        </nav>
        <div style="position: absolute; bottom: 20px;">
            <p style="font-size: 0.9em;">Usuario: <?= esc(session()->get('user_name')) ?></p>
            <a href="<?= url_to('logout') ?>" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Panel de Control Principal</h1>
        </div>
        <div class="card">
            <h2>👋 ¡Bienvenido, <?= esc(session()->get('user_name')) ?>!</h2>
            <p>La seguridad del sistema está operativa. La precondición de autenticación para la creación de facturas (CU-001) ya está cubierta. Ahora podemos construir los módulos de gestión.</p>
        </div>

        <div class="card">
            <h3>Estado del Sistema:</h3>
            <ul>
                <li>**Seguridad (Auth Filter):** ✅ Operativo</li>
                <li>**Clientes (CRUD):** ⚠️ Pendiente de Vistas</li>
                <li>**Productos/Servicios:** ❌ Pendiente</li>
            </ul>
        </div>
    </div>
</body>
</html>