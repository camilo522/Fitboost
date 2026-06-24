<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Desactivar la verificación de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Ahora MySQL te dejará limpiar la tabla sin quejarse
        DB::table('usuarios')->truncate();

        DB::table('usuarios')->insert([
            [
                'id' => 1,
                'nombre' => 'Camilo Rojas',
                'email' => 'camilo@fitboost.com',
                'password' => Hash::make('password123'),
                'fechaRegistro' => now()->subDays(5)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Kevin Sanchez',
                'email' => 'kevin@fitboost.com',
                'password' => Hash::make('password123'),
                'fechaRegistro' => now()->subDays(2)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Cristian Solano',
                'email' => 'cristian@fitboost.com',
                'password' => Hash::make('password123'),
                'fechaRegistro' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. Volver a activar la verificación de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}