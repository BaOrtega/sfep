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

    /**
     * Obtener facturas por usuario (para vendedor)
     */
    public function getByUsuario($usuario_id)
    {
        return $this->where('usuario_id', $usuario_id)
                    ->orderBy('fecha_emision', 'DESC')
                    ->findAll();
    }
    
    /**
     * Obtener estadísticas por usuario
     */
    public function getStatsByUsuario($usuario_id)
    {
        $stats = [
            'total' => $this->where('usuario_id', $usuario_id)->countAllResults(),
            'emitidas' => $this->where('usuario_id', $usuario_id)
                              ->where('estado', 'EMITIDA')
                              ->countAllResults(),
            'pagadas' => $this->where('usuario_id', $usuario_id)
                             ->where('estado', 'PAGADA')
                             ->countAllResults(),
            'anuladas' => $this->where('usuario_id', $usuario_id)
                              ->where('estado', 'ANULADA')
                              ->countAllResults(),
        ];
        
        $totalVentas = $this->selectSum('total_factura')
                           ->where('usuario_id', $usuario_id)
                           ->where('estado', 'PAGADA')
                           ->first();
        
        $stats['total_ventas'] = $totalVentas['total_factura'] ?? 0;
        
        return $stats;
    }
    
    /**
     * Verificar si una factura pertenece a un usuario
     */
    public function belongsToUsuario($factura_id, $usuario_id)
    {
        $factura = $this->where('id', $factura_id)
                       ->where('usuario_id', $usuario_id)
                       ->first();
        
        return $factura !== null;
    }

}