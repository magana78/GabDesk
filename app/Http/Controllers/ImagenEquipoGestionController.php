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

    public function store(Request $request, $equipoId)
{
    // Validar el archivo solo para tipos de imágenes
    $request->validate([
        'imagen' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,tiff,webp|max:2048', // Extensiones solo de imágenes
    ]);

    // Encontrar el equipo
    $equipo = Equipo::findOrFail($equipoId);

    // Verificar si el equipo ya tiene 3 imágenes
    $imagenesCount = Imagenesequipo::where('id_equipo', $equipoId)->count();
    if ($imagenesCount >= 2) {
        return redirect()->route('tecnico.equipos_gestion_show', $equipoId)->with('error', 'No puedes subir más de 3 imágenes para este equipo.');
    }

    // Guardar el archivo en storage/app/public/equipos
    $archivo = $request->file('imagen');
    $ruta = $archivo->store('equipos', 'public');

    // Generar la URL pública y forzar el puerto 8000
    $rutaPublica = url('/storage/' . $ruta);
    $rutaPublica = str_replace('localhost', 'localhost:8000', $rutaPublica); // Asegurarse del puerto 8000

    // Guardar la información en la base de datos
    Imagenesequipo::create([
        'id_equipo' => $equipo->id_equipo,
        'nombre_archivo' => $archivo->getClientOriginalName(),
        'extension' => $archivo->getClientOriginalExtension(),
        'ruta' => $rutaPublica,
        'fecha_subida' => now(),
    ]);
        // dd($equipo);
    return redirect()->route('tecnico.equipos_gestion_show', $equipoId)->with('success', 'Imagen agregada correctamente.');
}

    
}
