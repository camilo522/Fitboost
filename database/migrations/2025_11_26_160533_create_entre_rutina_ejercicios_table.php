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
        Schema::create('asigEntreUsuario', function (Blueprint $table) {
            $table->id();
            
            // FK usuario
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade');

            // FK entrenamiento
            $table->unsignedBigInteger('idEntrenamiento');
            $table->foreign('idEntrenamiento')
                  ->references('id')
                  ->on('entrenamientos')
                  ->onDelete('cascade');

            // fecha asignación
            $table->date('fechaAsignacion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asigEntreUsuario');
    }
};
    