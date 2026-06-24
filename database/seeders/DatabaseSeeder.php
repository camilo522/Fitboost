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
            EjercicioSeeder::class,
            EntrenamientoSeeder::class,
            RutinaSeeder::class,
            RutinaEjercicioSeeder::class,     
            PlanNutricionalSeeder::class,
            AsigEntreUsuarioSeeder::class,
        ]);
    }
}