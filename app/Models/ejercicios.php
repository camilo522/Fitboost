<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ejercicios extends Model
{
  protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'grupoMuscular',
        'dificultad',
        'duracionEstimada',
        'intensidad',
        'equipoNecesario',
        'imagenURL',
        'videoURL'
    ];

    // Un ejercicio puede estar en muchas rutinas
    public function rutinas()
    {
        return $this->belongsToMany(rutinas::class, 'rutina_ejercicios', 'idEjercicio', 'idRutina')
                    ->withPivot('series', 'repeticiones', 'orden');
    }
}
