<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $model = new UsuarioModel();


        if (!$this->validate([
            'nombre'   => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]',
        ])) {
    
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            //'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'password' => $this->request->getPost('password'), 
        ];

        $model->insert($data);
       

        session()->setFlashdata('success', '✅ Registro exitoso. ¡Inicia sesión con tu nuevo usuario!');
        return redirect()->to(url_to('login'));
    } 

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(url_to('dashboard'));
        }
        return view('auth/login');
    }
    
    public function attemptLogin()
    {
       $model = new UsuarioModel();
       
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Email o contraseña incorrectos.');
            return redirect()->back()->withInput();
        }

       $sessionData = [
            'user_id'    => $user['id'],
            'user_name'  => $user['nombre'],
            'isLoggedIn' => true,
        ];

        session()->set($sessionData);
        // Redirección al dashboard (la ruta protegida)
        return redirect()->to(url_to('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(url_to('login'));
    }
}