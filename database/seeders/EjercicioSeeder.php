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
                'id' => 1,
                'nombre' => 'Press de Banca',
                'descripcion' => 'Recostado en un banco plano, baja la barra de forma controlada hacia la parte media del pecho y empújala verticalmente extendiendo los brazos sin bloquear los codos.',
                'categoria' => 'Fuerza',
                'grupoMuscular' => 'Pecho',
                'dificultad' => 'Intermedio',
                'duracionEstimada' => 10,
                'intensidad' => 'Alta',
                'equipoNecesario' => 'Barra y Banco Plano',
                'imagenURL' => 'https://static.vecteezy.com/system/resources/previews/008/056/908/non_2x/man-doing-barbell-bench-press-chest-press-flat-illustration-isolated-on-white-background-free-vector.jpg',
                'videoURL' => 'https://fitcron.com/wp-content/uploads/2021/03/00251301-Barbell-Bench-Press_Chest-FIX_720.gif', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Sentadillas con Barra',
                'descripcion' => 'Coloca la barra sobre los trapecios. Baja la cadera rompiendo el paralelo de las rodillas (como si te sentaras), manteniendo la espalda recta y empujando con los talones hacia arriba.',
                'categoria' => 'Fuerza',
                'grupoMuscular' => 'Piernas',
                'dificultad' => 'Avanzado',
                'duracionEstimada' => 12,
                'intensidad' => 'Alta',
                'equipoNecesario' => 'Soporte y Barra',
                'imagenURL' => 'https://static.vecteezy.com/system/resources/previews/006/417/731/non_2x/man-doing-barbell-squat-exercise-flat-illustration-isolated-on-white-background-free-vector.jpg',
                'videoURL' => 'https://fitcron.com/wp-content/uploads/2021/04/15141301-Barbell-Quarter-Squat_Thighs_720.gif', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Curl de Bíceps con Mancuernas',
                'descripcion' => 'De pie, sostén las mancuernas con las palmas hacia el frente. Flexiona los codos manteniendo los brazos pegados al torso, concentrando el esfuerzo únicamente en el bíceps.',
                'categoria' => 'Hipertrofia',
                'grupoMuscular' => 'Brazos',
                'dificultad' => 'Principiante',
                'duracionEstimada' => 8,
                'intensidad' => 'Media',
                'equipoNecesario' => 'Mancuernas',
                'imagenURL' => 'https://static.vecteezy.com/system/resources/previews/008/572/895/non_2x/man-doing-standing-dumbbell-bicep-curls-flat-illustration-isolated-on-different-layers-workout-character-vector.jpg',
                'videoURL' => 'https://i.pinimg.com/originals/7d/3c/de/7d3cdeed84c1c19ad372d5b25beffd08.gif', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Peso Muerto Rumano',
                'descripcion' => 'Sujeta la barra frente a ti, empuja la cadera hacia atrás flexionando ligeramente las rodillas y desciende la barra pegada a tus piernas hasta sentir el estiramiento en los isquiotibiales.',
                'categoria' => 'Fuerza / Hipertrofia',
                'grupoMuscular' => 'Piernas / Espalda baja',
                'dificultad' => 'Intermedio',
                'duracionEstimada' => 10,
                'intensidad' => 'Alta',
                'equipoNecesario' => 'Barra o Mancuernas',
                'imagenURL' => 'https://static.vecteezy.com/system/resources/thumbnails/007/745/857/small/woman-doing-romanian-deadlift-exercise-flat-illustration-isolated-on-white-background-free-vector.jpg',
                'videoURL' => 'https://fitcron.com/wp-content/uploads/2021/04/00851301-Barbell-Romanian-Deadlift_Hips_720.gif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}