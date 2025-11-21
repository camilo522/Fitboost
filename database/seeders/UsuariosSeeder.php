<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia la tabla antes de insertar (solo en desarrollo)
        DB::table('usuarios')->delete(); // ✔ limpio y compatible con FK


        $usuarios = [];

        for ($i = 1; $i <= 10; $i++) {
            $usuarios[] = [
                'nombre' => "Usuario $i",
                'email' => "usuario{$i}@ejemplo.com",
                'contrasena' => Hash::make('123456'),
                'fechaRegistro' => now()->subDays(rand(1, 30))->format('Y-m-d'),
            ];
        }

        DB::table('usuarios')->insert($usuarios);
    }
}
