<?php

namespace App\Livewire;

use Livewire\Component;

class Relojito extends Component
{
    public $hora;
    public $size; // tamaño del reloj

    public function mount($size = 24) // tamaño por defecto 24
    {
        $this->size = $size;
        $this->actualizarHora();
    }

    public function actualizarHora()
    {
        $this->hora = now()->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.relojito');
    }
}
