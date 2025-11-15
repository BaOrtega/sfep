<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    // Este método se ejecuta ANTES de que el controlador sea llamado
    public function before(RequestInterface $request, $arguments = null)
    {
        // Si el usuario NO está logueado (la sesión 'isLoggedIn' no es true)
        if (!session()->get('isLoggedIn')) {
            // Redirigir a la página de login
            return redirect()->to(url_to('login'))
                ->with('error', 'Debes iniciar sesión para acceder a esa página.');
        }
    }

    // Este método se ejecuta DESPUÉS de que el controlador ha terminado
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    
    }
}