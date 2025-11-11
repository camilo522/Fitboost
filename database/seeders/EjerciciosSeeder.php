<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EjerciciosSeeder extends Seeder
{
    public function run(): void
    {
        $ejercicios = [];

        // Posibles valores para campos con opciones
        $categorias = ['Fuerza', 'Cardio', 'Resistencia', 'Flexibilidad', 'HIIT'];
        $gruposMusculares = ['Pectoral', 'Espalda', 'Piernas', 'Bíceps', 'Tríceps', 'Abdomen', 'Hombros'];
        $dificultades = ['Principiante', 'Intermedio', 'Avanzado'];
        $intensidades = ['Baja', 'Media', 'Alta'];
        $equipos = ['Ninguno', 'Mancuernas', 'Barra', 'Máquina', 'Banda elástica', 'Pesas rusas'];

        for ($i = 1; $i <= 15; $i++) {
            $nombre = [
                'Sentadillas',
                'Flexiones de pecho',
                'Peso muerto',
                'Press militar',
                'Plancha abdominal',
                'Curl de bíceps',
                'Fondos de tríceps',
                'Dominadas',
                'Zancadas',
                'Elevaciones laterales',
                'Burpees',
                'Mountain climbers',
                'Crunch abdominal',
                'Extensión de piernas',
                'Press de banca'
            ][$i - 1];

            $ejercicios[] = [
                'nombre' => $nombre,
                'descripcion' => 'Ejercicio de entrenamiento enfocado en el grupo muscular correspondiente. Mejora fuerza y resistencia.',
                'categoria' => $categorias[array_rand($categorias)],
                'grupoMuscular' => $gruposMusculares[array_rand($gruposMusculares)],
                'dificultad' => $dificultades[array_rand($dificultades)],
                'duracionEstimada' => rand(10, 45),
                'intensidad' => $intensidades[array_rand($intensidades)],
                'equipoNecesario' => $equipos[array_rand($equipos)],
                'imagenURL' => 'https://example.com/imagenes/ejercicio' . $i . '.jpg',
                'videoURL' => 'https://example.com/videos/ejercicio' . $i . '.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('ejercicios')->insert($ejercicios);
    }
}


