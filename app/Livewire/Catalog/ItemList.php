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
                        'title' => 'Pantallas LED Premium en Acción',
                        'image_url' => asset('storage/img/led-screens-event.png'),
                        'hotspots' => [
                            ['slug' => 'pantalla-led-p29-indoor-3x2m', 'x' => 45, 'y' => 20],
                            ['slug' => 'moving-head-200w-spot', 'x' => 75, 'y' => 35],
                        ],
                    ],
                    [
                        'id' => 'led-ceiling-setup',
                        'title' => 'Instalación de Techo LED',
                        'image_url' => asset('storage/img/led-ceiling-setup.jpg'),
                        'hotspots' => [
                            ['slug' => 'pantalla-led-p39-indoor-4x2m', 'x' => 50, 'y' => 30],
                            ['slug' => 'moving-head-200w-spot', 'x' => 70, 'y' => 60],
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
                        'title' => 'Show de Láser Profesional',
                        'image_url' => asset('storage/img/laser-show-event.png'),
                        'hotspots' => [
                            ['slug' => 'laser-rgb-2w-profesional', 'x' => 60, 'y' => 25],
                            ['slug' => 'par-led-rgb-18x10w', 'x' => 30, 'y' => 15],
                        ],
                    ],
                    [
                        'id' => 'laseres-green',
                        'title' => 'Láseres Verdes de Concierto',
                        'image_url' => asset('storage/img/lasers.jpg'),
                        'hotspots' => [
                            ['slug' => 'laser-verde-1w-animacion', 'x' => 50, 'y' => 40],
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

    public ?Item $selectedItem = null;

    public bool $showDetailPanel = false;

    public bool $showSpecs = false;

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
        //    y los mapea por su slug para fácil acceso.
        $itemsFromDb = Item::whereIn('slug', $allSlugs)
            ->where('active', true)
            ->get()
            ->keyBy('slug');

        // 4. Construye el array final, reemplazando 'slug' con el 'item_id' real.
        //    Si un item no se encuentra en la BBDD, el hotspot no se mostrará.
        $finalCategories = [];
        foreach ($sceneData as $category) {
            $finalCategory = $category;
            $finalCategory['images'] = [];

            foreach ($category['images'] as $image) {
                $finalImage = $image;
                $finalImage['hotspots'] = [];

                foreach ($image['hotspots'] as $hotspot) {
                    // ¡AQUÍ ESTÁ LA MAGIA!
                    // Buscamos el item que encontramos en la BBDD
                    if ($itemsFromDb->has($hotspot['slug'])) {
                        $item = $itemsFromDb->get($hotspot['slug']);

                        // Agregamos el hotspot solo si el item existe
                        $finalImage['hotspots'][] = [
                            'item_id' => $item->id, // Usamos el ID real de la BBDD
                            'name' => $item->name,    // Pasamos el nombre para el 'tooltip'
                            'x' => $hotspot['x'],
                            'y' => $hotspot['y'],
                        ];
                    }
                    // Si no existe, simplemente no se agrega al array y no se muestra.
                }
                $finalCategory['images'][] = $finalImage;
            }
            $finalCategories[] = $finalCategory;
        }

        $this->imageCategories = $finalCategories;
    }

    /**
     * Esta función se llama cuando hacés clic en un hotspot
     */
    public function selectItem($itemId)
    {
        // Cargamos el Item CON sus relaciones
        $this->selectedItem = Item::with('category', 'features', 'specs')
            ->find($itemId);

        $this->showSpecs = false;
        $this->showDetailPanel = true;
    }

    public function closePanel()
    {
        $this->showDetailPanel = false;
        $this->selectedItem = null;
        $this->showSpecs = false;
    }

    /**
     * Despacha el evento al CartManager (que ya está escuchando)
     */
    public function addToCartAndClose()
    {
        if ($this->selectedItem) {
            $this->dispatch('add-to-cart', itemId: $this->selectedItem->id);
            $this->closePanel();
        }
    }

    /**
     * Esta nueva función será llamada por el botón "Ver detalles"
     */
    public function toggleSpecs()
    {
        $this->showSpecs = true;
    }

    public function render()
    {
        return view('livewire.catalog.item-list')
            ->layout('livewire.layout.app', ['title' => 'Catálogo Interactivo']);
    }
}
