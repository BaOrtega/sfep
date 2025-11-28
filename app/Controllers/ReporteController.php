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
        $this->reporteModel = new ReporteModel();
        $this->facturaModel = new FacturaModel();
        $this->clienteModel = new ClienteModel();
        $this->productoModel = new ProductoModel();
    }

    // DASHBOARD PRINCIPAL DE REPORTES
    public function index()
    {
        $data['title'] = "Reportes y Análisis";
        
        // KPIs usando el nuevo modelo
        $data['kpi_total_facturado'] = $this->reporteModel->getTotalFacturado();
        $data['kpi_total_clientes'] = $this->clienteModel->countAll();
        $data['topProductos'] = $this->reporteModel->getTopProductos(5);
        
        // Estadísticas adicionales
        $data['distribucionEstados'] = $this->reporteModel->getDistribucionEstados();
        $data['estadisticasMensuales'] = $this->reporteModel->getEstadisticasMensuales();

        return view('reportes/index', $data);
    }

    // REPORTE DE VENTAS POR PERIODO
    public function ventasPorPeriodo()
    {
        $data['title'] = "Reporte de Ventas por Período";

        if ($this->request->getMethod() === 'post') {
            $fechaInicio = $this->request->getPost('fecha_inicio');
            $fechaFin = $this->request->getPost('fecha_fin');
            $estado = $this->request->getPost('estado');

            // Usar el modelo para obtener los datos
            $data['facturas'] = $this->reporteModel->getVentasPorPeriodo($fechaInicio, $fechaFin, $estado);
            $data['filtros'] = [
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'estado' => $estado
            ];

            // Calcular totales
            $data['total_ventas'] = array_sum(array_column($data['facturas'], 'total_factura'));
            $data['total_facturas'] = count($data['facturas']);
            $data['total_impuestos'] = array_sum(array_column($data['facturas'], 'total_impuestos'));

        } else {
            // Por defecto, mostrar último mes
            $data['facturas'] = [];
            $data['filtros'] = [
                'fecha_inicio' => date('Y-m-01'),
                'fecha_fin' => date('Y-m-t'),
                'estado' => 'TODOS'
            ];
            $data['total_ventas'] = 0;
            $data['total_facturas'] = 0;
            $data['total_impuestos'] = 0;
        }

        return view('reportes/ventas', $data);
    }

    // REPORTE DE CUENTAS POR COBRAR
    public function cuentasPorCobrar()
    {
        $data['title'] = "Cuentas por Cobrar";

        $data['facturasPendientes'] = $this->reporteModel->getCuentasPorCobrar();
        $data['total_pendiente'] = array_sum(array_column($data['facturasPendientes'], 'total_factura'));

        return view('reportes/cuentas_cobrar', $data);
    }

    // REPORTE DE CLIENTES
    public function clientes()
    {
        $data['title'] = "Reporte de Clientes";

        $data['topClientes'] = $this->reporteModel->getTopClientes(10);
        $data['totalClientes'] = $this->clienteModel->countAll();

        return view('reportes/clientes', $data);
    }

    // REPORTE DE PRODUCTOS
    public function productos()
    {
        $data['title'] = "Reporte de Productos";

        $data['bajoInventario'] = $this->reporteModel->getProductosBajoInventario(5);
        $data['productosRentables'] = $this->reporteModel->getProductosRentables();
        $data['totalProductos'] = $this->productoModel->where('activo', 1)->countAllResults();

        return view('reportes/productos', $data);
    }

    // EXPORTAR REPORTE DE VENTAS A PDF
    public function exportarVentasPDF()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio');
        $fechaFin = $this->request->getGet('fecha_fin');
        $estado = $this->request->getGet('estado');

        // Usar el modelo para obtener datos
        $data['facturas'] = $this->reporteModel->getVentasPorPeriodo($fechaInicio, $fechaFin, $estado);
        $data['filtros'] = ['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin, 'estado' => $estado];
        $data['title'] = "Reporte de Ventas";

        // Calcular totales para el PDF
        $data['total_ventas'] = array_sum(array_column($data['facturas'], 'total_factura'));
        $data['total_facturas'] = count($data['facturas']);

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