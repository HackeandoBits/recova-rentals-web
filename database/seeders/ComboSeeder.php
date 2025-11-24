<?php

namespace Database\Seeders;

use App\Models\Combo;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ComboSeeder extends Seeder
{
    public function run(): void
    {
        $combos = [
            [
                'name' => 'Kit Pantallas LED Premium',
                'slug' => 'combo-pantallas-premium',
                'items' => [
                    'pantalla-led-p2-9-indoor-3x2m' => ['quantity' => 1],
                    'moving-head-200w-spot' => ['quantity' => 1],
                    'consola-16ch-con-fx' => ['quantity' => 1],
                ],
            ],
            [
                'name' => 'Kit Techo LED',
                'slug' => 'combo-techo-led',
                'items' => [
                    'pantalla-led-p3-9-indoor-4x2m' => ['quantity' => 1],
                    'moving-head-200w-spot' => ['quantity' => 1],
                    'par-led-rgb-18x10w' => ['quantity' => 1],
                ],
            ],
            [
                'name' => 'Kit Show Láser Profesional',
                'slug' => 'combo-laser-show',
                'items' => [
                    'laser-rgb-2w-profesional' => ['quantity' => 1],
                    'par-led-rgb-18x10w' => ['quantity' => 1],
                    'consola-16ch-con-fx' => ['quantity' => 1],
                ],
            ],
            [
                'name' => 'Kit Láseres Verdes',
                'slug' => 'combo-laseres-verdes',
                'items' => [
                    'laser-verde-1w-animacion' => ['quantity' => 1],
                    'parlante-activo-12-1000w' => ['quantity' => 1],
                    'microfono-inalambrico-uhf' => ['quantity' => 1],
                ],
            ],
            [
                'name' => 'Kit Producción Escenario',
                'slug' => 'combo-escenario-completo',
                'items' => [
                    'estructura-6x4m' => ['quantity' => 1],
                    'parlante-activo-12-1000w' => ['quantity' => 1],
                    'subwoofer-18-1200w' => ['quantity' => 1],
                ],
            ],
        ];

        foreach ($combos as $data) {
            $combo = Combo::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'active' => true,
                ]
            );

            $syncData = [];
            foreach ($data['items'] as $slug => $pivot) {
                $item = Item::where('slug', $slug)->first();
                if ($item) {
                    $syncData[$item->id] = $pivot;
                }
            }
            $combo->items()->sync($syncData);
        }
    }
}
