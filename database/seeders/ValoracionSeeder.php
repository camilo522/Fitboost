<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValoracionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('valoraciones')->insert([
            [
                'idUsuario' => 1,
                'fecha' => now(),
                'altura' => 175,
                'peso' => 72.5,
                'pecho' => 95,
                'cintura' => 80,
                'cadera' => 92,
                'brazoIzquierdo' => 32,
                'brazoDerecho' => 33,
                'antebrazoIzquierdo' => 28,
                'antebrazoDerecho' => 28,
                'piernaIzquierda' => 55,
                'piernaDerecha' => 56,
                'pantorrillaIzquierda' => 36,
                'pantorrillaDerecha' => 36,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}