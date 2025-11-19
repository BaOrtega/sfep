<?php namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    protected $clienteModel;

    public function __construct()
    {
        // Inicializa el modelo al crear el controlador
        $this->clienteModel = new ClienteModel();
    }

    // [READ] LISTAR clientes 
    public function index()
    {
        $data['clientes'] = $this->clienteModel->findAll();
        $data['title'] = "Gestión de Clientes";
        
        // Muestra la vista de listado
        return view('clientes/index', $data);
    }

    // [CREATE] FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nuevo Cliente";
        // Muestra la vista del formulario (vacío)
        return view('clientes/form', $data);
    }

    // [CREATE/UPDATE] GUARDAR O ACTUALIZAR
    public function save()
    {
        // El método save() del modelo se encarga de la validación y de la lógica INSERT/UPDATE
        if (! $this->clienteModel->save($this->request->getPost())) {
            
            // Si la validación falla, regresa con errores
            return redirect()->back()->withInput()->with('errors', $this->clienteModel->errors());
        }

        session()->setFlashdata('success', 'Cliente guardado con éxito.');
        // Redirige al listado
        return redirect()->to('/clientes');
    }

    // [UPDATE] FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $cliente = $this->clienteModel->find($id);

        if (!$cliente) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cliente no encontrado.');
        }

        $data['cliente'] = $cliente;
        $data['title'] = "Editar Cliente";
        
        
        // Muestra la vista del formulario (precargado con datos)
        return view('/clientes/form', $data);
    }

    // [DELETE] ELIMINAR
    public function delete($id)
    {
        if ($this->clienteModel->delete($id)) {
            session()->setFlashdata('success', 'Cliente eliminado con éxito.');
        } else {
            session()->setFlashdata('error', 'No se pudo eliminar el cliente.');
        }
        
        return redirect()->to('/clientes');
    }
}