<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 * 
 * @property int $id_equipo
 * @property string $nombre_equipo
 * @property string|null $descripcion
 * @property string|null $numero_serie
 * @property string $estado_equipo
 * @property int|null $id_usuario_asignado
 * 
 * @property Usuario|null $usuario
 * @property Collection|Dispositivo[] $dispositivos
 * @property Collection|Imagenesequipo[] $imagenesequipos
 * @property Collection|Ticket[] $tickets
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Equipo extends Model
{
	protected $table = 'equipo';
	protected $primaryKey = 'id_equipo';
	public $timestamps = false;

	protected $casts = [
		'id_usuario_asignado' => 'int'
	];

	protected $fillable = [
		'nombre_equipo',
		'descripcion',
		'numero_serie',
		'estado_equipo',
		'id_usuario_asignado'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario_asignado');
	}

	public function dispositivos()
	{
		return $this->belongsToMany(Dispositivo::class, 'equipodispositivo', 'id_equipo', 'id_dispositivo');
	}

	public function imagenes()
	{
		return $this->hasMany(Imagenesequipo::class, 'id_equipo');
	}

	public function imagenesequipos()
	{
		return $this->hasMany(Imagenesequipo::class, 'id_equipo');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_equipo');
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'usuarioequipo', 'id_equipo', 'id_usuario')
					->withPivot('fecha_asignacion');
	}
}
