<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class ReporteController extends Controller
{
    public function index()
    {


        // Datos de ejemplo - aquí deberías hacer las consultas reales
        // $ticketsPendientes = Ticket::where('estado', 'pendiente')->count();
        // $ticketsEnProceso = Ticket::where('estado', 'en proceso')->count();
        // $ticketsResueltos = Ticket::where('estado', 'resuelto')->count();
        // $tecnicosActivos = User::where('role', 'tecnico')->where('activo', true)->count(); // Reemplaza con tu lógica de técnicos activos
        // $ticketsCerrados = Ticket::where('estado', 'cerrado')->count();
        
        // // Calcula el tiempo promedio de respuesta en horas
        // $tiempoPromedioRespuesta = Ticket::whereNotNull('tiempo_respuesta')->avg('tiempo_respuesta'); // Reemplaza según tu modelo

        // // Pasa los datos a la vista
        // return view('admin.reportes_index', compact(
        //     'ticketsPendientes', 
        //     'ticketsEnProceso', 
        //     'ticketsResueltos', 
        //     'tecnicosActivos', 
        //     'ticketsCerrados', 
        //     'tiempoPromedioRespuesta'
        // ));
    }
}
