<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValoracionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Desactivar la verificación de llaves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Ahora MySQL te dejará limpiar la tabla sin problemas
        DB::table('valoraciones')->truncate();

        DB::table('valoraciones')->insert([
            [
                'id' => 1,
                'idUsuario' => 1, // Camilo Rojas
                'fecha' => now()->subDays(5)->format('Y-m-d'),
                'altura' => 175,
                'peso' => 74.50,
                'pecho' => 98,
                'cintura' => 82,
                'cadera' => 94,
                'brazoIzquierdo' => 34,
                'brazoDerecho' => 34,
                'antebrazoIzquierdo' => 28,
                'antebrazoDerecho' => 28,
                'piernaIzquierda' => 54,
                'piernaDerecha' => 55,
                'pantorrillaIzquierda' => 36,
                'pantorrillaDerecha' => 36,
                'fechaRegistro' => now()->subDays(5)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'idUsuario' => 2, // Kevin Sanchez
                'fecha' => now()->subDays(2)->format('Y-m-d'),
                'altura' => 180,
                'peso' => 82.00,
                'pecho' => 104,
                'cintura' => 86,
                'cadera' => 98,
                'brazoIzquierdo' => 36,
                'brazoDerecho' => 37,
                'antebrazoIzquierdo' => 30,
                'antebrazoDerecho' => 30,
                'piernaIzquierda' => 58,
                'piernaDerecha' => 58,
                'pantorrillaIzquierda' => 38,
                'pantorrillaDerecha' => 38,
                'fechaRegistro' => now()->subDays(2)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'idUsuario' => 3, // Cristian Solano
                'fecha' => now()->format('Y-m-d'),
                'altura' => 178,
                'peso' => 76.20,
                'pecho' => 100,
                'cintura' => 80,
                'cadera' => 95,
                'brazoIzquierdo' => 35,
                'brazoDerecho' => 35,
                'antebrazoIzquierdo' => 29,
                'antebrazoDerecho' => 29,
                'piernaIzquierda' => 56,
                'piernaDerecha' => 56,
                'pantorrillaIzquierda' => 37,
                'pantorrillaDerecha' => 37,
                'fechaRegistro' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. Volver a activar la verificación de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}