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
        // Mapa de Hotspots por Combo
        $hotspotsMap = [
            // Batch 1
            'combo-001' => [['slug' => 'laser-show', 'x' => 50, 'y' => 30], ['slug' => 'estructura-truss', 'x' => 50, 'y' => 80]],
            'combo-002' => [['slug' => 'tarima', 'x' => 50, 'y' => 90], ['slug' => 'beam-light', 'x' => 20, 'y' => 40]],
            'combo-003' => [['slug' => 'beam-light', 'x' => 50, 'y' => 20], ['slug' => 'estructura-truss', 'x' => 80, 'y' => 50]],
            'combo-004' => [['slug' => 'laser-show', 'x' => 50, 'y' => 50], ['slug' => 'maquina-humo', 'x' => 80, 'y' => 80]],
            'combo-005' => [['slug' => 'pista-led', 'x' => 50, 'y' => 90], ['slug' => 'estructura-truss', 'x' => 50, 'y' => 20]],
            // Batch 2
            'combo-006' => [['slug' => 'tarima', 'x' => 50, 'y' => 80], ['slug' => 'wash-light', 'x' => 20, 'y' => 30]],
            'combo-007' => [['slug' => 'pantalla-led', 'x' => 50, 'y' => 40], ['slug' => 'beam-light', 'x' => 80, 'y' => 60]],
            'combo-008' => [['slug' => 'pista-led', 'x' => 50, 'y' => 90], ['slug' => 'laser-show', 'x' => 30, 'y' => 30]],
            'combo-009' => [['slug' => 'beam-light', 'x' => 50, 'y' => 40], ['slug' => 'maquina-humo', 'x' => 80, 'y' => 80]],
            'combo-010' => [['slug' => 'bola-espejo', 'x' => 50, 'y' => 20], ['slug' => 'beam-light', 'x' => 70, 'y' => 50]],
            // Batch 3
            'combo-011' => [['slug' => 'bola-espejo', 'x' => 30, 'y' => 20], ['slug' => 'wash-light', 'x' => 70, 'y' => 80]],
            'combo-012' => [['slug' => 'pantalla-led', 'x' => 50, 'y' => 50], ['slug' => 'wash-light', 'x' => 20, 'y' => 30]],
            'combo-013' => [['slug' => 'bola-espejo', 'x' => 50, 'y' => 30], ['slug' => 'wash-light', 'x' => 80, 'y' => 60]],
            'combo-014' => [['slug' => 'bola-espejo', 'x' => 50, 'y' => 20], ['slug' => 'efecto-led', 'x' => 50, 'y' => 50]],
            'combo-015' => [['slug' => 'co2', 'x' => 30, 'y' => 60], ['slug' => 'confetti', 'x' => 70, 'y' => 60]],
            // Batch 4
            'combo-016' => [['slug' => 'beam-light', 'x' => 20, 'y' => 30], ['slug' => 'pantalla-led', 'x' => 60, 'y' => 50]],
            'combo-017' => [['slug' => 'bola-espejo', 'x' => 50, 'y' => 20], ['slug' => 'wash-light', 'x' => 50, 'y' => 70]],
            'combo-018' => [['slug' => 'bola-espejo', 'x' => 33, 'y' => 30], ['slug' => 'bola-espejo', 'x' => 66, 'y' => 30]],
            'combo-019' => [['slug' => 'beam-light', 'x' => 20, 'y' => 40], ['slug' => 'bola-espejo', 'x' => 60, 'y' => 30]],
            'combo-020' => [['slug' => 'pista-led', 'x' => 50, 'y' => 85], ['slug' => 'beam-light', 'x' => 20, 'y' => 30]],
            // Batch 5
            'combo-021' => [['slug' => 'pantalla-led', 'x' => 50, 'y' => 40], ['slug' => 'beam-light', 'x' => 80, 'y' => 30]],
            'combo-022' => [['slug' => 'estructura-truss', 'x' => 50, 'y' => 50], ['slug' => 'wash-light', 'x' => 20, 'y' => 80]],
            'combo-023' => [['slug' => 'bola-espejo', 'x' => 40, 'y' => 25], ['slug' => 'wash-light', 'x' => 70, 'y' => 60]],
            'combo-024' => [['slug' => 'pantalla-led', 'x' => 30, 'y' => 50], ['slug' => 'pista-led', 'x' => 70, 'y' => 90]],
            'combo-025' => [['slug' => 'laser-show', 'x' => 50, 'y' => 40], ['slug' => 'beam-light', 'x' => 20, 'y' => 60]],
            // Batch 6
            'combo-026' => [['slug' => 'pantalla-led-curva', 'x' => 50, 'y' => 50]],
            'combo-027' => [['slug' => 'bola-espejo', 'x' => 30, 'y' => 20], ['slug' => 'beam-light', 'x' => 70, 'y' => 40]],
            'combo-028' => [['slug' => 'pantalla-led', 'x' => 30, 'y' => 40], ['slug' => 'laser-show', 'x' => 70, 'y' => 40]],
            'combo-029' => [['slug' => 'estructura-truss', 'x' => 50, 'y' => 30], ['slug' => 'pantalla-led', 'x' => 50, 'y' => 60]],
            'combo-030' => [['slug' => 'letras-led', 'x' => 50, 'y' => 70]],
            // Batch 7
            'combo-031' => [['slug' => 'pantalla-led', 'x' => 50, 'y' => 50], ['slug' => 'tarima', 'x' => 50, 'y' => 80]],
            'combo-032' => [['slug' => 'bola-espejo', 'x' => 50, 'y' => 30]],
            'combo-033' => [['slug' => 'bola-espejo', 'x' => 40, 'y' => 30], ['slug' => 'beam-light', 'x' => 70, 'y' => 50]],
            'combo-034' => [['slug' => 'laser-show', 'x' => 50, 'y' => 50], ['slug' => 'maquina-humo', 'x' => 50, 'y' => 80]],
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
                    // Asignar el nombre real de la BD al título local de la imagen
                    $image['title'] = $combo->name;

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
