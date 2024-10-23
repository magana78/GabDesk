<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
                $table->id(); // Crea la clave primaria 'id'
                $table->string('nombre'); // Nombre del dispositivo
                $table->string('modelo')->nullable(); // Modelo del dispositivo (opcional)
                $table->string('marca')->nullable(); // Marca del dispositivo (opcional)
                $table->timestamps(); // Crea campos 'created_at' y 'updated_at'
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispositivos', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('modelo');
            $table->dropColumn('marca');

        });
    }
};
