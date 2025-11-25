<?php namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table      = 'facturas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    // Campos permitidos, reflejando la estructura de tu CREATE TABLE
    protected $allowedFields = [
        'cliente_id', 
        'usuario_id',
        'fecha_emision', 
        'fecha_vencimiento', 
        'subtotal', 
        'total_impuestos', 
        'total_factura', 
        'moneda', 
        'estado',
    ];
}