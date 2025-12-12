<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configura aliases para las clases de Filtros.
     * Hace la lectura más simple y ordenada.
     *
     * @var array<string, class-string|list<class-string>>
     * 
     * [nombre_filtro => nombre_clase]
     * o [nombre_filtro => [clase1, clase2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        
        // Nuestros filtros personalizados
        'auth'          => \App\Filters\AuthFilter::class,    // Verifica autenticación
        'role'          => \App\Filters\RoleFilter::class,    // Verifica roles específicos
        'admin'         => \App\Filters\AdminFilter::class,   // Verifica que sea admin
    ];

    /**
     * Lista de filtros especiales requeridos.
     *
     * Estos filtros son especiales. Se aplican antes y después
     * de otros tipos de filtros, y siempre se aplican incluso si una ruta no existe.
     *
     * Los filtros establecidos por defecto proporcionan funcionalidad del framework.
     * Si se eliminan, esas funciones dejarán de funcionar.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            // 'forcehttps', // Forzar HTTPS globalmente (activar en producción)
        ],
        'after' => [
            'toolbar', // Barra de depuración
        ],
    ];

    /**
     * Lista de aliases de filtros que se aplican siempre
     * antes y después de cada solicitud.
     *
     * @var array{
     *     before: array<string, array{except: list<string>|string}>|list<string>,
     *     after: array<string, array{except: list<string>|string}>|list<string>
     * }
     */
    public array $globals = [
        'before' => [
            // CSRF: Protección contra Cross-Site Request Forgery
            // Activar solo si no tienes API externa
            // 'csrf' => ['except' => ['api/*']],
            
            // IMPORTANTE: NO apliques 'auth' globalmente aquí
            // Esto causaría bucle infinito en rutas públicas
        ],
        'after' => [
            // 'honeypot', // Protección contra bots
            // 'secureheaders', // Headers de seguridad
        ],
    ];

    /**
     * Lista de aliases de filtros que funcionan en
     * un método HTTP particular (GET, POST, etc.).
     *
     * Ejemplo:
     * 'POST' => ['foo', 'bar']
     *
     * Si usas esto, deberías desactivar auto-routing porque auto-routing
     * permite cualquier método HTTP para acceder a un controlador.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [
        // Ejemplo: aplicar filtro a métodos POST específicos
        // 'post' => ['csrf', 'auth'],
    ];

    /**
     * Lista de aliases de filtros que deberían ejecutarse en
     * patrones URI específicos (antes o después).
     *
     * Ejemplo:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [
        // Los filtros se aplicarán directamente en las rutas
        // Esta sección se deja vacía para evitar conflictos
    ];
}