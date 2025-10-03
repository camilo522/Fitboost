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
       Schema::create('valoraciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('idUsuario');
        $table->date('fecha');
        $table->integer('altura');
        $table->decimal('peso', 5, 2);
        $table->integer('pecho');
        $table->integer('cintura');
        $table->integer('cadera');
        $table->integer('brazoIzquierdo');
        $table->integer('brazoDerecho');
        $table->integer('antebrazoIzquierdo');
        $table->integer('antebrazoDerecho');
        $table->integer('piernaIzquierda');
        $table->integer('piernaDerecha');
        $table->integer('pantorrillaIzquierda');
        $table->integer('pantorrillaDerecha');
        $table->date('fechaRegistro');
        
        
        $table->timestamps();

        $table->foreign('idUsuario')->references('id')->on('usuarios');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};
