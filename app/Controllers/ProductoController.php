<?php namespace App\Controllers;

use App\Models\ProductoModel;

class ProductoController extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    // [READ] LISTAR productos
    public function index()
    {
        $data['productos'] = $this->productoModel->findAll();
        $data['title'] = "Inventario de Productos y Servicios";
        
        return view('productos/index', $data);
    }

    // [CREATE] FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nuevo Producto/Servicio";
        $data['iva_default'] = 19; 
        return view('productos/form', $data);
    }

    // [CREATE/UPDATE] GUARDAR O ACTUALIZAR
    public function save()
    {
        // Obtener el ID si existe (para edición)
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        
        // Validación manual para nombre único
        if ($id) {
            // En edición: verificar si el nombre ya existe excluyendo el actual
            $existing = $this->productoModel
                ->where('nombre', $nombre)
                ->where('id !=', $id)
                ->first();
        } else {
            // En creación: verificar si el nombre ya existe
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
        session()->setFlashdata('success', $message);
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
        
        return view('productos/form', $data);
    }

    // [DELETE] ELIMINAR
    public function delete($id)
    {
        if ($this->productoModel->delete($id)) {
            session()->setFlashdata('success', 'Producto/Servicio eliminado con éxito.');
        } else {
            session()->setFlashdata('error', 'No se pudo eliminar el Producto/Servicio.');
        }
        
        return redirect()->to('/productos');
    }
}