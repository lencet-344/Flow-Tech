<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $nombresBase = ['Arroz', 'Frijoles', 'Azúcar', 'Aceite', 'Café', 'Harina', 'Avena', 'Sal', 'Salsa', 'Pasta'];
        $tipos = ['granos', 'abarrotes', 'líquidos', 'alimentos'];
        $presentaciones = ['bolsa 1kg', 'botella 1L', 'saco 50lb', 'lata 400g'];

        for ($i = 1; $i <= 50; $i++) {
            Product::create([
                'name' => $nombresBase[array_rand($nombresBase)] . ' ' . rand(100, 999),
                'type' => $tipos[array_rand($tipos)],
                'quantity' => rand(10, 100),
                'cost' => rand(50, 3500),
                'presentation' => $presentaciones[array_rand($presentaciones)],
                'state' => 'activo',
                'code_bar' => '750' . rand(100000000, 999999999),
            ]);
        }
    }
}