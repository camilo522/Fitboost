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
        Schema::create('rutinas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('idEntrenamiento');
        $table->string('nombre', 100);
        $table->time('horario');
        $table->text('descripcion');

        $table->timestamps();

        $table->foreign('idEntrenamiento')->references('id')->on('entrenamientos');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutinas');
    }
};
