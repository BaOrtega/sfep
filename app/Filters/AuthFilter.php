<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Se ejecuta ANTES de que el controlador sea llamado
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario está logueado
        if (!session()->get('isLoggedIn')) {
            // Guardar la URL actual para redirigir después del login
            session()->set('redirect_url', current_url());
            
            // Redirigir a la página de login
            return redirect()->to(url_to('login'))
                ->with('error', 'Debes iniciar sesión para acceder a esa página.');
        }

        // Verificar si la sesión sigue siendo válida (tiempo de expiración)
        $lastActivity = session()->get('last_activity');
        $sessionTimeout = 60 * 60; // 1 hora en segundos
        
        if ($lastActivity && (time() - $lastActivity > $sessionTimeout)) {
            // Sesión expirada
            session()->destroy();
            return redirect()->to(url_to('login'))
                ->with('error', 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
        }
        
        // Actualizar el tiempo de última actividad
        session()->set('last_activity', time());
    }

    /**
     * Se ejecuta DESPUÉS de que el controlador ha terminado
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Puedes agregar lógica post-controlador si es necesario
        // Por ejemplo, logging, headers adicionales, etc.
    }
}