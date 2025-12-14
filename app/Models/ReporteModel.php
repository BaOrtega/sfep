<?php namespace App\Models;

use CodeIgniter\Model;

class ReporteModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * REPORTE DE VENTAS POR PERIODO - VERSIÓN CORREGIDA
     */
    
    public function getVentasPorPeriodo($fechaInicio = null, $fechaFin = null, $estado = null)
{
    $builder = $this->db->table('facturas f');
    $builder->select('
        f.id,
        f.fecha_emision,
        f.fecha_vencimiento,
        f.subtotal,
        f.total_impuestos,
        f.total_factura,
        f.estado,
        f.moneda,
        c.nombre as cliente_nombre,
        c.nit as cliente_nit,
        u.nombre as usuario_creador
    ');
    $builder->join('clientes c', 'c.id = f.cliente_id', 'left');
    $builder->join('usuarios u', 'u.id = f.usuario_id', 'left');

    // Aplicar filtros
    if ($fechaInicio) {
        $builder->where('DATE(f.fecha_emision) >=', $fechaInicio);
    }
    if ($fechaFin) {
        $builder->where('DATE(f.fecha_emision) <=', $fechaFin);
    }
    // CORREGIDO: Solo filtrar por estado si no es 'TODOS'
    if ($estado && $estado !== 'TODOS') {
        $builder->where('f.estado', $estado);
    }

    $builder->orderBy('f.fecha_emision', 'DESC');
    
    return $builder->get()->getResultArray();
}

public function getEstadisticasVentasPorPeriodo($inicio, $fin, $estado)
{
    $builder = $this->db->table('facturas f');
    $builder->select('
        COUNT(*) as total_facturas,
        COALESCE(SUM(f.total_factura), 0) as total_ventas,
        COALESCE(SUM(f.total_impuestos), 0) as total_impuestos,
        COALESCE(AVG(f.total_factura), 0) as promedio_venta
    ');
    
    // Aplicar filtros de fechas (USAR LA MISMA LÓGICA QUE getVentasPorPeriodo)
    if ($inicio) {
        $builder->where('f.fecha_emision >=', $inicio);
    }
    if ($fin) {
        $builder->where('f.fecha_emision <=', $fin);
    }
    
    // Aplicar filtro de estado si no es 'TODOS'
    if ($estado !== 'TODOS') {
        $builder->where('f.estado', $estado);
    }

    $result = $builder->get()->getRowArray();

    // DEBUG: Verificar resultados
    // log_message('debug', 'Estadísticas para ' . $inicio . ' a ' . $fin . ': ' . print_r($result, true));

    return [
        'total_facturas'  => $result['total_facturas'] ?? 0,
        'total_ventas'    => $result['total_ventas'] ?? 0,
        'total_impuestos' => $result['total_impuestos'] ?? 0,
        'promedio_venta'  => $result['promedio_venta'] ?? 0,
    ];
}

    /**
     * KPI - TOTAL FACTURADO (SOLO FACTURAS PAGADAS)
     */
    public function getTotalFacturado()
    {
        $builder = $this->db->table('facturas');
        $builder->selectSum('total_factura');
        $builder->where('estado', 'PAGADA');
        
        $result = $builder->get()->getRow();
        return $result ? (float)$result->total_factura : 0;
    }

    /**
     * TOP PRODUCTOS MÁS VENDIDOS
     */
    public function getTopProductos($limit = 5)
    {
        $builder = $this->db->table('detalle_factura df');
        $builder->select('
            p.nombre as nombre_producto,
            p.precio_unitario,
            SUM(df.cantidad) as total_cantidad_vendida,
            SUM(df.total_linea) as total_ingresos_generados,
            COUNT(DISTINCT df.factura_id) as total_facturas
        ');
        $builder->join('productos p', 'p.id = df.producto_id');
        $builder->join('facturas f', 'f.id = df.factura_id');
        $builder->where('f.estado', 'PAGADA');
        $builder->groupBy('df.producto_id, p.nombre, p.precio_unitario');
        $builder->orderBy('total_cantidad_vendida', 'DESC');
        $builder->limit($limit);

        return $builder->get()->getResultArray();
    }

    /**
     * CUENTAS POR COBRAR (FACTURAS EMITIDAS PENDIENTES)
     */
    public function getCuentasPorCobrar()
    {
        $builder = $this->db->table('facturas f');
        $builder->select('
            f.*,
            c.nombre as cliente_nombre,
            c.nit as cliente_nit,
            c.telefono,
            DATEDIFF(CURDATE(), f.fecha_emision) as dias_transcurridos,
            DATEDIFF(f.fecha_vencimiento, CURDATE()) as dias_para_vencer
        ');
        $builder->join('clientes c', 'c.id = f.cliente_id');
        $builder->where('f.estado', 'EMITIDA');
        $builder->orderBy('f.fecha_emision', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * REPORTE DE CLIENTES - TOP COMPRADORES
     */
    public function getTopClientes($limit = 10)
    {
        $builder = $this->db->table('facturas f');
        $builder->select('
            c.id,
            c.nombre,
            c.nit,
            c.email,
            COUNT(f.id) as total_facturas,
            SUM(f.total_factura) as total_compras,
            AVG(f.total_factura) as promedio_compra,
            MAX(f.fecha_emision) as ultima_compra
        ');
        $builder->join('clientes c', 'c.id = f.cliente_id');
        $builder->where('f.estado', 'PAGADA');
        $builder->groupBy('c.id, c.nombre, c.nit, c.email');
        $builder->orderBy('total_compras', 'DESC');
        $builder->limit($limit);

        return $builder->get()->getResultArray();
    }

    /**
     * REPORTE DE PRODUCTOS - BAJO INVENTARIO
     */
    public function getProductosBajoInventario($limite = 5)
    {
        $builder = $this->db->table('productos');
        $builder->select('*');
        $builder->where('inventario <=', $limite);
        $builder->where('activo', 1);
        $builder->orderBy('inventario', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * REPORTE DE PRODUCTOS - RENTABILIDAD
     */
    public function getProductosRentables()
    {
        $builder = $this->db->table('detalle_factura df');
        $builder->select('
            p.id,
            p.nombre,
            p.precio_unitario,
            p.costo,
            (p.precio_unitario - p.costo) as margen_bruto,
            ROUND(((p.precio_unitario - p.costo) / p.precio_unitario * 100), 2) as margen_porcentaje,
            SUM(df.cantidad) as total_vendido,
            SUM(df.total_linea) as total_ingresos,
            (SUM(df.cantidad) * (p.precio_unitario - p.costo)) as utilidad_total
        ');
        $builder->join('productos p', 'p.id = df.producto_id');
        $builder->join('facturas f', 'f.id = df.factura_id');
        $builder->where('f.estado', 'PAGADA');
        $builder->groupBy('p.id, p.nombre, p.precio_unitario, p.costo');
        $builder->orderBy('utilidad_total', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * ESTADÍSTICAS MENSUALES DE VENTAS
     */
    public function getEstadisticasMensuales($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        $builder = $this->db->table('facturas f');
        $builder->select('
            MONTH(f.fecha_emision) as mes,
            YEAR(f.fecha_emision) as año,
            COUNT(f.id) as total_facturas,
            SUM(f.total_factura) as total_ventas,
            AVG(f.total_factura) as promedio_venta,
            SUM(f.total_impuestos) as total_impuestos
        ');
        $builder->where('YEAR(f.fecha_emision)', $year);
        $builder->where('f.estado', 'PAGADA');
        $builder->groupBy('YEAR(f.fecha_emision), MONTH(f.fecha_emision)');
        $builder->orderBy('año, mes', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * DISTRIBUCIÓN DE ESTADOS DE FACTURAS
     */
    public function getDistribucionEstados()
    {
        $builder = $this->db->table('facturas');
        $builder->select('
            estado,
            COUNT(*) as cantidad,
            SUM(total_factura) as monto_total
        ');
        $builder->groupBy('estado');
        $builder->orderBy('cantidad', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * VENTAS POR CLIENTE DETALLADO
     */
    public function getVentasPorCliente($clienteId = null)
    {
        $builder = $this->db->table('facturas f');
        $builder->select('
            f.*,
            c.nombre as cliente_nombre,
            c.nit,
            (SELECT SUM(cantidad) FROM detalle_factura WHERE factura_id = f.id) as total_productos
        ');
        $builder->join('clientes c', 'c.id = f.cliente_id');
        $builder->where('f.estado', 'PAGADA');

        if ($clienteId) {
            $builder->where('f.cliente_id', $clienteId);
        }

        $builder->orderBy('f.fecha_emision', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * MÉTODO AUXILIAR: VALIDAR FECHA
     */
    private function esFechaValida($fecha)
    {
        $patron = '/^\d{4}-\d{2}-\d{2}$/';
        if (preg_match($patron, $fecha)) {
            $partes = explode('-', $fecha);
            if (count($partes) === 3) {
                list($anio, $mes, $dia) = $partes;
                return checkdate($mes, $dia, $anio);
            }
        }
        return false;
    }

    /**
     * MÉTODO AUXILIAR: DEPURAR CONSULTAS
     */
    public function debugQuery($fechaInicio = null, $fechaFin = null, $estado = null)
    {
        $builder = $this->db->table('facturas f');
        $builder->select('COUNT(*) as total');
        
        if (!empty($fechaInicio) && $this->esFechaValida($fechaInicio)) {
            $builder->where('DATE(f.fecha_emision) >=', $fechaInicio);
        }
        if (!empty($fechaFin) && $this->esFechaValida($fechaFin)) {
            $builder->where('DATE(f.fecha_emision) <=', $fechaFin);
        }
        if (!empty($estado) && $estado !== 'TODOS') {
            $builder->where('f.estado', $estado);
        }
        
        $sql = $builder->getCompiledSelect();
        $result = $builder->get()->getRowArray();
        
        return [
            'sql' => $sql,
            'total' => $result['total'] ?? 0
        ];
    }
}