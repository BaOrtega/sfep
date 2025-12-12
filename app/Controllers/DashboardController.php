<?php namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\ProductoModel;
use App\Models\FacturaModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // Ya verificado por filtros de autenticación
        
        $clienteModel = new ClienteModel();
        $productoModel = new ProductoModel();
        $facturaModel = new FacturaModel();
        
        $data = [];
        
        // Estadísticas básicas para todos los roles
        $data['totalClientes'] = $clienteModel->countAll();
        $data['totalProductos'] = $productoModel->countAll();
        
        // Estadísticas según rol
        if ($this->isAdmin()) {
            // Admin ve todo
            $data['totalFacturas'] = $facturaModel->countAll();
            $data['facturasEmitidas'] = $facturaModel->where('estado', 'EMITIDA')->countAllResults();
            $data['facturasPagadas'] = $facturaModel->where('estado', 'PAGADA')->countAllResults();
            $data['facturasAnuladas'] = $facturaModel->where('estado', 'ANULADA')->countAllResults();
            
            // Total de ventas
            $ventasTotales = $facturaModel->selectSum('total_factura')->where('estado', 'PAGADA')->first();
            $data['totalVentas'] = $ventasTotales['total_factura'] ?? 0;
            
            // Facturas recientes
            $data['facturasRecientes'] = $facturaModel
                ->select('facturas.*, clientes.nombre as cliente_nombre')
                ->join('clientes', 'clientes.id = facturas.cliente_id')
                ->orderBy('fecha_emision', 'DESC')
                ->limit(5)
                ->findAll();
        } else {
            // Vendedor ve solo sus facturas
            $usuario_id = $this->getUserId();
            $data['totalFacturas'] = $facturaModel->where('usuario_id', $usuario_id)->countAllResults();
            $data['facturasEmitidas'] = $facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'EMITIDA')->countAllResults();
            $data['facturasPagadas'] = $facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'PAGADA')->countAllResults();
            $data['facturasAnuladas'] = $facturaModel->where('usuario_id', $usuario_id)
                ->where('estado', 'ANULADA')->countAllResults();
            
            // Total de ventas del vendedor
            $misVentas = $facturaModel->selectSum('total_factura')
                ->where('usuario_id', $usuario_id)
                ->where('estado', 'PAGADA')
                ->first();
            $data['totalVentas'] = $misVentas['total_factura'] ?? 0;
            
            // Facturas recientes del vendedor
            $data['facturasRecientes'] = $facturaModel
                ->select('facturas.*, clientes.nombre as cliente_nombre')
                ->join('clientes', 'clientes.id = facturas.cliente_id')
                ->where('usuario_id', $usuario_id)
                ->orderBy('fecha_emision', 'DESC')
                ->limit(5)
                ->findAll();
        }
        
        $data['title'] = "Dashboard";
        
        return $this->renderView('dashboard/index', $data);
    }
}