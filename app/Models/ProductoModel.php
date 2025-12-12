<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    // Campos permitidos
    protected $allowedFields = [
        'nombre', 
        'descripcion', 
        'precio_unitario',
        'costo',
        'inventario',
        'tasa_impuesto',
        'activo',
    ];

    // Reglas de validación
    protected $validationRules = [
        'nombre'         => 'required|min_length[3]',
        'precio_unitario'=> 'required|decimal|greater_than_equal_to[0]',
        'costo'          => 'required|decimal|greater_than_equal_to[0]',
        'inventario'     => 'required|integer|greater_than_equal_to[0]',
        'tasa_impuesto'  => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'    => 'El nombre del producto/servicio es obligatorio.',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres.',
        ],
        'precio_unitario' => [
            'required'    => 'El precio de venta es obligatorio.',
            'decimal'     => 'El precio debe ser un número decimal.',
            'greater_than_equal_to' => 'El precio no puede ser negativo.'
        ],
        'costo' => [
            'required'    => 'El costo es obligatorio.',
            'decimal'     => 'El costo debe ser un número decimal.',
            'greater_than_equal_to' => 'El costo no puede ser negativo.'
        ],
        'inventario' => [
            'required'    => 'El inventario inicial es obligatorio.',
            'integer'     => 'El inventario debe ser un número entero.',
            'greater_than_equal_to' => 'El inventario no puede ser negativo.'
        ],
        'tasa_impuesto' => [
            'required'    => 'La tasa de impuesto es obligatoria.',
            'decimal'     => 'La tasa de impuesto debe ser un número.',
            'greater_than_equal_to' => 'La tasa de impuesto no puede ser negativa.',
            'less_than_equal_to' => 'La tasa de impuesto no puede ser mayor a 100%.'
        ],
    ];
}