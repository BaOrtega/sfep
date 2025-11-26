<?php namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;

class FacturaController extends BaseController
{
    protected $facturaModel;
    protected $detalleModel;
    protected $clienteModel;
    protected $productoModel;

    public function __construct()
    {
        $this->facturaModel = new FacturaModel();
        $this->detalleModel = new DetalleFacturaModel();
        $this->clienteModel = new ClienteModel();
        $this->productoModel = new ProductoModel();
    }

    // [READ] LISTAR FACTURAS
    public function index()
    {
        $data['facturas'] = $this->facturaModel->findAll();
        $data['title'] = "Gestión de Facturas";
        
        return view('facturas/index', $data);
    }

    // [CREATE] MUESTRA EL FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nueva Factura";
        
        // Cargar clientes y productos para los select
        $data['clientes'] = $this->clienteModel->findAll();
        // Solo cargamos productos activos
        $data['productos'] = $this->productoModel->where('activo', 1)->findAll(); 

        // Valores por defecto
        $data['fecha_emision'] = date('Y-m-d');
        $data['fecha_vencimiento'] = date('Y-m-d', strtotime('+30 days'));
        
        return view('facturas/form', $data);
    }

    // [CREATE/UPDATE] PROCESAR Y GUARDAR FACTURA
    public function save()
    {
        $post = $this->request->getPost();
        $detalles_json = $post['detalles_json']; // JSON con los productos de la vista
        $detalles_productos = json_decode($detalles_json, true);
        
        if (empty($detalles_productos)) {
            session()->setFlashdata('error', 'Debe agregar al menos un producto a la factura.');
            return redirect()->back()->withInput();
        }

        $subtotal_general = 0;
        $impuestos_general = 0;

        // 1. CALCULAR TOTALES DE LA FACTURA
        foreach ($detalles_productos as $detalle) {
            $subtotal_general += $detalle['subtotal_linea'];
            $impuestos_general += $detalle['impuesto_linea'];
        }

        $total_factura = $subtotal_general + $impuestos_general;
        
        // Obtener el ID del usuario logeado
        $usuario_id = session()->get('user_id'); 
        if (!$usuario_id) {
             session()->setFlashdata('error', 'Sesión de usuario no válida.');
             return redirect()->to('/login');
        }

        // 2. INSERTAR LA CABECERA (Factura principal)
        $facturaData = [
            'cliente_id'        => $post['cliente_id'],
            'usuario_id'        => $usuario_id, // Usar el ID del usuario logeado
            'fecha_emision'     => $post['fecha_emision'],
            'fecha_vencimiento' => $post['fecha_vencimiento'],
            'subtotal'          => $subtotal_general,
            'total_impuestos'   => $impuestos_general,
            'total_factura'     => $total_factura,
            'moneda'            => 'COP',
            'estado'            => 'EMITIDA', 
        ];

        // Usamos transacciones
        $this->facturaModel->db->transStart();
        
        if (!$this->facturaModel->insert($facturaData)) {
            $this->facturaModel->db->transRollback();
            session()->setFlashdata('error', 'Error al crear la cabecera de la factura.');
            return redirect()->back()->withInput();
        }

        $factura_id = $this->facturaModel->getInsertID();

        // 3. INSERTAR EL DETALLE DE LA FACTURA
        foreach ($detalles_productos as $detalle) {
            $detalleData = [
                'factura_id'              => $factura_id,
                'producto_id'             => $detalle['producto_id'],
                'cantidad'                => $detalle['cantidad'],
                'precio_unitario'         => $detalle['precio_unitario_venta'], // Nombre CORREGIDO
                'tasa_impuesto'           => $detalle['iva_porcentaje_venta'],  // Nombre CORREGIDO
                'total_linea'             => $detalle['total_linea'], // Usamos total_linea de la DB
                // 'descripcion_adicional' => Opcional, lo omitimos por simplicidad.
            ];

            if (!$this->detalleModel->insert($detalleData)) {
                $this->facturaModel->db->transRollback();
                session()->setFlashdata('error', 'Error al guardar el detalle de los productos.');
                return redirect()->back()->withInput();
            }
            
            // 4. (FUTURO): Actualizar Inventario (restar cantidad del stock)
        }

        $this->facturaModel->db->transComplete();

        session()->setFlashdata('success', 'Factura N°' . $factura_id . ' emitida con éxito. Total: $' . number_format($total_factura, 2, ',', '.'));
        return redirect()->to(url_to('facturas'));
    }


    public function view($id)
    {
        // 1. Obtener la cabecera de la factura
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            // Manejo de error si la factura no existe
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Factura N°: ' . $id . ' no encontrada.');
        }

        // 2. Obtener los datos del cliente
        $cliente = $this->clienteModel->find($factura['cliente_id']);
        
        // 3. Obtener los detalles de la factura con el nombre del producto.
        // Usamos JOIN para obtener el nombre del producto directamente
        $detalles = $this->detalleModel
            ->select('detalle_factura.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_factura.producto_id')
            ->where('factura_id', $id)
            ->findAll();

        $data['title'] = "Detalle de Factura N°" . $id;
        $data['factura'] = $factura;
        $data['cliente'] = $cliente;
        $data['detalles'] = $detalles;
        
        return view('facturas/view', $data); // Cargar la nueva vista
    }

    // app/Controllers/FacturaController.php (Añadir dentro de la clase FacturaController)

// ...

    // [ACTION] CAMBIA EL ESTADO A PAGADA
    public function pagar($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            session()->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        // 1. Actualizar el estado
        $this->facturaModel->update($id, ['estado' => 'PAGADA']);

        // 2. Redirigir
        session()->setFlashdata('success', 'Factura N°' . $id . ' marcada como PAGADA con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    // [ACTION] CAMBIA EL ESTADO A ANULADA
    public function anular($id)
    {
        $factura = $this->facturaModel->find($id);
        
        if (empty($factura)) {
            session()->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        if ($factura['estado'] == 'ANULADA') {
            session()->setFlashdata('info', 'La Factura N°' . $id . ' ya está ANULADA.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        // 1. Actualizar el estado
        // NOTA: En un sistema real, aquí se revertiría el inventario.
        $this->facturaModel->update($id, ['estado' => 'ANULADA']);

        // 2. Redirigir
        session()->setFlashdata('success', 'Factura N°' . $id . ' ha sido ANULADA con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }


}