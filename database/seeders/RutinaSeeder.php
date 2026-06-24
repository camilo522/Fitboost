<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutinaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear las Rutinas vinculadas a los entrenamientos
        DB::table('rutinas')->insert([
            [
                'id' => 1,
                'idEntrenamiento' => 1,
                'nombre' => 'Rutina A: Torso y Brazos',
                'horario' => '08:00:00',
                'descripcion' => 'Enfoque en tren superior con alta densidad de trabajo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'idEntrenamiento' => 1,
                'nombre' => 'Rutina B: Piernas Completas',
                'horario' => '16:00:00',
                'descripcion' => 'Trabajo pesado enfocado en cuádriceps e isquios.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. Sembrar la tabla de asignación intermedia rutina_ejercicios
        DB::table('rutina_ejercicios')->insert([
            [
                'idRutina' => 1,
                'idEjercicio' => 1, // Press de Banca
                'series' => 4,
                'repeticiones' => 10,
                'orden' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 1,
                'idEjercicio' => 3, // Curl de Bíceps
                'series' => 3,
                'repeticiones' => 12,
                'orden' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRutina' => 2,
                'idEjercicio' => 2, // Sentadillas
                'series' => 4,
                'repeticiones' => 8,
                'orden' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}