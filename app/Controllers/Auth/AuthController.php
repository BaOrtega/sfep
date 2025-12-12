<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    /**
     * @var UsuarioModel
     */
    protected $usuarioModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Inicializar modelo de usuarios
        $this->usuarioModel = new UsuarioModel();
    }

    // ============================================================
    // REGISTRO DE USUARIOS
    // ============================================================

    /**
     * Mostrar formulario de registro
     * - Si NO hay usuarios: público para crear primer admin
     * - Si HAY usuarios: solo para administradores
     */
    public function register()
    {
        // Verificar si ya hay usuarios en el sistema
        $userCount = $this->usuarioModel->countAllResults();
        
        if ($userCount > 0) {
            // Si ya hay usuarios, solo permitir acceso a administradores
            if (!session()->get('isLoggedIn')) {
                return redirect()->to(url_to('login'))
                    ->with('error', 'Debes iniciar sesión como administrador.');
            }
            
            if (session()->get('rol') !== 'admin') {
                return redirect()->to(url_to('dashboard'))
                    ->with('error', 'Solo los administradores pueden registrar nuevos usuarios.');
            }
        }
        
        // Si no hay usuarios, mostrar registro público
        $data = [
            'esPrimerUsuario' => ($userCount == 0),
            'roles' => ['admin' => 'Administrador', 'vendedor' => 'Vendedor']
        ];
        
        return view('auth/register', $data);
    }

    /**
     * Procesar registro de usuario
     */
    public function attemptRegister()
    {
        $userCount = $this->usuarioModel->countAllResults();
        
        // Validar según el caso
        if ($userCount > 0) {
            // Si ya hay usuarios, validar permisos de admin
            if (!session()->get('isLoggedIn') || session()->get('rol') !== 'admin') {
                return redirect()->to(url_to('login'))
                    ->with('error', 'No tienes permisos para registrar usuarios.');
            }
            
            $rol = $this->request->getPost('rol') ?? 'vendedor';
        } else {
            // Primer usuario SIEMPRE será admin
            $rol = 'admin';
        }
        
        // Obtener datos del formulario
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'rol'      => $rol,
            'activo'   => 1
        ];
        
        // Validaciones
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre'   => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[6]'
        ]);
        
        if (!$validation->run($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }
        
        // Guardar usuario
        if ($this->usuarioModel->save($data)) {
            $mensaje = ($userCount == 0) 
                ? '✅ Administrador creado exitosamente. Ahora puedes iniciar sesión.'
                : '✅ Usuario registrado exitosamente.';
            
            // Redirigir según el caso
            if ($userCount == 0) {
                return redirect()->to(url_to('login'))
                    ->with('success', $mensaje);
            } else {
                return redirect()->to(url_to('usuarios_index'))
                    ->with('success', $mensaje);
            }
        } else {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->usuarioModel->errors());
        }
    }

    // ============================================================
    // AUTENTICACIÓN (LOGIN/LOGOUT)
    // ============================================================

    /**
     * Mostrar formulario de login
     * Ruta pública - no requiere autenticación
     */
    public function login()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to(url_to('dashboard'));
        }
        
        // Verificar si hay usuarios en la base de datos
        $userCount = $this->usuarioModel->countAllResults();
        
        $data['userCount'] = $userCount;
        
        return view('auth/login', $data);
    }
    
    /**
     * Procesar intento de login
     * Ruta pública - no requiere autenticación
     */
    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Buscar usuario por email
        $user = $this->usuarioModel->where('email', $email)->first();

        // Verificar credenciales
        if (!$user || !password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Email o contraseña incorrectos.');
            return redirect()->back()->withInput();
        }

        // Verificar si el usuario está activo (si existe el campo)
        if (isset($user['activo']) && $user['activo'] != 1) {
            session()->setFlashdata('error', 'Tu cuenta está desactivada. Contacta al administrador.');
            return redirect()->back()->withInput();
        }

        // Configurar datos de sesión
        $sessionData = [
            'user_id'       => $user['id'],
            'user_name'     => $user['nombre'],
            'email'         => $user['email'],
            'rol'           => $user['rol'] ?? 'vendedor',
            'isLoggedIn'    => true,
            'last_activity' => time()
        ];

        session()->set($sessionData);
        
        // Redirigir al dashboard
        return redirect()->to(url_to('dashboard'))
            ->with('success', '¡Bienvenido, ' . $user['nombre'] . '!');
    }

    /**
     * Cerrar sesión
     * Accesible para todos los usuarios autenticados
     */
    public function logout()
    {
        // Destruir sesión
        session()->destroy();
        
        // Redirigir al login
        return redirect()->to(url_to('login'))
            ->with('success', 'Sesión cerrada correctamente.');
    }

    // ============================================================
    // RECUPERACIÓN DE CONTRASEÑA
    // ============================================================

    /**
     * Mostrar formulario para solicitar recuperación de contraseña
     * Ruta pública
     */
    public function forgotPassword()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to(url_to('dashboard'));
        }
        
        return view('auth/forgot_password');
    }

    /**
     * Procesar solicitud de recuperación de contraseña
     * Ruta pública
     */
    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        
        // Validar email
        if (!$this->validate([
            'email' => 'required|valid_email'
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        // Verificar si el email existe
        $user = $this->usuarioModel->findByEmail($email);
        
        if (!$user) {
            // Por seguridad, mostrar mismo mensaje aunque el email no exista
            return redirect()->to(url_to('login'))
                ->with('success', 'Si el email está registrado, recibirás un enlace de recuperación.');
        }
        
        // Generar token único
        $token = bin2hex(random_bytes(32));
        
        // Guardar token en la tabla password_resets (válido por 1 hora)
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $passwordResetModel->insert([
            'email'      => $email,
            'token'      => $token,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);
        
        // Enviar correo de recuperación
        if ($this->sendResetEmail($email, $token)) {
            return redirect()->to(url_to('login'))
                ->with('success', 'Se ha enviado un enlace de recuperación a tu correo.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al enviar el correo. Por favor, intenta más tarde.');
        }
    }

    /**
     * Mostrar formulario para restablecer contraseña (con token)
     * Ruta pública
     */
    public function resetPassword($token = null)
    {
        // Validar que se proporcione un token
        if (!$token) {
            return redirect()->to(url_to('forgot_password'));
        }
        
        // Verificar si el token es válido y no ha expirado
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $reset = $passwordResetModel->isValidToken($token);
        
        if (!$reset) {
            return redirect()->to(url_to('forgot_password'))
                ->with('error', 'El enlace de recuperación ha expirado o es inválido.');
        }
        
        // Mostrar formulario de restablecimiento
        $data['token'] = $token;
        return view('auth/reset_password', $data);
    }

    /**
     * Procesar restablecimiento de contraseña
     * Ruta pública
     */
    public function processResetPassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        // Validaciones básicas
        if ($password !== $confirm_password) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Las contraseñas no coinciden.');
        }
        
        if (strlen($password) < 6) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La contraseña debe tener al menos 6 caracteres.');
        }
        
        // Verificar token
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $reset = $passwordResetModel->isValidToken($token);
        
        if (!$reset) {
            return redirect()->to(url_to('forgot_password'))
                ->with('error', 'El enlace de recuperación ha expirado o es inválido.');
        }
        
        // Buscar usuario por email
        $user = $this->usuarioModel->findByEmail($reset['email']);
        
        if ($user) {
            // Cambiar contraseña usando el método del modelo
            $this->usuarioModel->changePassword($user['id'], $password);
            
            // Eliminar token usado
            $passwordResetModel->delete($reset['id']);
            
            return redirect()->to(url_to('login'))
                ->with('success', 'Contraseña restablecida exitosamente. Ahora puedes iniciar sesión.');
        }
        
        return redirect()->to(url_to('forgot_password'))
            ->with('error', 'Usuario no encontrado.');
    }

    /**
     * Enviar correo de recuperación de contraseña
     */
    private function sendResetEmail($email, $token)
    {
        try {
            // Generar enlace de restablecimiento
            $resetLink = base_url("reset-password/{$token}");
            
            // Obtener servicio de email
            $emailService = \Config\Services::email();
            
            // Configurar email
            $emailService->setFrom('noreply@sistema-facturacion.com', 'Sistema de Facturación');
            $emailService->setTo($email);
            $emailService->setSubject('Recuperación de Contraseña - Sistema de Facturación');
            
            // Crear mensaje HTML usando vista
            $message = view('emails/reset_password', [
                'resetLink' => $resetLink
            ]);
            
            $emailService->setMessage($message);
            
            // Intentar enviar
            if ($emailService->send()) {
                log_message('info', "Email de recuperación enviado a: {$email}");
                return true;
            } else {
                // Log del error
                $debug = $emailService->printDebugger(['headers']);
                log_message('error', "Error enviando email a {$email}: " . $debug);
                return false;
            }
        } catch (\Exception $e) {
            // Log de excepción
            log_message('error', 'Excepción en sendResetEmail: ' . $e->getMessage());
            return false;
        }
    }

    // ============================================================
    // PERFIL DE USUARIO
    // ============================================================

    /**
     * Mostrar perfil del usuario actual
     * Requiere autenticación
     */
    public function profile()
    {
        // Nota: El filtro 'auth' ya verifica autenticación
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(url_to('login'));
        }
        
        $user_id = session()->get('user_id');
        $user = $this->usuarioModel->find($user_id);
        
        if (!$user) {
            return redirect()->to(url_to('dashboard'))
                ->with('error', 'Usuario no encontrado.');
        }
        
        // No mostrar contraseña en los datos
        unset($user['password']);
        
        $data = [
            'title' => 'Mi Perfil',
            'user' => $user
        ];
        
        return view('auth/profile', $data);
    }

    /**
     * Actualizar perfil del usuario actual
     * Requiere autenticación
     */
    public function updateProfile()
    {
        // Verificar autenticación
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(url_to('login'));
        }
        
        $user_id = session()->get('user_id');
        $post = $this->request->getPost();
        
        // Validar que el nombre no esté vacío
        if (empty($post['nombre'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El nombre es requerido.');
        }
        
        // Preparar datos para actualizar
        $updateData = ['nombre' => $post['nombre']];
        
        // Si se proporciona nueva contraseña, validarla y agregarla
        if (!empty($post['new_password'])) {
            if ($post['new_password'] !== $post['confirm_password']) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Las contraseñas no coinciden.');
            }
            
            if (strlen($post['new_password']) < 6) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'La contraseña debe tener al menos 6 caracteres.');
            }
            
            $updateData['password'] = $post['new_password'];
        }
        
        // Actualizar usuario
        if ($this->usuarioModel->update($user_id, $updateData)) {
            // Actualizar nombre en sesión si cambió
            if ($post['nombre'] !== session()->get('user_name')) {
                session()->set('user_name', $post['nombre']);
            }
            
            session()->setFlashdata('success', 'Perfil actualizado exitosamente.');
            return redirect()->to(url_to('profile'));
        } else {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->usuarioModel->errors());
        }
    }
}