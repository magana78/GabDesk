<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacione
 * 
 * @property int $id_notificacion
 * @property string $mensaje
 * @property Carbon $fecha_envio
 * @property int|null $id_usuario_destinatario
 * @property string $estado
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Notificacione extends Model
{
	protected $table = 'notificaciones';
	protected $primaryKey = 'id_notificacion';
	public $timestamps = false;

	protected $casts = [
		'fecha_envio' => 'datetime',
		'id_usuario_destinatario' => 'int'
	];

	protected $fillable = [
		'mensaje',
		'fecha_envio',
		'id_usuario_destinatario',
		'estado'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_destinatario');
	}
}
