<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialValoracion extends Model
{
    use HasFactory;

    protected $table = 'historial_valoraciones';

    // ✅ Laravel manejará created_at y updated_at automáticamente
    public $timestamps = true;

    protected $fillable = [
        'valoracion_id',
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
        'fechaRegistro',
        'tipo_accion',
        'fecha_historial'
    ];

    // 🔗 Si quieres la relación con la valoración original
    public function valoracion()
    {
        return $this->belongsTo(valoraciones::class, 'valoracion_id');
    }

    // 🔗 Y la relación con el usuario, si existe
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }
}
