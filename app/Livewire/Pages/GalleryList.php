<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class GalleryList extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = [
            [
                'id' => 1,
                'title' => 'Festival Electrónico Formosa',
                'date' => 'Marzo 2024',
                'location' => 'Parque Central',
                'category' => 'Festival',
                'image' => asset('storage/img/led-screens-event.png'),
                'description' => 'Un evento masivo con la mejor tecnología en pantallas LED y sonido envolvente para una experiencia inolvidable.',
                'equipment' => ['Pantallas LED P3', 'Sistema Line Array', 'Láseres RGB 10W'],
            ],
            [
                'id' => 2,
                'title' => 'Show de Luces Corporativo',
                'date' => 'Abril 2024',
                'location' => 'Hotel Howard Johnson',
                'category' => 'Corporativo',
                'image' => asset('storage/img/laser-show-event.png'),
                'description' => 'Presentación de producto con un show de láseres sincronizados y efectos visuales de alto impacto.',
                'equipment' => ['Láseres RGB', 'Máquinas de Humo', 'Iluminación Robótica'],
            ],
            [
                'id' => 3,
                'title' => 'Concierto Rock en Vivo',
                'date' => 'Mayo 2024',
                'location' => 'Estadio Cincuentenario',
                'category' => 'Concierto',
                'image' => asset('storage/img/stage-production-event.png'),
                'description' => 'Montaje completo de escenario, iluminación y sonido para banda de rock internacional.',
                'equipment' => ['Escenario Modular', 'Iluminación Beam/Spot', 'Consola Digital 64ch'],
            ],
            [
                'id' => 4,
                'title' => 'Gala de Premiación',
                'date' => 'Junio 2024',
                'location' => 'Salón de Eventos',
                'category' => 'Social',
                'image' => asset('storage/img/led-ceiling-setup.jpg'),
                'description' => 'Ambientación elegante con techo LED y proyección de mapping para cena de gala.',
                'equipment' => ['Techo LED', 'Proyectores 10K', 'Sonido Distribuido'],
            ],
        ];
    }

    public function render()
    {
        return view('livewire.pages.gallery-list');
    }
}
