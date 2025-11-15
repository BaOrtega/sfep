<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro PFEP</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f2f5; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); width: 350px; text-align: center; }
        h2 { color: #333; margin-bottom: 25px; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; background-color: #007bff; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .error { color: #dc3545; margin-bottom: 15px; list-style: none; padding: 0; text-align: left; }
        .success { color: #28a745; margin-bottom: 15px; }
        .link { margin-top: 15px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Registro de Administrador PFEP</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (isset($errors)): ?>
            <ul class="error">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif; ?>

        <form action="<?= url_to('attemptRegister') ?>" method="post">
            <?= csrf_field() ?>
            
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" value="<?= old('nombre') ?>" required>
            

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="admin@pfep.com" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrar Cuenta</button>
        </form>

        <div class="link">
            ¿Ya tienes cuenta? <a href="<?= url_to('login') ?>">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>