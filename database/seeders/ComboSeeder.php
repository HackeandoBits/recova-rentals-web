<?php

namespace Database\Seeders;

use App\Models\Combo;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ComboSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Definition of Combos (34 Batches)
        $combos = [
            ['slug' => 'combo-001', 'name' => 'Pack Pista Láser Infinity'],
        ];

        foreach ($combos as $data) {
            Combo::updateOrCreate(
                ['slug' => $data['slug']],
                ['name' => $data['name'], 'active' => true]
            );
        }

        // 2. Mapping Items to Combos
        // Mapea el Combo Slug -> Lista de Item Slugs (usando los nuevos slugs generados en ItemSeeder)
        $comboItemsMap = [
            'combo-001' => ['cabezal-movil-beam-7r', 'laser-verde-pro-3w', 'cluster-esferas-de-espejos', 'pantalla-led-p3-indoor'],
        ];

        // 3. Sync Logic
        // Primero, conseguir todos los IDs de items necesarios
        $allItemSlugs = [];
        foreach ($comboItemsMap as $items) {
            foreach ($items as $slug) {
                if (! in_array($slug, $allItemSlugs)) {
                    $allItemSlugs[] = $slug;
                }
            }
        }

        $itemsLookup = Item::whereIn('slug', $allItemSlugs)->pluck('id', 'slug');

        foreach ($comboItemsMap as $comboSlug => $itemSlugsList) {
            $combo = Combo::where('slug', $comboSlug)->first();

            if (! $combo) {
                continue;
            }

            $syncData = [];
            foreach ($itemSlugsList as $itemSlug) {
                if (isset($itemsLookup[$itemSlug])) {
                    $syncData[$itemsLookup[$itemSlug]] = ['quantity' => 1];
                }
            }

            // Sincronizar items al combo
            if (! empty($syncData)) {
                $combo->items()->sync($syncData);
            }
        }
    }
}
