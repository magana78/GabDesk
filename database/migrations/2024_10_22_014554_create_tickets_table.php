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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id_ticket')->comment('Identificador único del ticket');
            $table->string('titulo', 255)->comment('Titulo del ticket');
            $table->text('descripcion')->comment('Descripcion detallada del ticket');
            $table->dateTime('fecha_creacion')->comment('Fecha de creacion del ticket');
            $table->dateTime('fecha_resolucion')->nullable()->comment('Fecha en que se resolvió el ticket');
            $table->enum('estado_ticket', ['pendiente', 'en proceso', 'resuelto', 'cerrado'])->comment('Estado actual del ticket');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->comment('Prioridad del ticket');
            $table->text('observaciones')->nullable()->comment('Observaciones relacionadas con el ticket');
            $table->boolean('confirmado_por_usuario')->default(false)->comment('Indica si el usuario ha confirmado la resolución');
            $table->dateTime('fecha_confirmacion')->nullable()->comment('Fecha en que el usuario confirmó la resolución');
            $table->foreignId('id_usuario_reportante')->nullable()->constrained('usuarios')->comment('Usuario que reportó el ticket');
            $table->foreignId('id_usuario_asignado')->nullable()->constrained('usuarios')->comment('Usuario asignado para resolver el ticket');
            $table->foreignId('id_dispositivo')->nullable()->constrained('dispositivos')->comment('Dispositivo asociado al ticket');
            $table->timestamps(); // Esto añade las columnas created_at y updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('id_ticket');
            $table->dropColumn('titulo');
            $table->dropColumn('descripcion');
            $table->dropColumn('fecha_creacion');
            $table->dropColumn('fecha_resolucion');
            $table->dropColumn('estado_ticket');
            $table->dropColumn('prioridad');
            $table->dropColumn('observaciones');
            $table->dropColumn('confirmado_por_usuario');
            $table->dropColumn('id_usuario_reportante');
            $table->dropColumn('id_usuario_asignado');
            $table->dropColumn('id_dispositivo');




            
        });
    }
};
