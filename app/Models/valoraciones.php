<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoraciones extends Model
{
    use HasFactory;

    protected $table = 'valoraciones';

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

    // 🔗 Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    // 🔗 Relación con Entrenamientos (si los usas)
    public function entrenamientos()
    {
        return $this->hasMany(Entrenamientos::class, 'idValoracion');
    }

    // 🔗 Relación con Historial de Valoraciones
    public function historial()
    {
        return $this->hasMany(HistorialValoracion::class, 'valoracion_id');
    }

    
    // app/Models/Valoracion.php

    public function getImcAttribute()
    {
        if (!$this->peso || !$this->altura) {
            return null;
        }

        // Altura viene en cm → convertir a metros
        $alturaMetros = $this->altura / 100;

        // Fórmula IMC = peso / altura²
        return round($this->peso / ($alturaMetros ** 2), 2);
    }


    
}