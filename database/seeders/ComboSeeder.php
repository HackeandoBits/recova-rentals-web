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
            ['slug' => 'combo-002', 'name' => 'Pack Efecto Vortex Blue'],
            ['slug' => 'combo-003', 'name' => 'Pórtico Triángulo Pixel'],
            ['slug' => 'combo-004', 'name' => 'Set Entrada Triunfal'],
            ['slug' => 'combo-005', 'name' => 'Show Beam Gold'],
            ['slug' => 'combo-006', 'name' => 'Pack Gala Crystal Palace'],
            ['slug' => 'combo-007', 'name' => 'Pack Red Storm Laser'],
            ['slug' => 'combo-008', 'name' => 'Techo Matrix Disco Gold'],
            ['slug' => 'combo-009', 'name' => 'Estructura Circular 360'],
            ['slug' => 'combo-010', 'name' => 'Escenario Wedding Amber'],
            ['slug' => 'combo-011', 'name' => 'Efecto Golden Starburst'],
            ['slug' => 'combo-012', 'name' => 'Show Blue Rain'],
            ['slug' => 'combo-013', 'name' => 'Ambientación Red Lounge'],
            ['slug' => 'combo-014', 'name' => 'Techo Imperial Pink'],
            ['slug' => 'combo-015', 'name' => 'Kit Fiesta FX & CO2'],
            ['slug' => 'combo-016', 'name' => 'Techo Digital Sky Club'],
            ['slug' => 'combo-017', 'name' => 'Escenario Gold Waves'],
            ['slug' => 'combo-018', 'name' => 'Pista Red Galaxy'],
            ['slug' => 'combo-019', 'name' => 'Estructura Matrix Wave'],
            ['slug' => 'combo-020', 'name' => 'Show Beam Multicolor'],
            ['slug' => 'combo-021', 'name' => 'Set Blue Winter'],
            ['slug' => 'combo-022', 'name' => 'Pack Láser Show Vip'],
            ['slug' => 'combo-023', 'name' => 'Techo Pixel Amber'],
            ['slug' => 'combo-024', 'name' => 'Set Control & Truss Circular'],
            ['slug' => 'combo-025', 'name' => 'Sky Diamond & Disco'],
            ['slug' => 'combo-026', 'name' => 'Signo LOVE Video'],
            ['slug' => 'combo-027', 'name' => 'Escenario Cinema Wall'],
            ['slug' => 'combo-028', 'name' => 'Techo Espejos & Arañas (Cold)'],
            ['slug' => 'combo-029', 'name' => 'Set Split Screen & Laser'],
            ['slug' => 'combo-030', 'name' => 'Cabina DJ Overhead Screen'],
            ['slug' => 'combo-031', 'name' => 'Túnel Láser Blue Vortex'],
            ['slug' => 'combo-032', 'name' => 'Festival Main Stage'],
            ['slug' => 'combo-033', 'name' => 'Cortina Esferas (Backdrop)'],
            ['slug' => 'combo-034', 'name' => 'Techo Imperial Royal Blue'],
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
            'combo-002' => ['laser-show-azul-3w', 'circulo-led-neon-flex', 'maquina-de-humo-haze'],
            'combo-003' => ['tubos-led-pixel', 'estructura-truss-negra'],
            'combo-004' => ['maquina-fuego-frio', 'pantalla-led-poster'],
            'combo-005' => ['cabezal-movil-beam-7r', 'banadores-led', 'pantalla-led-de-fondo'],
            'combo-006' => ['arana-cristal-estilo-imperio', 'pantalla-led-totem-1x4', 'techo-de-esferas-fondo'],
            'combo-007' => ['sistema-laser-array-rojo', 'pantalla-led-segmentada'],
            'combo-008' => ['matriz-de-esferas-de-espejos', 'cabezal-movil-beam-7r'],
            'combo-009' => ['truss-circular-ring', 'cabezal-movil-beam-7r', 'consola-de-iluminacion'],
            'combo-010' => ['pantalla-led-p3-split', 'cabezal-movil-hibrido'],
            'combo-011' => ['esferas-de-espejos-mix', 'pin-spot-led-beam'],
            'combo-012' => ['cabezal-movil-beam-7r', 'pantalla-led-escenario-completo'],
            'combo-013' => ['banadores-led', 'hileras-de-esferas'],
            'combo-014' => ['estructura-rectangular-de-esferas', 'aranas-colgantes-5-brazos'],
            'combo-015' => ['pistola-de-co2', 'cotillon-luminoso'],
            'combo-016' => ['paneles-led-techo', 'cabezal-movil-beam-verde'],
            'combo-017' => ['cabezal-movil-beam-gold', 'pantallas-led-diseno'],
            'combo-018' => ['grid-de-esferas', 'banadores-led-high-power'],
            'combo-019' => ['esferas-colgantes', 'sistema-de-rigging'],
            'combo-020' => ['cabezal-movil-beam-mix-colores', 'cluster-esferas-de-espejos'],
            'combo-021' => ['pantallas-led-totems-separadas', 'iluminacion-wash-azul'],
            'combo-022' => ['laser-grafico-verde', 'iluminacion-perimetral'],
            'combo-023' => ['techo-led-pixel', 'cabezal-beam-ambar'],
            'combo-024' => ['truss-circular-ring', 'consola-de-iluminacion', 'pista-ajedrezada'],
            'combo-025' => ['paneles-led-techo-diamante', 'tubos-led-verticales', 'cabezal-movil-beam-violeta'],
            'combo-026' => ['letras-corporeas-led-love', 'iluminacion-decorativa-guirnaldas'],
            'combo-027' => ['pared-led-gran-formato', 'pista-ajedrezada'],
            'combo-028' => ['matriz-esferas-techo', 'aranas-de-estilo-chandelier'],
            'combo-029' => ['pantalla-led-dividida-stripes', 'laser-verde-show'],
            'combo-030' => ['pantalla-led-techo-inclinada', 'tarimas-escenario-dj'],
            'combo-031' => ['sistema-laser-azul-tunel', 'esferas-de-espejo-reflectoras'],
            'combo-032' => ['estructura-escenario-layher', 'mix-pantallas-custom', 'array-iluminacion-beam-wash'],
            'combo-033' => ['bastidor-estructura-movil', 'cortina-de-esferas'],
            'combo-034' => ['grid-esferas-masivo', 'iluminacion-beam-cruzada'],
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
