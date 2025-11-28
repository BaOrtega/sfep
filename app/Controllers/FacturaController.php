<?php namespace App\Controllers;

use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;
use Dompdf\Dompdf;

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
        $data['facturas'] = $this->facturaModel
        ->select('facturas.*') 
        // ¡Importante! Seleccionamos el nombre del cliente y le damos un alias claro
        ->select('clientes.nombre AS nombre_cliente') 
        // Realizamos la unión de las dos tablas
        ->join('clientes', 'clientes.id = facturas.cliente_id')
        // Ordenamos por ID descendente
        ->orderBy('facturas.id', 'DESC')
        ->findAll();
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
            // Verificar si el stock es suficiente antes de proceder
            $producto_id = $detalle['producto_id'];
            $cantidad_vendida = $detalle['cantidad'];
            
            $productoActual = $this->productoModel->find($producto_id);

            // Validar stock: Si el producto existe y la cantidad vendida es mayor que el inventario actual
            if (!$productoActual || $cantidad_vendida > $productoActual['inventario']) {
                session()->setFlashdata('error', 'Error: La cantidad de ' . esc($productoActual['nombre'] ?? 'un producto') . ' excede el inventario disponible (' . esc($productoActual['inventario'] ?? 0) . ').');
                return redirect()->back()->withInput();
            }

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

        // Usamos transacciones para asegurar la integridad (Factura y Stock)
        $this->facturaModel->db->transStart();
        
        if (!$this->facturaModel->insert($facturaData)) {
            $this->facturaModel->db->transRollback();
            session()->setFlashdata('error', 'Error al crear la cabecera de la factura.');
            return redirect()->back()->withInput();
        }

        $factura_id = $this->facturaModel->getInsertID();

        // 3. INSERTAR EL DETALLE DE LA FACTURA Y DESCONTAR INVENTARIO
        foreach ($detalles_productos as $detalle) {
            $detalleData = [
                'factura_id'              => $factura_id,
                'producto_id'             => $detalle['producto_id'],
                'cantidad'                => $detalle['cantidad'],
                'precio_unitario'         => $detalle['precio_unitario_venta'], // Nombre CORREGIDO
                'tasa_impuesto'           => $detalle['iva_porcentaje_venta'],  // Nombre CORREGIDO
                'total_linea'             => $detalle['total_linea'], // Usamos total_linea de la DB
            ];

            if (!$this->detalleModel->insert($detalleData)) {
                $this->facturaModel->db->transRollback();
                session()->setFlashdata('error', 'Error al guardar el detalle de los productos.');
                return redirect()->back()->withInput();
            }
            
            // 4. [NUEVA LÓGICA DE INVENTARIO] Descontar la cantidad vendida del inventario
            $producto_id = $detalle['producto_id'];
            $cantidad_vendida = $detalle['cantidad'];
            
            // Volvemos a obtener el producto (o usamos el que ya cargamos si es una lista estática, pero por seguridad, lo volvemos a cargar)
            $productoActual = $this->productoModel->find($producto_id);

            if ($productoActual) {
                $nuevo_inventario = $productoActual['inventario'] - $cantidad_vendida;
                
                // Actualizar el inventario en la tabla 'productos'
                $this->productoModel->update($producto_id, ['inventario' => $nuevo_inventario]);
            }
        }

        $this->facturaModel->db->transComplete();
        // Si la transacción falla por alguna razón (y no fue capturada por el Rollback), podemos revisar los logs.
        if ($this->facturaModel->db->transStatus() === false) {
             session()->setFlashdata('error', 'La transacción de guardado de factura y stock falló.');
             return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Factura N°' . $factura_id . ' emitida con éxito. Stock de productos actualizado. Total: $' . number_format($total_factura, 2, ',', '.'));
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

    // [ACTION] CAMBIA EL ESTADO A PAGADA
    public function pagar($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            session()->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        // Si la factura ya está anulada, no se puede pagar
        if ($factura['estado'] == 'ANULADA') {
            session()->setFlashdata('warning', 'La factura N°' . $id . ' está anulada y no puede ser marcada como PAGADA.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        // 1. Actualizar el estado
        $this->facturaModel->update($id, ['estado' => 'PAGADA']);

        // 2. Redirigir
        session()->setFlashdata('success', 'Factura N°' . $id . ' marcada como PAGADA con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    // [ACTION] CAMBIA EL ESTADO A ANULADA Y REVIERTE EL INVENTARIO
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

        // Iniciar transacción para asegurar que la anulación y la reversión de inventario sean atómicas
        $this->facturaModel->db->transStart();

        // 1. Obtener los detalles de la factura a anular
        $detalles = $this->detalleModel->where('factura_id', $id)->findAll();
        
        // 2. Revertir el inventario para cada producto
        foreach ($detalles as $detalle) {
            $productoId = $detalle['producto_id'];
            $cantidad = $detalle['cantidad'];
            
            $productoActual = $this->productoModel->find($productoId);
            
            if ($productoActual) {
                // [NUEVA LÓGICA DE INVENTARIO] Sumar la cantidad de vuelta al inventario (columna 'inventario')
                $nuevo_inventario = $productoActual['inventario'] + $cantidad;
                
                // Actualizar el inventario
                $this->productoModel->update($productoId, ['inventario' => $nuevo_inventario]);
            }
        }

        // 3. Actualizar el estado de la factura a ANULADA
        $this->facturaModel->update($id, ['estado' => 'ANULADA']);

        $this->facturaModel->db->transComplete(); // Finalizar la transacción

        if ($this->facturaModel->db->transStatus() === false) {
             session()->setFlashdata('error', 'La anulación de la factura y la reversión de stock fallaron.');
             return redirect()->to(url_to('facturas_view', $id));
        }

        // 4. Redirigir
        session()->setFlashdata('success', 'Factura N°' . $id . ' ha sido ANULADA y el inventario revertido con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    public function generatePdf($id)
    {
        // 1. OBTENER LOS DATOS (misma lógica que en view($id))
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            // Manejo de error
            return redirect()->to(url_to('facturas_index'))->with('error', 'Factura no encontrada para PDF.');
        }

        $cliente = $this->clienteModel->find($factura['cliente_id']);
        $detalles = $this->detalleModel
            ->select('detalle_factura.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_factura.producto_id')
            ->where('factura_id', $id)
            ->findAll();

        $data['title'] = "Factura N°" . $id;
        $data['factura'] = $factura;
        $data['cliente'] = $cliente;
        $data['detalles'] = $detalles;

        // 2. CARGAR LA VISTA HTML (usando la vista limpia que crearemos a continuación)
        $html = view('facturas/pdf_template', $data);

        // 3. GENERAR EL PDF USANDO DOMPDF
        $dompdf = new Dompdf();

        // Carga el HTML generado
        $dompdf->loadHtml($html);

        // Configura el tamaño del papel (A4 es estándar)
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza el HTML a PDF
        $dompdf->render();

        // Enviar el archivo PDF al navegador
        $filename = 'Factura_' . $id . '.pdf';

        // 'I' = Inline (Muestra el PDF en el navegador), 'D' = Download (Descarga el archivo)
        $dompdf->stream($filename, ["Attachment" => false]);

        exit(); // Detenemos la ejecución del script después de enviar el archivo
    }

}