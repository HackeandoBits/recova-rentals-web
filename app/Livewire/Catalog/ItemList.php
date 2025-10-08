<?php
namespace App\Livewire\Catalog;
use Livewire\Component;
use App\Models\Item;

class ItemList extends Component {
    public string $q = '';
    public function render(){
        $items = Item::query()
          ->when($this->q, fn($qr)=>$qr->where('name','like',"%{$this->q}%"))
          ->with('images')
          ->where('active', true)
          ->paginate(12);
        return view('livewire.catalog.item-list', compact('items'))
            ->layout('livewire.layout.app', ['title' => 'Catálogo']);
    }
}