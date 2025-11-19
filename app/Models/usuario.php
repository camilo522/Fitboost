<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'fechaRegistro'
    ];

    protected $hidden = [
        'password',
    ];

    // Auth::attempt usará esta columna
    public function getAuthPassword()
    {
        return $this->password;
    }

    // 🔹 Mutator: siempre guarda la contraseña hasheada
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function valoraciones()
    {
        return $this->hasMany(valoraciones::class, 'idUsuario');
    }

    public function historialValoraciones()
    {
        return $this->hasMany(HistorialValoracion::class, 'idUsuario');
    }

    
}
