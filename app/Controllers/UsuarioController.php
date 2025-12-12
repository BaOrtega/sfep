<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $session;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
        
        // Verificar que el usuario esté autenticado y sea administrador
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to(url_to('login'));
        }
        
        if ($this->session->get('rol') !== 'admin') {
            $this->session->setFlashdata('error', 'Acceso denegado. Solo los administradores pueden gestionar usuarios.');
            return redirect()->to(url_to('dashboard'));
        }
    }

    /**
     * Listar todos los usuarios
     */
    public function index()
    {
        $data = [
            'title' => 'Gestión de Usuarios',
            'usuarios' => $this->usuarioModel->findAll(),
            'session' => $this->session
        ];
        
        return view('usuarios/index', $data);
    }

    /**
     * Mostrar formulario para crear nuevo usuario
     */
    public function new()
    {
        $data = [
            'title' => 'Nuevo Usuario',
            'roles' => ['admin' => 'Administrador', 'vendedor' => 'Vendedor'],
            'session' => $this->session
        ];
        
        return view('usuarios/form', $data);
    }

    /**
     * Guardar usuario (crear o actualizar)
     */
    public function save()
    {
        // Obtener datos del formulario
        $postData = $this->request->getPost();
        
        // Validar que los datos requeridos estén presentes
        if (empty($postData['nombre']) || empty($postData['email'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El nombre y el email son requeridos.');
        }
        
        // Si es creación, validar contraseña
        if (empty($postData['id']) && empty($postData['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La contraseña es requerida para nuevos usuarios.');
        }
        
        // Si es edición y se proporciona contraseña, validar que coincidan
        if (!empty($postData['id']) && !empty($postData['password'])) {
            if ($postData['password'] !== $postData['confirm_password']) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Las contraseñas no coinciden.');
            }
        }
        
        // Si no se proporciona rol, asignar 'vendedor' por defecto
        if (!isset($postData['rol']) || empty($postData['rol'])) {
            $postData['rol'] = 'vendedor';
        }
        
        // Preparar datos para guardar
        $dataToSave = [
            'nombre' => $postData['nombre'],
            'email' => $postData['email'],
            'rol' => $postData['rol']
        ];
        
        // Solo agregar contraseña si se proporciona
        if (!empty($postData['password'])) {
            $dataToSave['password'] = $postData['password'];
        }
        
        // Si hay ID, es una edición
        if (!empty($postData['id'])) {
            $dataToSave['id'] = $postData['id'];
        }
        
        // Guardar usando el modelo
        if ($this->usuarioModel->save($dataToSave)) {
            $message = empty($postData['id']) ? 'Usuario creado exitosamente.' : 'Usuario actualizado exitosamente.';
            $this->session->setFlashdata('success', $message);
            
            return redirect()->to(url_to('usuarios_index'));
        } else {
            // Si hay errores de validación del modelo
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->usuarioModel->errors());
        }
    }

    /**
     * Mostrar formulario para editar usuario
     */
    public function edit($id)
    {
        // Verificar que no sea el propio usuario (para evitar autoeliminación/modificación peligrosa)
        if ($id == $this->session->get('user_id')) {
            return redirect()->to(url_to('profile'))->with('info', 'Para editar tu propio perfil, usa la sección "Mi Perfil".');
        }
        
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            $this->session->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // No mostrar la contraseña
        unset($usuario['password']);
        
        $data = [
            'title' => 'Editar Usuario',
            'usuario' => $usuario,
            'roles' => ['admin' => 'Administrador', 'vendedor' => 'Vendedor'],
            'session' => $this->session
        ];
        
        return view('usuarios/form', $data);
    }

    /**
     * Eliminar usuario
     */
    public function delete($id)
    {
        // Validaciones de seguridad
        if ($id == $this->session->get('user_id')) {
            $this->session->setFlashdata('error', 'No puedes eliminarte a ti mismo.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // Verificar que no sea el único administrador
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            $this->session->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // Si es administrador, verificar que no sea el único
        if ($usuario['rol'] === 'admin') {
            $totalAdmins = $this->usuarioModel->where('rol', 'admin')->countAllResults();
            
            if ($totalAdmins <= 1) {
                $this->session->setFlashdata('error', 'No se puede eliminar el único administrador del sistema.');
                return redirect()->to(url_to('usuarios_index'));
            }
        }
        
        // Eliminar usuario
        if ($this->usuarioModel->delete($id)) {
            $this->session->setFlashdata('success', 'Usuario eliminado exitosamente.');
        } else {
            $this->session->setFlashdata('error', 'Error al eliminar el usuario.');
        }
        
        return redirect()->to(url_to('usuarios_index'));
    }

    /**
     * Activar/desactivar usuario
     * (Si agregas campo "activo" en el futuro)
     */
    public function toggleStatus($id)
    {
        // Este método es opcional, para cuando agregues campo "activo" a usuarios
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            $this->session->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // Verificar que no sea el propio usuario
        if ($id == $this->session->get('user_id')) {
            $this->session->setFlashdata('error', 'No puedes desactivar tu propia cuenta.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // Cambiar estado (ejemplo si tienes campo "activo")
        $nuevoEstado = $usuario['activo'] ? 0 : 1;
        
        if ($this->usuarioModel->update($id, ['activo' => $nuevoEstado])) {
            $estadoTexto = $nuevoEstado ? 'activado' : 'desactivado';
            $this->session->setFlashdata('success', "Usuario {$estadoTexto} exitosamente.");
        } else {
            $this->session->setFlashdata('error', 'Error al cambiar el estado del usuario.');
        }
        
        return redirect()->to(url_to('usuarios_index'));
    }

    /**
     * Buscar usuarios (para futuras implementaciones)
     */
    public function search()
    {
        $searchTerm = $this->request->getGet('q');
        
        $usuarios = $this->usuarioModel
            ->groupStart()
                ->like('nombre', $searchTerm)
                ->orLike('email', $searchTerm)
            ->groupEnd()
            ->findAll();
        
        return $this->response->setJSON($usuarios);
    }

    /**
     * Ver estadísticas de usuarios
     */
    public function stats()
    {
        $stats = $this->usuarioModel->getStats();
        
        $data = [
            'title' => 'Estadísticas de Usuarios',
            'stats' => $stats,
            'session' => $this->session
        ];
        
        return view('usuarios/stats', $data);
    }

    /**
     * Exportar lista de usuarios a CSV
     */
    public function exportCSV()
    {
        $usuarios = $this->usuarioModel->findAll();
        
        // Crear contenido CSV
        $csvContent = "ID,Nombre,Email,Rol,Fecha Creación\n";
        
        foreach ($usuarios as $usuario) {
            $csvContent .= "{$usuario['id']},{$usuario['nombre']},{$usuario['email']},{$usuario['rol']},{$usuario['creado_en']}\n";
        }
        
        // Configurar headers para descarga
        $filename = 'usuarios_' . date('Y-m-d') . '.csv';
        
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', "attachment; filename=\"{$filename}\"")
            ->setBody($csvContent);
    }

    /**
     * Ver actividades recientes del usuario (si implementas logs)
     */
    public function activities($id)
    {
        $usuario = $this->usuarioModel->find($id);
        
        if (!$usuario) {
            $this->session->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to(url_to('usuarios_index'));
        }
        
        // Aquí puedes cargar actividades del usuario si tienes una tabla de logs
        // $actividades = $this->logModel->where('usuario_id', $id)->orderBy('fecha', 'DESC')->findAll();
        
        $data = [
            'title' => 'Actividades del Usuario',
            'usuario' => $usuario,
            // 'actividades' => $actividades,
            'session' => $this->session
        ];
        
        return view('usuarios/activities', $data);
    }
}