<?php namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        // El filtro AuthFilter garantiza que solo usuarios logueados lleguen aquí.
        $data['user_name'] = session()->get('user_name');
        
        // Muestra la vista del dashboard
        return view('dashboard/index', $data);
    }
}