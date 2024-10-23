<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
     // Mostrar todos los tickets
     public function index()
     {
         // Obtener todos los tickets
         $tickets = Ticket::all();
         
         // Retornar la vista con los tickets disponibles
         return view('tecnico.index', compact('tickets'));
     }
 
     // Mostrar el formulario de creación de un ticket
     public function create()
     {
         // Obtener todos los usuarios para asignar a un ticket
         $usuarios = User::all();
         
         // Obtener todos los dispositivos para seleccionar en el ticket
         $dispositivos = Dispositivo::all();
 
         // Retornar la vista para crear un ticket, pasando usuarios y dispositivos
         return view('tecnico.create', compact('usuarios', 'dispositivos'));
     }
 
     // Guardar un nuevo ticket
     public function store(Request $request)
     {
         // Validar los datos del formulario
         $request->validate([
             'titulo' => 'required|max:255',
             'descripcion' => 'required',
             'prioridad' => 'required|in:baja,media,alta',
             'estado_ticket' => 'required|in:pendiente,en proceso,resuelto,cerrado',
             'observaciones' => 'nullable|max:500',
             'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_creacion',
             'confirmado_por_usuario' => 'nullable|boolean',
             'fecha_confirmacion' => 'nullable|date|after_or_equal:fecha_resolucion',
             'id_usuario_asignado' => 'nullable|exists:users,id',
             'id_dispositivo' => 'nullable|exists:dispositivos,id', // Verifica si el dispositivo existe
         ]);
 
         // Preparar los datos para el nuevo ticket
         $data = $request->all();
         $data['fecha_creacion'] = now(); // Fecha actual como fecha de creación del ticket
         $data['id_usuario_reportante'] = Auth::id(); // Usuario autenticado que reporta el ticket
 
         // Crear el ticket en la base de datos
         Ticket::create($data);
 
         // Redirigir a la lista de tickets con un mensaje de éxito
         return redirect()->route('tecnico.index')->with('success', 'Ticket creado exitosamente');
     }
 
     // Mostrar el formulario para editar un ticket existente
     public function edit(Ticket $ticket)
     {
         // Obtener los usuarios y dispositivos para el formulario de edición
         $usuarios = User::all();
         $dispositivos = Dispositivo::all();
 
         // Retornar la vista para editar un ticket con los datos existentes
         return view('tecnico.edit', compact('ticket', 'usuarios', 'dispositivos'));
     }
 
     // Actualizar un ticket existente
     public function update(Request $request, Ticket $ticket)
     {
         // Validar los datos actualizados
         $request->validate([
             'titulo' => 'required|max:255',
             'descripcion' => 'required',
             'prioridad' => 'required|in:baja,media,alta',
             'estado_ticket' => 'required|in:pendiente,en proceso,resuelto,cerrado',
             'observaciones' => 'nullable|max:500',
             'fecha_resolucion' => 'nullable|date|after_or_equal:fecha_creacion',
             'confirmado_por_usuario' => 'nullable|boolean',
             'fecha_confirmacion' => 'nullable|date|after_or_equal:fecha_resolucion',
             'id_usuario_asignado' => 'nullable|exists:users,id',
             'id_dispositivo' => 'nullable|exists:dispositivos,id',
         ]);
 
         // Actualizar los datos del ticket
         $ticket->update($request->all());
 
         // Redirigir a la lista de tickets con un mensaje de éxito
         return redirect()->route('tecnico.index')->with('success', 'Ticket actualizado exitosamente');
     }
 
     // Eliminar un ticket
     public function destroy(Ticket $ticket)
     {
         // Eliminar el ticket de la base de datos
         $ticket->delete();
 
         // Redirigir a la lista de tickets con un mensaje de éxito
         return redirect()->route('tecnico.index')->with('success', 'Ticket eliminado exitosamente');
     }
 }