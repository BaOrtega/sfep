<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecimiento de Contraseña</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .email-header .icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: block;
        }
        .email-body {
            padding: 30px;
        }
        .email-body p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }
        .reset-button {
            display: inline-block;
            background: linear-gradient(90deg, #28a745, #20c997);
            color: white;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
            border: none;
        }
        .reset-button:hover {
            background: linear-gradient(90deg, #218838, #1e9e7e);
        }
        .link-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
            word-break: break-all;
            font-size: 14px;
            color: #495057;
        }
        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 25px 0;
            font-size: 14px;
        }
        .warning-box strong {
            color: #856404;
        }
        .email-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
        }
        .logo {
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="icon">🔐</div>
            <h1>Restablecer tu Contraseña</h1>
        </div>
        
        <div class="email-body">
            <div class="logo">Sistema de Facturación</div>
            
            <p>Hola,</p>
            
            <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en el <strong>Sistema de Facturación</strong>. Si no realizaste esta solicitud, puedes ignorar este correo.</p>
            
            <p>Para crear una nueva contraseña, haz clic en el siguiente botón:</p>
            
            <div class="button-container">
                <a href="<?= $resetLink ?>" class="reset-button">
                    🔑 Restablecer Contraseña
                </a>
            </div>
            
            <p>O copia y pega este enlace en tu navegador:</p>
            
            <div class="link-box">
                <?= $resetLink ?>
            </div>
            
            <div class="warning-box">
                <strong>⚠️ Importante:</strong><br>
                • Este enlace expirará en <strong>1 hora</strong><br>
                • Por seguridad, no compartas este enlace con nadie<br>
                • Si no solicitaste este restablecimiento, ignora este mensaje
            </div>
            
            <p>Si tienes problemas para hacer clic en el botón, copia y pega la URL completa en la barra de direcciones de tu navegador.</p>
            
            <p>Saludos cordiales,<br>
            <strong>Equipo de Soporte - Sistema de Facturación</strong></p>
        </div>
        
        <div class="email-footer">
            <p>© <?= date('Y') ?> Sistema de Facturación. Todos los derechos reservados.</p>
            <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
            <p>Si necesitas ayuda adicional, contacta al administrador del sistema.</p>
        </div>
    </div>
</body>
</html>