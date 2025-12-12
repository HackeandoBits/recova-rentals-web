<?php

namespace App\Livewire\Catalog;

use App\Models\Item;
use Livewire\Component;

class ItemList extends Component
{
    /*
    |--------------------------------------------------------------------------
    | 📖 GUÍA DE EDICIÓN DEL CATÁLOGO (Hotspots y Combos)
    |--------------------------------------------------------------------------
    |
    | 1. ¿DÓNDE ESTÁN LAS FOTOS?
    |    Las fotos de los combos (001.jpg, 002.jpg...) están en: storage/app/public/img/
    |    Si quieres cambiar una foto de fondo, simplemente reemplaza el archivo .jpg allí.
    |
    | 2. ¿CÓMO CAMBIO LOS PUNTOS INTERACTIVOS (HOTSPOTS)?
    |    Modifica el array $hotspotsMap aquí abajo.
    |
    |    Formato:
    |    'combo-XXX' => [
    |        ['slug' => 'item-slug', 'x' => 50, 'y' => 50],
    |        ...
    |    ]
    |
    |    - 'combo-XXX': Es el ID de la foto (ej: combo-001 corresponde a 001.jpg).
    |    - 'slug': Es el identificador del producto individual (ej: 'pantalla-led', 'beam-light').
    |              Estos slugs están definidos en la base de datos (tabla 'items').
    |    - 'x' / 'y': Son las coordenadas en PORCENTAJE (%).
    |              x=0 es izquierda, x=100 es derecha.
    |              y=0 es arriba, y=100 es abajo.
    |              Ej: x=50, y=50 es exactamente el centro.
    |
    | 3. ¿CÓMO AGREGO NUEVOS PRODUCTOS?
    |    Si necesitas un nuevo producto para etiquetar (ej: 'Nuevas Luces'), debes agregarlo
    |    primero en el archivo de migración: database/migrations/..._seed_essential_items_for_hotspots.php
    |    y luego ejecutar 'php artisan migrate:refresh'.
    |
    */
    private function getSceneData(): array
    {
        // Mapa de Hotspots por Combo
        $hotspotsMap = [
            // Batch 1
            'combo-001' => [
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 51, 'y' => 26],
                ['slug' => 'laser-verde-pro-3w', 'x' => 16, 'y' => 66],
                ['slug' => 'cluster-esferas-de-espejos', 'x' => 38, 'y' => 20],
                ['slug' => 'pantalla-led-p3-indoor', 'x' => 40, 'y' => 59],
            ],
            'combo-002' => [
                ['slug' => 'laser-show-azul-3w', 'x' => 19, 'y' => 14],
                ['slug' => 'circulo-led-neon-flex', 'x' => 51, 'y' => 78],
                ['slug' => 'maquina-de-humo-haze', 'x' => 17, 'y' => 45],
            ],
            'combo-003' => [
                ['slug' => 'tubos-led-pixel', 'x' => 48, 'y' => 24],
                ['slug' => 'estructura-truss-negra', 'x' => 33, 'y' => 44],
            ],
            'combo-004' => [
                ['slug' => 'maquina-fuego-frio', 'x' => 8, 'y' => 71],
                ['slug' => 'pantalla-led-poster', 'x' => 62, 'y' => 46],
            ],
            'combo-005' => [
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 27, 'y' => 55],
                ['slug' => 'banadores-led', 'x' => 77, 'y' => 50],
                ['slug' => 'pantalla-led-de-fondo', 'x' => 47, 'y' => 50],
            ],
            // Batch 2
            'combo-006' => [
                ['slug' => 'aranas-de-cristal-estilo-imperio', 'x' => 57, 'y' => 31],
                ['slug' => 'pantalla-led-totem-1x4', 'x' => 71, 'y' => 54],
                ['slug' => 'techo-de-esferas-fondo', 'x' => 48, 'y' => 8],
            ],
            'combo-007' => [
                ['slug' => 'sistema-laser-array-rojo', 'x' => 24, 'y' => 44],
                ['slug' => 'pantalla-led-segmentada', 'x' => 47, 'y' => 49],
            ],
            'combo-008' => [
                ['slug' => 'matriz-de-esferas-de-espejos', 'x' => 46, 'y' => 48],
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 52, 'y' => 26],
            ],
            // New 009 (Copy of Old 023)
            'combo-009' => [
                ['slug' => 'truss-circular-ring', 'x' => 39, 'y' => 36],
                ['slug' => 'consola-de-iluminacion', 'x' => 59, 'y' => 75],
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 31, 'y' => 48],
            ],
            'combo-010' => [
                ['slug' => 'pantalla-led-p3-split', 'x' => 35, 'y' => 64],
                ['slug' => 'cabezal-movil-hibrido', 'x' => 66, 'y' => 38],
            ],
            // Batch 3
            'combo-011' => [
                ['slug' => 'esferas-de-espejos-mix', 'x' => 50, 'y' => 50],
                ['slug' => 'pin-spot-led-beam', 'x' => 90, 'y' => 23],
            ],
            'combo-012' => [
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 29, 'y' => 48],
                ['slug' => 'pantalla-led-escenario-completo', 'x' => 51, 'y' => 50],
            ],
            'combo-013' => [
                ['slug' => 'cabezal-movil-wash', 'x' => 84, 'y' => 40],
                ['slug' => 'hileras-de-esferas', 'x' => 45, 'y' => 29],
            ],
            // New 014 (Old 026 Items, Old 014 Coords)
            'combo-014' => [
                ['slug' => 'matriz-esferas-techo', 'x' => 46, 'y' => 36], // Was 'estructura-rectangular...'
                ['slug' => 'aranas-de-estilo-chandelier', 'x' => 79, 'y' => 42], // Was 'aranas-colgantes...'
            ],
            'combo-015' => [
                ['slug' => 'pistola-de-co2', 'x' => 38, 'y' => 37],
                ['slug' => 'cotillon-luminoso', 'x' => 71, 'y' => 31],
            ],
            // Batch 4
            'combo-016' => [
                ['slug' => 'paneles-led-techo', 'x' => 48, 'y' => 15],
                ['slug' => 'cabezal-movil-beam-verde', 'x' => 37, 'y' => 16],
            ],
            'combo-017' => [
                ['slug' => 'grid-de-esferas', 'x' => 61, 'y' => 32],
                ['slug' => 'banadores-led-high-power', 'x' => 66, 'y' => 50],
            ],
            'combo-018' => [
                ['slug' => 'esferas-colgantes', 'x' => 49, 'y' => 15],
                ['slug' => 'sistema-de-rigging', 'x' => 12, 'y' => 15],
            ],
            'combo-019' => [
                ['slug' => 'cabezal-movil-beam-mix-colores', 'x' => 22, 'y' => 32],
                ['slug' => 'cluster-esferas-de-espejos', 'x' => 53, 'y' => 10],
            ],
            // Batch 5
            'combo-020' => [
                ['slug' => 'pantallas-led-totems-separadas', 'x' => 37, 'y' => 58],
                ['slug' => 'iluminacion-wash-azul', 'x' => 62, 'y' => 50],
            ],
            'combo-021' => [
                ['slug' => 'laser-grafico-verde', 'x' => 77, 'y' => 46],
                ['slug' => 'iluminacion-perimetral', 'x' => 52, 'y' => 45],
            ],
            'combo-022' => [
                ['slug' => 'techo-led-pixel', 'x' => 44, 'y' => 30],
                ['slug' => 'cabezal-beam-ambar', 'x' => 61, 'y' => 50],
            ],
            'combo-023' => [
                ['slug' => 'paneles-led-techo-diamante', 'x' => 54, 'y' => 32],
                ['slug' => 'tubos-led-verticales', 'x' => 63, 'y' => 58],
                ['slug' => 'cabezal-movil-beam-violeta', 'x' => 66, 'y' => 29],
            ],
            'combo-024' => [
                ['slug' => 'letras-corporeas-led-love', 'x' => 47, 'y' => 48],
                ['slug' => 'iluminacion-decorativa-guirnaldas', 'x' => 24, 'y' => 35],
            ],
            'combo-025' => [
                ['slug' => 'pared-led-gran-formato', 'x' => 58, 'y' => 31],
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 12, 'y' => 29],
            ],
            // Old 026 REMOVED, shifted up
            'combo-026' => [
                ['slug' => 'pantalla-led-dividida-stripes', 'x' => 79, 'y' => 58],
                ['slug' => 'laser-verde-show', 'x' => 24, 'y' => 52],
            ],
            'combo-027' => [
                ['slug' => 'pantalla-led-techo-inclinada', 'x' => 49, 'y' => 38],
                ['slug' => 'tarimas-escenario-dj', 'x' => 56, 'y' => 78],
            ],
            // Batch 7
            'combo-028' => [
                ['slug' => 'sistema-laser-azul-tunel', 'x' => 54, 'y' => 38],
                ['slug' => 'esferas-de-espejo-reflectoras', 'x' => 55, 'y' => 14],
            ],
            'combo-029' => [
                ['slug' => 'estructura-escenario-layher', 'x' => 48, 'y' => 81],
                ['slug' => 'mix-pantallas-custom', 'x' => 54, 'y' => 62],
                ['slug' => 'array-iluminacion-beamwash', 'x' => 76, 'y' => 20],
            ],
            'combo-030' => [
                ['slug' => 'bastidor-estructura-movil', 'x' => 41, 'y' => 21],
                ['slug' => 'cortina-de-esferas', 'x' => 47, 'y' => 47],
            ],
            'combo-031' => [
                ['slug' => 'grid-esferas-masivo', 'x' => 39, 'y' => 40],
                ['slug' => 'iluminacion-beam-cruzada', 'x' => 13, 'y' => 27],
            ],
        ];

        // Configuración de las 3 Categorías
        // Distribuimos las fotos 001-031 en 3 grupos balanceados.

        $categories = [
            [
                'id' => 'seleccion-1',
                'title' => 'Nuevos Ingresos',
                'description' => 'Descubre lo último en equipamiento para eventos.',
                'range' => [1, 12], // 1-12
            ],
            [
                'id' => 'seleccion-2',
                'title' => 'Tendencias',
                'description' => 'Los combos más populares de la temporada.',
                'range' => [13, 22], // 13-22 (10 items)
            ],
            [
                'id' => 'seleccion-3',
                'title' => 'Escenarios & Estructuras',
                'description' => 'Montajes profesionales para grandes impactos.',
                'range' => [23, 31], // 23-31 (9 items)
            ],
        ];

        $finalData = [];

        foreach ($categories as $cat) {
            $catImages = [];
            // Generamos las imágenes basándonos en el rango
            for ($i = $cat['range'][0]; $i <= $cat['range'][1]; $i++) {
                // Formato de número a 3 dígitos (ej: 001, 005, 012)
                $num = str_pad($i, 3, '0', STR_PAD_LEFT);
                $comboSlug = "combo-{$num}";

                $catImages[] = [
                    'id' => $comboSlug,
                    'combo_slug' => $comboSlug, // Slug para BD
                    'title' => "Combo {$num}",       // Título temporal del producto
                    'image_url' => asset("storage/img/{$num}.jpg"),
                    // Asignamos los hotspots del mapa
                    'hotspots' => $hotspotsMap[$comboSlug] ?? [],
                ];
            }

            $finalData[] = [
                'id' => $cat['id'],
                'title' => $cat['title'],
                'description' => $cat['description'],
                'images' => $catImages,
            ];
        }

        return $finalData;
    }

    // --- PROPIEDADES PÚBLICAS ---

    public array $imageCategories = [];

    // Datos pre-cargados para el modal en el cliente (AlpineJS)
    public array $itemsJson = [];

    public function mount()
    {
        // 1. Carga la plantilla visual (con slugs)
        $sceneData = $this->getSceneData();

        // 2. Extrae todos los slugs que necesitamos de la plantilla
        $allSlugs = [];
        foreach ($sceneData as $category) {
            foreach ($category['images'] as $image) {
                foreach ($image['hotspots'] as $hotspot) {
                    if (isset($hotspot['slug'])) {
                        $allSlugs[] = $hotspot['slug'];
                    }
                }
            }
        }

        // 3. Busca en la BBDD todos los items de una sola vez
        //    Cargamos relaciones necesarias para el modal
        $itemsFromDb = Item::with(['category', 'features', 'specs'])
            ->whereIn('slug', $allSlugs)
            ->where('active', true)
            ->get()
            ->keyBy('slug');

        // 4. Construye el array final y el JSON para el cliente
        $finalCategories = [];
        $itemsForClient = [];

        foreach ($sceneData as $category) {
            $finalCategory = $category;
            $finalCategory['images'] = [];

            foreach ($category['images'] as $image) {
                $finalImage = $image;
                $finalImage['hotspots'] = [];

                foreach ($image['hotspots'] as $hotspot) {
                    if ($itemsFromDb->has($hotspot['slug'])) {
                        $item = $itemsFromDb->get($hotspot['slug']);

                        // Agregamos el hotspot
                        $finalImage['hotspots'][] = [
                            'item_id' => $item->id,
                            'name' => $item->name,
                            'slug' => $hotspot['slug'], // Agregamos Slug para modo debug
                            'x' => $hotspot['x'],
                            'y' => $hotspot['y'],
                        ];

                        // Preparamos los datos para el modal (si no están ya)
                        if (! isset($itemsForClient[$item->id])) {
                            $itemsForClient[$item->id] = [
                                'id' => $item->id,
                                'name' => $item->name,
                                'description' => $item->description,
                                'image_url' => \Illuminate\Support\Str::startsWith($item->image_url, ['http', 'https'])
                                    ? $item->image_url
                                    : asset($item->image_url),
                                'category_name' => $item->category->name ?? 'Producto',
                                'features' => $item->features->sortBy('sort_order')->values()->toArray(),
                                'specs' => $item->specs->sortBy('sort_order')->values()->toArray(),
                            ];
                        }
                    }
                }
                $finalCategory['images'][] = $finalImage;
            }
            $finalCategories[] = $finalCategory;
        }

        // 5. Obtener los combos con sus items para el botón "Agregar Combo"
        $comboSlugs = [];
        foreach ($sceneData as $category) {
            foreach ($category['images'] as $image) {
                if (isset($image['combo_slug'])) {
                    $comboSlugs[] = $image['combo_slug'];
                }
            }
        }

        $combos = \App\Models\Combo::whereIn('slug', $comboSlugs)
            ->with(['items']) // Cargar items para obtener datos reales
            ->get()
            ->keyBy('slug');

        foreach ($finalCategories as &$category) {
            foreach ($category['images'] as &$image) {
                if (isset($image['combo_slug']) && $combos->has($image['combo_slug'])) {
                    $combo = $combos->get($image['combo_slug']);

                    // Sobrescribimos el título con el nombre real de la BD
                    $image['title'] = $combo->name;

                    // Construimos la lista de items para el carrito
                    $cartItems = [];
                    foreach ($combo->items as $cItem) {
                        $cartItems[] = [
                            'id' => $cItem->id,
                            'name' => $cItem->name,
                            'image_url' => \Illuminate\Support\Str::startsWith($cItem->image_url, ['http', 'https'])
                                ? $cItem->image_url
                                : asset($cItem->image_url),
                            'category' => $cItem->category->name ?? 'Combo',
                            'quantity' => $cItem->pivot->quantity ?? 1,
                        ];
                    }

                    $image['combo_items'] = $cartItems;
                } else {
                    // Fallback si no hay combo en BD
                    $image['combo_items'] = [];
                }
            }
        }

        $this->imageCategories = $finalCategories;
        $this->itemsJson = $itemsForClient;
    }

    /**
     * Método llamado desde el cliente para agregar al carrito
     */
    public function addToCart($itemId)
    {
        $this->dispatch('add-to-cart', itemId: $itemId);
    }

    public function addCombo($comboSlug)
    {
        $this->dispatch('add-combo', comboSlug: $comboSlug);
    }

    public function render()
    {
        return view('livewire.catalog.item-list')
            ->layout('livewire.layout.app', ['title' => 'Catálogo Interactivo']);
    }
}
