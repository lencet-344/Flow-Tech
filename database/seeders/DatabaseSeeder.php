<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos al Administrador
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);

        // 2. Creamos al Proveedor
        User::create([
            'name' => 'Proveedor de Prueba',
            'email' => 'proveedor@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'proveedor',
        ]);

        // 3. Creamos al Usuario normal (Comprador/Verificador)
        User::create([
            'name' => 'Usuario Normal',
            'email' => 'usuario@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);
    }
}