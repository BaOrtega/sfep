<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        echo "<h1>🧪 TEST - SISTEMA DE FACTURACIÓN ELECTRÓNICA</h1>";
        echo "<h2>PFEP - Plataforma de Facturación Electrónica para PYMEs</h2>";
        
        // Probar conexión a base de datos
        try {
            $db = \Config\Database::connect();
            echo "<p style='color: green; font-weight: bold;'>✅ CONEXIÓN A BASE DE DATOS EXITOSA</p>";
            
            // Mostrar información de la BD
            echo "<h3>📊 Información de la Base de Datos:</h3>";
            echo "<ul>";
            echo "<li><strong>Base de datos:</strong> pfe_db</li>";
            echo "<li><strong>Host:</strong> localhost:8889</li>";
            echo "<li><strong>Usuario:</strong> root</li>";
            echo "<li><strong>Estado:</strong> Conectado</li>";
            echo "</ul>";
            
            // Probar consulta SQL
            $result = $db->query('SELECT VERSION() as version')->getRow();
            echo "<p><strong>Versión MySQL:</strong> " . $result->version . "</p>";
            
        } catch (\Exception $e) {
            echo "<p style='color: red; font-weight: bold;'>❌ ERROR DE CONEXIÓN: " . $e->getMessage() . "</p>";
        }
        
        echo "<hr>";
        echo "<h3>🚀 Próximos Pasos:</h3>";
        echo "<ol>";
        echo "<li>Crear migraciones para las tablas</li>";
        echo "<li>Crear modelos</li>";
        echo "<li>Crear controladores para facturas</li>";
        echo "<li>Desarrollar interfaces de usuario</li>";
        echo "</ol>";
        
        echo "<p><a href='/'>🏠 Volver al Inicio</a> | <a href='/demo'>Ver Demo</a></p>";
    }
}