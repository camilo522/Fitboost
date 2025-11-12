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
    Schema::create('planes_nutricionales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade'); // Relación con la tabla usuarios
        $table->integer('calorias_diarias');
        $table->integer('proteinas_gramos'); // en gramos
        $table->integer('carbohidratos_gramos'); // en gramos
        $table->integer('grasas_gramos'); // añadimos grasas para completar
        $table->text('consejos_adicionales')->nullable(); // Un campo para consejos extra
        $table->boolean('activo')->default(true); // Para saber si este es el plan actual del usuario
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes_nutricionales');
    }
};
