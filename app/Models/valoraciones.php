<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class valoraciones extends Model
{
 protected $fillable = [
        'idUsuario',
        'fecha',
        'altura',
        'peso',
        'pecho',
        'cintura',
        'cadera',
        'brazoIzquierdo',
        'brazoDerecho',
        'antebrazoIzquierdo',
        'antebrazoDerecho',
        'piernaIzquierda',
        'piernaDerecha',
        'pantorrillaIzquierda',
        'pantorrillaDerecha',
        'fechaRegistro'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function entrenamientos()
    {
        return $this->hasMany(entrenamientos::class, 'idValoracion');
    }
}