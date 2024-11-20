<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Accesorio
 * 
 * @property int $id_accesorio
 * @property string $nombre_accesorio
 * @property string $tipo_accesorio
 * @property bool $estado_accesorio
 * @property int $cantidad
 * @property int|null $id_dispositivo
 * 
 * @property Dispositivo|null $dispositivo
 *
 * @package App\Models
 */
class Accesorio extends Model
{
	protected $table = 'accesorios';
	protected $primaryKey = 'id_accesorio';
	public $timestamps = false;

	protected $casts = [
		'estado_accesorio' => 'bool',
		'cantidad' => 'int',
		'id_dispositivo' => 'int'
	];

	protected $fillable = [
		'nombre_accesorio',
		'tipo_accesorio',
		'estado_accesorio',
		'cantidad',
		'id_dispositivo'
	];

	public function dispositivo()
	{
		return $this->belongsTo(Dispositivo::class, 'id_dispositivo');
	}
}
