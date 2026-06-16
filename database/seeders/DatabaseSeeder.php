<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UsuarioSeeder::class,
            ValoracionSeeder::class,
            EntrenamientoSeeder::class,
            RutinaSeeder::class,
            EjercicioSeeder::class,
            RutinaEjercicioSeeder::class,
            PlanNutricionalSeeder::class,
            AsigEntreUsuarioSeeder::class,
        ]);
    }
}