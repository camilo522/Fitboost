<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class asigEntreUsuario extends Model
{
    protected $table = 'asigEntreUsuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idRutina',
        'idEjercicio',
       'fechaAsignacion',
    ];

    // Relaciones
    public function rutina()
    {
        return $this->belongsTo(rutinas::class, 'idRutina');
    }

    public function ejercicio()
    {
        return $this->belongsTo(ejercicios::class, 'idEjercicio');
    }
}
