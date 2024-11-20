<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Historialestadosticket
 * 
 * @property int $id_historial
 * @property int|null $id_ticket
 * @property string $estado_ticket
 * @property Carbon $fecha_cambio
 * 
 * @property Ticket|null $ticket
 *
 * @package App\Models
 */
class Historialestadosticket extends Model
{
	protected $table = 'historialestadostickets';
	protected $primaryKey = 'id_historial';
	public $timestamps = false;

	protected $casts = [
		'id_ticket' => 'int',
		'fecha_cambio' => 'datetime'
	];

	protected $fillable = [
		'id_ticket',
		'estado_ticket',
		'fecha_cambio'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class, 'id_ticket');
	}
}
