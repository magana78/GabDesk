<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cubiculo;
use App\Models\Departamento;
use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Usuario;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
use App\Models\Estadosticket;
use App\Models\Evidenciaticket;
use App\Models\Ubicacione;
use App\Traits\AsignarTicketTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TicketController extends Controller
{

    use AsignarTicketTrait;
        public function index(Request $request)
        {
            // Capturar el valor de búsqueda
            $search = $request->input('search');
        
            // Crear la consulta base con filtrado de estado
            $tickets = Ticket::query()
                ->whereIn('estado_ticket', ['pendiente', 'en proceso']); // Excluir 'resuelto' y 'cerrado'
        
            // Aplicar el filtro si hay un valor de búsqueda
            if ($search) {
                $tickets->where(function ($query) use ($search) {
                    $query->where('titulo', 'like', "%{$search}%")
                        ->orWhere('estado_ticket', 'like', "%{$search}%")
                        ->orWhere('prioridad', 'like', "%{$search}%")
                        ->orWhereHas('asignado', function ($q) use ($search) {
                            $q->where('nombre', 'like', "%{$search}%");
                        });
                });
            }
        
            // Cargar las relaciones y aplicar la paginación (5 elementos por página)
            $tickets = $tickets->with('reportante', 'asignado', 'equipo')->paginate(5);
        
            $departamentos = Departamento::all(); // Obtiene todos los departamentos

            // Obtener todos los usuarios
            $usuarios = Usuario::all();
        
            return view('tecnico.index', compact('tickets', 'usuarios','departamentos' ));
        }
    

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'fecha_creacion' => 'required|date',
            'estado_ticket' => 'required|in:pendiente,en proceso,resuelto,cerrado',
            'prioridad' => 'required|in:baja,media,alta',
            'observaciones' => 'nullable|max:500',
            'confirmado_por_usuario' => 'required|boolean',
            'id_usuario_asignado' => 'nullable|exists:usuarios,id',
            'id_dispositivo' => 'nullable|exists:dispositivos,id',
        ]);

        $data = $request->only([
            'titulo', 'descripcion', 'fecha_creacion', 'estado_ticket', 'prioridad', 
            'observaciones', 'confirmado_por_usuario', 'id_usuario_asignado', 'id_dispositivo'
        ]);
        $data['id_usuario_reportante'] = Auth::id();
        
        Ticket::create($data);
        return redirect()->route('tecnico.index')->with('success', 'Ticket creado exitosamente.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'estado_ticket' => 'required|in:pendiente,en proceso,resuelto,cerrado',
            'prioridad' => 'required|in:baja,media,alta',
            'observaciones' => 'nullable|max:500',
            'confirmado_por_usuario' => 'required|boolean',
            'id_usuario_asignado' => 'nullable|exists:usuarios,id',
            'id_dispositivo' => 'nullable|exists:dispositivos,id',
        ]);

        $ticket->update($request->all());
        $ticket->observaciones .= "\nActualizado por usuario ID: " . Auth::id();
        $ticket->save();

        return redirect()->route('tecnico.index')->with('success', 'Ticket actualizado exitosamente.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tecnico.index')->with('success', 'Ticket eliminado exitosamente.');
    }

    public function tomar($id)
    {
        $ticket = Ticket::findOrFail($id);
    
        if ($ticket->estado_ticket === 'pendiente') {
            $ticket->id_usuario_asignado = Auth::id();
            $ticket->estado_ticket = 'en proceso';
            $ticket->observaciones = ($ticket->observaciones ?? '') . "\nTicket tomado por el usuario ID: " . Auth::id();
            $ticket->save();

            return redirect()->route('tecnico.index')->with('success', 'Has tomado el ticket y ha sido asignado a ti.');
        }
    
        return redirect()->route('tecnico.index')->with('error', 'Este ticket ya ha sido tomado por otro técnico o no está pendiente.');
    }

    public function asignarForm($id)
    {
        $ticket = Ticket::findOrFail($id);
        $tecnicos = Usuario::whereHas('roles', function ($query) {
            $query->where('nombre_rol', 'Tecnico de Soporte');
        })->get();

        return view('tecnico.asignar', compact('ticket', 'tecnicos'));
    }

    public function asignar(Request $request, $id)
    {
        $request->validate([
            'id_usuario_asignado' => 'required|exists:usuarios,id_usuario',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->id_usuario_asignado = $request->id_usuario_asignado;
        $ticket->observaciones .= "\nTicket asignado al usuario ID: " . $request->id_usuario_asignado;
        $ticket->save();

        return redirect()->route('tecnico.index')->with('success', 'Ticket asignado exitosamente.');
    }

    public function cambiarEstadoForm($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tecnico.cambiarEstado', compact('ticket'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $nuevoEstado = $request->input('nuevoEstado');
        $ticket->estado_ticket = $nuevoEstado;
        $ticket->save();
    
        return response()->json(['success' => true, 'message' => 'Estado cambiado con éxito.', 'nuevoEstado' => ucfirst($nuevoEstado)]);
    }
    
    public function show($id)
    {
        // Obtener el ticket con sus evidencias sin definir la relación en el modelo
        $ticket = Ticket::findOrFail($id);
        $evidencias = $ticket->hasMany(Evidenciaticket::class, 'id_ticket', 'id_ticket')->get();
    
        return view('tecnico.show', compact('ticket', 'evidencias'));
    }
    
    public function vista($id)
    {
        // Obtener el ticket con sus evidencias sin definir la relación en el modelo
        $ticket = Ticket::findOrFail($id);
        $evidencias = $ticket->hasMany(Evidenciaticket::class, 'id_ticket', 'id_ticket')->get();
    
        return view('admin.vista', compact('ticket', 'evidencias'));
    }
 

    public function uploadEvidencia(Request $request, $ticketId)
    {
        // Validar el archivo solo para tipos de imágenes
        $request->validate([
            'archivo' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,tiff,webp|max:51200', // Extensiones solo de imágenes
        ]);
    
        // Encontrar el ticket
        $ticket = Ticket::findOrFail($ticketId);
    
        // Verificar si el ticket ya tiene 3 evidencias
        $evidenciasCount = Evidenciaticket::where('id_ticket', $ticketId)->count();
        if ($evidenciasCount >= 3) {
            return redirect()->route('tecnico.show', $ticketId)->with('error', 'No puedes subir más de 3 evidencias para este ticket.');
        }
    
        // Guardar el archivo en storage/app/public/evidencias
        $archivo = $request->file('archivo');
        $ruta = $archivo->store('evidencias', 'public');
    
        // Generar la URL pública y forzar el puerto 8000
        $rutaPublica = url('/storage/' . $ruta);
        $rutaPublica = str_replace('localhost', 'localhost:8000', $rutaPublica); // Asegurarse del puerto 8000
    
        // Guardar la información en la base de datos
        Evidenciaticket::create([
            'id_ticket' => $ticket->id_ticket,
            'nombre_archivo' => $archivo->getClientOriginalName(),
            'extension' => $archivo->getClientOriginalExtension(),
            'ruta' => $rutaPublica,
            'fecha_subida' => now(),
        ]);
    
        return redirect()->route('tecnico.show', $ticketId)->with('success', 'Evidencia subida correctamente.');
    }
    
    

    public function deleteEvidencia($evidenciaId)
    {
        // Encontrar la evidencia en la base de datos
        $evidencia = Evidenciaticket::findOrFail($evidenciaId);
    
        // Eliminar el archivo del almacenamiento
        if (Storage::disk('public')->exists(str_replace('/storage/', '', $evidencia->ruta))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $evidencia->ruta));
        }
    
        // Eliminar el registro de la evidencia de la base de datos
        $evidencia->delete();
    
        // Redirigir a la vista del ticket con un mensaje de éxito
        return back()->with('success', 'Evidencia eliminada correctamente.');
    }

    public function adminIndex(Request $request)
    {
        // Capturar el valor de búsqueda
        $search = $request->input('search');
    
        // Crear la consulta base con relaciones necesarias
        $tickets = Ticket::with('reportante', 'asignado', 'equipo');
    
        // Aplicar el filtro si hay un valor de búsqueda
        if ($search) {
            $tickets->where(function ($query) use ($search) {
                $query->where('titulo', 'like', "%{$search}%")
                      ->orWhere('estado_ticket', 'like', "%{$search}%")
                      ->orWhere('prioridad', 'like', "%{$search}%")
                      ->orWhereHas('asignado', function ($q) use ($search) {
                          $q->where('nombre', 'like', "%{$search}%");
                      });
            });
        }
    
        // Obtener los resultados finales con el filtro aplicado
        $tickets = $tickets->get();
    
        // Retornar la vista con los tickets filtrados
        return view('admin.tickets.index', compact('tickets'));
    }
    

public function asignarFormAdmin($id)
{
    // Buscar el ticket específico
    $ticket = Ticket::findOrFail($id);

    // Obtener una lista de todos los técnicos de soporte
    $tecnicos = Usuario::whereHas('roles', function ($query) {
        $query->where('nombre_rol', 'Tecnico de Soporte');
    })->get();

    // Cargar directamente la vista de asignación para el administrador
    return view('admin.asignar', compact('ticket', 'tecnicos'));
}


public function asignarAdmin(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $usuarioId = $request->input('usuario_id');

    // Verificar si el usuario tiene el rol de Técnico de Soporte
    $usuario = Usuario::where('id_usuario', $usuarioId)->whereHas('roles', function ($query) {
        $query->where('nombre_rol', 'Técnico de Soporte');
    })->first();

    if (!$usuario) {
        return response()->json([
            'success' => false,
            'message' => 'El usuario seleccionado no tiene el rol adecuado.'
        ]);
    }

    // Asignar el usuario al ticket
    $ticket->id_usuario_asignado = $usuarioId; // Asegúrate de que el nombre del campo sea correcto
    $ticket->save();
    

    return response()->json([
        'success' => true,
        'message' => 'Ticket asignado exitosamente.',
        'nuevoAsignado' => $usuario->nombre
    ]);
}




public function cambiarEstadoFormAdmin($id)
{
    $ticket = Ticket::findOrFail($id);
    return view('admin.cambiarEstado', compact('ticket'));
}
public function cambiarEstadoAdmin(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $nuevoEstado = $request->input('nuevoEstado');

    if (in_array($nuevoEstado, ['pendiente', 'en proceso', 'resuelto', 'cerrado'])) {
        $ticket->estado_ticket = $nuevoEstado;
        $ticket->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado del ticket actualizado exitosamente.',
            'nuevoEstado' => ucfirst($nuevoEstado)
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Estado inválido.'
    ]);
}





public function agregarObservacion(Request $request, $id)
{
    // Obtén el usuario autenticado como instancia del modelo Usuario
    $usuario = Usuario::find(Auth::id());

    // Verificar que el usuario es el técnico asignado o tiene el rol de administrador
    $ticket = Ticket::findOrFail($id);
    if ($ticket->id_usuario_asignado !== $usuario->id_usuario && !$usuario->hasRole('Técnico de soporte')) {
        return response()->json(['error' => 'No tienes permiso para añadir observaciones a este ticket.'], 403);
    }

    // Concatenar la nueva observación al campo existente de observaciones
    $nuevaObservacion = $request->input('observacion');
    $ticket->observaciones = trim($ticket->observaciones . "\n" . $nuevaObservacion);
    $ticket->save();

    return response()->json(['success' => true, 'observacion' => $nuevaObservacion, 'timestamp' => now()->format('d/m/Y H:i')]);
}
public function detalle($id)
{
    $ticket = Ticket::findOrFail($id);
    $evidencias = $ticket->evidenciatickets()->get(); // Obtiene las evidencias si existe la relación

    return view('tecnico.show', compact('ticket', 'evidencias'));
}

public function cerrarTicket($id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->estado_ticket = 'cerrado'; // Cambia el estado a 'cerrado'
    $ticket->save();

    return response()->json([
        'success' => true, 
        'message' => 'El ticket se ha cerrado exitosamente.',
    ]);
}





public function filterByState($estado)
{
    $validStates = ['pendiente', 'en proceso', 'resuelto', 'cerrado'];
    if (!in_array($estado, $validStates)) {
        return redirect()->route('tecnico.index')->with('error', 'Estado no válido.');
    }

    $tickets = Ticket::where('estado_ticket', $estado)
                    ->with('reportante', 'asignado', 'equipo')
                    ->get();

    return view('tecnico.Gestion', compact('tickets'))->with('selectedEstado', $estado);
}


public function filterTickets($estado = null)
{
    $validStates = ['pendiente', 'en proceso', 'resuelto', 'cerrado'];

    // Si el estado es nulo o vacío, muestra todos los tickets
    if (is_null($estado) || $estado === '') {
        $tickets = Ticket::with('asignado')->get();
    } elseif (in_array($estado, $validStates)) {
        // Si el estado es válido, filtra por el estado proporcionado
        $tickets = Ticket::where('estado_ticket', $estado)->with('asignado')->get();
    } else {
        // Si el estado no es válido, devuelve un error
        return response()->json(['error' => 'Estado no válido.'], 400);
    }

    return response()->json(['tickets' => $tickets]);
}


public function getTicketData()
{
    try {
        // Obtener el conteo de tickets por estado
        $ticketCounts = \App\Models\Ticket::select(DB::raw('LOWER(TRIM(estado_ticket)) as estado_ticket'), DB::raw('count(*) as total'))
            ->groupBy('estado_ticket')
            ->pluck('total', 'estado_ticket')
            ->toArray();

        // Definir todos los posibles estados y asegurarse de que todos estén representados
        $estados = ['pendiente', 'en proceso', 'resuelto', 'cerrado'];
        // Rellenar los estados que faltan con 0
        $ticketCounts = array_merge(array_fill_keys($estados, 0), $ticketCounts);

        // Ordenar los valores según el orden de los estados
        $orderedTicketCounts = [];
        foreach ($estados as $estado) {
            $orderedTicketCounts[] = $ticketCounts[$estado] ?? 0;
        }

        return response()->json($orderedTicketCounts);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

// AdminController.php

public function getAdminTicketData()
{
    // Lógica para obtener los datos de tickets específicos para el administrador
    $ticketCounts = Ticket::select(DB::raw('LOWER(TRIM(estado_ticket)) as estado_ticket'), DB::raw('count(*) as total'))
        ->groupBy('estado_ticket')
        ->pluck('total', 'estado_ticket')
        ->toArray();

    $estados = ['pendiente', 'en proceso', 'resuelto', 'cerrado'];
    $ticketCounts = array_merge(array_fill_keys($estados, 0), $ticketCounts);

    $orderedTicketCounts = [];
    foreach ($estados as $estado) {
        $orderedTicketCounts[] = $ticketCounts[$estado] ?? 0;
    }

    // Devuelve los datos en formato JSON
    return response()->json($orderedTicketCounts);
}

public function getTicketStatistics()
{
    try {
        $pendingTickets = \App\Models\Ticket::where('estado_ticket', 'pendiente')->count();
        $inProgressTickets = \App\Models\Ticket::where('estado_ticket', 'en proceso')->count();
        $resolvedTickets = \App\Models\Ticket::where('estado_ticket', 'resuelto')->count();
        $closedTickets = \App\Models\Ticket::where('estado_ticket', 'cerrado')->count();

        return response()->json([
            'pending' => $pendingTickets,
            'in_progress' => $inProgressTickets,
            'resolved' => $resolvedTickets,
            'closed' => $closedTickets,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



public function cerrarTicketAdmin($id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->estado_ticket = 'cerrado'; // Cambia el estado a 'cerrado'
    $ticket->save();

    return response()->json([
        'success' => true, 
        'message' => 'El ticket se ha cerrado exitosamente.',
    ]);
}

// UsuarioController.php
public function getTecnicosSoporte()
{
    $usuarios = Usuario::whereHas('roles', function ($query) {
        $query->where('nombre_rol', 'Técnico de Soporte');
    })->get(['id_usuario', 'nombre']); // Asegúrate de que los campos coincidan

    return response()->json(['usuarios' => $usuarios]);
}


public function mostrarFormulario(Request $request)
{
    // Obtener todos los departamentos
    $departamentos = Departamento::all();

    // Obtener áreas basadas en el departamento seleccionado
    $areas = collect(); // Inicializar vacío
    if ($request->has('departamento_id')) {
        $departamentoId = $request->input('departamento_id');
        $areas = Area::where('id_departamento', $departamentoId)->get();
    }

    return view('tecnico.filtrarcarteras', compact('departamentos', 'areas'));
}

public function filtrarAreas(Request $request)
{
    $departamentoId = $request->input('departamento_id');
    // Tu lógica de consulta
    $areas = Area::where('id_departamento', $departamentoId)->get(['id_area', 'nombre_area']);
    
    return response()->json(['areas' => $areas]);
}


public function filtrarUbicaciones(Request $request)
{
    $areaId = $request->input('area_id');
    $ubicaciones = Ubicacione::where('id_area', $areaId)->get();
    return response()->json(['ubicaciones' => $ubicaciones]);
}

public function filtrarCubiculos(Request $request)
{
    $ubicacionId = $request->input('ubicacion_id');
    $cubiculos = Cubiculo::where('id_ubicacion', $ubicacionId)->get();
    return response()->json(['cubiculos' => $cubiculos]);
}

public function obtenerInformacionSoporte(Request $request)
{
    $tecnico = Auth::user(); // Obtenemos el usuario autenticado

    if ($tecnico) {
        // Consultar el cubículo relacionado
        $cubiculo = Cubiculo::where('id_cubiculo', $tecnico->id_cubiculo)->first();
        $ubicacion = null;
        $area = null;

        if ($cubiculo) {
            // Obtener la ubicación y el área relacionadas con el cubículo
            $ubicacion = Ubicacione::where('id_ubicacion', $cubiculo->id_ubicacion)->first();
            if ($ubicacion) {
                $area = Area::where('id_area', $ubicacion->id_area)->first();
            }
        }

        // Retorno de la información
        return response()->json([
            'departamento' => $tecnico->id_departamento ?? 'N/A',
            'area' => $area ? $area->nombre_area : 'N/A',
            'ubicacion' => $ubicacion ? $ubicacion->nombre_ubicacion : 'N/A',
            'cubiculo' => $cubiculo ? $cubiculo->id_cubiculo : 'N/A',
        ]);
    }

    return response()->json(['error' => 'Usuario no autenticado o datos incompletos'], 401);
}










    

}