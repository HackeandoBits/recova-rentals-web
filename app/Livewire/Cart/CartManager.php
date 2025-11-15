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
    public function loadCart(): void
    {
        $this->cartItems = session('cart', []);
        $this->cartCount = count($this->cartItems);
    }

    // Guarda el carrito en la sesión
    private function saveCart(): void
    {
        session(['cart' => $this->cartItems]);
        $this->loadCart(); // Recarga el estado
    }

     public function openCart(): void
    {
        $this->dispatch('open-cart-modal');
    }

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

        // Si el item no está en el carrito, lo agregamos (sin precio)
        if (! isset($this->cartItems[$itemId])) {
            $this->cartItems[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => 1,
                // 'image' => $item->image_url, // (Opcional, si tenés una)
            ];
        }
        // (No necesitamos 'else' porque no sumamos cantidad, solo es para seleccionar)

        $this->saveCart();

        // Disparamos un evento para que el Modal sepa que debe refrescarse
        $this->dispatch('cart-updated');

        // Opcional: Mostrar una notificación "¡Agregado!"
        // $this->dispatch('show-toast', 'Producto agregado');
    }

    /**
     * Listener: Escucha el evento 'remove-from-cart'.
     * (Lo llamará el CartModal)
     */
    #[On('remove-from-cart')]
    public function removeFromCart($itemId): void
    {
        if (isset($this->cartItems[$itemId])) {
            unset($this->cartItems[$itemId]);
            $this->saveCart();
            $this->dispatch('cart-updated'); // Avisa al modal que refresque
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
