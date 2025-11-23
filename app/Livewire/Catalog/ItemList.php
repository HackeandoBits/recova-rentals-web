<?php

namespace App\Livewire\Catalog;

use App\Models\Item;
use Livewire\Component;

class ItemList extends Component
{
    /**
     * Esta es la "plantilla" de tu página de hotspots.
     * Define las imágenes de fondo y las coordenadas [x, y] de cada hotspot.
     * El 'slug' DEBE coincidir con un slug de tu ItemSeeder.php
     */
    private function getSceneData(): array
    {
        $baseData = [
            [
                'id' => 'pantallas-led',
                'title' => 'Pantallas LED',
                'description' => 'Sistemas de pantallas LED de alta definición.',
                'images' => [
                    [
                        'id' => 'led-screens-setup',
                        'combo_slug' => 'combo-pantallas-premium', // Nuevo slug
                        'title' => 'Pantallas LED Premium en Acción',
                        'image_url' => asset('storage/img/led-screens-event.png'),
                        'hotspots' => [
                            ['slug' => 'pantalla-led-p2-9-indoor-3x2m', 'x' => 45, 'y' => 20],
                            ['slug' => 'moving-head-200w-spot', 'x' => 75, 'y' => 35],
                            ['slug' => 'consola-16ch-con-fx', 'x' => 20, 'y' => 80], // Nuevo
                        ],
                    ],
                    [
                        'id' => 'led-ceiling-setup',
                        'combo_slug' => 'combo-techo-led', // Nuevo slug
                        'title' => 'Instalación de Techo LED',
                        'image_url' => asset('storage/img/led-ceiling-setup.jpg'),
                        'hotspots' => [
                            ['slug' => 'pantalla-led-p3-9-indoor-4x2m', 'x' => 50, 'y' => 30],
                            ['slug' => 'moving-head-200w-spot', 'x' => 70, 'y' => 60],
                            ['slug' => 'par-led-rgb-18x10w', 'x' => 30, 'y' => 20], // Nuevo
                        ],
                    ],
                ],
            ],
            [
                'id' => 'iluminacion',
                'title' => 'Iluminación y Láseres',
                'description' => 'Sistemas de iluminación profesional y láseres de alta potencia.',
                'images' => [
                    [
                        'id' => 'laser-show',
                        'combo_slug' => 'combo-laser-show', // Nuevo slug
                        'title' => 'Show de Láser Profesional',
                        'image_url' => asset('storage/img/laser-show-event.png'),
                        'hotspots' => [
                            ['slug' => 'laser-rgb-2w-profesional', 'x' => 60, 'y' => 25],
                            ['slug' => 'par-led-rgb-18x10w', 'x' => 30, 'y' => 15],
                            ['slug' => 'consola-16ch-con-fx', 'x' => 80, 'y' => 80], // Nuevo
                        ],
                    ],
                    [
                        'id' => 'laseres-green',
                        'combo_slug' => 'combo-laseres-verdes', // Nuevo slug
                        'title' => 'Láseres Verdes de Concierto',
                        'image_url' => asset('storage/img/lasers.jpg'),
                        'hotspots' => [
                            ['slug' => 'laser-verde-1w-animacion', 'x' => 50, 'y' => 40],
                            ['slug' => 'parlante-activo-12-1000w', 'x' => 20, 'y' => 60], // Nuevo
                            ['slug' => 'microfono-inalambrico-uhf', 'x' => 80, 'y' => 70], // Nuevo
                        ],
                    ],
                ],
            ],
            [
                'id' => 'escenarios',
                'title' => 'Escenarios y Sonido',
                'description' => 'Estructuras modulares y sonido de alta calidad.',
                'images' => [
                    [
                        'id' => 'stage-production',
                        'combo_slug' => 'combo-escenario-completo', // Nuevo slug
                        'title' => 'Producción Completa de Escenario',
                        'image_url' => asset('storage/img/stage-production-event.png'),
                        'hotspots' => [
                            ['slug' => 'estructura-6x4m', 'x' => 65, 'y' => 70],
                            ['slug' => 'parlante-activo-12-1000w', 'x' => 80, 'y' => 55],
                            ['slug' => 'subwoofer-18-1200w', 'x' => 20, 'y' => 60],
                        ],
                    ],
                ],
            ],
        ];

        // DUPLICACIÓN DE IMÁGENES PARA EL CARRUSEL
        // Queremos que cada categoría tenga al menos 6 imágenes para que el carrusel de 3 se vea bien y loopee.
        foreach ($baseData as &$category) {
            $originalImages = $category['images'];
            // Repetimos las imágenes hasta tener al menos 6
            while (count($category['images']) < 6) {
                foreach ($originalImages as $img) {
                    // Es importante generar un ID único para el key de React/Alpine si fuera necesario,
                    // aunque aquí usamos índices mayormente.
                    $newImg = $img;
                    $newImg['id'] = $img['id'].'_'.uniqid();
                    $category['images'][] = $newImg;
                }
            }
        }

        return $baseData;
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

        // 5. Obtener los conteos de items por combo para la actualización optimista
        $comboSlugs = [];
        foreach ($sceneData as $category) {
            foreach ($category['images'] as $image) {
                if (isset($image['combo_slug'])) {
                    $comboSlugs[] = $image['combo_slug'];
                }
            }
        }

        $combos = \App\Models\Combo::whereIn('slug', $comboSlugs)->withCount('items')->get()->keyBy('slug');

        foreach ($finalCategories as &$category) {
            foreach ($category['images'] as &$image) {
                if (isset($image['combo_slug']) && $combos->has($image['combo_slug'])) {
                    // Sumamos la cantidad total de items (considerando la cantidad pivot si fuera necesario,
                    // pero withCount('items') da el número de filas. Si la cantidad importa, deberíamos sumar 'quantity'.
                    // Por simplicidad y rendimiento, asumimos 1 item = 1 cantidad o usamos una query más compleja si es crítico.
                    // Para ser más precisos, cargamos los items y sumamos quantities.
                    $combo = $combos->get($image['combo_slug']);
                    // Si necesitamos la suma de cantidades (pivot), withCount no basta.
                    // Pero para el contador de "ítems únicos" o "bultos", withCount sirve.
                    // Si el carrito suma cantidades totales, necesitamos eso.
                    // Vamos a asumir que el contador del carrito muestra la suma de cantidades.
                    // Haremos una carga ligera para esto o lo dejamos en withCount si es suficiente.
                    // Revisando CartManager, usa array_sum(column(quantity)).
                    // Entonces necesitamos la suma de cantidades.

                    // Ajuste: Cargar combos con items para sumar cantidades correctamente.
                    // Esto se hace mejor fuera del loop.
                }
            }
        }
        // Re-hacemos la query de combos para obtener los items con sus datos necesarios
        $combosWithItems = \App\Models\Combo::whereIn('slug', $comboSlugs)
            ->with(['items' => function ($query) {
                $query->with('category')->select('items.id', 'items.name', 'items.category_id', 'items.image_url');
            }])
            ->get()
            ->keyBy('slug');

        foreach ($finalCategories as &$category) {
            foreach ($category['images'] as &$image) {
                $image['combo_count'] = 0; // Default
                $image['combo_items'] = []; // Default for client-side cart

                if (isset($image['combo_slug']) && $combosWithItems->has($image['combo_slug'])) {
                    $combo = $combosWithItems->get($image['combo_slug']);
                    $totalQty = 0;
                    $comboItemsData = [];

                    foreach ($combo->items as $cItem) {
                        $qty = $cItem->pivot->quantity ?? 1;
                        $totalQty += $qty;

                        $comboItemsData[] = [
                            'id' => $cItem->id,
                            'name' => $cItem->name,
                            'category' => $cItem->category->name ?? 'General',
                            'image_url' => $cItem->image_url ? asset($cItem->image_url) : null, // Ensure asset() helper is used if needed, or just path
                            'quantity' => $qty,
                        ];
                    }
                    $image['combo_count'] = $totalQty;
                    $image['combo_items'] = $comboItemsData;
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
