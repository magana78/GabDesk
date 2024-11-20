<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Asegúrate de importar DB aquí
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            // Crear el usuario
            $usuario = Usuario::create([
                'nombre' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Contraseña para todos los usuarios de prueba
                'estado' => 'activo'
            ]);

            // Asignar un rol aleatorio al usuario
            $id_rol = $faker->randomElement([1, 2, 3]); // 1: Administrador, 2: Supervisor, 3: Tecnico de Soporte
            DB::table('usuariosroles')->insert([
                'id_usuario' => $usuario->id_usuario,
                'id_rol' => $id_rol
            ]);
        }
    }
}
