<?php

namespace App\Observers;

use App\Models\Valoracion;
use App\Models\HistorialValoracion;
use App\Models\valoraciones;

class ValoracionObserver
{
    private $creadas = [];

    public function created(valoraciones $valoracion)
    {
        $this->creadas[] = $valoracion->id;
        $this->registrarHistorial($valoracion, 'CREACIÓN');
    }

    public function updated(valoraciones $valoracion)
    {
        // Evita duplicar si el update se ejecuta justo después del create
        if (in_array($valoracion->id, $this->creadas)) {
            return;
        }

        $this->registrarHistorial($valoracion, 'ACTUALIZACIÓN');
    }

    

    private function registrarHistorial(valoraciones $valoracion, string $accion)
    {
        HistorialValoracion::create([
            'valoracion_id'         => $valoracion->id,
            'idUsuario'             => $valoracion->idUsuario,
            'fecha'                 => $valoracion->fecha,
            'altura'                => $valoracion->altura,
            'peso'                  => $valoracion->peso,
            'pecho'                 => $valoracion->pecho,
            'cintura'               => $valoracion->cintura,
            'cadera'                => $valoracion->cadera,
            'brazoIzquierdo'        => $valoracion->brazoIzquierdo,
            'brazoDerecho'          => $valoracion->brazoDerecho,
            'antebrazoIzquierdo'    => $valoracion->antebrazoIzquierdo,
            'antebrazoDerecho'      => $valoracion->antebrazoDerecho,
            'piernaIzquierda'       => $valoracion->piernaIzquierda,
            'piernaDerecha'         => $valoracion->piernaDerecha,
            'pantorrillaIzquierda'  => $valoracion->pantorrillaIzquierda,
            'pantorrillaDerecha'    => $valoracion->pantorrillaDerecha,
            'fechaRegistro'         => $valoracion->fechaRegistro,
            'tipo_accion'           => $accion,
            'fecha_historial'       => now(),
        ]);
    }
}
