<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Company; 
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Instanciamos Faker en español para que invente nombres realistas
        $faker = Faker::create('es_ES'); 

        // Tu lista exacta de la imagen
        $categorias = [
            'Tecnología', 'Alimentos', 'Construcción', 'Salud', 
            'Moda', 'Hogar', 'Servicios', 'Educación', 
            'Automotriz', 'Arte', 'Deporte', 'Belleza'
        ];

        foreach ($categorias as $nombreCategoria) {
            // 1. Creamos la categoría (o la buscamos si ya existe)
            $categoria = Category::firstOrCreate(
    ['name' => $nombreCategoria], // Condición para buscar si ya existe
    [
        'type' => 'general',      // Dato de relleno obligatorio
        'quantity' => 0,          // Dato de relleno obligatorio
        'description' => 'Categoría de negocios de ' . $nombreCategoria
    ]
);

            // 2. Inventamos un número random de negocios para esta categoría (ej. entre 15 y 60)
            $cantidadNegocios = rand(15, 60);

            // 3. Creamos esos negocios "random" asignados a esta categoría específica
            for ($i = 0; $i < $cantidadNegocios; $i++) {
                Company::create([
                    // Faker inventará nombres de empresas como "Sistemas Globales S.A."
                    'name' => substr($faker->company, 0, 30), 
                    'category_id' => $categoria->id, // Conectamos el negocio a la categoría actual
                    'status' => 'activo',
                    // Si tu tabla companies tiene otros campos, puedes usar Faker para llenarlos:
                    'email' => $faker->unique()->companyEmail,
                    'telephone' => $faker->phoneNumber,
                    'address' => $faker->address,
                    'type_product' => 'Productos y Servicios',
                ]);
            }
        }
    }
}