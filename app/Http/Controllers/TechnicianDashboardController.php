<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnicianDashboardController extends Controller
{
    public function index()
    {
        // Lógica específica para el Técnico
        return view('tecnico.dashboard');  // Vistas específicas para el Técnico
    }
}
