<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Valoraciones;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        
            
      $this->call([
        UsuarioSeeder::class,
       EntrenamientosSeeder::class,
        RutinaSeeder::class,
        EjerciciosSeeder::class,
        ValoracionesSeeder::class,

    ]);

    }

}





