<?php

namespace App\Livewire\Catalog;

use App\Models\Item;
use Livewire\Component;

class ItemList extends Component
{
    public string $q = '';

    public function render()
    {
        $items = Item::query()
            ->when($this->q !== '', fn ($qr) => $qr->where('name', 'like', '%'.$this->q.'%'))
            // Solo eager-load si la relación existe
            ->when(method_exists(Item::class, 'images'), fn ($qr) => $qr->with('images'))
            ->where('active', 1)   // evita true/false si tu columna es tinyint
            ->paginate(12)
            ->withQueryString();

        return view('livewire.catalog.item-list', compact('items'))
            ->layout('livewire.layout.app', ['title' => 'Catálogo']);
    }
}
