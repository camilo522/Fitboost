<?php

namespace Database\Seeders;

use App\Models\PlanNutricional;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanNutricionalSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos algunos usuarios a los que asignaremos un plan
        $usuarios = Usuario::take(5)->get();

        foreach ($usuarios as $usuario) {
            PlanNutricional::create([
                'id_usuario' => $usuario->id,
                'calorias_diarias' => rand(1800, 3000),
                'proteinas_gramos' => rand(120, 200),
                'carbohidratos_gramos' => rand(200, 350),
                'grasas_gramos' => rand(60, 90),
                'consejos_adicionales' => 'Bebe al menos 2 litros de agua al día. Prioriza alimentos integrales y no olvides incluir frutas y verduras en cada comida.',
                'activo' => true,
            ]);
        }
    }
}