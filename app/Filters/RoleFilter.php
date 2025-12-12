<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * Se ejecuta ANTES de que el controlador sea llamado
     * Verifica que el usuario tenga los roles necesarios
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Primero, verificar que el usuario esté autenticado
        if (!session()->get('isLoggedIn')) {
            session()->set('redirect_url', current_url());
            return redirect()->to(url_to('login'))
                ->with('error', 'Debes iniciar sesión para acceder a esa página.');
        }

        // Si no se especifican roles, permitir acceso a todos los usuarios autenticados
        if (empty($arguments)) {
            return;
        }

        // Obtener el rol del usuario actual
        $userRole = session()->get('rol');
        
        // Si el usuario no tiene rol definido, asignar 'vendedor' por defecto
        if (!$userRole) {
            $userRole = 'vendedor';
            session()->set('rol', $userRole);
        }

        // Verificar si el rol del usuario está en los roles permitidos
        if (!in_array($userRole, $arguments)) {
            // Log del intento de acceso no autorizado
            log_message('warning', 'Acceso denegado: Usuario ' . session()->get('user_id') . 
                ' con rol ' . $userRole . ' intentó acceder a ' . current_url());
            
            // Redirigir con mensaje de error
            return redirect()->to(url_to('dashboard'))
                ->with('error', 'No tienes permisos suficientes para acceder a esta sección.');
        }
    }

    /**
     * Se ejecuta DESPUÉS de que el controlador ha terminado
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Puedes agregar lógica post-controlador si es necesario
    }

    /**
     * Helper para verificar permisos en controladores
     */
    public static function checkPermission($requiredRoles)
    {
        if (!is_array($requiredRoles)) {
            $requiredRoles = [$requiredRoles];
        }

        $userRole = session()->get('rol');
        
        if (!in_array($userRole, $requiredRoles)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Acceso denegado');
        }
        
        return true;
    }

    /**
     * Helper para verificar permisos en vistas
     */
    public static function canAccess($requiredRoles)
    {
        if (!is_array($requiredRoles)) {
            $requiredRoles = [$requiredRoles];
        }

        $userRole = session()->get('rol');
        return in_array($userRole, $requiredRoles);
    }
}