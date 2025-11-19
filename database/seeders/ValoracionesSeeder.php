<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ValoracionesSeeder extends Seeder
{
    public function run(): void
    {
        // Array para almacenar los registros que se insertarán
        $valoraciones = [];

        // Generar 10 registros de ejemplo con datos de medidas corporales
        for ($i = 1; $i <= 10; $i++) {
            $valoraciones[] = [
                'idUsuario' => $i, // Suponiendo que ya existen usuarios con id del 1 al 10
                'fecha' => Carbon::now(),
                'altura' => rand(150, 190), // altura en cm
                'peso' => rand(50, 100), // peso en kg
                'pecho' => rand(80, 110),
                'cintura' => rand(70, 100),
                'cadera' => rand(80, 110),
                'brazoIzquierdo' => rand(25, 40),
                'brazoDerecho' => rand(25, 40),
                'antebrazoIzquierdo' => rand(20, 30),
                'antebrazoDerecho' => rand(20, 30),
                'piernaIzquierda' => rand(40, 60),
                'piernaDerecha' => rand(40, 60),
                'pantorrillaIzquierda' => rand(30, 45),
                'pantorrillaDerecha' => rand(30, 45),
                'fechaRegistro' => Carbon::now(),
            ];
        }

        // Inserta todos los registros generados en la tabla "valoraciones"
        DB::table('valoraciones')->insert($valoraciones);
    }
}
