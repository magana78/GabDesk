<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Supervisor'],
            ['nombre_rol' => 'Tecnico de Soporte'],
            ['nombre_rol' => 'Agente Telefonico'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
