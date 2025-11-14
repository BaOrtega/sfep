<?php

namespace App\Controllers;

class Demo extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'PFEP - Demo',
            'page_title' => 'Sistema de Facturación Electrónica',
            'features' => [
                'Creación y gestión de facturas',
                'Cálculo automático de impuestos',
                'Integración con entidades fiscales',
                'Reportes y análisis',
                'Soporte multimoneda y multilenguaje'
            ]
        ];
        
        return view('demo_view', $data);
    }
}