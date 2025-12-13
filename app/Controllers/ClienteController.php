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
        // Obtener datos del formulario
        $data = $this->request->getPost();
        
        // Validar datos básicos
        if (empty($data['nombre']) || empty($data['nit'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nombre y NIT son campos obligatorios.');
        }
        
        // Determinar si es creación o edición
        $esEdicion = !empty($data['id']);
        $id = $esEdicion ? (int)$data['id'] : null;
        
        // Verificar si el NIT ya existe (excepto en edición del mismo cliente)
        $nitExiste = $this->clienteModel->nitExiste($data['nit'], $id);
        
        if ($nitExiste) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El NIT/Cédula "'.$data['nit'].'" ya está registrado. Por favor, use un número diferente.');
        }
        
        // Preparar datos para guardar
        $datosGuardar = [
            'nombre' => trim($data['nombre']),
            'nit' => trim($data['nit']),
            'direccion' => !empty($data['direccion']) ? trim($data['direccion']) : null,
            'email' => !empty($data['email']) ? trim($data['email']) : null,
            'telefono' => !empty($data['telefono']) ? trim($data['telefono']) : null
        ];
        
        // Si es edición, agregar el ID
        if ($esEdicion) {
            $datosGuardar['id'] = $id;
        }
        
        try {
            // Intentar guardar
            if ($this->clienteModel->save($datosGuardar)) {
                $mensaje = $esEdicion ? 'Cliente actualizado con éxito.' : 'Cliente creado con éxito.';
                $this->session->setFlashdata('success', $mensaje);
                return redirect()->to('/clientes');
            } else {
                // Si hay errores de validación del modelo
                $errores = $this->clienteModel->errors();
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $errores);
            }
        } catch (\Exception $e) {
            // Capturar error específico de duplicado
            $mensajeError = $e->getMessage();
            
            if (strpos($mensajeError, 'Duplicate entry') !== false || 
                strpos($mensajeError, '1062') !== false) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'El NIT/Cédula ya está registrado en la base de datos.');
            }
            
            // Log del error
            log_message('error', 'Error en ClienteController::save: ' . $mensajeError);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al guardar el cliente. Por favor, intente nuevamente.');
        }
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
    
    /**
     * Verificar NIT vía AJAX
     */
    public function verificarNit()
    {
        // Verificar que sea petición AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Petición inválida'
            ]);
        }
        
        $nit = $this->request->getPost('nit');
        $id = $this->request->getPost('id') ? (int)$this->request->getPost('id') : null;
        
        // Validar NIT
        if (empty($nit)) {
            return $this->response->setJSON([
                'valido' => false,
                'mensaje' => 'El NIT es requerido'
            ]);
        }
        
        // Verificar si el NIT ya existe
        $existe = $this->clienteModel->nitExiste($nit, $id);
        
        return $this->response->setJSON([
            'valido' => !$existe,
            'mensaje' => $existe ? 'Este NIT ya está registrado' : 'NIT disponible'
        ]);
    }
    
    /**
     * Cantidad de clientes para dashboard
     */
    public function cantidadClientes()
    {
        $total = $this->clienteModel->countAll();
        return $this->response->setJSON(['total' => $total]);
    }
}