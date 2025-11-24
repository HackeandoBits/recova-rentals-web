<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemFeature;
use App\Models\ItemSpec;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // Garantiza que existan las categorías necesarias
        $this->call(CategorySeeder::class);

        // Mapa determinístico por categoría
        $plan = [
            'pantallas-led-indoor' => [
                ['Pantalla LED P2.9 Indoor 3x2m', 2,
                    ['Paso de pixel' => 'P2.9', 'Uso' => 'Indoor', 'Brillo (nits)' => '1200', 'Resolución' => 'Full HD'],
                    ['Módulos escalables', 'Incluye procesador', 'Instalación profesional'],
                    'items/pantallas-led.jpg',
                ],
                ['Pantalla LED P3.9 Indoor 4x2m', 1,
                    ['Paso de pixel' => 'P3.9', 'Uso' => 'Indoor', 'Brillo (nits)' => '1000', 'Resolución' => 'Full HD'],
                    ['Estructura incluida', 'Control remoto', 'Soporte técnico 24/7'],
                    'items/pantallas-led.jpg',
                ],
            ],
            'pantallas-led-outdoor' => [
                ['Pantalla LED P3.9 Outdoor 3x2m', 1,
                    ['Paso de pixel' => 'P3.9', 'Uso' => 'Outdoor', 'Brillo (nits)' => '4500', 'Resolución' => 'Full HD'],
                    ['IP65', 'Mástiles incluidos', 'Visibilidad a pleno sol'],
                    'items/pantallas-led.jpg',
                ],
            ],
            'pantallas-proyectores' => [
                ['Proyector 5000 lúmenes Full HD', 3,
                    ['Brillo (lm)' => '5000', 'Resolución' => '1080p', 'Uso' => 'Indoor'],
                    ['Incluye HDMI', 'Trípode de pantalla', 'Control remoto'],
                    'items/lighting-setup-2.jpg',

                ],
            ],
            'laseres-verde' => [
                ['Láser Verde 1W animación', 2,
                    ['Color' => 'Verde', 'Potencia' => '1W', 'Modos' => 'DMX/Auto/Sound'],
                    ['Efectos geométricos', 'Incluye soporte', 'DMX 512'],
                    'items/laser-show-event.png',
                ],
            ],
            'laseres-rgb' => [
                ['Láser RGB 2W profesional', 1,
                    ['Color' => 'RGB', 'Potencia' => '2W', 'Modos' => 'ILDA/DMX'],
                    ['Animaciones predefinidas', 'Gobos múltiples', 'Show ILDA'],
                    'items/golden-laser-effects.jpg',
                ],
            ],
            'sonido-parlantes' => [
                ['Parlante Activo 12" 1000W', 6,
                    ['Potencia' => '1000W', 'Tamaño' => '12"', 'Entrada' => 'XLR/Line'],
                    ['Cableado incluido', 'Soporte de pie', 'Bluetooth (opcional)'],
                    'items/sonido.jpg',
                ],
                ['Subwoofer 18" 1200W', 3,
                    ['Potencia' => '1200W', 'Tamaño' => '18"', 'Tipo' => 'Activo'],
                    ['Frecuencia extendida', 'Caja reforzada', 'Ruedas'],
                    'items/sonido.jpg',
                ],
            ],
            'sonido-consolas' => [
                ['Consola 16ch con FX', 2,
                    ['Canales' => '16', 'Efectos' => 'Reverb/Delay', 'Salidas' => 'Main/Sub/Aux'],
                    ['Rackable', 'Incluye estuche', 'Fuente incluida'],
                    'items/sonido.jpg',
                ],
            ],
            'sonido-microfonos' => [
                ['Micrófono inalámbrico UHF', 4,
                    ['Banda' => 'UHF', 'Alcance' => '60m', 'Tipo' => 'Handheld'],
                    ['Doble antena', 'Baterías incluidas', 'Case rígido'],
                    'items/sonido.jpg',
                ],
            ],
            'escenario-estructuras' => [
                ['Estructura 6x4m', 1,
                    ['Material' => 'Aluminio', 'Dimensiones' => '6x4m', 'Uso' => 'Exterior/Interior'],
                    ['Incluye armado', 'Anclajes de seguridad', 'Ingeniería básica'],
                    'items/stage-blue-lighting.jpg',
                ],
            ],
            'escenario-tarimas' => [
                ['Tarimas modulares 1x2m (x6)', 1,
                    ['Módulos' => '6', 'Alto regulable' => '0.4–1m', 'Carga' => '750 kg/m²'],
                    ['Antideslizante', 'Niveladores', 'Faldón opcional'],
                    'items/stage-blue-lighting.jpg',
                ],
            ],
            'luces-moving-head' => [
                ['Moving Head 200W Spot', 4,
                    ['Tipo' => 'Spot', 'Lámpara' => 'LED 200W', 'Modos' => 'DMX/Auto/Sound'],
                    ['Gobos rotativos', 'Prismas', 'Pan/Tilt rápida'],
                    'items/stage-blue-lighting.jpg',
                ],
            ],
            'luces-par-led' => [
                ['PAR LED RGB 18x10W', 10,
                    ['LEDs' => '18x10W', 'Colores' => 'RGB', 'Modos' => 'DMX/Auto/Sound'],
                    ['Soporte omega', 'Daisy chain', 'Baja temperatura'],
                    'items/laser-show-ceiling.jpg',
                ],
            ],
        ];

        foreach ($plan as $categorySlug => $items) {
            $category = Category::where('slug', $categorySlug)->first();

            if (! $category) {
                // Fail-fast (opcional): avisar y cortar
                $this->command?->error("Falta la categoría requerida: {$categorySlug}. Revisá CategorySeeder.");
                throw new \RuntimeException("Falta la categoría {$categorySlug}");
            }

            foreach ($items as [$name, $stock, $specs, $features, $imageUrl]) {
                $slug = Str::slug($name);

                // Ítem idempotente por slug
                $item = Item::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $category->id,
                        'name' => $name,
                        'description' => $name.' — equipo en excelente estado para eventos.',
                        'image_url' => asset('storage/'.$imageUrl),
                        'stock' => $stock,
                        'active' => true,
                    ]
                );

                // Features idempotentes por (item_id, sort_order)
                $order = 10;
                foreach ($features as $text) {
                    ItemFeature::updateOrCreate(
                        ['item_id' => $item->id, 'sort_order' => $order],
                        ['text' => $text]
                    );
                    $order += 10;
                }

                // Specs idempotentes por (item_id, spec_key)
                $order = 10;
                foreach ($specs as $k => $v) {
                    ItemSpec::updateOrCreate(
                        ['item_id' => $item->id, 'spec_key' => $k],
                        ['spec_value' => $v, 'sort_order' => $order]
                    );
                    $order += 10;
                }
            }
        }
    }
}
