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

        'fechaRegistro',

        'foto',

    ];

    /**
     * OCULTAR CAMPOS
     */
    protected $hidden = [

        'password',

        'remember_token',

    ];

    /**
     * CASTS
     */
    protected $casts = [

        'fechaRegistro' => 'date',

    ];

    /**
     * AUTH PASSWORD
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * HASH AUTOMÁTICO PASSWORD
     */
    public function setPasswordAttribute($value)
    {

        if (!empty($value)) {

            $this->attributes['password'] = Hash::make($value);

        }

    }

    /**
     * RELACIÓN VALORACIONES
     */
    public function valoraciones()
    {

        return $this->hasMany(
            Valoraciones::class,
            'idUsuario'
        );

    }

    /**
     * RELACIÓN HISTORIAL
     */
    public function historialValoraciones()
    {

        return $this->hasMany(
            HistorialValoracion::class,
            'idUsuario'
        );

    }

    /**
     * RELACIÓN PLANES NUTRICIONALES
     */
    public function planesNutricionales()
    {
        return $this->hasMany(PlanNutricional::class, 'id_usuario');
    }

    /**
     * URL pública de la foto de perfil
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

}