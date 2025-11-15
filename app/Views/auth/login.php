<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - PFEP</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; }
        h2 { text-align: center; color: #333; }
        input[type="email"], input[type="password"] { width: 100%; padding: 10px; margin: 8px 0 15px 0; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background-color: #0056b3; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Acceso PFEP</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= url_to('attemptLogin') ?>" method="post">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Ingresa tu Email" name="email" required value="<?= old('email') ?>">

            <label for="password"><b>Contraseña</b></label>
            <input type="password" placeholder="Ingresa tu Contraseña" name="password" required>
                
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>