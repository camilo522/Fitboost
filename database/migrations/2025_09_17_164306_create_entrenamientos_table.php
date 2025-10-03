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
        Schema::create('entrenamientos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('idValoracion')->nullable(); // ✅ NULL permitido
    $table->string('nombre', 100);
    $table->text('descripcion');
    $table->string('objetivo', 50)->nullable();
    $table->string('duracion', 20)->nullable();
    $table->enum('nivel', ['Principiante','Intermedio','Avanzado']);
    $table->string('diasSemana', 50)->nullable();
    $table->enum('estado', ['Activo','Inactivo'])->default('Activo');
    $table->timestamps();

    $table->foreign('idValoracion')->references('id')->on('valoraciones')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
    }
};
