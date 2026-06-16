<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Cristian Solano',
                'email' => 'cristian@fitboost.com',
                'password' => Hash::make('12345678'),
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Juan Perez',
                'email' => 'juan@fitboost.com',
                'password' => Hash::make('12345678'),
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}