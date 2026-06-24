<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@fitboost.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Entrenador',
            'email' => 'trainer@fitboost.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}