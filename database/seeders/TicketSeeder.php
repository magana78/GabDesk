<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Genera 20 tickets de prueba
        for ($i = 1; $i <= 20; $i++) {
            Ticket::create([
                'titulo' => 'Ticket de prueba ' . $i,
                'descripcion' => 'Descripción del ticket de prueba ' . $i,
                'fecha_creacion' => Carbon::now(),
                'fecha_resolucion' => Carbon::now()->addDays(rand(1, 10)),
                'estado_ticket' => 'pendiente', // o el estado inicial que uses
                'prioridad' => rand(1, 3), // Cambia los valores de prioridad según tu lógica
                'observaciones' => 'Observaciones del ticket de prueba ' . $i,
                'confirmado_por_usuario' => rand(0, 1), // 0 o 1 para simular confirmación
                'fecha_confirmacion' => rand(0, 1) ? Carbon::now() : null,
                'id_usuario_reportante' => 2, // ID de supervisor o cambia según tu rol de supervisor
                'id_usuario_asignado' => null, // Puede ser null al inicio
                'id_equipo' => rand(1, 10), // Cambia según los ID de equipos que tengas
            ]);
        }
    }
}
