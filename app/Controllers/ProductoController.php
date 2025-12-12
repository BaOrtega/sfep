<?php namespace App\Controllers;

use App\Models\ProductoModel;

class ProductoController extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        parent::__construct();
        $this->productoModel = new ProductoModel();
        
        // Verificar permisos - ambos roles pueden acceder
        $this->checkPermission(['admin', 'vendedor']);
    }

    // [READ] LISTAR productos
    public function index()
    {
        $data['productos'] = $this->productoModel->findAll();
        $data['title'] = "Inventario de Productos y Servicios";
        
        return $this->renderView('productos/index', $data);
    }

    // [CREATE] FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nuevo Producto/Servicio";
        $data['iva_default'] = 19; 
        return $this->renderView('productos/form', $data);
    }

    // [CREATE/UPDATE] GUARDAR O ACTUALIZAR
    public function save()
    {
        // Obtener el ID si existe (para edición)
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        
        // Validación manual para nombre único
        if ($id) {
            $existing = $this->productoModel
                ->where('nombre', $nombre)
                ->where('id !=', $id)
                ->first();
        } else {
            $existing = $this->productoModel->where('nombre', $nombre)->first();
        }
        
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['nombre' => 'Ya existe un producto con ese nombre.']);
        }

        // Usar la validación del modelo para los demás campos
        if (! $this->productoModel->save($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->productoModel->errors());
        }

        $message = $id ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.';
        $this->session->setFlashdata('success', $message);
        return redirect()->to('/productos');
    }

    // [UPDATE] FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $producto = $this->productoModel->find($id);

        if (!$producto) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Producto no encontrado.');
        }

        $data['producto'] = $producto;
        $data['title'] = "Editar Producto/Servicio";
        
        return $this->renderView('productos/form', $data);
    }

    // [DELETE] ELIMINAR
    public function delete($id)
    {
        // Solo admin puede eliminar (verificado por filtro de ruta)
        if ($this->productoModel->delete($id)) {
            $this->session->setFlashdata('success', 'Producto/Servicio eliminado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'No se pudo eliminar el Producto/Servicio.');
        }
        
        return redirect()->to('/productos');
    }
}