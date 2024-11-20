<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioEquipoGestionController extends Controller
{
    public function assignForm(Equipo $equipo)
    {
        // Obtener solo usuarios que no tienen equipos asociados
        $usuarios = Usuario::doesntHave('equipos')->get();
        return view('tecnico.equipos_gestion_assign_user', compact('equipo', 'usuarios'));
    }

    public function assign(Request $request, Equipo $equipo)
    {
        $usuario = Usuario::find($request->input('usuario_id'));
        if ($usuario && !$usuario->equipos()->exists()) {
            // Asigna el usuario al equipo
            $equipo->usuarios()->attach($usuario->id_usuario, ['fecha_asignacion' => now()]);

            // Actualiza el id_usuario_asignado en el equipo
            $equipo->id_usuario_asignado = $usuario->id_usuario;
            $equipo->save();
        }

        return redirect()->route('tecnico.equipos.gestion.index')->with('success', 'Usuario asignado con éxito.');
    }
}
