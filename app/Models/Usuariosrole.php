<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuariosrole
 * 
 * @property int $id_usuario
 * @property int $id_rol
 * 
 * @property Usuario $usuario
 * @property Role $role
 *
 * @package App\Models
 */
class Usuariosrole extends Model
{
	protected $table = 'usuariosroles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_rol' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_rol');
	}
}
