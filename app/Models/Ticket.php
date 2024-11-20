<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id_ticket
 * @property string $titulo
 * @property string $descripcion
 * @property Carbon $fecha_creacion
 * @property Carbon|null $fecha_resolucion
 * @property string $estado_ticket
 * @property string $prioridad
 * @property string $observaciones
 * @property bool|null $confirmado_por_usuario
 * @property Carbon|null $fecha_confirmacion
 * @property int $id_usuario_reportante
 * @property int|null $id_usuario_asignado
 * @property int|null $id_equipo
 * 
 * @property Usuario|null $usuario
 * @property Usuario|null $reportante
 * @property Equipo|null $equipo
 * @property Collection|Estadosticket[] $estadostickets
 * @property Collection|Evidenciaticket[] $evidenciatickets
 * @property Collection|Historialestadostickets[] $historialestadostickets
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';
	protected $primaryKey = 'id_ticket';
	public $timestamps = false;

	protected $casts = [
		'fecha_creacion' => 'datetime',
		'fecha_resolucion' => 'datetime',
		'confirmado_por_usuario' => 'bool',
		'fecha_confirmacion' => 'datetime',
		'id_usuario_reportante' => 'int',
		'id_usuario_asignado' => 'int',
		'id_equipo' => 'int'
	];

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
		'id_equipo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_asignado');
	}

	public function reportante()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_reportante');
	}

	public function usuarioReportante()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_reportante');
	}

	public function usuarioAsignado()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_asignado');
	}

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'id_equipo');
	}

	public function estadostickets()
	{
		return $this->hasMany(Estadosticket::class, 'id_ticket');
	}

	public function evidenciatickets()
	{
		return $this->hasMany(Evidenciaticket::class, 'id_ticket');
	}

	public function historialestadostickets()
	{
		return $this->hasMany(Historialestadosticket::class, 'id_ticket');
	}
	public function asignado()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_asignado');
    }

	public function asignarATecnico($userId)
{
    $this->id_usuario_asignado = $userId;
    $this->observaciones .= "\nTicket asignado al usuario ID: " . $userId;
    $this->save();
}


}
