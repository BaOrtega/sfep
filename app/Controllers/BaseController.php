<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController proporciona un lugar conveniente para cargar componentes
 * y realizar funciones que son necesarias para todos tus controladores.
 * Extiende esta clase en cualquier controlador nuevo:
 *     class Home extends BaseController
 *
 * Por seguridad, declara cualquier método nuevo como protected o private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instancia del objeto Request principal.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Instancia del servicio de sesión
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Un array de helpers para cargar automáticamente al
     * instanciar la clase. Estos helpers estarán disponibles
     * para todos los controladores que extiendan BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'permission'];

    /**
     * Constructor.
     * Inicializa servicios comunes.
     */
    public function __construct()
    {
        // Inicializar servicios
        $this->session = \Config\Services::session();
    }

    /**
     * Método de inicialización del controlador.
     * Se ejecuta automáticamente por el framework.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // ¡NO EDITES ESTA LÍNEA!
        parent::initController($request, $response, $logger);

        // Pre-carga de modelos, librerías, etc.
        
        // Cargar sesión si no se ha cargado en el constructor
        if (!$this->session) {
            $this->session = \Config\Services::session();
        }

        // NOTA IMPORTANTE: La autenticación se maneja mediante FILTROS,
        // no aquí en el BaseController. Esto evita bucles infinitos.
        // Los filtros (AuthFilter, RoleFilter, AdminFilter) se encargan
        // de verificar la autenticación y permisos antes de llegar aquí.
    }

    /**
     * Verificar permisos de rol (método auxiliar para controladores)
     *
     * @param string|array $requiredRole Rol o array de roles permitidos
     * @return bool
     * @throws \CodeIgniter\Exceptions\PageNotFoundException
     */
    protected function checkPermission($requiredRole)
    {
        // Obtener rol del usuario desde sesión
        $userRole = $this->session->get('rol');
        
        // Si no hay rol pero el usuario está autenticado, asignar 'vendedor' por defecto
        if (!$userRole && $this->session->get('isLoggedIn')) {
            $userRole = 'vendedor';
            $this->session->set('rol', $userRole);
        }
        
        // Convertir a array si es string
        $allowedRoles = is_array($requiredRole) ? $requiredRole : [$requiredRole];
        
        // Verificar si el rol del usuario está en los permitidos
        if (!in_array($userRole, $allowedRoles)) {
            // Lanzar excepción 404 (no encontrado) por seguridad
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'No tienes permiso para acceder a esta sección.'
            );
        }
        
        return true; // Acceso permitido
    }

    /**
     * Verificar si el usuario actual es administrador
     *
     * @return bool
     */
    protected function isAdmin()
    {
        return $this->session->get('rol') === 'admin';
    }

    /**
     * Verificar si el usuario actual es vendedor
     *
     * @return bool
     */
    protected function isVendedor()
    {
        return $this->session->get('rol') === 'vendedor';
    }

    /**
     * Obtener el ID del usuario actual
     *
     * @return int|null
     */
    protected function getUserId()
    {
        return $this->session->get('user_id');
    }

    /**
     * Obtener el nombre del usuario actual
     *
     * @return string|null
     */
    protected function getUserName()
    {
        return $this->session->get('user_name');
    }

    /**
     * Renderizar vista con datos comunes (método helper)
     *
     * @param string $view Nombre de la vista (sin extensión)
     * @param array $data Datos para pasar a la vista
     * @return string HTML renderizado
     */
    protected function renderView($view, $data = [])
    {
        // Datos que estarán disponibles en TODAS las vistas
        $defaultData = [
            'session' => $this->session, // Objeto de sesión completo
            'isAdmin' => $this->isAdmin(), // Boolean: ¿es admin?
            'isVendedor' => $this->isVendedor(), // Boolean: ¿es vendedor?
            'current_url' => current_url(), // URL actual
            'user_id' => $this->getUserId(), // ID del usuario
            'user_name' => $this->getUserName(), // Nombre del usuario
            'user_role' => $this->session->get('rol'), // Rol del usuario
            'title' => isset($data['title']) ? $data['title'] : 'Sistema de Facturación', // Título de página
        ];
        
        // Combinar datos por defecto con los específicos de la vista
        $viewData = array_merge($defaultData, $data);
        
        // Renderizar y devolver la vista
        return view($view, $viewData);
    }

    /**
     * Redireccionar con mensaje de éxito (helper)
     *
     * @param string $url URL a redirigir
     * @param string $message Mensaje de éxito
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    protected function redirectWithSuccess($url, $message)
    {
        return redirect()->to($url)->with('success', $message);
    }

    /**
     * Redireccionar con mensaje de error (helper)
     *
     * @param string $url URL a redirigir
     * @param string $message Mensaje de error
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    protected function redirectWithError($url, $message)
    {
        return redirect()->to($url)->with('error', $message);
    }

    /**
     * Redireccionar con mensaje de información (helper)
     *
     * @param string $url URL a redirigir
     * @param string $message Mensaje de información
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    protected function redirectWithInfo($url, $message)
    {
        return redirect()->to($url)->with('info', $message);
    }

    /**
     * Validar si se puede eliminar un usuario
     * (Útil para evitar eliminar el último administrador)
     *
     * @param int $userId ID del usuario a eliminar
     * @param \App\Models\UsuarioModel $usuarioModel
     * @return array ['success' => bool, 'message' => string]
     */
    protected function canDeleteUser($userId, $usuarioModel)
    {
        $currentUserId = $this->getUserId();
        
        // No permitir eliminar al propio usuario
        if ($userId == $currentUserId) {
            return [
                'success' => false,
                'message' => 'No puedes eliminarte a ti mismo.'
            ];
        }
        
        $user = $usuarioModel->find($userId);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuario no encontrado.'
            ];
        }
        
        // Si es administrador, verificar que no sea el único
        if ($user['rol'] === 'admin') {
            $totalAdmins = $usuarioModel->where('rol', 'admin')->countAllResults();
            
            if ($totalAdmins <= 1) {
                return [
                    'success' => false,
                    'message' => 'No se puede eliminar el único administrador del sistema.'
                ];
            }
        }
        
        return ['success' => true, 'message' => ''];
    }

    /**
     * Registrar actividad del usuario (para futuros logs)
     *
     * @param string $action Acción realizada (ej: "login", "create", "delete")
     * @param string $module Módulo donde se realizó la acción (ej: "auth", "clientes")
     * @param mixed $data Datos adicionales (se serializarán a JSON)
     * @return void
     */
    protected function logActivity($action, $module = 'system', $data = null)
    {
        // Placeholder para implementación futura de logs de actividad
        // Ejemplo de implementación:
        /*
        $logModel = new \App\Models\LogModel();
        $logModel->insert([
            'user_id' => $this->getUserId(),
            'action' => $action,
            'module' => $module,
            'data' => json_encode($data),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        */
    }

    /**
     * Validar CSRF token para formularios AJAX
     *
     * @return bool True si el token es válido, False si no
     */
    protected function validateCSRFAjax()
    {
        // Buscar token en headers o en POST
        $token = $this->request->getHeaderLine('X-CSRF-TOKEN');
        
        if (!$token) {
            $token = $this->request->getPost('csrf_token');
        }
        
        // Comparar con el hash CSRF actual
        return $token === csrf_hash();
    }

    /**
     * Responder con JSON estándar (helper para API)
     *
     * @param array $data Datos a responder
     * @param int $statusCode Código de estado HTTP (200 = OK, 400 = Bad Request, etc.)
     * @return \CodeIgniter\HTTP\Response
     */
    protected function jsonResponse($data = [], $statusCode = 200)
    {
        $response = service('response');
        
        return $response
            ->setStatusCode($statusCode)
            ->setJSON($data);
    }

    /**
     * Obtener parámetros de paginación desde la solicitud GET
     *
     * @return array ['page' => int, 'per_page' => int, 'offset' => int]
     */
    protected function getPaginationParams()
    {
        $page = $this->request->getGet('page') ? (int) $this->request->getGet('page') : 1;
        $perPage = $this->request->getGet('per_page') ? (int) $this->request->getGet('per_page') : 10;
        
        return [
            'page' => $page,
            'per_page' => $perPage,
            'offset' => ($page - 1) * $perPage
        ];
    }

    /**
     * Manejar excepciones de manera consistente
     *
     * @param \Exception $e Excepción capturada
     * @param string $redirectUrl URL para redireccionar en caso de error
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    protected function handleException(\Exception $e, $redirectUrl = null)
    {
        // Log del error
        log_message('error', 'Excepción: ' . $e->getMessage() . ' en ' . $e->getFile() . ':' . $e->getLine());
        
        // Redireccionar con mensaje de error
        $redirectUrl = $redirectUrl ?: previous_url() ?: base_url();
        return $this->redirectWithError($redirectUrl, 'Ocurrió un error: ' . $e->getMessage());
    }
}