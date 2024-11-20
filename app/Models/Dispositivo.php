<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dispositivo
 * 
 * @property int $id_dispositivo
 * @property string $tipo_dispositivo
 * @property string|null $marca
 * @property string|null $modelo
 * @property bool $estado_dispositivo
 * @property int $cantidad
 * @property int|null $id_ubicacion
 * 
 * @property Ubicacione|null $ubicacione
 * @property Collection|Accesorio[] $accesorios
 * @property Collection|Equipo[] $equipos
 *
 * @package App\Models
 */
class Dispositivo extends Model
{
	protected $table = 'dispositivos';
	protected $primaryKey = 'id_dispositivo';
	public $timestamps = false;

	protected $casts = [
		'estado_dispositivo' => 'bool',
		'cantidad' => 'int',
		'id_ubicacion' => 'int'
	];

	protected $fillable = [
		'tipo_dispositivo',
		'marca',
		'modelo',
		'estado_dispositivo',
		'cantidad',
		'id_ubicacion'
	];

	public function ubicacione()
	{
		return $this->belongsTo(Ubicacione::class, 'id_ubicacion');
	}

	public function accesorios()
	{
		return $this->hasMany(Accesorio::class, 'id_dispositivo');
	}

	public function equipos()
	{
		return $this->belongsToMany(Equipo::class, 'equipodispositivo', 'id_dispositivo', 'id_equipo');
	}
}
