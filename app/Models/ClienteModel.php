<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false; 

    // Campos permitidos para ser insertados o actualizados
    protected $allowedFields = ['id', 'nombre', 'nit', 'direccion', 'email', 'telefono'];

    // Reglas de validación
    protected $validationRules = [
        'nombre'  => 'required|min_length[3]',
        'nit'     => 'required|min_length[5]',
        'email'   => 'permit_empty|valid_email',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del cliente es obligatorio.',
        ],
        'nit' => [
            'required'  => 'El NIT/Cédula es obligatorio.',
            'is_unique' => 'Ya existe un cliente con este NIT/Cédula.',
        ],
    ];
}