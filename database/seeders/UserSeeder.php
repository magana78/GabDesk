<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  // Verificar si el usuario Administrador ya existe
  if (User::where('email', 'admin@example.com')->doesntExist()) {
    User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'rol' => 'Administrador',
    ]);
}

// Verificar si el usuario Técnico ya existe
if (User::where('email', 'soporte@example.com')->doesntExist()) {
    User::create([
        'name' => 'Soporte User',
        'email' => 'soporte@example.com',
        'password' => Hash::make('password'),
        'rol' => 'Técnico',
    ]);
}
}
}