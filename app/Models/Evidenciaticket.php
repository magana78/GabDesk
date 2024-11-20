<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evidenciaticket
 * 
 * @property int $id_evidencia
 * @property int|null $id_ticket
 * @property string $nombre_archivo
 * @property string $extension
 * @property string $ruta
 * @property Carbon $fecha_subida
 * 
 * @property Ticket|null $ticket
 *
 * @package App\Models
 */
class Evidenciaticket extends Model
{
	protected $table = 'evidenciaticket';
	protected $primaryKey = 'id_evidencia';
	public $timestamps = false;

	protected $casts = [
		'id_ticket' => 'int',
		'fecha_subida' => 'datetime'
	];

	protected $fillable = [
		'id_ticket',
		'nombre_archivo',
		'extension',
		'ruta',
		'fecha_subida'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class, 'id_ticket');
	}
}
