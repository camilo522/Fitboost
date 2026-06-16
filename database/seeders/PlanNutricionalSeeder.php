<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanNutricionalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('planes_nutricionales')->insert([
            [
                'id_usuario' => 1,
                'calorias_diarias' => 2800,
                'proteinas_gramos' => 180,
                'carbohidratos_gramos' => 320,
                'grasas_gramos' => 70,
                'consejos_adicionales' => 'Consumir suficiente agua',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}