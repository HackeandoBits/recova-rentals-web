<?php

namespace App\Livewire\Cart;

use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Component; // ¡Importante para escuchar eventos!

class CartManager extends Component
{
    public array $cartItems = [];

    public int $cartCount = 0;

    public function mount(): void
    {
        $this->loadCart();
    }

    // Carga el carrito desde la sesión
    #[On('cart-updated')]
    public function loadCart(): void
    {
        $this->cartItems = session('cart', []);
        $this->cartCount = array_sum(array_column($this->cartItems, 'quantity'));
    }

    // Guarda el carrito en la sesión
    private function saveCart(): void
    {
        session(['cart' => $this->cartItems]);
        $this->loadCart(); // Recarga el estado
    }

    // public function openCart(): void
    // {
    //     $this->dispatch('open-cart-modal');
    // }

    /**
     * Listener: Escucha el evento 'add-to-cart'
     * disparado desde el ItemList.
     */
    #[On('add-to-cart')]
    public function addToCart($itemId): void
    {
        $item = Item::find($itemId);
        if (! $item) {
            return;
        }

        // Si el item ya está, sumamos 1. Si no, lo creamos con cantidad 1.
        if (isset($this->cartItems[$itemId])) {
            $this->cartItems[$itemId]['quantity']++;
        } else {
            $this->cartItems[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => 1,
                // 'image' => $item->image_url, // (Opcional, si tenés una)
            ];
        }

        $this->saveCart();

        // Disparamos un evento para que el Modal sepa que debe refrescarse
        $this->dispatch('cart-updated');

        // Opcional: Mostrar una notificación "¡Agregado!"
        // $this->dispatch('show-toast', 'Producto agregado');
        // $this->dispatch('show-toast', 'Producto agregado');
    }

    /**
     * Listener: Escucha el evento 'add-combo'
     * disparado desde el ItemList.
     */
    #[On('add-combo')]
    public function addCombo($comboSlug): void
    {
        \Illuminate\Support\Facades\Log::info('addCombo called', ['slug' => $comboSlug]);
        // Buscar el combo por slug
        $combo = \App\Models\Combo::with('items')->where('slug', $comboSlug)->first();

        if (! $combo) {
            \Illuminate\Support\Facades\Log::warning('Combo not found', ['slug' => $comboSlug]);

            return;
        }

        // Iterar sobre los items del combo y agregarlos
        foreach ($combo->items as $item) {
            $qtyToAdd = $item->pivot->quantity ?? 1; // Cantidad definida en el combo

            if (isset($this->cartItems[$item->id])) {
                $this->cartItems[$item->id]['quantity'] += $qtyToAdd;
            } else {
                $this->cartItems[$item->id] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $qtyToAdd,
                ];
            }
        }

        $this->saveCart();
        $this->dispatch('cart-updated');
        // $this->dispatch('open-cart-modal'); // YA NO ABRIMOS EL MODAL AUTOMÁTICAMENTE
    }

    /**
     * Listener: Escucha el evento 'remove-from-cart'.
     * (Lo llamará el CartModal)
     */
    #[On('remove-from-cart')]
    public function removeFromCart($itemId): void
    {
        $itemId = (int) $itemId; // Forzar casting a entero
        \Illuminate\Support\Facades\Log::info('removeFromCart called', ['itemId' => $itemId, 'cart_keys' => array_keys($this->cartItems)]);

        if (isset($this->cartItems[$itemId])) {
            unset($this->cartItems[$itemId]);
            $this->saveCart();
            $this->dispatch('cart-updated'); // Avisa al modal que refresque
        } else {
            \Illuminate\Support\Facades\Log::warning('Item to remove not found in cart', ['itemId' => $itemId]);
        }
    }

    /**
     * Listener: Escucha el evento 'clear-cart'.
     * (Lo llamará el CartModal cuando se envíe el form)
     */
    #[On('clear-cart')]
    public function clearCart(): void
    {
        session()->forget('cart');
        $this->loadCart();
        $this->dispatch('cart-updated'); // Avisa al modal que refresque
    }

    /**
     * Este componente renderiza el ícono del carrito.
     * La vista es 'resources/views/livewire/cart/cart-manager.blade.php'
     */
    public function render()
    {
        return view('livewire.cart.cart-manager');
    }
}
