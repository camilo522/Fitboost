<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('entrenamientos')->insert([
            [
                'idValoracion' => 1,
                'nombre' => 'Hipertrofia Avanzada',
                'descripcion' => 'Rutina enfocada en ganancia muscular',
                'objetivo' => 'Ganar masa muscular',
                'duracion' => '12 semanas',
                'nivel' => 'Intermedio',
                'diasSemana' => 'Lunes a Viernes',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}