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

        // Mapa de ítems limpios para Combo 001
        $plan = [
            'luces-moving-head' => [
                ['Cabezal Móvil Beam 7R', 8,
                    ['Lámpara' => '7R 230W', 'Temperatura color' => '8000K', 'Alcance' => '100m', 'Peso' => '17kg'],
                    ['Haz de luz concentrado', 'Colores intensos', 'Movimiento rápido', 'Prisma 8 caras'],
                    'items/beam-light.jpg',
                ],
            ],
            'laseres-verde' => [
                ['Láser Verde Pro 3W', 2,
                    ['Potencia' => '3000mW (3W)', 'Color' => 'Verde 532nm', 'Modos' => 'DMX / Audiorítmico'],
                    ['Efecto túnel de alto impacto', 'Ideal para pistas grandes', 'Haz verde de alta visibilidad'],
                    'items/laser-show.jpg',
                ],
            ],
            'escenario-decoracion' => [
                ['Cluster Esferas de Espejos', 12,
                    ['Cantidad' => '12 unidades (aprox)', 'Diámetros' => 'Mix 30cm / 40cm', 'Material' => 'Facetas de vidrio real'],
                    ['Clásico efecto disco vintage', 'Reflejos multidireccionales', 'Montaje en racimo decorativo'],
                    'items/bola-espejo.jpg',
                ],
            ],
            'pantallas-led-indoor' => [
                ['Pantalla LED P3 Indoor', 6,
                    ['Paso de pixel' => 'P3.9', 'Uso' => 'Indoor', 'Brillo (nits)' => '1000', 'Resolución' => 'Full HD'],
                    ['Módulos escalables', 'Incluye procesador', 'Instalación profesional', 'Ideal para eventos'],
                    'items/pantalla-led.jpg',
                ],
            ],
        ];

        // $migrationItems removido ya que limpiamos todo.
        // $plan = array_merge_recursive($plan, $migrationItems); // ya no es necesario

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
                        'image_url' => 'storage/'.$imageUrl,
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
