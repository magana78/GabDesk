<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SoporteTecnicoController extends Controller
{
    public function showAssignForm()
    {
        $usuarios = User::all();
        return view('tickets.asignar', compact('usuarios'));
    }

    public function asignarTicket(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'ticket_id' => 'required|exists:tickets,id_ticket',
        ]);

        $ticket = Ticket::find($request->ticket_id);
        $ticket->id_usuario_asignado = $request->usuario_id;
        $ticket->save();

        return redirect()->route('tecnico.index')->with('success', 'Ticket asignado correctamente.');
    }
}