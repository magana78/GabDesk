<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 * 
 * @property int $id_area
 * @property string $nombre_area
 * @property int|null $id_departamento
 * 
 * @property Departamento|null $departamento
 * @property Collection|Ubicacione[] $ubicaciones
 *
 * @package App\Models
 */
class Area extends Model
{
	protected $table = 'areas';
	protected $primaryKey = 'id_area';
	public $timestamps = false;

	protected $casts = [
		'id_departamento' => 'int'
	];

	protected $fillable = [
		'nombre_area',
		'id_departamento'
	];

	public function departamento()
	{
		return $this->belongsTo(Departamento::class, 'id_departamento');
	}

	public function ubicaciones()
	{
		return $this->hasMany(Ubicacione::class, 'id_area');
	}
}
