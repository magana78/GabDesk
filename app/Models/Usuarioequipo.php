<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuarioequipo
 * 
 * @property int $id_usuario
 * @property int $id_equipo
 * @property Carbon $fecha_asignacion
 * 
 * @property Usuario $usuario
 * @property Equipo $equipo
 *
 * @package App\Models
 */
class Usuarioequipo extends Model
{
	protected $table = 'usuarioequipo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_equipo' => 'int',
		'fecha_asignacion' => 'datetime'
	];

	protected $fillable = [
		'fecha_asignacion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'id_equipo');
	}
}
