<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsigEntreUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('asigEntreUsuario')->insert([
            [
                'idUsuario' => 1,
                'idEntrenamiento' => 1,
                'fechaAsignacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}