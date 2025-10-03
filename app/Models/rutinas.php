<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rutinas extends Model
{

protected $fillable = [
        'idEntrenamiento',
        'nombre',
        'horario',
        'descripcion'
    ];

    // Relaciones
    public function entrenamiento()
    {
        return $this->belongsTo(entrenamientos::class, 'idEntrenamiento');
    }

    public function ejercicios()
    {
        return $this->belongsToMany(ejercicios::class, 'rutina_ejercicios', 'idRutina', 'idEjercicio')
                    ->withPivot('series', 'repeticiones', 'orden');
    }
}