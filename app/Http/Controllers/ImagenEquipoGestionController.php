<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Imagenesequipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenEquipoGestionController extends Controller
{
    public function create(Equipo $equipo)
    {
        return view('tecnico.equipos_gestion_add_image', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048'
        ]);

        // Guarda la imagen en "storage/app/public/equipos"
        $archivo = $request->file('imagen');
        $ruta = $archivo->store('equipos', 'public'); // Esto devuelve "equipos/nombre_archivo.jpg"

        // Guarda solo la ruta relativa en la base de datos
        Imagenesequipo::create([
            'id_equipo' => $equipo->id_equipo,
            'nombre_archivo' => $archivo->getClientOriginalName(),
            'extension' => $archivo->getClientOriginalExtension(),
            'ruta' => $ruta, // Solo "equipos/nombre_archivo.jpg"
            'fecha_subida' => now()
        ]);

        return redirect()->route('tecnico.equipos.gestion.index')->with('success', 'Imagen agregada con éxito.');
    }
}
