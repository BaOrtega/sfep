<?php namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController extends BaseController
{
    protected $clienteModel;

    public function __construct()
    {
        parent::__construct();
        $this->clienteModel = new ClienteModel();
        
        // Verificar permisos - ambos roles pueden acceder
        $this->checkPermission(['admin', 'vendedor']);
    }

    // [READ] LISTAR clientes 
    public function index()
    {
        $data['clientes'] = $this->clienteModel->findAll();
        $data['title'] = "Gestión de Clientes";
        
        return $this->renderView('clientes/index', $data);
    }

    // [CREATE] FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nuevo Cliente";
        return $this->renderView('clientes/form', $data);
    }

    // [CREATE/UPDATE] GUARDAR O ACTUALIZAR
    public function save()
    {
        // El método save() del modelo se encarga de la validación y de la lógica INSERT/UPDATE
        if (! $this->clienteModel->save($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $this->clienteModel->errors());
        }

        $this->session->setFlashdata('success', 'Cliente guardado con éxito.');
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
        
        return $this->renderView('clientes/form', $data);
    }

    // [DELETE] ELIMINAR
    public function delete($id)
    {
        if ($this->clienteModel->delete($id)) {
            $this->session->setFlashdata('success', 'Cliente eliminado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'No se pudo eliminar el cliente.');
        }
        
        return redirect()->to('/clientes');
    }
    
    // Cantidad de clientes (para AJAX/dashboard)
    public function cantidadClientes()
    {
        $total = $this->clienteModel->countAll();
        return $this->response->setJSON(['total' => $total]);
    }
}