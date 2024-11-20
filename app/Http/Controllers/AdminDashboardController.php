<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
 
        // Lógica específica para el Administrador
        public function index()
        {
            $roles = Role::all();

            $usuarios = Usuario::whereHas('roles', function ($query) {
                $query->where('nombre_rol', 'Técnico de Soporte');
            })->get();
        
            // Obtener los tickets paginados
            $tickets = Ticket::paginate(10); // Paginar con 10 elementos por página
            $totalTickets = Ticket::count(); // Contar el total de tickets
        
            // Obtener el rol de "Técnico de Soporte"
            $tecnicoRole = Role::where('nombre_rol', 'Técnico de Soporte')->first();
        
            // Obtener los usuarios con el rol "Técnico de Soporte"
            $totalTecnicos = $usuarios->count(); // Contar usuarios con el rol "Técnico de Soporte"
        
            // Verifica los resultados
        
            return view('admin.dashboard', compact('roles', 'usuarios', 'tickets', 'totalTickets', 'totalTecnicos'));
        }
        
        
}
