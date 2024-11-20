<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{

    public function index()
{
    // Recuperar todos los equipos para mostrarlos
    $equipos = Equipo::all();

    // Devolver la vista con los equipos
    return view('tecnico.equipo.index', compact('equipos'));
}

    public function equiposPorEstado($estado)
    {
        // Validar que el estado sea uno de los permitidos
        $estadosPermitidos = ['operativo', 'en reparación', 'fuera de servicio'];
        if (!in_array($estado, $estadosPermitidos)) {
            return redirect()->route('equipos.index')->with('error', 'Estado no válido.');
        }
    
        // Obtener solo los equipos con el estado especificado
        $equipos = Equipo::where('estado_equipo', $estado)->get();
    
        return view('equipos.index', compact('equipos', 'estado'));
    }


    public function cambiarEstadoEquipo(Request $request, $id)
    {
        // Validar que el estado sea uno de los permitidos
        $estadosPermitidos = ['operativo', 'en reparación', 'fuera de servicio'];
        $nuevoEstado = $request->input('estado_equipo');

        if (!in_array($nuevoEstado, $estadosPermitidos)) {
            return redirect()->back()->with('error', 'Estado no válido.');
        }

        // Encontrar el equipo y actualizar su estado
        $equipo = Equipo::findOrFail($id);
        $equipo->estado_equipo = $nuevoEstado;
        $equipo->save();

        return redirect()->back()->with('success', 'Estado del equipo actualizado correctamente.');
    }
}
 


