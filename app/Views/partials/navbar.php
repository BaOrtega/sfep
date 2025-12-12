<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Facturación PFEP' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .navbar-custom {
            background: linear-gradient(90deg, #2c3e50, #4a6491);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 10px;
            color: #4dabf7;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 8px 15px !important;
            margin: 0 3px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            color: white !important;
            background-color: rgba(77, 171, 247, 0.2);
            border-left: 3px solid #4dabf7;
        }
        
        .nav-link i {
            margin-right: 8px;
            font-size: 1.1rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            color: white;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .user-role {
            font-size: 0.75rem;
            opacity: 0.8;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .dropdown-item {
            padding: 10px 15px;
            border-radius: 5px;
            margin: 2px 10px;
            width: auto;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .navbar-toggler {
            border: none;
            color: white;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .container-fluid {
            padding: 0 20px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: rgba(44, 62, 80, 0.95);
                padding: 15px;
                border-radius: 10px;
                margin-top: 10px;
            }
            
            .nav-link {
                margin: 5px 0;
            }
            
            .user-info {
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
        }
    </style>
</head>
<body>
    <?php
    $session = session();
    $isLoggedIn = $session->get('isLoggedIn');
    $userName = $session->get('user_name');
    $userEmail = $session->get('email');
    $userRole = $session->get('rol');
    $userId = $session->get('user_id');
    
    // Determinar la página actual
    $currentUri = current_url(true);
    $currentPath = $currentUri->getPath();
    
    // Función para verificar si el enlace está activo
    function isActive($path, $currentPath) {
        if ($path === '/' && $currentPath === '/') return true;
        if ($path !== '/' && strpos($currentPath, $path) === 0) return true;
        return false;
    }
    ?>
    
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <!-- Logo y nombre del sistema -->
            <a class="navbar-brand" href="<?= base_url($isLoggedIn ? 'dashboard' : '/') ?>">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>PFEP Facturación</span>
            </a>
            
            <!-- Botón para menú en móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <?php if ($isLoggedIn): ?>
                <!-- Menú para usuarios autenticados -->
                <ul class="navbar-nav me-auto">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/dashboard', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <!-- Clientes (admin y vendedor) -->
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/clientes', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('clientes') ?>">
                            <i class="fas fa-users"></i>
                            Clientes
                        </a>
                    </li>
                    
                    <!-- Productos (admin y vendedor) -->
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/productos', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('productos') ?>">
                            <i class="fas fa-boxes"></i>
                            Productos
                        </a>
                    </li>
                    
                    <!-- Facturas (admin y vendedor) -->
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/facturas', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('facturas') ?>">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Facturas
                        </a>
                    </li>
                    
                    <!-- Reportes (solo admin) -->
                    <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/reportes', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('reportes') ?>">
                            <i class="fas fa-chart-bar"></i>
                            Reportes
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <!-- Usuarios (solo admin) -->
                    <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/usuarios', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('usuarios') ?>">
                            <i class="fas fa-users-cog"></i>
                            Usuarios
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Información del usuario y menú desplegable -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" 
                           role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <span class="user-name"><?= esc($userName) ?></span>
                                <span class="user-role">
                                    <span class="badge <?= $userRole === 'admin' ? 'bg-danger' : 'bg-info' ?>">
                                        <?= $userRole === 'admin' ? 'Administrador' : 'Vendedor' ?>
                                    </span>
                                </span>
                            </div>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('profile') ?>">
                                    <i class="fas fa-user me-2"></i> Mi Perfil
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <?php if ($userRole === 'admin'): ?>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('usuarios/new') ?>">
                                    <i class="fas fa-user-plus me-2"></i> Crear Usuario
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            
                            <li>
                                <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
                <?php else: ?>
                <!-- Menú para usuarios no autenticados -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('/login', $currentPath) ? 'active' : '' ?>" 
                           href="<?= base_url('login') ?>">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </li>
                    
                    <?php 
                    // Mostrar enlace de registro solo si no hay usuarios en el sistema
                    $usuarioModel = new \App\Models\UsuarioModel();
                    $userCount = $usuarioModel->countAllResults();
                    if ($userCount == 0): 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2" 
                           href="<?= base_url('register') ?>">
                            <i class="fas fa-user-plus"></i> Primer Acceso
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <!-- Bootstrap JS (se incluye en las vistas que lo necesitan) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar menú al hacer clic en un enlace (en móviles)
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                });
            });
            
            // Agregar clase activa a los enlaces del dropdown
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                if (item.href === window.location.href) {
                    item.classList.add('active');
                }
            });
            
            // Mostrar notificación de nuevo usuario (ejemplo)
            const userRole = '<?= $userRole ?? "" ?>';
            if (userRole === 'admin') {
                // Podrías agregar lógica para mostrar notificaciones
                // Por ejemplo, contar usuarios inactivos, facturas pendientes, etc.
            }
        });
    </script>
</body>
</html>