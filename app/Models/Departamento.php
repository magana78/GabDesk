<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 * 
 * @property int $id_departamento
 * @property string $nombre_departamento
 * 
 * @property Collection|Area[] $areas
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Departamento extends Model
{
	protected $table = 'departamentos';
	protected $primaryKey = 'id_departamento';
	public $timestamps = false;

	protected $fillable = [
		'nombre_departamento'
	];

	public function areas()
	{
		return $this->hasMany(Area::class, 'id_departamento');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'id_departamento');
	}
}
