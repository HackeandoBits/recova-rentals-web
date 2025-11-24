<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Catalog\ItemList;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ItemListTest extends TestCase
{
    use RefreshDatabase;

    public function test_scene_hotspots_are_enriched_with_existing_items(): void
    {
        $category = Category::create([
            'name' => 'Equipos de prueba',
            'slug' => 'equipos-prueba',
            'description' => 'Categoría para tests',
            'parent_id' => null,
        ]);

        // Slugs que el ItemList usa en su getSceneData()
        $slugs = [
            'pantalla-led-p29-indoor-3x2m',
            'pantalla-led-p39-indoor-4x2m',
            'laser-rgb-2w-profesional',
            'laser-verde-1w-animacion',
            'par-led-rgb-18x10w',
            'parlante-activo-12-1000w',
            'subwoofer-18-1200w',
            'estructura-6x4m',
            'moving-head-200w-spot',
        ];

        foreach ($slugs as $slug) {
            Item::create([
                'category_id' => $category->id,
                'name' => 'Item '.$slug,
                'slug' => $slug,
                'description' => 'Item de prueba para escena',
                'stock' => 10,
                'active' => true,
            ]);
        }

        $component = Livewire::test(ItemList::class);

        // Obtenemos la propiedad pública $imageCategories
        $imageCategories = $component->get('imageCategories');

        $this->assertNotEmpty($imageCategories, 'imageCategories no debería estar vacío');

        // Aplanamos todas las imágenes y hotspots
        $hotspots = collect($imageCategories)
            ->flatMap(fn ($category) => $category['images'])
            ->flatMap(fn ($image) => $image['hotspots'])
            ->values()
            ->all();

        $this->assertNotEmpty($hotspots, 'La escena debería tener hotspots generados');

        // Cada hotspot que se muestra debería tener info del item
        foreach ($hotspots as $hotspot) {
            $this->assertArrayHasKey('item_id', $hotspot);
            $this->assertArrayHasKey('name', $hotspot);
            $this->assertArrayHasKey('x', $hotspot);
            $this->assertArrayHasKey('y', $hotspot);
        }
    }
}
