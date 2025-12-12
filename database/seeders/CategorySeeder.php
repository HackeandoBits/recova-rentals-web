<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'Pantallas' => ['LED Indoor', 'Verticales', 'Techo', 'Diseño', 'Gran Formato', 'Decoración'],
            'Láseres' => ['Verde', 'Azul', 'Rojo'],
            'Escenario' => ['Decoración', 'Estructuras', 'Pisos', 'Rigging'],
            'Luces' => ['Moving Head', 'Pixel', 'Bañadores', 'Neon', 'Control', 'Ambientación', 'Decorativa'],
            'Efectos' => ['Niebla', 'Fuego Frío', 'CO2', 'Varios'],
        ];

        foreach ($tree as $parentName => $children) {
            $parent = Category::updateOrCreate(
                ['slug' => Str::slug($parentName)],
                ['name' => $parentName, 'description' => $parentName.' del catálogo', 'parent_id' => null]
            );

            foreach ($children as $childName) {
                Category::updateOrCreate(
                    ['slug' => Str::slug($parentName.' '.$childName)],
                    ['name' => $childName, 'description' => $childName.' dentro de '.$parentName, 'parent_id' => $parent->id]
                );
            }
        }
    }
}
