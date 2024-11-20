<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ubicacione
 * 
 * @property int $id_ubicacion
 * @property string $nombre_ubicacion
 * @property int|null $id_area
 * 
 * @property Area|null $area
 * @property Collection|Cubiculo[] $cubiculos
 * @property Collection|Dispositivo[] $dispositivos
 *
 * @package App\Models
 */
class Ubicacione extends Model
{
	protected $table = 'ubicaciones';
	protected $primaryKey = 'id_ubicacion';
	public $timestamps = false;

	protected $casts = [
		'id_area' => 'int'
	];

	protected $fillable = [
		'nombre_ubicacion',
		'id_area'
	];

	public function area()
	{
		return $this->belongsTo(Area::class, 'id_area');
	}

	public function cubiculos()
	{
		return $this->hasMany(Cubiculo::class, 'id_ubicacion');
	}

	public function dispositivos()
	{
		return $this->hasMany(Dispositivo::class, 'id_ubicacion');
	}
}
