<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Matriz lógica: Producto => [Tipo, Rango de Precio (C$), Presentaciones]
        $catalogo = [
            'Arroz'    => ['tipo' => 'granos',    'precio' => [800, 2200], 'presentacion' => ['saco 50lb', 'saco 100lb', 'bolsa 1kg']],
            'Frijoles' => ['tipo' => 'granos',    'precio' => [1200, 3000],'presentacion' => ['saco 50lb', 'saco 100lb']],
            'Azúcar'   => ['tipo' => 'abarrotes', 'precio' => [900, 1500], 'presentacion' => ['saco 50lb', 'bolsa 1kg']],
            'Aceite'   => ['tipo' => 'líquidos',  'precio' => [800, 1500], 'presentacion' => ['bidón 5gal', 'caja 12 botellas 1L']],
            'Café'     => ['tipo' => 'abarrotes', 'precio' => [150, 450],  'presentacion' => ['bolsa 400g', 'bolsa 1kg']],
            'Harina'   => ['tipo' => 'abarrotes', 'precio' => [700, 1100], 'presentacion' => ['saco 50lb', 'bolsa 1kg']],
            'Avena'    => ['tipo' => 'abarrotes', 'precio' => [30, 90],    'presentacion' => ['bolsa 400g', 'bolsa 1kg']],
            'Sal'      => ['tipo' => 'abarrotes', 'precio' => [10, 30],    'presentacion' => ['bolsa 1kg', 'bolsa 400g']],
            'Salsa'    => ['tipo' => 'líquidos',  'precio' => [25, 70],    'presentacion' => ['botella 1L', 'frasco 500g', 'caja 24 un']],
            'Pasta'    => ['tipo' => 'abarrotes', 'precio' => [15, 50],    'presentacion' => ['bolsa 400g', 'caja 500g']],
            'Leche'    => ['tipo' => 'líquidos',  'precio' => [35, 75],    'presentacion' => ['caja 1L', 'caja 12L']],
            'Atún'     => ['tipo' => 'enlatados', 'precio' => [45, 95],    'presentacion' => ['lata 170g', 'caja 24 latas']],
            'Sardina'  => ['tipo' => 'enlatados', 'precio' => [30, 65],    'presentacion' => ['lata 155g', 'lata 425g']],
            'Cereal'   => ['tipo' => 'abarrotes', 'precio' => [60, 150],   'presentacion' => ['caja 500g', 'bolsa 1kg']],
            'Galletas' => ['tipo' => 'abarrotes', 'precio' => [20, 80],    'presentacion' => ['paquete 12 un', 'caja display']],
        ];

        // Ya no necesitamos el arreglo de atributos aleatorios.
        
        $productosUnicos = [];
        
        // Unimos el nombre base con CADA presentación para generar productos únicos y descriptivos.
        foreach ($catalogo as $nombreBase => $datos) {
            foreach ($datos['presentacion'] as $presentacionEspecifica) {
                $productosUnicos[] = [
                    'nombreCompleto' => $nombreBase . ' ' . $presentacionEspecifica, // Ej: "Arroz saco 50lb"
                    'claveBase'      => $nombreBase, 
                    'presentacion'   => $presentacionEspecifica 
                ];
            }
        }

        // Si cuentas los elementos de $productosUnicos, verás que salen alrededor de 34 combinaciones exactas (sin repetir).
        // Podemos mezclar el arreglo por si no quieres mostrarlos en el mismo orden siempre.
        shuffle($productosUnicos);
        
        // Creamos todos los productos generados
        foreach ($productosUnicos as $item) {
            $base = $item['claveBase'];
            $logica = $catalogo[$base]; 

            Product::create([
                'name'         => $item['nombreCompleto'],
                'type'         => $logica['tipo'],
                'quantity'     => rand(10, 100),
                'cost'         => rand($logica['precio'][0], $logica['precio'][1]), 
                'presentation' => $item['presentacion'], // Usamos la presentación de la combinación
                'state'        => 'activo',
                'code_bar'     => '750' . rand(100000000, 999999999),
            ]);
        }
    }
}