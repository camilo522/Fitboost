<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_valoraciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valoracion_id');
            $table->unsignedBigInteger('idUsuario');
            $table->date('fecha')->nullable();
            $table->integer('altura')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->integer('pecho')->nullable();
            $table->integer('cintura')->nullable();
            $table->integer('cadera')->nullable();
            $table->integer('brazoIzquierdo')->nullable();
            $table->integer('brazoDerecho')->nullable();
            $table->integer('antebrazoIzquierdo')->nullable();
            $table->integer('antebrazoDerecho')->nullable();
            $table->integer('piernaIzquierda')->nullable();
            $table->integer('piernaDerecha')->nullable();
            $table->integer('pantorrillaIzquierda')->nullable();
            $table->integer('pantorrillaDerecha')->nullable();
            $table->date('fechaRegistro')->nullable();
            $table->enum('tipo_accion', ['CREACIÓN', 'ACTUALIZACIÓN', 'ELIMINACIÓN']);
            $table->timestamp('fecha_historial')->useCurrent();

            $table->foreign('valoracion_id')->references('id')->on('valoraciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_valoraciones');
    }
};
