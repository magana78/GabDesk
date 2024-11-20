<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dispositivo;
use Faker\Factory as Faker;

class DispositivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generar 10 dispositivos de ejemplo
        for ($i = 0; $i < 10; $i++) {
            Dispositivo::create([
                'tipo_dispositivo' => $faker->randomElement(['Impresora', 'Computadora', 'Router', 'Teclado', 'Monitor']),
                'marca' => $faker->randomElement(['HP', 'Dell', 'Cisco', 'Logitech', 'Samsung']),
                'modelo' => $faker->bothify('Model-##??'),
                'numero_serie' => $faker->bothify('SN-######'),
                'estado_dispositivo' => $faker->randomElement(['activo', 'inactivo', 'en reparación']),
                'id_ubicacion' => $faker->numberBetween(1, 5), // Asegúrate de que estos IDs de ubicación existan en tu base de datos o usa null si no es relevante
            ]);
        }
    }
}
