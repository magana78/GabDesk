<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipodispositivo
 * 
 * @property int $id_equipo
 * @property int $id_dispositivo
 * 
 * @property Equipo $equipo
 * @property Dispositivo $dispositivo
 *
 * @package App\Models
 */
class Equipodispositivo extends Model
{
	protected $table = 'equipodispositivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_equipo' => 'int',
		'id_dispositivo' => 'int'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'id_equipo');
	}

	public function dispositivo()
	{
		return $this->belongsTo(Dispositivo::class, 'id_dispositivo');
	}
}
