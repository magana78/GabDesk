<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $id_permission
 * @property string $nombre_permission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permissions';
	protected $primaryKey = 'id_permission';

	protected $fillable = [
		'nombre_permission'
	];

	public function roles()
{
    return $this->belongsToMany(Role::class, 'permission_role', 'id_permission', 'id_rol');
}
}

