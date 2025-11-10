<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutinaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rutinas')->insert([
            [
                'idEntrenamiento' => 1,
                'nombre' => 'Usuario 1',
                'horario' => '06:00:00',
                'descripcion' => 'Rutina enfocada en fuerza y resistencia para el usuario 1.'
            ],
            [
                'idEntrenamiento' => 2,
                'nombre' => 'Usuario 2',
                'horario' => '09:00:00',
                'descripcion' => 'Rutina enfocada en fuerza y resistencia para el usuario 2.'
            ],
            [
                'idEntrenamiento' => 3,
                'nombre' => 'Usuario 3',
                'horario' => '07:30:00',
                'descripcion' => 'Rutina enfocada en fuerza y resistencia para el usuario 3.'
            ],
            [
                'idEntrenamiento' => 1,
                'nombre' => 'Usuario 4',
                'horario' => '08:00:00',
                'descripcion' => 'Rutina enfocada en fuerza y resistencia para el usuario 4.'
            ],
            [
                'idEntrenamiento' => 2,
                'nombre' => 'Usuario 5',
                'horario' => '10:00:00',
                'descripcion' => 'Rutina enfocada en fuerza y resistencia para el usuario 5.'
            ],
        ]);
    }
}