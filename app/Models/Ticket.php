<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    protected $table = 'tickets';
        // Especificar la clave primaria personalizada
        protected $primaryKey = 'id_ticket';

        // Si no utilizas timestamps, indica que no los usas
        public $timestamps = false;
    

    protected $fillable = [
        'titulo', 
        'descripcion', 
        'fecha_creacion', 
        'fecha_resolucion', 
        'estado_ticket', 
        'prioridad', 
        'observaciones', 
        'confirmado_por_usuario', 
        'fecha_confirmacion', 
        'id_usuario_reportante', 
        'id_usuario_asignado', 
        'id_dispositivo'
    ];

}
