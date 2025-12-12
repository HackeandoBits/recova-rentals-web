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
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 50, 'y' => 30],
                ['slug' => 'laser-verde-pro-3w', 'x' => 50, 'y' => 80],
                ['slug' => 'cluster-esferas-de-espejos', 'x' => 50, 'y' => 50],
                ['slug' => 'pantalla-led-p3-indoor', 'x' => 80, 'y' => 50],
            ],
            'combo-002' => [['slug' => 'tarima-modular', 'x' => 50, 'y' => 90], ['slug' => 'cabezal-movil-beam-230', 'x' => 20, 'y' => 40]],
            'combo-003' => [['slug' => 'cabezal-movil-beam-230', 'x' => 50, 'y' => 20], ['slug' => 'estructura-truss-30x30', 'x' => 80, 'y' => 50]],
            'combo-004' => [['slug' => 'laser-show-rgb-3w', 'x' => 50, 'y' => 50], ['slug' => 'maquina-de-humo-baja', 'x' => 80, 'y' => 80]],
            'combo-005' => [['slug' => 'pista-led-infinity', 'x' => 50, 'y' => 90], ['slug' => 'estructura-truss-30x30', 'x' => 50, 'y' => 20]],
            // Batch 2
            'combo-006' => [['slug' => 'tarima-modular', 'x' => 50, 'y' => 80], ['slug' => 'cabezal-movil-wash-led', 'x' => 20, 'y' => 30]],
            'combo-007' => [['slug' => 'pantalla-led-p3', 'x' => 50, 'y' => 40], ['slug' => 'cabezal-movil-beam-230', 'x' => 80, 'y' => 60]],
            'combo-008' => [['slug' => 'pista-led-infinity', 'x' => 50, 'y' => 90], ['slug' => 'laser-show-rgb-3w', 'x' => 30, 'y' => 30]],
            'combo-009' => [['slug' => 'cabezal-movil-beam-230', 'x' => 50, 'y' => 40], ['slug' => 'maquina-de-humo-baja', 'x' => 80, 'y' => 80]],
            'combo-010' => [['slug' => 'bola-de-espejos-50cm', 'x' => 50, 'y' => 20], ['slug' => 'cabezal-movil-beam-230', 'x' => 70, 'y' => 50]],
            // Batch 3
            'combo-011' => [['slug' => 'bola-de-espejos-50cm', 'x' => 30, 'y' => 20], ['slug' => 'cabezal-movil-wash-led', 'x' => 70, 'y' => 80]],
            'combo-012' => [['slug' => 'pantalla-led-p3', 'x' => 50, 'y' => 50], ['slug' => 'cabezal-movil-wash-led', 'x' => 20, 'y' => 30]],
            'combo-013' => [['slug' => 'bola-de-espejos-50cm', 'x' => 50, 'y' => 30], ['slug' => 'cabezal-movil-wash-led', 'x' => 80, 'y' => 60]],
            'combo-014' => [['slug' => 'bola-de-espejos-50cm', 'x' => 50, 'y' => 20], ['slug' => 'efecto-led', 'x' => 50, 'y' => 50]],
            'combo-015' => [['slug' => 'pistola-co2', 'x' => 30, 'y' => 60], ['slug' => 'canon-de-confetti', 'x' => 70, 'y' => 60]],
            // Batch 4
            'combo-016' => [['slug' => 'cabezal-movil-beam-230', 'x' => 20, 'y' => 30], ['slug' => 'pantalla-led-p3', 'x' => 60, 'y' => 50]],
            'combo-017' => [['slug' => 'bola-de-espejos-50cm', 'x' => 50, 'y' => 20], ['slug' => 'cabezal-movil-wash-led', 'x' => 50, 'y' => 70]],
            'combo-018' => [['slug' => 'bola-de-espejos-50cm', 'x' => 33, 'y' => 30], ['slug' => 'bola-de-espejos-50cm', 'x' => 66, 'y' => 30]],
            'combo-019' => [['slug' => 'cabezal-movil-beam-230', 'x' => 20, 'y' => 40], ['slug' => 'bola-de-espejos-50cm', 'x' => 60, 'y' => 30]],
            'combo-020' => [['slug' => 'pista-led-infinity', 'x' => 50, 'y' => 85], ['slug' => 'cabezal-movil-beam-230', 'x' => 20, 'y' => 30]],
            // Batch 5
            'combo-021' => [['slug' => 'pantalla-led-p3', 'x' => 50, 'y' => 40], ['slug' => 'cabezal-movil-beam-230', 'x' => 80, 'y' => 30]],
            'combo-022' => [['slug' => 'estructura-truss-30x30', 'x' => 50, 'y' => 50], ['slug' => 'cabezal-movil-wash-led', 'x' => 20, 'y' => 80]],
            'combo-023' => [['slug' => 'bola-de-espejos-50cm', 'x' => 40, 'y' => 25], ['slug' => 'cabezal-movil-wash-led', 'x' => 70, 'y' => 60]],
            'combo-024' => [['slug' => 'pantalla-led-p3', 'x' => 30, 'y' => 50], ['slug' => 'pista-led-infinity', 'x' => 70, 'y' => 90]],
            'combo-025' => [['slug' => 'laser-show-rgb-3w', 'x' => 50, 'y' => 40], ['slug' => 'cabezal-movil-beam-230', 'x' => 20, 'y' => 60]],
            // Batch 6
            'combo-026' => [['slug' => 'pantalla-led-curva', 'x' => 50, 'y' => 50]],
            'combo-027' => [['slug' => 'bola-de-espejos-50cm', 'x' => 30, 'y' => 20], ['slug' => 'cabezal-movil-beam-230', 'x' => 70, 'y' => 40]],
            'combo-028' => [['slug' => 'pantalla-led-p3', 'x' => 30, 'y' => 40], ['slug' => 'laser-show-rgb-3w', 'x' => 70, 'y' => 40]],
            'combo-029' => [['slug' => 'estructura-truss-30x30', 'x' => 50, 'y' => 30], ['slug' => 'pantalla-led-p3', 'x' => 50, 'y' => 60]],
            'combo-030' => [['slug' => 'letras-gigantes-led', 'x' => 50, 'y' => 70]],
            // Batch 7
            'combo-031' => [['slug' => 'pantalla-led-p3', 'x' => 50, 'y' => 50], ['slug' => 'tarima-modular', 'x' => 50, 'y' => 80]],
            'combo-032' => [['slug' => 'bola-de-espejos-50cm', 'x' => 50, 'y' => 30]],
            'combo-033' => [['slug' => 'bola-de-espejos-50cm', 'x' => 40, 'y' => 30], ['slug' => 'cabezal-movil-beam-230', 'x' => 70, 'y' => 50]],
            'combo-034' => [['slug' => 'laser-show-rgb-3w', 'x' => 50, 'y' => 50], ['slug' => 'maquina-de-humo-baja', 'x' => 50, 'y' => 80]],
        ];

        // Configuración de las 3 Categorías
        // Distribuimos las fotos 001-034 en 3 grupos balanceados.

        $categories = [
            [
                'id' => 'seleccion-1',
                'title' => 'Nuevos Ingresos', // Título editable
                'description' => 'Descubre lo último en equipamiento para eventos.',
                'range' => [1, 12], // De la 001 a la 012
            ],
            [
                'id' => 'seleccion-2',
                'title' => 'Tendencias', // Título editable
                'description' => 'Los combos más populares de la temporada.',
                'range' => [13, 24], // De la 013 a la 024
            ],
            [
                'id' => 'seleccion-3',
                'title' => 'Escenarios & Estructuras', // Título editable
                'description' => 'Montajes profesionales para grandes impactos.',
                'range' => [25, 34], // De la 025 a la 034
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
                    $allSlugs[] = $hotspot['slug'];
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
