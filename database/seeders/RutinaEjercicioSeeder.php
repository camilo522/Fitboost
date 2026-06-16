<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutinaEjercicioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rutina_ejercicios')->insert([
            [
                'idRutina' => 1,
                'idEjercicio' => 1,
                'series' => 4,
                'repeticiones' => 12,
                'orden' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 1,
                'idEjercicio' => 2,
                'series' => 3,
                'repeticiones' => 15,
                'orden' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}