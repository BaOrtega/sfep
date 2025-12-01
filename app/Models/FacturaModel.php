<?php namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table      = 'facturas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $allowedFields = [
        'cliente_id', 
        'usuario_id',
        'fecha_emision', 
        'fecha_vencimiento', 
        'subtotal', 
        'total_impuestos', 
        'total_factura', 
        'moneda', 
        'estado'
        // NO incluir 'created_at' - la tabla no lo tiene
    ];
    
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'cliente_id'        => 'required|is_not_unique[clientes.id]',
        'usuario_id'        => 'required|is_not_unique[usuarios.id]',
        'fecha_emision'     => 'required|valid_date',
        'fecha_vencimiento' => 'required|valid_date',
        'subtotal'          => 'required|decimal',
        'total_impuestos'   => 'required|decimal',
        'total_factura'     => 'required|decimal|greater_than[0]',
        'estado'            => 'required|in_list[EMITIDA,PAGADA,ANULADA]',
        'moneda'            => 'required|max_length[3]'
    ];
    
    protected $validationMessages = [
        'cliente_id' => [
            'required' => 'El cliente es requerido',
            'is_not_unique' => 'El cliente seleccionado no existe'
        ],
        'total_factura' => [
            'greater_than' => 'El total debe ser mayor a 0'
        ]
    ];
    
    protected $skipValidation = false;
}