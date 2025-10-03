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
    Schema::create('rutina_ejercicios', function (Blueprint $table) {
        $table->id(); // Primary Key autoincremental (1, 2, 3...)
        $table->unsignedBigInteger('idRutina');   // Relación con tabla rutinas
        $table->unsignedBigInteger('idEjercicio'); // Relación con tabla ejercicios
        $table->integer('series');
        $table->integer('repeticiones');
        $table->integer('orden')->nullable();

        // Relaciones foráneas
        $table->foreign('idRutina')->references('id')->on('rutinas')->onDelete('cascade');
        $table->foreign('idEjercicio')->references('id')->on('ejercicios')->onDelete('cascade');

        // Restricción de unicidad para no repetir la misma combinación rutina + ejercicio
        $table->unique(['idRutina', 'idEjercicio']);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RutinaEjercicios');
    }
};
