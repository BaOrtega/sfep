<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .header { background: #f4f4f4; padding: 20px; border-radius: 5px; }
        .feature-list { background: #e7f3ff; padding: 15px; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏢 <?= $page_title ?></h1>
        <p class="success">¡CodeIgniter 4 está funcionando correctamente!</p>
    </div>
    
    <h2>✨ Características Principales:</h2>
    <div class="feature-list">
        <ul>
            <?php foreach ($features as $feature): ?>
                <li><?= $feature ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <h2>🔗 Enlaces de Prueba:</h2>
    <ul>
        <li><a href="/">Página de Inicio</a></li>
        <li><a href="/test">Probar Base de Datos</a></li>
        <li><a href="http://localhost:8888/phpmyadmin" target="_blank">PHPMyAdmin</a></li>
    </ul>
    
    <hr>
    <p><strong>Próximo paso:</strong> Crear la estructura de la base de datos para el sistema de facturación.</p>
</body>
</html>