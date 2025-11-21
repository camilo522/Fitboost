<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ValoracionesSeeder extends Seeder
{
    public function run(): void
    {
        // Array para almacenar los registros que se insertarán en la base de datos
        $valoraciones = [];

        // Diferentes opciones de valoración que se asignarán aleatoriamente
        $opciones = ['Excelente', 'Buena', 'Regular', 'Mala'];

        // Generar 10 registros de ejemplo con datos variados
        for ($i = 1; $i <= 10; $i++) {
            $valoraciones[] = [
                'Nombre' => 'Usuario ' . $i,
                'Horario' => '0' . rand(6, 9) . ':00 AM - ' . rand(10, 12) . ':00 PM',
                'Descripción' => 'Comentario del usuario ' . $i . ' sobre su experiencia de entrenamiento.',
                'Valoración' => rand(1, 5), // Ejemplo: valores numéricos de 1 a 5 (puedes adaptarlo)
                'Opciones' => $opciones[array_rand($opciones)], // Se elige una opción al azar
            ];
        }

        // Inserta todos los registros generados en la tabla "valoraciones"
        DB::table('valoraciones')->insert($valoraciones);
    }
}
