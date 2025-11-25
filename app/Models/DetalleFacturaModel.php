<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table      = 'detalle_factura';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    // Campos permitidos, reflejando la estructura de tu CREATE TABLE
    protected $allowedFields = [
        'factura_id', 
        'producto_id', 
        'descripcion_adicional', 
        'cantidad', 
        'precio_unitario',          // Nombre CORREGIDO
        'tasa_impuesto',            // Nombre CORREGIDO
        'total_linea', 
    ];
}