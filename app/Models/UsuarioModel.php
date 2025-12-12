<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table      = 'usuarios';
    
    // Clave primaria
    protected $primaryKey = 'id';

    // Auto-incremento
    protected $useAutoIncrement = true;

    // Tipo de retorno
    protected $returnType     = 'array';
    
    // Soft deletes (eliminación suave)
    protected $useSoftDeletes = false;

    // Campos permitidos para insertar/actualizar
    protected $allowedFields = [
        'nombre', 
        'email', 
        'password', 
        'rol',
        'reset_token',
        'reset_expira',
        'activo'
    ];

    // Reglas de validación - SIMPLIFICADAS (sin placeholder {id})
    protected $validationRules = [
        'nombre'   => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email',
        'password' => 'permit_empty|min_length[6]',
        'rol'      => 'required|in_list[admin,vendedor]'
    ];

    // Mensajes de error personalizados
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Este correo electrónico ya está registrado.'
        ],
        'rol' => [
            'in_list' => 'El rol debe ser "admin" o "vendedor".'
        ]
    ];

    // Callbacks para hashear la contraseña automáticamente
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash de contraseña antes de insertar o actualizar
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']);
        }
        
        return $data;
    }

    /**
     * Validar email único (excepto para el ID actual)
     */
    public function isUniqueEmail($email, $id = null)
    {
        $builder = $this->builder();
        $builder->where('email', $email);
        
        if ($id) {
            $builder->where('id !=', $id);
        }
        
        return $builder->countAllResults() === 0;
    }

    /**
     * Buscar usuario por email
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Cambiar contraseña
     */
    public function changePassword($id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->update($id, ['password' => $hashedPassword]);
    }

    /**
     * Verificar contraseña
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    /**
     * Crear token de recuperación
     */
    public function crearTokenReset($email)
    {
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $this->set([
            'reset_token' => $token,
            'reset_expira' => $expira
        ])->where('email', $email)->update();
        
        return $token;
    }

    /**
     * Validar token de recuperación
     */
    public function validarTokenReset($token)
    {
        return $this->where('reset_token', $token)
                    ->where('reset_expira >', date('Y-m-d H:i:s'))
                    ->first();
    }

    /**
     * Limpiar token
     */
    public function limpiarTokenReset($id)
    {
        return $this->update($id, [
            'reset_token' => null,
            'reset_expira' => null
        ]);
    }

    /**
     * Obtener por rol
     */
    public function getByRole($role)
    {
        return $this->where('rol', $role)->findAll();
    }

    /**
     * Obtener estadísticas
     */
    public function getStats()
    {
        return [
            'total' => $this->countAll(),
            'admins' => $this->where('rol', 'admin')->countAllResults(),
            'vendedores' => $this->where('rol', 'vendedor')->countAllResults(),
            'activos' => $this->where('activo', 1)->countAllResults(),
            'inactivos' => $this->where('activo', 0)->countAllResults()
        ];
    }

    /**
     * Validar si se puede eliminar
     */
    public function canDelete($id)
    {
        $user = $this->find($id);
        
        if (!$user) return false;
        
        if ($user['rol'] === 'admin') {
            $adminCount = $this->where('rol', 'admin')->countAllResults();
            return $adminCount > 1;
        }
        
        return true;
    }

    /**
     * Obtener vendedores para dropdown
     */
    public function getVendedoresForDropdown()
    {
        $vendedores = $this->select('id, nombre, email')
                          ->where('rol', 'vendedor')
                          ->where('activo', 1)
                          ->orderBy('nombre', 'ASC')
                          ->findAll();
        
        $options = [];
        foreach ($vendedores as $vendedor) {
            $options[$vendedor['id']] = $vendedor['nombre'] . ' (' . $vendedor['email'] . ')';
        }
        
        return $options;
    }

    /**
     * Actualizar perfil
     */
    public function updateProfile($id, $data)
    {
        unset($data['rol']);
        return $this->update($id, $data);
    }

    /**
     * Buscar con paginación
     */
    public function getPaginated($perPage = 10, $search = null)
    {
        $builder = $this;
        
        if ($search) {
            $builder->groupStart()
                   ->like('nombre', $search)
                   ->orLike('email', $search)
                   ->groupEnd();
        }
        
        return [
            'usuarios' => $builder->orderBy('creado_en', 'DESC')->paginate($perPage),
            'pager' => $builder->pager
        ];
    }

    /**
     * Activar/desactivar
     */
    public function setActivo($id, $activo = 1)
    {
        return $this->update($id, ['activo' => $activo]);
    }

    /**
     * Obtener activos
     */
    public function getActivos()
    {
        return $this->where('activo', 1)->findAll();
    }
}