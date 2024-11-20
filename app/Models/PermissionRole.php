<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRole
 * 
 * @property int $id
 * @property int $id_rol
 * @property int $id_permission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PermissionRole extends Model
{
	protected $table = 'permission_role';

	protected $casts = [
		'id_rol' => 'int',
		'id_permission' => 'int'
	];

	protected $fillable = [
		'id_rol',
		'id_permission'
	];
}
