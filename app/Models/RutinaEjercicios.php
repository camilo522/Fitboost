<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RutinaEjercicios extends Model
{
   

    protected $fillable = [
        'idRutina',
        'idEjercicio',
        'series',
        'repeticiones',
        'orden'
    ];

    // Una fila pertenece a una rutina
    public function rutina()
    {
        return $this->belongsTo(rutinas::class, 'idRutina');
    }

    // Una fila pertenece a un ejercicio
    public function ejercicio()
    {
        return $this->belongsTo(ejercicios::class, 'idEjercicio');
    }
}
