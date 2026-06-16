<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjercicioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ejercicios')->insert([
            [
                'nombre' => 'Press de banca',
                'descripcion' => 'Ejercicio para pecho',
                'categoria' => 'Fuerza',
                'grupoMuscular' => 'Pecho',
                'dificultad' => 'Media',
                'duracionEstimada' => 15,
                'intensidad' => 'Alta',
                'equipoNecesario' => 'Barra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fondos',
                'descripcion' => 'Ejercicio para triceps',
                'categoria' => 'Calistenia',
                'grupoMuscular' => 'Triceps',
                'dificultad' => 'Alta',
                'duracionEstimada' => 10,
                'intensidad' => 'Media',
                'equipoNecesario' => 'Paralelas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}