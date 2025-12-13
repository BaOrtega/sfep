<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Campos permitidos - NO incluir 'id' aquí
    protected $allowedFields = ['nombre', 'nit', 'direccion', 'email', 'telefono'];

    // Reglas de validación simplificadas
    protected $validationRules = [
        'nombre'  => 'required|min_length[3]|max_length[100]',
        'nit'     => 'required|min_length[3]|max_length[20]',
        'email'   => 'permit_empty|valid_email|max_length[100]',
        'telefono' => 'permit_empty|min_length[7]|max_length[20]',
        'direccion' => 'permit_empty|max_length[200]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del cliente es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.'
        ],
        'nit' => [
            'required'  => 'El NIT/Cédula es obligatorio.',
            'min_length' => 'El NIT/Cédula debe tener al menos 3 caracteres.',
        ],
        'email' => [
            'valid_email' => 'Debe ingresar un correo electrónico válido.'
        ]
    ];

    /**
     * Verifica si un NIT ya existe en la base de datos
     * @param string $nit El NIT a verificar
     * @param int|null $idExcluir ID a excluir (para edición)
     * @return bool True si el NIT no existe, False si ya existe
     */
    public function nitExiste(string $nit, ?int $idExcluir = null): bool
    {
        if (empty($nit)) {
            return false;
        }

        $builder = $this->db->table($this->table);
        $builder->where('nit', $nit);
        
        if ($idExcluir !== null && $idExcluir > 0) {
            $builder->where('id !=', $idExcluir);
        }
        
        return $builder->countAllResults() > 0;
    }

    /**
     * Obtiene cliente por NIT
     * @param string $nit NIT a buscar
     * @return array|null Cliente encontrado o null
     */
    public function obtenerPorNit(string $nit): ?array
    {
        return $this->where('nit', $nit)->first();
    }
}