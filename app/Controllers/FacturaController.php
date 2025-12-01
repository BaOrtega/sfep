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
        // Obtener facturas ÚNICAS usando DISTINCT para evitar duplicados
        $data['facturas'] = $this->facturaModel
            ->select('facturas.*, clientes.nombre as cliente_nombre, clientes.nit as cliente_documento')
            ->distinct() // ¡ESTO ES CLAVE! Previene duplicados
            ->join('clientes', 'clientes.id = facturas.cliente_id')
            ->orderBy('facturas.id', 'DESC')
            ->findAll();
        
        // Calcular estadísticas
        $data['totalFacturas'] = count($data['facturas']);
        $data['facturasEmitidas'] = $this->facturaModel
            ->where('estado', 'EMITIDA')
            ->countAllResults();
        $data['facturasPendientes'] = $this->facturaModel
            ->where('estado', 'PAGADA')
            ->countAllResults();
        $data['facturasAnuladas'] = $this->facturaModel
            ->where('estado', 'ANULADA')
            ->countAllResults();
        
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

    // [CREATE/UPDATE] PROCESAR Y GUARDAR FACTURA - CORREGIDO (SIN created_at)
    public function save()
    {
        // Verificar que sea una solicitud POST
        if (!$this->request->is('post')) {
            session()->setFlashdata('error', 'Método no permitido.');
            return redirect()->to(url_to('facturas_new'));
        }
        
        $post = $this->request->getPost();
        
        // Validación básica
        if (empty($post['cliente_id'])) {
            session()->setFlashdata('error', 'Debe seleccionar un cliente.');
            return redirect()->back()->withInput();
        }
        
        if (empty($post['detalles_json'])) {
            session()->setFlashdata('error', 'Debe agregar al menos un producto a la factura.');
            return redirect()->back()->withInput();
        }
        
        $detalles_json = $post['detalles_json'];
        $detalles_productos = json_decode($detalles_json, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($detalles_productos)) {
            session()->setFlashdata('error', 'El detalle de productos está vacío o es inválido.');
            return redirect()->back()->withInput();
        }
        
        $subtotal_general = 0;
        $impuestos_general = 0;

        // 1. VALIDAR STOCK Y CALCULAR TOTALES
        foreach ($detalles_productos as $detalle) {
            if (!isset($detalle['producto_id'], $detalle['cantidad'])) {
                session()->setFlashdata('error', 'Datos de producto incompletos.');
                return redirect()->back()->withInput();
            }
            
            $producto_id = (int)$detalle['producto_id'];
            $cantidad_vendida = (int)$detalle['cantidad'];
            
            // Validar que la cantidad sea positiva
            if ($cantidad_vendida <= 0) {
                session()->setFlashdata('error', 'La cantidad debe ser mayor a 0.');
                return redirect()->back()->withInput();
            }
            
            $productoActual = $this->productoModel->find($producto_id);

            if (!$productoActual) {
                session()->setFlashdata('error', 'Producto no encontrado.');
                return redirect()->back()->withInput();
            }
            
            if ($cantidad_vendida > $productoActual['inventario']) {
                session()->setFlashdata('error', 'La cantidad de ' . esc($productoActual['nombre']) . 
                    ' excede el inventario disponible (' . $productoActual['inventario'] . ').');
                return redirect()->back()->withInput();
            }

            // Calcular subtotal e impuestos para esta línea
            $precio_unitario = (float)($detalle['precio_unitario_venta'] ?? $productoActual['precio_unitario']);
            $tasa_impuesto = (float)($detalle['iva_porcentaje_venta'] ?? $productoActual['tasa_impuesto']);
            
            $subtotal_linea = $precio_unitario * $cantidad_vendida;
            $impuesto_linea = $subtotal_linea * ($tasa_impuesto / 100);
            
            $subtotal_general += $subtotal_linea;
            $impuestos_general += $impuesto_linea;
        }

        $total_factura = $subtotal_general + $impuestos_general;
        
        // Validar que el total sea positivo
        if ($total_factura <= 0) {
            session()->setFlashdata('error', 'El total de la factura debe ser mayor a 0.');
            return redirect()->back()->withInput();
        }
        
        // Obtener el ID del usuario logeado
        $usuario_id = session()->get('user_id'); 
        if (!$usuario_id) {
            session()->setFlashdata('error', 'Sesión de usuario no válida. Por favor, inicie sesión nuevamente.');
            return redirect()->to('/login');
        }
        
        // PREPARAR DATOS DE LA FACTURA (SIN created_at)
        $facturaData = [
            'cliente_id'        => (int)$post['cliente_id'],
            'usuario_id'        => (int)$usuario_id,
            'fecha_emision'     => $post['fecha_emision'],
            'fecha_vencimiento' => $post['fecha_vencimiento'],
            'subtotal'          => $subtotal_general,
            'total_impuestos'   => $impuestos_general,
            'total_factura'     => $total_factura,
            'moneda'            => 'COP',
            'estado'            => 'EMITIDA'
            // REMOVIDO: 'created_at' => date('Y-m-d H:i:s')
        ];
        
        // USAR TRANSACCIÓN
        $db = \Config\Database::connect();
        $db->transStart();
        
        try {
            // Insertar cabecera de factura
            if (!$this->facturaModel->insert($facturaData)) {
                $error = $this->facturaModel->errors();
                throw new \Exception('Error al crear la cabecera de la factura: ' . implode(', ', $error));
            }

            $factura_id = $this->facturaModel->getInsertID();
            
            // INSERTAR DETALLES Y ACTUALIZAR INVENTARIO (SIN created_at)
            foreach ($detalles_productos as $detalle) {
                $producto_id = (int)$detalle['producto_id'];
                $cantidad = (int)$detalle['cantidad'];
                $precio_unitario = (float)($detalle['precio_unitario_venta'] ?? 0);
                $tasa_impuesto = (float)($detalle['iva_porcentaje_venta'] ?? 0);
                
                $subtotal_linea = $precio_unitario * $cantidad;
                $impuesto_linea = $subtotal_linea * ($tasa_impuesto / 100);
                $total_linea = $subtotal_linea + $impuesto_linea;
                
                $detalleData = [
                    'factura_id'      => $factura_id,
                    'producto_id'     => $producto_id,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'tasa_impuesto'   => $tasa_impuesto,
                    'total_linea'     => $total_linea
                    // REMOVIDO: 'created_at' => date('Y-m-d H:i:s')
                ];
                
                if (!$this->detalleModel->insert($detalleData)) {
                    $error = $this->detalleModel->errors();
                    throw new \Exception('Error al guardar el detalle: ' . implode(', ', $error));
                }
                
                // Actualizar inventario
                $productoActual = $this->productoModel->find($producto_id);
                if ($productoActual) {
                    $nuevo_inventario = $productoActual['inventario'] - $cantidad;
                    
                    if (!$this->productoModel->update($producto_id, ['inventario' => $nuevo_inventario])) {
                        $error = $this->productoModel->errors();
                        throw new \Exception('Error al actualizar inventario: ' . implode(', ', $error));
                    }
                }
            }
            
            $db->transComplete();
            
            if ($db->transStatus() === false) {
                throw new \Exception('La transacción falló.');
            }
            
            session()->setFlashdata('success', 'Factura N°' . $factura_id . ' emitida con éxito. Total: $' . number_format($total_factura, 2, ',', '.'));
            return redirect()->to(url_to('facturas_index'));
            
        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function view($id)
    {
        // 1. Obtener la cabecera de la factura
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Factura N°: ' . $id . ' no encontrada.');
        }

        // 2. Obtener los datos del cliente
        $cliente = $this->clienteModel->find($factura['cliente_id']);
        
        // 3. Obtener los detalles de la factura
        $detalles = $this->detalleModel
            ->select('detalle_factura.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_factura.producto_id')
            ->where('factura_id', $id)
            ->findAll();

        $data['title'] = "Detalle de Factura N°" . $id;
        $data['factura'] = $factura;
        $data['cliente'] = $cliente;
        $data['detalles'] = $detalles;
        
        return view('facturas/view', $data);
    }

    // [ACTION] CAMBIA EL ESTADO A PAGADA
    public function pagar($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            session()->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        if ($factura['estado'] == 'ANULADA') {
            session()->setFlashdata('warning', 'La factura N°' . $id . ' está anulada y no puede ser marcada como PAGADA.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        $this->facturaModel->update($id, ['estado' => 'PAGADA']);

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

        $this->facturaModel->db->transStart();

        // 1. Obtener los detalles de la factura a anular
        $detalles = $this->detalleModel->where('factura_id', $id)->findAll();
        
        // 2. Revertir el inventario para cada producto
        foreach ($detalles as $detalle) {
            $productoId = $detalle['producto_id'];
            $cantidad = $detalle['cantidad'];
            
            $productoActual = $this->productoModel->find($productoId);
            
            if ($productoActual) {
                $nuevo_inventario = $productoActual['inventario'] + $cantidad;
                
                $this->productoModel->update($productoId, ['inventario' => $nuevo_inventario]);
            }
        }

        // 3. Actualizar el estado de la factura a ANULADA
        $this->facturaModel->update($id, ['estado' => 'ANULADA']);

        $this->facturaModel->db->transComplete();

        if ($this->facturaModel->db->transStatus() === false) {
            session()->setFlashdata('error', 'La anulación de la factura y la reversión de stock fallaron.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        session()->setFlashdata('success', 'Factura N°' . $id . ' ha sido ANULADA y el inventario revertido con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    public function generatePdf($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
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

        $html = view('facturas/pdf_template', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Factura_' . $id . '.pdf';
        $dompdf->stream($filename, ["Attachment" => false]);

        exit();
    }
}