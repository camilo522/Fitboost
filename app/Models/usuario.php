<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'contrasena',
        'fechaRegistro'
    ];

    // Relación: un usuario puede tener muchas valoraciones
    public function valoraciones()
    {
        return $this->hasMany(valoraciones::class, 'idUsuario');
    }

    // Relación: un usuario puede tener muchos registros en el historial
    public function historialValoraciones()
    {
        return $this->hasMany(HistorialValoracion::class, 'idUsuario');
    }
}
