<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadosticket
 * 
 * @property int $id_estado_ticket
 * @property string $estado
 * @property Carbon $fecha_cambio
 * @property int|null $id_ticket
 * 
 * @property Ticket|null $ticket
 *
 * @package App\Models
 */
class Estadosticket extends Model
{
	protected $table = 'estadosticket';
	protected $primaryKey = 'id_estado_ticket';
	public $timestamps = false;

	protected $casts = [
		'fecha_cambio' => 'datetime',
		'id_ticket' => 'int'
	];

	protected $fillable = [
		'estado',
		'fecha_cambio',
		'id_ticket'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class, 'id_ticket');
	}
}
