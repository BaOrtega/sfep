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
        parent::__construct();
        
        $this->facturaModel = new FacturaModel();
        $this->detalleModel = new DetalleFacturaModel();
        $this->clienteModel = new ClienteModel();
        $this->productoModel = new ProductoModel();
        
        // Verificar permisos - ambos roles pueden acceder
        $this->checkPermission(['admin', 'vendedor']);
    }

    // [READ] LISTAR FACTURAS
    public function index()
    {
        $query = $this->facturaModel
            ->select('facturas.*, clientes.nombre as cliente_nombre, clientes.nit as cliente_documento')
            ->distinct()
            ->join('clientes', 'clientes.id = facturas.cliente_id');
        
        // Si es vendedor, filtrar solo sus facturas
        if ($this->isVendedor()) {
            $query->where('facturas.usuario_id', $this->getUserId());
        }
        
        $data['facturas'] = $query->orderBy('facturas.id', 'DESC')->findAll();
        
        // Calcular estadísticas según rol
        if ($this->isAdmin()) {
            $data['totalFacturas'] = $this->facturaModel->countAll();
            $data['facturasEmitidas'] = $this->facturaModel->where('estado', 'EMITIDA')->countAllResults();
            $data['facturasPagadas'] = $this->facturaModel->where('estado', 'PAGADA')->countAllResults();
            $data['facturasAnuladas'] = $this->facturaModel->where('estado', 'ANULADA')->countAllResults();
        } else {
            $usuario_id = $this->getUserId();
            $data['totalFacturas'] = $this->facturaModel->where('usuario_id', $usuario_id)->countAllResults();
            $data['facturasEmitidas'] = $this->facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'EMITIDA')->countAllResults();
            $data['facturasPagadas'] = $this->facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'PAGADA')->countAllResults();
            $data['facturasAnuladas'] = $this->facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'ANULADA')->countAllResults();
        }
        
        $data['title'] = "Gestión de Facturas";
        
        return $this->renderView('facturas/index', $data);
    }

    // [CREATE] MUESTRA EL FORMULARIO DE CREACIÓN
    public function new()
    {
        $data['title'] = "Nueva Factura";
        $data['clientes'] = $this->clienteModel->findAll();
        $data['productos'] = $this->productoModel->where('activo', 1)->findAll();
        $data['fecha_emision'] = date('Y-m-d');
        $data['fecha_vencimiento'] = date('Y-m-d', strtotime('+30 days'));
        
        return $this->renderView('facturas/form', $data);
    }

    // [CREATE/UPDATE] PROCESAR Y GUARDAR FACTURA
    public function save()
    {
        if (!$this->request->is('post')) {
            $this->session->setFlashdata('error', 'Método no permitido.');
            return redirect()->to(url_to('facturas_new'));
        }
        
        $post = $this->request->getPost();
        
        if (empty($post['cliente_id'])) {
            $this->session->setFlashdata('error', 'Debe seleccionar un cliente.');
            return redirect()->back()->withInput();
        }
        
        if (empty($post['detalles_json'])) {
            $this->session->setFlashdata('error', 'Debe agregar al menos un producto a la factura.');
            return redirect()->back()->withInput();
        }
        
        $detalles_json = $post['detalles_json'];
        $detalles_productos = json_decode($detalles_json, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($detalles_productos)) {
            $this->session->setFlashdata('error', 'El detalle de productos está vacío o es inválido.');
            return redirect()->back()->withInput();
        }
        
        $subtotal_general = 0;
        $impuestos_general = 0;

        foreach ($detalles_productos as $detalle) {
            if (!isset($detalle['producto_id'], $detalle['cantidad'])) {
                $this->session->setFlashdata('error', 'Datos de producto incompletos.');
                return redirect()->back()->withInput();
            }
            
            $producto_id = (int)$detalle['producto_id'];
            $cantidad_vendida = (int)$detalle['cantidad'];
            
            if ($cantidad_vendida <= 0) {
                $this->session->setFlashdata('error', 'La cantidad debe ser mayor a 0.');
                return redirect()->back()->withInput();
            }
            
            $productoActual = $this->productoModel->find($producto_id);

            if (!$productoActual) {
                $this->session->setFlashdata('error', 'Producto no encontrado.');
                return redirect()->back()->withInput();
            }
            
            if ($cantidad_vendida > $productoActual['inventario']) {
                $this->session->setFlashdata('error', 'La cantidad de ' . esc($productoActual['nombre']) . 
                    ' excede el inventario disponible (' . $productoActual['inventario'] . ').');
                return redirect()->back()->withInput();
            }

            $precio_unitario = (float)($detalle['precio_unitario_venta'] ?? $productoActual['precio_unitario']);
            $tasa_impuesto = (float)($detalle['iva_porcentaje_venta'] ?? $productoActual['tasa_impuesto']);
            
            $subtotal_linea = $precio_unitario * $cantidad_vendida;
            $impuesto_linea = $subtotal_linea * ($tasa_impuesto / 100);
            
            $subtotal_general += $subtotal_linea;
            $impuestos_general += $impuesto_linea;
        }

        $total_factura = $subtotal_general + $impuestos_general;
        
        if ($total_factura <= 0) {
            $this->session->setFlashdata('error', 'El total de la factura debe ser mayor a 0.');
            return redirect()->back()->withInput();
        }
        
        $usuario_id = $this->getUserId();
        if (!$usuario_id) {
            $this->session->setFlashdata('error', 'Sesión de usuario no válida. Por favor, inicie sesión nuevamente.');
            return redirect()->to('/login');
        }
        
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
        ];
        
        $db = \Config\Database::connect();
        $db->transStart();
        
        try {
            if (!$this->facturaModel->insert($facturaData)) {
                $error = $this->facturaModel->errors();
                throw new \Exception('Error al crear la cabecera de la factura: ' . implode(', ', $error));
            }

            $factura_id = $this->facturaModel->getInsertID();
            
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
                ];
                
                if (!$this->detalleModel->insert($detalleData)) {
                    $error = $this->detalleModel->errors();
                    throw new \Exception('Error al guardar el detalle: ' . implode(', ', $error));
                }
                
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
            
            $this->session->setFlashdata('success', 'Factura N°' . $factura_id . ' emitida con éxito. Total: $' . number_format($total_factura, 2, ',', '.'));
            return redirect()->to(url_to('facturas_index'));
            
        } catch (\Exception $e) {
            $db->transRollback();
            $this->session->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function view($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Factura N°: ' . $id . ' no encontrada.');
        }

        // Verificar permisos: vendedor solo puede ver sus propias facturas
        if ($this->isVendedor() && $factura['usuario_id'] != $this->getUserId()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No tienes permiso para ver esta factura.');
        }

        $cliente = $this->clienteModel->find($factura['cliente_id']);
        $detalles = $this->detalleModel
            ->select('detalle_factura.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_factura.producto_id')
            ->where('factura_id', $id)
            ->findAll();

        $data['title'] = "Detalle de Factura N°" . $id;
        $data['factura'] = $factura;
        $data['cliente'] = $cliente;
        $data['detalles'] = $detalles;
        
        return $this->renderView('facturas/view', $data);
    }

    // [ACTION] CAMBIA EL ESTADO A PAGADA
    public function pagar($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            $this->session->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        // Verificar permisos: vendedor solo puede pagar sus propias facturas
        if ($this->isVendedor() && $factura['usuario_id'] != $this->getUserId()) {
            $this->session->setFlashdata('error', 'No tienes permiso para marcar esta factura como pagada.');
            return redirect()->to(url_to('facturas_index'));
        }

        if ($factura['estado'] == 'ANULADA') {
            $this->session->setFlashdata('warning', 'La factura N°' . $id . ' está anulada y no puede ser marcada como PAGADA.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        $this->facturaModel->update($id, ['estado' => 'PAGADA']);

        $this->session->setFlashdata('success', 'Factura N°' . $id . ' marcada como PAGADA con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    // [ACTION] CAMBIA EL ESTADO A ANULADA Y REVIERTE EL INVENTARIO
    public function anular($id)
    {
        $factura = $this->facturaModel->find($id);
        
        if (empty($factura)) {
            $this->session->setFlashdata('error', 'Factura no encontrada.');
            return redirect()->to(url_to('facturas_index'));
        }

        // Solo admin puede anular (verificado por filtro de ruta)
        if ($factura['estado'] == 'ANULADA') {
            $this->session->setFlashdata('info', 'La Factura N°' . $id . ' ya está ANULADA.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        $this->facturaModel->db->transStart();

        $detalles = $this->detalleModel->where('factura_id', $id)->findAll();
        
        foreach ($detalles as $detalle) {
            $productoId = $detalle['producto_id'];
            $cantidad = $detalle['cantidad'];
            
            $productoActual = $this->productoModel->find($productoId);
            
            if ($productoActual) {
                $nuevo_inventario = $productoActual['inventario'] + $cantidad;
                $this->productoModel->update($productoId, ['inventario' => $nuevo_inventario]);
            }
        }

        $this->facturaModel->update($id, ['estado' => 'ANULADA']);

        $this->facturaModel->db->transComplete();

        if ($this->facturaModel->db->transStatus() === false) {
            $this->session->setFlashdata('error', 'La anulación de la factura y la reversión de stock fallaron.');
            return redirect()->to(url_to('facturas_view', $id));
        }

        $this->session->setFlashdata('success', 'Factura N°' . $id . ' ha sido ANULADA y el inventario revertido con éxito.');
        return redirect()->to(url_to('facturas_view', $id));
    }

    public function generatePdf($id)
    {
        $factura = $this->facturaModel->find($id);

        if (empty($factura)) {
            return redirect()->to(url_to('facturas_index'))->with('error', 'Factura no encontrada para PDF.');
        }

        // Verificar permisos: vendedor solo puede ver sus propias facturas
        if ($this->isVendedor() && $factura['usuario_id'] != $this->getUserId()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No tienes permiso para ver esta factura.');
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