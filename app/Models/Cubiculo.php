<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cubiculo
 * 
 * @property int $id_cubiculo
 * @property string $numero_cubiculo
 * @property int|null $id_ubicacion
 * 
 * @property Ubicacione|null $ubicacione
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Cubiculo extends Model
{
	protected $table = 'cubiculos';
	protected $primaryKey = 'id_cubiculo';
	public $timestamps = false;

	protected $casts = [
		'id_ubicacion' => 'int'
	];

	protected $fillable = [
		'numero_cubiculo',
		'id_ubicacion'
	];

	public function ubicacione()
	{
		return $this->belongsTo(Ubicacione::class, 'id_ubicacion');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'id_cubiculo');
	}
}
