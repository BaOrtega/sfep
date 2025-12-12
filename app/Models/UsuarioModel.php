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
        'reset_token',      // Token para recuperación
        'reset_expira',     // Expiración del token
        'activo'           // Estado del usuario
    ];

    // Reglas de validación
    protected $validationRules = [
        'nombre'   => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'password' => 'permit_empty|min_length[6]', // permit_empty para ediciones
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
     * 
     * @param array $data Datos del usuario
     * @return array Datos con contraseña hasheada (si se proporcionó)
     */
    protected function hashPassword(array $data)
    {
        // Solo hashear si el campo password está presente y no está vacío
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            // Si no se envía contraseña, mantener la actual (eliminar del array)
            unset($data['data']['password']);
        }
        
        return $data;
    }

    /**
     * Buscar usuario por email
     * 
     * @param string $email Email a buscar
     * @return array|null Datos del usuario o null si no existe
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Cambiar contraseña (para recuperación)
     * Este método evita los callbacks para control manual del hash
     * 
     * @param int $id ID del usuario
     * @param string $password Nueva contraseña
     * @return bool True si se actualizó, False si no
     */
    public function changePassword($id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        return $this->update($id, ['password' => $hashedPassword]);
    }

    /**
     * Verificar contraseña
     * 
     * @param string $password Contraseña en texto plano
     * @param string $hashedPassword Contraseña hasheada
     * @return bool True si coinciden, False si no
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    /**
     * Crear token de recuperación de contraseña
     * 
     * @param string $email Email del usuario
     * @return string Token generado
     */
    public function crearTokenReset($email)
    {
        $token = bin2hex(random_bytes(32)); // Token seguro de 64 caracteres
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expira en 1 hora
        
        $this->set([
            'reset_token' => $token,
            'reset_expira' => $expira
        ])->where('email', $email)->update();
        
        return $token;
    }

    /**
     * Validar token de recuperación
     * 
     * @param string $token Token a validar
     * @return array|null Datos del usuario o null si el token es inválido
     */
    public function validarTokenReset($token)
    {
        return $this->where('reset_token', $token)
                    ->where('reset_expira >', date('Y-m-d H:i:s'))
                    ->first();
    }

    /**
     * Limpiar token de recuperación después de usarlo
     * 
     * @param int $id ID del usuario
     * @return bool True si se actualizó, False si no
     */
    public function limpiarTokenReset($id)
    {
        return $this->update($id, [
            'reset_token' => null,
            'reset_expira' => null
        ]);
    }

    /**
     * Obtener todos los usuarios con un rol específico
     * 
     * @param string $role Rol a filtrar
     * @return array Lista de usuarios
     */
    public function getByRole($role)
    {
        return $this->where('rol', $role)->findAll();
    }

    /**
     * Obtener estadísticas de usuarios
     * 
     * @return array Estadísticas
     */
    public function getStats()
    {
        $stats = [
            'total' => $this->countAll(),
            'admins' => $this->where('rol', 'admin')->countAllResults(),
            'vendedores' => $this->where('rol', 'vendedor')->countAllResults(),
            'activos' => $this->where('activo', 1)->countAllResults(),
            'inactivos' => $this->where('activo', 0)->countAllResults()
        ];
        
        return $stats;
    }

    /**
     * Validar si un usuario puede ser eliminado
     * (No permitir eliminar el último administrador)
     * 
     * @param int $id ID del usuario
     * @return bool True si se puede eliminar, False si no
     */
    public function canDelete($id)
    {
        $user = $this->find($id);
        
        if (!$user) {
            return false;
        }
        
        // Si es administrador, verificar que no sea el único
        if ($user['rol'] === 'admin') {
            $adminCount = $this->where('rol', 'admin')->countAllResults();
            return $adminCount > 1;
        }
        
        return true;
    }

    /**
     * Obtener vendedores para dropdown/select
     * 
     * @return array Opciones para dropdown
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
     * Actualizar perfil de usuario (sin cambiar rol)
     * 
     * @param int $id ID del usuario
     * @param array $data Datos a actualizar
     * @return bool True si se actualizó, False si no
     */
    public function updateProfile($id, $data)
    {
        // Asegurarse de no cambiar el rol desde esta función
        unset($data['rol']);
        
        return $this->update($id, $data);
    }

    /**
     * Buscar usuarios con paginación
     * 
     * @param int $perPage Usuarios por página
     * @param string|null $search Término de búsqueda
     * @return array Resultados y paginador
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
     * Activar/desactivar usuario
     * 
     * @param int $id ID del usuario
     * @param int $activo Estado (1 = activo, 0 = inactivo)
     * @return bool True si se actualizó, False si no
     */
    public function setActivo($id, $activo = 1)
    {
        return $this->update($id, ['activo' => $activo]);
    }

    /**
     * Obtener usuarios activos
     * 
     * @return array Usuarios activos
     */
    public function getActivos()
    {
        return $this->where('activo', 1)->findAll();
    }
}