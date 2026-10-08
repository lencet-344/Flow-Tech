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
            'name' => 'Administrador Principal',
            'email' => 'administrador608@gmail.com',
            'password' => Hash::make('singkiuia01'),
            'role' => 'administrador',
        ]);

        
        User::create([
            'name' => 'Proveedor de Prueba',
            'email' => 'proveedor345singki@gmail.com',
            'password' => Hash::make('123proveedor'),
            'role' => 'proveedor',
        ]);

        
        User::create([
            'name' => 'Usuario Normal',
            'email' => 'edmundoherrera234@gmail.com',
            'password' => Hash::make('123usuario'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'Auditor',
            'email' => 'usuario@flowtech.com',
            'password' => Hash::make('password'),
            'role' => 'auditor',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        
    }
    
}