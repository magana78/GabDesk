<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Usuario
 * 
 * @property int $id_usuario
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property string $estado
 * @property int|null $id_departamento
 * @property int|null $id_cubiculo
 * 
 * @property Departamento|null $departamento
 * @property Cubiculo|null $cubiculo
 * @property Collection|Equipo[] $equipos
 * @property Collection|Notificacione[] $notificaciones
 * @property Collection|Ticket[] $tickets
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Usuario extends Authenticatable
{
    
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $casts = [
        'id_departamento' => 'int',
        'id_cubiculo' => 'int'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'nombre',
		'email',
		'password',
		'remember_token',
		'estado',
		'id_departamento',
		'id_cubiculo'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function cubiculo()
    {
        return $this->belongsTo(Cubiculo::class, 'id_cubiculo');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'usuarioequipo', 'id_usuario', 'id_equipo')
                    ->withPivot('fecha_asignacion');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacione::class, 'id_usuario_destinatario');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id_usuario_asignado');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'usuariosroles', 'id_usuario', 'id_rol');
    }

    /**
     * Asigna un rol al usuario.
     *
     * @param string $roleName
     * @return void
     */
    public function assignRole($roleName)
    {
        $role = Role::where('nombre_rol', $roleName)->first();
        if ($role) {
            $this->roles()->attach($role->id_rol);
        }
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('nombre_rol', $roleName)->exists();
    }

    /**
     * Relación con el usuario reportante.
     */
    public function reportante()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_reportante');
    }

    /**
     * Relación con el usuario asignado.
     */
    public function asignado()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_asignado');
    }

    /**
     * Relación con el equipo asociado.
     */
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }
   
    
    
}
