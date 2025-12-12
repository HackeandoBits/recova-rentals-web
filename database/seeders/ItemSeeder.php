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

        // Items migrados desde "seed_essential_items_for_hotspots"
        $migrationItems = [
            'pantallas-led-indoor' => [
                ['Pantalla LED P3', 4,
                    ['Pixel Pitch' => '3.91mm', 'Brillo' => '4500 nits', 'Consumo' => '600W/m2', 'Peso' => '12kg/panel'],
                    ['Alta resolución P3', 'Brillo ajustable', 'Uso interior/exterior', 'Conectividad HDMI/DVI'],
                    'items/pantalla-led.jpg',
                ],
                ['Pantalla LED P3 Indoor', 6,
                    ['Paso de pixel' => 'P3.9', 'Uso' => 'Indoor', 'Brillo (nits)' => '1000', 'Resolución' => 'Full HD'],
                    ['Módulos escalables', 'Incluye procesador', 'Instalación profesional', 'Ideal para eventos'],
                    'items/pantalla-led.jpg',
                ],
                ['Pantalla LED Curva', 2,
                    ['Radio de curvatura' => '+/- 15°', 'Pixel Pitch' => '2.9mm', 'Brillo' => '3500 nits', 'Peso' => '8kg/panel'],
                    ['Diseño flexible', 'Inmersión visual', 'Alta tasa de refresco', 'Configuración modular'],
                    'items/pantalla-led-curva.jpg',
                ],
            ],
            'luces-moving-head' => [
                ['Cabezal Móvil Beam 230', 8,
                    ['Lámpara' => '7R 230W', 'Temperatura color' => '8000K', 'Canales DMX' => '16/20', 'Peso' => '17kg'],
                    ['Haz de luz concentrado', 'Colores intensos', 'Movimiento rápido', 'Control DMX 16 canales'],
                    'items/beam-light.jpg',
                ],
                ['Cabezal Móvil Beam 7R', 8,
                    ['Lámpara' => '7R 230W', 'Temperatura color' => '8000K', 'Alcance' => '100m', 'Peso' => '17kg'],
                    ['Haz de luz concentrado', 'Colores intensos', 'Movimiento rápido', 'Prisma 8 caras'],
                    'items/beam-light.jpg',
                ],
                ['Cabezal Móvil Spot', 4,
                    ['LED' => '150W White', 'Gobos' => '7 rotativos + open', 'Prisma' => '3 caras', 'Enfoque' => 'Motorizado'],
                    ['Gobos intercambiables', 'Enfoque nítido', 'Prisma rotativo', 'Proyección de logotipos'],
                    'items/spot-light.jpg',
                ],
            ],
            'luces-wash-spot' => [
                ['Cabezal Móvil Wash LED', 6,
                    ['LEDs' => '36x10W RGBW', 'Zoom' => '15°-60°', 'Consumo' => '400W', 'Vida útil' => '50,000 hs'],
                    ['Baño de color amplio', 'Mezcla RGBW suave', 'Zoom motorizado', 'Ideal para ambientación'],
                    'items/wash-light.jpg',
                ],
            ],
            'laseres-verde' => [
                ['Láser Verde Pro 3W', 2,
                    ['Potencia' => '3000mW (3W)', 'Color' => 'Verde 532nm', 'Modos' => 'DMX / Audiorítmico'],
                    ['Efecto túnel de alto impacto', 'Ideal para pistas grandes', 'Haz verde de alta visibilidad'],
                    'items/laser-show.jpg',
                ],
            ],
            'laseres-rgb' => [
                ['Láser Show RGB 3W', 2,
                    ['Potencia' => '3000mW', 'Escáner' => '25kpps', 'Modos' => 'Auto/Sound/DMX/ILDA', 'Diodos' => 'RGB Analógico'],
                    ['Gráficos 3D', 'Miles de colores', 'Audiorítmico', 'Seguro para la vista'],
                    'items/laser-show.jpg',
                ],
            ],
            'efectos-clasicos' => [
                ['Bola de Espejos 50cm', 5,
                    ['Diámetro' => '50cm', 'Material' => 'Espejo cristal real', 'Motor' => '1.5 RPM', 'Peso' => '5kg'],
                    ['Efecto clásico', 'Reflejos nítidos', 'Motor incluido', 'Varios tamaños'],
                    'items/bola-espejo.jpg',
                ],
                ['Efecto LED', 4,
                    ['Tipo' => 'LED', 'Colores' => 'RGB', 'Control' => 'Auto/Sound'],
                    ['Efecto dinámico', 'Bajo consumo', 'Alta luminosidad'],
                    'items/efecto-led.jpg',
                ],
            ],
            'efectos-atmosfericos' => [
                ['Máquina de Humo Baja', 2,
                    ['Potencia' => '3000W', 'Salida' => '40000 cu.ft/min', 'Tanque' => '2.5L', 'Tiempo calentamiento' => '4 min'],
                    ['Humo bajo denso', 'Sin olor', 'Calentamiento rápido', 'Control remoto'],
                    'items/maquina-humo.jpg',
                ],
            ],
            'efectos-lanzadores' => [
                ['Cañón de Confetti', 2,
                    ['Mecanismo' => 'Aire Comprimido / CO2', 'Consumible' => 'Papel metálico/papel', 'Alcance' => '12 metros'],
                    ['Disparo de aire comprimido', 'Alcance 10-15m', 'Papel ignífugo', 'Efecto lluvia'],
                    'items/confetti.jpg',
                ],
                ['Pistola CO2', 2,
                    ['Manguera' => 'Alta presión 3m', 'Alcance' => '8 metros', 'Accionamiento' => 'Gatillo manual', 'Peso' => '3kg'],
                    ['Chorro criogénico', 'Efecto refrescante', 'Disparo instantáneo', 'Seguro para interiores'],
                    'items/co2.jpg',
                ],
            ],
            'escenario-pistas' => [
                ['Pista LED Infinity', 1,
                    ['Resolución' => '10mm', 'Carga máx' => '500kg/panel', 'Protección' => 'IP65', 'Consumo' => '100W/panel'],
                    ['Suelo interactivo', 'Soporta alto peso', 'Patrones dinámicos', 'Superficie antideslizante'],
                    'items/pista-led.jpg',
                ],
            ],
            'escenario-tarimas' => [
                ['Tarima Modular', 4,
                    ['Módulo' => '2x1m', 'Altura' => '0.2 - 1.4m', 'Carga' => '750kg/m2', 'Material' => 'Aluminio y Fenólico'],
                    ['Altura ajustable', 'Superficie modular', 'Acabado profesional', 'Peldaños incluidos'],
                    'items/tarima.jpg',
                ],
            ],
            'escenario-estructuras' => [
                ['Estructura Truss 30x30', 4,
                    ['Tipo' => 'K30 Cuadrada', 'Aleación' => 'EN-AW 6082 T6', 'Tubo principal' => '50x2mm', 'Unión' => 'Cónica'],
                    ['Aluminio reforzado', 'Montaje rápido', 'Soporta gran carga', 'Diseño versátil'],
                    'items/estructura-truss.jpg',
                ],
            ],
            'escenario-decoracion' => [
                ['Cluster Esferas de Espejos', 12,
                    ['Cantidad' => '12 unidades (aprox)', 'Diámetros' => 'Mix 30cm / 40cm', 'Material' => 'Facetas de vidrio real'],
                    ['Clásico efecto disco vintage', 'Reflejos multidireccionales', 'Montaje en racimo decorativo'],
                    'items/bola-espejo.jpg',
                ],
                ['Letras Gigantes LED', 1,
                    ['Altura' => '100cm', 'Material' => 'Chapa pintada', 'Luces' => 'Módulos LED Pixel', 'Voltaje' => '12V'],
                    ['1 metro de altura', 'Iluminación RGB', 'Control individual', 'Tipografía moderna'],
                    'items/letras-led.jpg',
                ],
            ],
        ];

        $plan = array_merge_recursive($plan, $migrationItems);

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
