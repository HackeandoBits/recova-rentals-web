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
            ['slug' => 'combo-002', 'name' => 'Pasarela Chispas Frías'],
            ['slug' => 'combo-003', 'name' => 'Escenario Beam Star'],
            ['slug' => 'combo-004', 'name' => 'Matriz Láser Disco'],
            ['slug' => 'combo-005', 'name' => 'Túnel Triángulo Neón'],
            ['slug' => 'combo-006', 'name' => 'Escenario Boda Elegante'],
            ['slug' => 'combo-007', 'name' => 'Quinceaños Lujo Vertical'],
            ['slug' => 'combo-008', 'name' => 'Pista Láser Verde y Espejos'],
            ['slug' => 'combo-009', 'name' => 'Show Beam Rojo Intenso'],
            ['slug' => 'combo-010', 'name' => 'Techo Espejo y Control Beam'],
            ['slug' => 'combo-011', 'name' => 'Cielo Bolas Espejadas Cálido'],
            ['slug' => 'combo-012', 'name' => 'Escenario Azul y Pantallas'],
            ['slug' => 'combo-013', 'name' => 'Atmósfera Roja y Bolas Disco'],
            ['slug' => 'combo-014', 'name' => 'Techo Bolas Disco RGB'],
            ['slug' => 'combo-015', 'name' => 'Fiesta CO2 y Accesorios LED'],
            ['slug' => 'combo-016', 'name' => 'Pista Beams Verdes y Pantallas'],
            ['slug' => 'combo-017', 'name' => 'Escenario Beams Azules y Pantallas'],
            ['slug' => 'combo-018', 'name' => 'Fiesta Bolas Disco Rojas'],
            ['slug' => 'combo-019', 'name' => 'Techo Completo Bolas Disco'],
            ['slug' => 'combo-020', 'name' => 'Fiesta Disco RGB y Beams'],
            ['slug' => 'combo-021', 'name' => 'Techo Pantallas LED y Beams Dorados'],
            ['slug' => 'combo-022', 'name' => 'Techo Bolas Disco y Atmósfera Rosa'],
            ['slug' => 'combo-023', 'name' => 'Escenario Floral LED y Puntos de Piso'],
            ['slug' => 'combo-024', 'name' => 'Show Láser Haz Verde'],
            ['slug' => 'combo-025', 'name' => 'Estructura Circular y Bañado Azul'],
            ['slug' => 'combo-026', 'name' => 'Escenario Pantalla LED Paisaje'],
            ['slug' => 'combo-027', 'name' => 'Techo Bolas Disco y Arañas'],
            ['slug' => 'combo-028', 'name' => 'Pantallas LED Divididas y Láseres'],
            ['slug' => 'combo-029', 'name' => 'Estructura Pantalla Aérea'],
            ['slug' => 'combo-030', 'name' => 'Letras LOVE LED Gigantes'],
            ['slug' => 'combo-031', 'name' => 'Escenario Exterior Mandala LED'],
            ['slug' => 'combo-032', 'name' => 'Cortina Bolas Disco Vertical'],
            ['slug' => 'combo-033', 'name' => 'Techo Disco y Arañas Azules'],
            ['slug' => 'combo-034', 'name' => 'Experiencia Túnel Láser Azul'],
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
            'combo-002' => ['tarima-modular', 'cabezal-movil-beam-230'],
            'combo-003' => ['cabezal-movil-beam-230', 'estructura-truss-30x30'],
            'combo-004' => ['laser-show-rgb-3w', 'maquina-de-humo-baja'],
            'combo-005' => ['pista-led-infinity', 'estructura-truss-30x30'],
            'combo-006' => ['tarima-modular', 'cabezal-movil-wash-led'],
            'combo-007' => ['pantalla-led-p3', 'cabezal-movil-beam-230'],
            'combo-008' => ['pista-led-infinity', 'laser-show-rgb-3w'],
            'combo-009' => ['cabezal-movil-beam-230', 'maquina-de-humo-baja'],
            'combo-010' => ['bola-de-espejos-50cm', 'cabezal-movil-beam-230'],
            'combo-011' => ['bola-de-espejos-50cm', 'cabezal-movil-wash-led'],
            'combo-012' => ['pantalla-led-p3', 'cabezal-movil-wash-led'],
            'combo-013' => ['bola-de-espejos-50cm', 'cabezal-movil-wash-led'],
            'combo-014' => ['bola-de-espejos-50cm', 'efecto-led'],
            'combo-015' => ['pistola-co2', 'canon-de-confetti'],
            'combo-016' => ['cabezal-movil-beam-230', 'pantalla-led-p3'],
            'combo-017' => ['bola-de-espejos-50cm', 'cabezal-movil-wash-led'],
            'combo-018' => ['bola-de-espejos-50cm'],
            'combo-019' => ['cabezal-movil-beam-230', 'bola-de-espejos-50cm'],
            'combo-020' => ['pista-led-infinity', 'cabezal-movil-beam-230'],
            'combo-021' => ['pantalla-led-p3', 'cabezal-movil-beam-230'],
            'combo-022' => ['estructura-truss-30x30', 'cabezal-movil-wash-led'],
            'combo-023' => ['bola-de-espejos-50cm', 'cabezal-movil-wash-led'],
            'combo-024' => ['pantalla-led-p3', 'pista-led-infinity'],
            'combo-025' => ['laser-show-rgb-3w', 'cabezal-movil-beam-230'],
            'combo-026' => ['pantalla-led-curva'],
            'combo-027' => ['bola-de-espejos-50cm', 'cabezal-movil-beam-230'],
            'combo-028' => ['pantalla-led-p3', 'laser-show-rgb-3w'],
            'combo-029' => ['estructura-truss-30x30', 'pantalla-led-p3'],
            'combo-030' => ['letras-gigantes-led'],
            'combo-031' => ['pantalla-led-p3', 'tarima-modular'],
            'combo-032' => ['bola-de-espejos-50cm'],
            'combo-033' => ['bola-de-espejos-50cm', 'cabezal-movil-beam-230'],
            'combo-034' => ['laser-show-rgb-3w', 'maquina-de-humo-baja'],
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
