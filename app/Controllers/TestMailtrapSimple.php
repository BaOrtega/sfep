<?php namespace App\Controllers;

class TestMailtrapSimple extends BaseController
{
    public function index()
    {
        echo "<h1>🔧 Prueba de Configuración Mailtrap</h1>";
        echo "<p>Verificando conexión con tus credenciales...</p>";
        
        // Mostrar configuración actual
        echo "<h3>Tus credenciales:</h3>";
        echo "<pre>";
        echo "Host: sandbox.smtp.mailtrap.io\n";
        echo "Usuario: 19721b6f27fec8\n";
        echo "Contraseña: e129\n";
        echo "Puerto: 587\n";
        echo "Encriptación: tls\n";
        echo "</pre>";
        
        // Probar envío
        $this->testEnvio();
    }
    
    private function testEnvio()
    {
        echo "<hr><h2>📤 Probando envío de correo...</h2>";
        
        $email = \Config\Services::email();
        
        // Configurar (usando tus datos de mailtrap)
        $email->setTo('test@mailtrap.io'); // No importa, mailtrap captura todo
        $email->setSubject('✅ Prueba de Mailtrap - Sistema de Facturación');
        $email->setMessage($this->getSimpleMessage());
        
        echo "<p>Enviando correo a Mailtrap...</p>";
        
        if ($email->send()) {
            echo '<div style="background: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 4px;">
                    <strong>✅ ¡ÉXITO!</strong> Correo enviado correctamente a Mailtrap.
                  </div>';
            echo "<p><a href='https://mailtrap.io/inboxes' target='_blank' style='color: blue;'>
                    👉 Haz clic aquí para ver tu correo en Mailtrap
                  </a></p>";
        } else {
            echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
                    <strong>❌ ERROR:</strong> No se pudo enviar el correo.
                  </div>';
            
            // Mostrar debug detallado
            echo "<h3>Detalles del error:</h3>";
            echo "<pre style='background: #f8f9fa; padding: 10px; border: 1px solid #ddd;'>";
            echo htmlspecialchars($email->printDebugger());
            echo "</pre>";
            
            // Sugerencias
            echo "<h3>Posibles soluciones:</h3>";
            echo "<ol>
                    <li>Verifica que tu usuario y contraseña sean exactamente: <br>
                        Usuario: <code>19721b6f27fec8</code><br>
                        Contraseña: <code>e129</code>
                    </li>
                    <li>Prueba con puerto 2525 y <code>SMTPCrypto = ''</code> (vacío)</li>
                    <li>Verifica que no haya firewall bloqueando el puerto 587</li>
                    <li>Intenta con el host alternativo: <code>smtp.mailtrap.io</code></li>
                  </ol>";
        }
    }
    
    private function getSimpleMessage()
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px;">
            <div style="background: #007bff; color: white; padding: 20px; text-align: center;">
                <h1>🚀 Configuración Exitosa</h1>
                <p>Sistema de Facturación + Mailtrap</p>
            </div>
            <div style="padding: 20px; background: #f8f9fa;">
                <h2>¡Felicidades!</h2>
                <p>Si estás viendo este correo, significa que tu configuración de Mailtrap está funcionando correctamente.</p>
                
                <div style="background: white; padding: 15px; border: 1px solid #dee2e6; margin: 15px 0;">
                    <strong>📅 Fecha:</strong> ' . date('d/m/Y H:i:s') . '<br>
                    <strong>🆔 ID:</strong> TEST-' . uniqid() . '
                </div>
                
                <p>Ahora puedes:</p>
                <ul>
                    <li>Enviar correos de recuperación de contraseña</li>
                    <li>Probar notificaciones del sistema</li>
                    <li>Ver todos los correos en Mailtrap sin enviarlos realmente</li>
                </ul>
                
                <div style="text-align: center; margin: 20px 0;">
                    <a href="https://mailtrap.io" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                        Ver en Mailtrap
                    </a>
                </div>
            </div>
            <div style="background: #e9ecef; padding: 15px; text-align: center; font-size: 12px; color: #6c757d;">
                <p>Correo de prueba - Sistema de Facturación</p>
            </div>
        </div>';
    }
}