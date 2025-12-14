<?php namespace App\Controllers;

class TestMailtrapSimple extends BaseController
{
    public function index()
    {
        echo "<h1>🔧 Prueba de Configuración Mailtrap</h1>";
        echo "<p>Verificando conexión con tus NUEVAS credenciales...</p>";
        
        // Mostrar configuración actual
        echo "<h3>Tus NUEVAS credenciales:</h3>";
        echo "<pre>";
        echo "Host: sandbox.smtp.mailtrap.io\n";
        echo "Usuario: 4af29935e8273f\n";
        echo "Contraseña: AEB7\n";
        echo "Puerto: 2525\n";
        echo "Encriptación: tls\n";
        echo "</pre>";
        
        // Probar envío
        $this->testEnvio();
    }
    
    private function testEnvio()
    {
        echo "<hr><h2>📤 Probando envío de correo...</h2>";
        
        $email = \Config\Services::email();
        
        // Configurar (usando tus NUEVOS datos de mailtrap)
        $email->setTo('test@mailtrap.io'); // No importa, mailtrap captura todo
        $email->setSubject('✅ Prueba de Mailtrap - NUEVAS Credenciales');
        $email->setMessage($this->getSimpleMessage());
        
        echo "<p>Enviando correo a Mailtrap con NUEVAS credenciales...</p>";
        
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
                        Usuario: <code>4af29935e8273f</code><br>
                        Contraseña: <code>AEB7</code>
                    </li>
                    <li>Revisa que no haya espacios antes o después de las credenciales</li>
                    <li>Verifica en Mailtrap que tu inbox esté activo</li>
                  </ol>";
        }
    }
    
    private function getSimpleMessage()
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px;">
            <div style="background: #007bff; color: white; padding: 20px; text-align: center;">
                <h1>🚀 NUEVAS Credenciales</h1>
                <p>Sistema de Facturación + Mailtrap</p>
            </div>
            <div style="padding: 20px; background: #f8f9fa;">
                <h2>¡Credenciales Actualizadas!</h2>
                <p>Esta es una prueba con tus NUEVAS credenciales de Mailtrap.</p>
                
                <div style="background: white; padding: 15px; border: 1px solid #dee2e6; margin: 15px 0;">
                    <strong>📅 Fecha:</strong> ' . date('d/m/Y H:i:s') . '<br>
                    <strong>🆔 ID:</strong> NEW-' . uniqid() . '<br>
                    <strong>🔑 Usuario:</strong> 4af29935e8273f
                </div>
                
                <p>Si este correo llega, significa que:</p>
                <ul>
                    <li>Tus NUEVAS credenciales son correctas</li>
                    <li>La configuración SMTP está funcionando</li>
                    <li>Tu sistema de recuperación de contraseña funcionará</li>
                </ul>
                
                <div style="text-align: center; margin: 20px 0;">
                    <a href="https://mailtrap.io" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
                        Ver en Mailtrap
                    </a>
                </div>
            </div>
            <div style="background: #e9ecef; padding: 15px; text-align: center; font-size: 12px; color: #6c757d;">
                <p>Correo de prueba - Sistema de Facturación - Credenciales actualizadas</p>
            </div>
        </div>';
    }
}