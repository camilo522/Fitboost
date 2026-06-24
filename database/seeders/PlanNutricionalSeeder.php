<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanNutricionalSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la tabla antes de sembrar
        DB::table('planes_nutricionales')->truncate();

        DB::table('planes_nutricionales')->insert([
            [
                'id_usuario' => 1, // Camilo Rojas
                'calorias_diarias' => 2200,
                'proteinas_gramos' => 160,
                'carbohidratos_gramos' => 200,
                'grasas_gramos' => 70,
                'consejos_adicionales' => 'Priorizar el consumo de agua antes y durante el entreno. Mantener déficits moderados.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 2, // Kevin Sanchez
                'calorias_diarias' => 3200,
                'proteinas_gramos' => 180,
                'carbohidratos_gramos' => 400,
                'grasas_gramos' => 95,
                'consejos_adicionales' => 'Mantener un superávit limpio controlando harinas refinadas e incluyendo grasas saludables.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 3, // Cristian Solano
                'calorias_diarias' => 2600,
                'proteinas_gramos' => 165,
                'carbohidratos_gramos' => 280,
                'grasas_gramos' => 80,
                'consejos_adicionales' => 'Plan enfocado en normocalorías para recomposición corporal y rendimiento deportivo en fútbol.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}