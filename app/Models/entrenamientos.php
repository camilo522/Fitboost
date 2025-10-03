<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class entrenamientos extends Model
{
  protected $fillable = [
        'idValoracion',
        'nombre',
        'descripcion',
        'objetivo',
        'duracion',
        'nivel',
        'diasSemana',
        'estado'
        
    ];


    // Relaciones
    public function valoracion()
    {
        return $this->belongsTo(valoraciones::class, 'idValoracion');
    }

    public function rutinas()
    {
        return $this->hasMany(rutinas::class, 'idEntrenamiento');
    }
}