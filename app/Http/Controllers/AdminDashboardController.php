<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Lógica específica para el Administrador
        return view('admin.dashboard');  // Vistas específicas para el Administrador
    }
}
