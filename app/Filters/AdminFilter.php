<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Verifica que el usuario sea administrador
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar autenticación
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(url_to('login'))
                ->with('error', 'Debes iniciar sesión para acceder a esa página.');
        }

        // Verificar que sea administrador
        $userRole = session()->get('rol');
        
        if ($userRole !== 'admin') {
            log_message('warning', 'Intento de acceso de administrador fallido: Usuario ' . 
                session()->get('user_id') . ' con rol ' . $userRole);
            
            return redirect()->to(url_to('dashboard'))
                ->with('error', 'Acceso restringido a administradores.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se requiere lógica post-controlador
    }
}