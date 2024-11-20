<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Lógica específica para el Administrador
        return view('admin.dashboard');  // Vistas específicas para el Administrador
    }
}
