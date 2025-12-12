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
            'combo-002' => [
                ['slug' => 'laser-show-azul-3w', 'x' => 50, 'y' => 20],
                ['slug' => 'circulo-led-neon-flex', 'x' => 50, 'y' => 90],
                ['slug' => 'maquina-de-humo-haze', 'x' => 80, 'y' => 80],
            ],
            'combo-003' => [
                ['slug' => 'tubos-led-pixel', 'x' => 50, 'y' => 50],
                ['slug' => 'estructura-truss-negra', 'x' => 50, 'y' => 20],
            ],
            'combo-004' => [
                ['slug' => 'maquina-fuego-frio', 'x' => 20, 'y' => 80],
                ['slug' => 'pantalla-led-poster', 'x' => 80, 'y' => 50],
            ],
            'combo-005' => [
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 50, 'y' => 30],
                ['slug' => 'banadores-led', 'x' => 50, 'y' => 90],
                ['slug' => 'pantalla-led-de-fondo', 'x' => 50, 'y' => 50],
            ],
            // Batch 2
            'combo-006' => [
                ['slug' => 'arana-cristal-estilo-imperio', 'x' => 50, 'y' => 30],
                ['slug' => 'pantalla-led-totem-1x4', 'x' => 80, 'y' => 50],
                ['slug' => 'techo-de-esferas-fondo', 'x' => 50, 'y' => 20],
            ],
            'combo-007' => [
                ['slug' => 'sistema-laser-array-rojo', 'x' => 50, 'y' => 30],
                ['slug' => 'pantalla-led-segmentada', 'x' => 50, 'y' => 50],
            ],
            'combo-008' => [
                ['slug' => 'matriz-de-esferas-de-espejos', 'x' => 50, 'y' => 20],
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 80, 'y' => 50],
            ],
            'combo-009' => [
                ['slug' => 'truss-circular-ring', 'x' => 50, 'y' => 30],
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 50, 'y' => 40],
                ['slug' => 'consola-de-iluminacion', 'x' => 50, 'y' => 80],
            ],
            'combo-010' => [
                ['slug' => 'pantalla-led-p3-split', 'x' => 30, 'y' => 50],
                ['slug' => 'cabezal-movil-hibrido', 'x' => 70, 'y' => 50],
            ],
            // Batch 3
            'combo-011' => [
                ['slug' => 'esferas-de-espejos-mix', 'x' => 50, 'y' => 50],
                ['slug' => 'pin-spot-led-beam', 'x' => 80, 'y' => 20],
            ],
            'combo-012' => [
                ['slug' => 'cabezal-movil-beam-7r', 'x' => 20, 'y' => 30],
                ['slug' => 'pantalla-led-escenario-completo', 'x' => 50, 'y' => 50],
            ],
            'combo-013' => [
                ['slug' => 'banadores-led', 'x' => 50, 'y' => 80],
                ['slug' => 'hileras-de-esferas', 'x' => 50, 'y' => 30],
            ],
            'combo-014' => [
                ['slug' => 'estructura-rectangular-de-esferas', 'x' => 50, 'y' => 20],
                ['slug' => 'aranas-colgantes-5-brazos', 'x' => 50, 'y' => 50],
            ],
            'combo-015' => [
                ['slug' => 'pistola-de-co2', 'x' => 30, 'y' => 60],
                ['slug' => 'cotillon-luminoso', 'x' => 70, 'y' => 60],
            ],
            // Batch 4
            'combo-016' => [
                ['slug' => 'paneles-led-techo', 'x' => 50, 'y' => 20],
                ['slug' => 'cabezal-movil-beam-verde', 'x' => 50, 'y' => 50],
            ],
            'combo-017' => [
                ['slug' => 'cabezal-movil-beam-gold', 'x' => 50, 'y' => 20],
                ['slug' => 'pantallas-led-diseno', 'x' => 50, 'y' => 80],
            ],
            'combo-018' => [
                ['slug' => 'grid-de-esferas', 'x' => 50, 'y' => 20],
                ['slug' => 'banadores-led-high-power', 'x' => 50, 'y' => 80],
            ],
            'combo-019' => [
                ['slug' => 'esferas-colgantes', 'x' => 50, 'y' => 30],
                ['slug' => 'sistema-de-rigging', 'x' => 50, 'y' => 10],
            ],
            'combo-020' => [
                ['slug' => 'cabezal-movil-beam-mix-colores', 'x' => 50, 'y' => 50],
                ['slug' => 'cluster-esferas-de-espejos', 'x' => 50, 'y' => 20],
            ],
            // Batch 5
            'combo-021' => [
                ['slug' => 'pantallas-led-totems-separadas', 'x' => 50, 'y' => 50],
                ['slug' => 'iluminacion-wash-azul', 'x' => 50, 'y' => 80],
            ],
            'combo-022' => [
                ['slug' => 'laser-grafico-verde', 'x' => 50, 'y' => 40],
                ['slug' => 'iluminacion-perimetral', 'x' => 50, 'y' => 80],
            ],
            'combo-023' => [
                ['slug' => 'techo-led-pixel', 'x' => 50, 'y' => 20],
                ['slug' => 'cabezal-beam-ambar', 'x' => 50, 'y' => 80],
            ],
            'combo-024' => [
                ['slug' => 'truss-circular-ring', 'x' => 50, 'y' => 30],
                ['slug' => 'consola-de-iluminacion', 'x' => 30, 'y' => 80],
                ['slug' => 'pista-ajedrezada', 'x' => 70, 'y' => 80],
            ],
            // Batch 6
            'combo-025' => [
                ['slug' => 'paneles-led-techo-diamante', 'x' => 50, 'y' => 20],
                ['slug' => 'tubos-led-verticales', 'x' => 80, 'y' => 50],
                ['slug' => 'cabezal-movil-beam-violeta', 'x' => 20, 'y' => 50],
            ],
            'combo-026' => [
                ['slug' => 'letras-corporeas-led-love', 'x' => 50, 'y' => 50],
                ['slug' => 'iluminacion-decorativa-guirnaldas', 'x' => 50, 'y' => 20],
            ],
            'combo-027' => [
                ['slug' => 'pared-led-gran-formato', 'x' => 50, 'y' => 50],
                ['slug' => 'pista-ajedrezada', 'x' => 50, 'y' => 90],
            ],
            'combo-028' => [
                ['slug' => 'matriz-esferas-techo', 'x' => 50, 'y' => 20],
                ['slug' => 'aranas-de-estilo-chandelier', 'x' => 50, 'y' => 40],
            ],
            'combo-029' => [
                ['slug' => 'pantalla-led-dividida-stripes', 'x' => 50, 'y' => 50],
                ['slug' => 'laser-verde-show', 'x' => 20, 'y' => 50],
            ],
            'combo-030' => [
                ['slug' => 'pantalla-led-techo-inclinada', 'x' => 50, 'y' => 20],
                ['slug' => 'tarimas-escenario-dj', 'x' => 50, 'y' => 80],
            ],
            // Batch 7
            'combo-031' => [
                ['slug' => 'sistema-laser-azul-tunel', 'x' => 50, 'y' => 50],
                ['slug' => 'esferas-de-espejo-reflectoras', 'x' => 20, 'y' => 50],
            ],
            'combo-032' => [
                ['slug' => 'estructura-escenario-layher', 'x' => 50, 'y' => 50],
                ['slug' => 'mix-pantallas-custom', 'x' => 50, 'y' => 30],
                ['slug' => 'array-iluminacion-beam-wash', 'x' => 50, 'y' => 10],
            ],
            'combo-033' => [
                ['slug' => 'bastidor-estructura-movil', 'x' => 50, 'y' => 50],
                ['slug' => 'cortina-de-esferas', 'x' => 50, 'y' => 50],
            ],
            'combo-034' => [
                ['slug' => 'grid-esferas-masivo', 'x' => 50, 'y' => 20],
                ['slug' => 'iluminacion-beam-cruzada', 'x' => 50, 'y' => 80],
            ],
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
