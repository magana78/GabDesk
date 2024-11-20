<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id_rol
 * @property string $nombre_rol
 * 
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'id_rol';
	public $timestamps = false;

	protected $fillable = [
		'nombre_rol'
	];

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class, 'usuariosroles', 'id_rol', 'id_usuario');
	}
	
	public function permissions()
{
    return $this->belongsToMany(Permission::class, 'permission_role', 'id_rol', 'id_permission');
}
}
