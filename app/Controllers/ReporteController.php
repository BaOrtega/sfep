<?php namespace App\Controllers;

use App\Models\ReporteModel;
use App\Models\FacturaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;

class ReporteController extends BaseController
{
    protected $reporteModel;
    protected $facturaModel;
    protected $clienteModel;
    protected $productoModel;

    public function __construct()
    {
        parent::__construct();
        
        $this->reporteModel = new ReporteModel();
        $this->facturaModel = new FacturaModel();
        $this->clienteModel = new ClienteModel();
        $this->productoModel = new ProductoModel();
        
        // Solo admin puede acceder
        $this->checkPermission('admin');
    }

    // DASHBOARD PRINCIPAL DE REPORTES
    public function index()
    {
        $data['title'] = "Reportes y Análisis";
        
        $data['kpi_total_facturado'] = $this->reporteModel->getTotalFacturado();
        $data['kpi_total_clientes'] = $this->clienteModel->countAll();
        $data['topProductos'] = $this->reporteModel->getTopProductos(5);
        $data['distribucionEstados'] = $this->reporteModel->getDistribucionEstados();
        $data['estadisticasMensuales'] = $this->reporteModel->getEstadisticasMensuales();

        return $this->renderView('reportes/index', $data);
    }

    public function ventasPorPeriodo()
{
    $data = [];
    $data['title'] = 'Reporte de Ventas por Período';

    // 1. Inicializar con valores por defecto (mes actual)
    $fechaInicio = date('Y-m-01');
    $fechaFin = date('Y-m-t');
    $estado = 'TODOS';
    
    // 2. Si es POST, usar los datos del formulario
    if ($this->request->getMethod() === 'POST') {
        $fechaInicio = $this->request->getPost('fecha_inicio') ?: $fechaInicio;
        $fechaFin = $this->request->getPost('fecha_fin') ?: $fechaFin;
        $estado = $this->request->getPost('estado') ?: $estado;
        
        // 3. Validar que fecha inicio no sea mayor a fecha fin
        if ($fechaInicio > $fechaFin) {
            // Intercambiar si están invertidas
            [$fechaInicio, $fechaFin] = [$fechaFin, $fechaInicio];
        }
    }
    
    // 4. Obtener datos del modelo
    $data['facturas'] = $this->reporteModel
        ->getVentasPorPeriodo($fechaInicio, $fechaFin, $estado);

    $estadisticas = $this->reporteModel
        ->getEstadisticasVentasPorPeriodo($fechaInicio, $fechaFin, $estado);

    // 5. Preparar datos para la vista
    $data['filtros'] = [
        'fecha_inicio' => $fechaInicio,
        'fecha_fin'    => $fechaFin,
        'estado'       => $estado
    ];
    
    $data['total_ventas']    = $estadisticas['total_ventas'];
    $data['total_facturas']  = $estadisticas['total_facturas'];
    $data['total_impuestos'] = $estadisticas['total_impuestos'];
    $data['promedio_venta']  = $estadisticas['promedio_venta'];

    return view('reportes/ventas', $data);
}


    // REPORTE DE CUENTAS POR COBRAR
    public function cuentasPorCobrar()
    {
        $data['title'] = "Cuentas por Cobrar";
        $data['facturasPendientes'] = $this->reporteModel->getCuentasPorCobrar();
        $data['total_pendiente'] = array_sum(array_column($data['facturasPendientes'], 'total_factura'));

        return $this->renderView('reportes/cuentas_cobrar', $data);
    }

    // REPORTE DE CLIENTES
    public function clientes()
    {
        $data['title'] = "Reporte de Clientes";
        $data['topClientes'] = $this->reporteModel->getTopClientes(10);
        $data['totalClientes'] = $this->clienteModel->countAll();

        return $this->renderView('reportes/clientes', $data);
    }

    // REPORTE DE PRODUCTOS
    public function productos()
    {
        $data['title'] = "Reporte de Productos";
        $data['bajoInventario'] = $this->reporteModel->getProductosBajoInventario(5);
        $data['productosRentables'] = $this->reporteModel->getProductosRentables();
        $data['totalProductos'] = $this->productoModel->where('activo', 1)->countAllResults();

        return $this->renderView('reportes/productos', $data);
    }

    // EXPORTAR REPORTE DE VENTAS A PDF
    public function exportarVentasPDF()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio');
        $fechaFin = $this->request->getGet('fecha_fin');
        $estado = $this->request->getGet('estado');

        $data['facturas'] = $this->reporteModel->getVentasPorPeriodo($fechaInicio, $fechaFin, $estado);
        $data['filtros'] = [
            'fecha_inicio' => $fechaInicio, 
            'fecha_fin' => $fechaFin, 
            'estado' => $estado
        ];
        $data['title'] = "Reporte de Ventas";

        // Obtener estadísticas con filtros
        $estadisticas = $this->reporteModel->getEstadisticasVentasPorPeriodo($fechaInicio, $fechaFin, $estado);
        $data['total_ventas'] = $estadisticas['total_ventas'];
        $data['total_facturas'] = $estadisticas['total_facturas'];

        $html = view('reportes/export/ventas_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = 'Reporte_Ventas_' . date('Y-m-d') . '.pdf';
        $dompdf->stream($filename, ["Attachment" => false]);
        exit();
    }

}