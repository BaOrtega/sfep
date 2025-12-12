<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 20px;
        }
        .btn-add {
            background: linear-gradient(90deg, #28a745, #20c997);
            border: none;
            padding: 8px 20px;
        }
        .badge-admin {
            background-color: #dc3545;
            color: white;
        }
        .badge-vendedor {
            background-color: #17a2b8;
            color: white;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
        }
        .action-buttons .btn {
            padding: 4px 8px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php if (file_exists(APPPATH . 'Views/partials/navbar.php')): ?>
        <?= view('partials/navbar') ?>
    <?php endif; ?>
    
    <div class="container mt-4">
        <!-- Mensajes de sesión -->
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-users me-2"></i>Gestión de Usuarios
                </h4>
                <a href="<?= url_to('usuarios_new') ?>" class="btn btn-add">
                    <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                </a>
            </div>
            
            <div class="card-body">
                <?php if (empty($usuarios)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay usuarios registrados</h5>
                        <p class="text-muted">Comienza agregando un nuevo usuario</p>
                        <a href="<?= url_to('usuarios_new') ?>" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Agregar Primer Usuario
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Fecha Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td>#<?= $usuario['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <strong><?= esc($usuario['nombre']) ?></strong>
                                                <?php if ($usuario['id'] == session()->get('user_id')): ?>
                                                    <span class="badge bg-secondary ms-1">Tú</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($usuario['email']) ?></td>
                                    <td>
                                        <span class="badge <?= $usuario['rol'] == 'admin' ? 'badge-admin' : 'badge-vendedor' ?>">
                                            <i class="fas fa-user-tag me-1"></i>
                                            <?= $usuario['rol'] == 'admin' ? 'Administrador' : 'Vendedor' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (isset($usuario['creado_en'])): ?>
                                            <?= date('d/m/Y', strtotime($usuario['creado_en'])) ?>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= url_to('usuarios_edit', $usuario['id']) ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- No permitir eliminar a sí mismo -->
                                            <?php if ($usuario['id'] != session()->get('user_id')): ?>
                                                <a href="<?= url_to('usuarios_delete', $usuario['id']) ?>" 
                                                   class="btn btn-sm btn-outline-danger" 
                                                   title="Eliminar"
                                                   onclick="return confirm('¿Estás seguro de eliminar al usuario <?= esc($usuario['nombre']) ?>?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-outline-secondary" disabled title="No puedes eliminarte a ti mismo">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Estadísticas -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><?= count($usuarios) ?></h5>
                                    <p class="card-text text-muted">Total Usuarios</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= count(array_filter($usuarios, fn($u) => $u['rol'] == 'admin')) ?>
                                    </h5>
                                    <p class="card-text text-muted">Administradores</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= count(array_filter($usuarios, fn($u) => $u['rol'] == 'vendedor')) ?>
                                    </h5>
                                    <p class="card-text text-muted">Vendedores</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= count(array_filter($usuarios, fn($u) => $u['id'] == session()->get('user_id'))) ?>
                                    </h5>
                                    <p class="card-text text-muted">Tú</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Información -->
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Nota:</strong> Solo los usuarios con rol "Administrador" pueden gestionar otros usuarios.
            Los vendedores solo pueden ver su perfil personal.
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-ocultar alertas después de 5 segundos
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Confirmación para eliminar usuarios
            document.querySelectorAll('a[href*="delete"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>