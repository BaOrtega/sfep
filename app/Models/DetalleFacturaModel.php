<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table      = 'detalle_factura';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $allowedFields = [
        'factura_id',
        'producto_id',
        'descripcion_adicional',
        'cantidad',
        'precio_unitario',
        'tasa_impuesto',
        'total_linea'
    ];
    
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'factura_id'    => 'required|is_not_unique[facturas.id]',
        'producto_id'   => 'required|is_not_unique[productos.id]',
        'cantidad'      => 'required|greater_than[0]',
        'precio_unitario' => 'required|greater_than[0]',
        'tasa_impuesto' => 'required',
        'total_linea'   => 'required|greater_than[0]'
    ];
}