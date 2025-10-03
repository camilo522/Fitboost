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
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->string('categoria', 50)->nullable();
            $table->string('grupoMuscular', 50)->nullable();
            $table->string('dificultad', 50)->nullable(); 
            $table->integer('duracionEstimada')->nullable();
            $table->string('intensidad', 50)->nullable(); 
            $table->string('equipoNecesario', 100)->nullable();
            $table->string('imagenURL', 255)->nullable();
            $table->string('videoURL', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
