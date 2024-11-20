<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Imagenesequipo
 * 
 * @property int $id_imagen
 * @property int|null $id_equipo
 * @property string $nombre_archivo
 * @property string $extension
 * @property string $ruta
 * @property Carbon $fecha_subida
 * 
 * @property Equipo|null $equipo
 *
 * @package App\Models
 */
class Imagenesequipo extends Model
{
	protected $table = 'imagenesequipo';
	protected $primaryKey = 'id_imagen';
	public $timestamps = false;

	protected $casts = [
		'id_equipo' => 'int',
		'fecha_subida' => 'datetime'
	];

	protected $fillable = [
		'id_equipo',
		'nombre_archivo',
		'extension',
		'ruta',
		'fecha_subida'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'id_equipo');
	}
}
