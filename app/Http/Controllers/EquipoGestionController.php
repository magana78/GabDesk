<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class EquipoGestionController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with([
            'imagenesequipos' => function ($query) {
                $query->take(1); // Cargar solo la primera imagen
            },
            'usuario', // Cargar el usuario asignado
            'dispositivos' // Cargar los dispositivos asociados
        ])->paginate(5);

        return view('tecnico.equipos_gestion_index', compact('equipos'));
    }

    public function create()
    {
        $dispositivos = Dispositivo::all();
        return view('tecnico.equipos_gestion_create', compact('dispositivos'));
    }

    public function store(Request $request)
    {
        // Crear el equipo
        $equipo = Equipo::create($request->only(['nombre_equipo', 'descripcion', 'numero_serie', 'estado_equipo']));

        // Seleccionar los 4 dispositivos predeterminados
        $dispositivos = Dispositivo::whereIn('id_dispositivo', [1, 2, 3, 4])->get();

        // Adjuntar dispositivos al equipo y actualizar su cantidad
        foreach ($dispositivos as $dispositivo) {
            if ($dispositivo->cantidad > 0) {
                $equipo->dispositivos()->attach($dispositivo->id_dispositivo);
                $dispositivo->decrement('cantidad', 1);
            }
        }

        return redirect()->route('tecnico.equipos.gestion.index')->with('success', 'Equipo creado con éxito y dispositivos asignados automáticamente.');
    }

    public function show(Equipo $equipo)
    {
        $equipo->load('dispositivos.accesorios');
        return view('tecnico.equipos_gestion_show', compact('equipo'));
    }

    public function addAccessory(Request $request, Equipo $equipo)
    {
        $dispositivo = Dispositivo::find($request->input('dispositivo_id'));

        if ($dispositivo && $dispositivo->cantidad > 0) {
            $equipo->dispositivos()->attach($dispositivo->id_dispositivo);
            $dispositivo->decrement('cantidad', 1);
        }

        return redirect()->back()->with('success', 'Dispositivo agregado con éxito.');
    }
}
