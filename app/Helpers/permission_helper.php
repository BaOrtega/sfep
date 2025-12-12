<?php

if (!function_exists('can_access')) {
    /**
     * Verificar si el usuario tiene permiso para ver/realizar una acción
     * 
     * @param string|array $requiredRole Rol o array de roles permitidos
     * @return bool
     */
    function can_access($requiredRole)
    {
        $session = session();
        
        // Si no está logueado, no tiene permisos
        if (!$session->get('isLoggedIn')) {
            return false;
        }
        
        $userRole = $session->get('rol');
        
        // Si no tiene rol asignado, asumir vendedor
        if (!$userRole) {
            $userRole = 'vendedor';
            $session->set('rol', $userRole);
        }
        
        // Si se requiere admin y el usuario es admin
        if ($requiredRole === 'admin' && $userRole === 'admin') {
            return true;
        }
        
        // Si se requiere vendedor y el usuario es admin o vendedor
        if ($requiredRole === 'vendedor' && ($userRole === 'admin' || $userRole === 'vendedor')) {
            return true;
        }
        
        // Para múltiples roles
        if (is_array($requiredRole)) {
            return in_array($userRole, $requiredRole);
        }
        
        return false;
    }
}

if (!function_exists('is_admin')) {
    /**
     * Verificar si el usuario actual es administrador
     * 
     * @return bool
     */
    function is_admin()
    {
        return session()->get('rol') === 'admin';
    }
}

if (!function_exists('is_vendedor')) {
    /**
     * Verificar si el usuario actual es vendedor
     * 
     * @return bool
     */
    function is_vendedor()
    {
        return session()->get('rol') === 'vendedor';
    }
}

if (!function_exists('show_if_can')) {
    /**
     * Mostrar elemento solo si el usuario tiene permiso
     * 
     * @param string|array $requiredRole Rol requerido
     * @param string $html HTML a mostrar
     * @return string
     */
    function show_if_can($requiredRole, $html)
    {
        if (can_access($requiredRole)) {
            return $html;
        }
        return '';
    }
}

if (!function_exists('current_role')) {
    /**
     * Obtener el nombre del rol actual
     * 
     * @return string
     */
    function current_role()
    {
        $role = session()->get('rol');
        $roles = [
            'admin' => 'Administrador',
            'vendedor' => 'Vendedor'
        ];
        
        return $roles[$role] ?? 'Usuario';
    }
}

if (!function_exists('can_view')) {
    /**
     * Verificar permisos específicos para módulos
     * 
     * @param string $module Nombre del módulo
     * @return bool
     */
    function can_view($module)
    {
        $userRole = session()->get('rol');
        
        $permissions = [
            'admin' => ['dashboard', 'clientes', 'productos', 'facturas', 'reportes', 'usuarios', 'profile'],
            'vendedor' => ['dashboard', 'clientes', 'productos', 'facturas', 'profile']
        ];
        
        if (!isset($permissions[$userRole])) {
            return false;
        }
        
        return in_array($module, $permissions[$userRole]);
    }
}

if (!function_exists('can_edit')) {
    /**
     * Verificar si puede editar un recurso específico
     * Útil para facturas que solo pueden ser editadas por su creador
     * 
     * @param int $resourceUserId ID del usuario que creó el recurso
     * @return bool
     */
    function can_edit($resourceUserId)
    {
        // Admin puede editar todo
        if (is_admin()) {
            return true;
        }
        
        // Vendedor solo puede editar sus propios recursos
        return session()->get('user_id') == $resourceUserId;
    }
}

if (!function_exists('role_badge')) {
    /**
     * Generar un badge (etiqueta) para el rol
     * 
     * @param string $role Rol
     * @return string HTML del badge
     */
    function role_badge($role)
    {
        $badges = [
            'admin' => '<span class="badge bg-danger">Administrador</span>',
            'vendedor' => '<span class="badge bg-info">Vendedor</span>'
        ];
        
        return $badges[$role] ?? '<span class="badge bg-secondary">' . $role . '</span>';
    }
}

if (!function_exists('check_permission')) {
    /**
     * Verificar permiso y redirigir si no tiene acceso
     * 
     * @param string|array $requiredRole Rol requerido
     * @param string $redirectUrl URL para redirigir
     * @param string $message Mensaje de error
     * @return void
     */
    function check_permission($requiredRole, $redirectUrl = null, $message = null)
    {
        if (!can_access($requiredRole)) {
            $session = session();
            $redirectUrl = $redirectUrl ?? base_url('dashboard');
            $message = $message ?? 'No tienes permiso para acceder a esta sección.';
            
            $session->setFlashdata('error', $message);
            redirect()->to($redirectUrl)->send();
            exit();
        }
    }
}