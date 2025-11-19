<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ValoracionesSeeder extends Seeder
{
    public function run(): void
    {
        $valoraciones = [];

        for ($i = 1; $i <= 10; $i++) {
            $valoraciones[] = [
                'idUsuario' => rand(1, 10), // Cambia según existan usuarios
                'fecha' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                'altura' => rand(150, 200),
                'peso' => rand(50, 100),

                'pecho' => rand(80, 120),
                'cintura' => rand(60, 100),
                'cadera' => rand(80, 120),

                'brazoIzquierdo' => rand(20, 45),
                'brazoDerecho' => rand(20, 45),
                'antebrazoIzquierdo' => rand(15, 35),
                'antebrazoDerecho' => rand(15, 35),

                'piernaIzquierda' => rand(40, 70),
                'piernaDerecha' => rand(40, 70),
                'pantorrillaIzquierda' => rand(25, 45),
                'pantorrillaDerecha' => rand(25, 45),

                'fechaRegistro' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('valoraciones')->insert($valoraciones);
    }
}
