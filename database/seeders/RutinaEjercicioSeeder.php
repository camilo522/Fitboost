<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutinaEjercicioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Limpiamos la tabla para evitar duplicados si corres el seeder más de una vez
        DB::table('rutina_ejercicios')->truncate();

        // 2. Insertamos datos asegurándonos de NO repetir la combinación de idRutina e idEjercicio
        DB::table('rutina_ejercicios')->insert([
            [
                'idRutina' => 1,     // Rutina A
                'idEjercicio' => 1,  // Press de Banca (Existe en EjercicioSeeder)
                'series' => 4,
                'repeticiones' => 10,
                'orden' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 1,     // Rutina A
                'idEjercicio' => 3,  // Curl de Bíceps (Existe en EjercicioSeeder)
                'series' => 3,
                'repeticiones' => 12,
                'orden' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 2,     // Rutina B
                'idEjercicio' => 2,  // Sentadillas (Existe en EjercicioSeeder)
                'series' => 4,
                'repeticiones' => 8,
                'orden' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 2,     // Rutina B
                'idEjercicio' => 4,  // Peso Muerto Rumano (Existe en EjercicioSeeder)
                'series' => 4,
                'repeticiones' => 10,
                'orden' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}