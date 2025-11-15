<?php namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsuarioModel; // Asegúrate de que el nombre de tu modelo es 'UsuarioModel'

class AuthController extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        // El '1' o el símbolo rojo en la línea 92 probablemente provienen de un carácter
        // invisible o un error de cierre de llave. Aquí está el código limpio.
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
            // Si el modelo NO hace el hasheo, descomenta la siguiente línea:
            // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'password' => $this->request->getPost('password'), 
        ];

        $model->insert($data);
        //echo $model; exit;

        session()->setFlashdata('success', '✅ Registro exitoso. ¡Inicia sesión con tu nuevo usuario!');
        return redirect()->to(url_to('login'));
    } // <-- La llave de cierre de la función debe ser la línea 92

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
//echo "no"; exit;

        // VALIDACIÓN Y CORRECCIÓN CRÍTICA: Añadir el 'return'
        if (!$user || !password_verify($password, $user['password'])) {
            // Usuario no encontrado o contraseña incorrecta
            session()->setFlashdata('error', 'Email o contraseña incorrectos.');
            return redirect()->back()->withInput(); // <--- ¡AÑADIR ESTE RETURN!
        }

        // Inicio de sesión exitoso. Configurar la sesión.
       $sessionData = [
            'user_id'    => $user['id'],
            'user_name'  => $user['nombre'],
            'isLoggedIn' => true, // <--- La clave que revisa el AuthFilter
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