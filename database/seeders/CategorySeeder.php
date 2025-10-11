<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'Pantallas' => ['LED Indoor', 'LED Outdoor', 'Proyectores'],
            'Láseres'   => ['Verde', 'RGB', 'Animación'],
            'Sonido'    => ['Parlantes', 'Consolas', 'Micrófonos', 'Accesorios'],
            'Escenario' => ['Estructuras', 'Tarimas', 'Truss'],
            'Luces'     => ['Moving Head', 'PAR LED', 'Strobes', 'Wash/Spot'],
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
