<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\PasswordResetModel;
use CodeIgniter\Email\Email;

class PasswordController extends BaseController
{
    protected $usuarioModel;
    protected $passwordResetModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->passwordResetModel = new PasswordResetModel();
        
        // Limpiar tokens expirados
        $this->passwordResetModel->cleanExpiredTokens();
    }

    // Vista para solicitar recuperación
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    // Procesar solicitud de recuperación
    public function processForgot()
    {
        $email = $this->request->getPost('email');
        
        $user = $this->usuarioModel->findByEmail($email);
        
        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El correo electrónico no está registrado.');
        }
        
        // Generar token único
        $token = bin2hex(random_bytes(32));
        
        // Guardar token en base de datos (válido por 1 hora)
        $this->passwordResetModel->insert([
            'email' => $email,
            'token' => $token,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);
        
        // Enviar correo
        $this->sendResetEmail($email, $token);
        
        return redirect()->to('/login')
            ->with('success', 'Se ha enviado un enlace de recuperación a tu correo.');
    }

    // Vista para restablecer contraseña
    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('/forgot-password');
        }
        
        $reset = $this->passwordResetModel->isValidToken($token);
        
        if (!$reset) {
            return redirect()->to('/forgot-password')
                ->with('error', 'El enlace de recuperación ha expirado o es inválido.');
        }
        
        $data['token'] = $token;
        return view('auth/reset_password', $data);
    }

    // Procesar restablecimiento
    public function processReset()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        if ($password !== $confirm_password) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Las contraseñas no coinciden.');
        }
        
        $reset = $this->passwordResetModel->isValidToken($token);
        
        if (!$reset) {
            return redirect()->to('/forgot-password')
                ->with('error', 'El enlace de recuperación ha expirado o es inválido.');
        }
        
        // Actualizar contraseña
        $user = $this->usuarioModel->findByEmail($reset['email']);
        $this->usuarioModel->changePassword($user['id'], $password);
        
        // Eliminar token usado
        $this->passwordResetModel->delete($reset['id']);
        
        return redirect()->to('/login')
            ->with('success', 'Contraseña restablecida exitosamente. Ahora puedes iniciar sesión.');
    }

    // Enviar correo de recuperación
    private function sendResetEmail($email, $token)
    {
        $emailService = \Config\Services::email();
        
        $resetLink = base_url("reset-password/{$token}");
        
        $message = view('emails/reset_password', [
            'resetLink' => $resetLink
        ]);
        
        $emailService->setTo($email);
        $emailService->setSubject('Restablecimiento de Contraseña - Sistema de Facturación');
        $emailService->setMessage($message);
        
        return $emailService->send();
    }
}