<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear entrenamientos base
        DB::table('entrenamientos')->insert([
            [
                'id' => 1,
                'idValoracion' => 1, // Conectado a la valoración creada antes
                'nombre' => 'Plan de Definición Muscular',
                'descripcion' => 'Rutinas enfocadas en la pérdida de grasa y retención de músculo.',
                'objetivo' => 'Quema de grasa',
                'duracion' => '8 Semanas',
                'nivel' => 'Intermedio',
                'diasSemana' => 'Lunes, Miércoles, Viernes',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'idValoracion' => null,
                'nombre' => 'Aumento de Fuerza Base',
                'descripcion' => 'Enfoque estricto en ejercicios multiarticulares pesados.',
                'objetivo' => 'Fuerza pura',
                'duracion' => '12 Semanas',
                'nivel' => 'Avanzado',
                'diasSemana' => 'Martes, Jueves, Sábado',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. Sembrar tabla pivote de asignación de usuarios (asigEntreUsuario)
        DB::table('asigEntreUsuario')->insert([
            [
                'idUsuario' => 1,
                'idEntrenamiento' => 1,
                'fechaAsignacion' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idUsuario' => 2,
                'idEntrenamiento' => 2,
                'fechaAsignacion' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}