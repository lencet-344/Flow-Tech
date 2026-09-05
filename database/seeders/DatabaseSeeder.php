<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);

        
        User::create([
            'name' => 'Proveedor de Prueba',
            'email' => 'proveedor@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'proveedor',
        ]);

        
        User::create([
            'name' => 'Usuario Normal',
            'email' => 'usuario@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);
    }
}