<?php

namespace App\Traits;

use App\Models\Ticket;
use Illuminate\Support\Facades\Request;

trait AsignarTicketTrait
{
    /**
     * Asigna un técnico a un ticket y actualiza las observaciones.
     *
     * @param Ticket $ticket
     * @param int $userId
     */
    public function asignarTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $nuevoUsuario = $request->input('usuario_id');
        $ticket->id_usuario_asignado = $nuevoUsuario;
        $ticket->save();
    
        $nombreUsuario = $ticket->asignado->nombre ?? 'Sin asignar';
        return response()->json(['success' => true, 'message' => 'Usuario asignado con éxito.', 'nuevoAsignado' => $nombreUsuario]);
    }
}
