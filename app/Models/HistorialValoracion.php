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

    protected $casts = [
        'fecha' => 'date',
        'fechaRegistro' => 'datetime',
        'fecha_historial' => 'datetime',
    ];

    // 🔗 Relación con la valoración original
    public function valoracion()
    {
        return $this->belongsTo(Valoraciones::class, 'valoracion_id');
    }

    // 🔗 Relación con el usuario que hizo la valoración
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    // 🕒 Establece automáticamente la fecha del historial
    protected static function booted()
    {
        static::creating(function ($historial) {
            if (!$historial->fecha_historial) {
                $historial->fecha_historial = now();
            }
        });
    }

    // ⚙️ Solo registrar CREAR y EDITAR (sin eliminar)
    public static function registrarHistorial($valoracion, $tipoAccion)
    {
        // Solo permitimos "CREACIÓN" o "ACTUALIZACIÓN"
        if (!in_array($tipoAccion, ['CREACIÓN', 'ACTUALIZACIÓN'])) {
            return;
        }

        self::create([
            'valoracion_id'       => $valoracion->id,
            'idUsuario'           => $valoracion->idUsuario,
            'fecha'               => $valoracion->fecha,
            'altura'              => $valoracion->altura,
            'peso'                => $valoracion->peso,
            'pecho'               => $valoracion->pecho,
            'cintura'             => $valoracion->cintura,
            'cadera'              => $valoracion->cadera,
            'brazoIzquierdo'      => $valoracion->brazoIzquierdo,
            'brazoDerecho'        => $valoracion->brazoDerecho,
            'antebrazoIzquierdo'  => $valoracion->antebrazoIzquierdo,
            'antebrazoDerecho'    => $valoracion->antebrazoDerecho,
            'piernaIzquierda'     => $valoracion->piernaIzquierda,
            'piernaDerecha'       => $valoracion->piernaDerecha,
            'pantorrillaIzquierda'=> $valoracion->pantorrillaIzquierda,
            'pantorrillaDerecha'  => $valoracion->pantorrillaDerecha,
            'fechaRegistro'       => $valoracion->fechaRegistro,
            'tipo_accion'         => $tipoAccion,
            'fecha_historial'     => now(),
        ]);
    }
}
