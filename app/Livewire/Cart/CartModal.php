<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class CartModal extends Component
{
    public bool $isOpen = false;

    public array $items = [];

    // --- Datos del Formulario ---
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $requestType = ''; // 'whatsapp' o 'reunion'

    public ?string $meetingDate = null;

    public string $notes = '';

    /**
     * Listener: Escucha el evento disparado
     * desde el ícono del carrito (CartManager)
     */
    #[On('open-cart-modal')]
    public function openModal(): void
    {
        $this->loadCart();
        $this->isOpen = true;
    }

    /**
     * Listener: Escucha a CartManager por si
     * un item se borra MIENTRAS el modal está abierto.
     */
    #[On('cart-updated')]
    public function loadCart(): void
    {
        $this->items = session('cart', []);
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    // Llama al CartManager para borrar un item
    public function removeItem($itemId): void
    {
        $this->dispatch('remove-from-cart', itemId: $itemId);
        // El listener 'cart-updated' se encargará de refrescar
    }

    /**
     * El paso final: enviar todo a la API del Admin
     */
    public function handleSubmit(): void
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'requestType' => 'required|in:whatsapp,reunion',
            'meetingDate' => 'nullable|required_if:requestType,reunion|date',
            'notes' => 'nullable|string|max:500',
        ]);

        if (count($this->items) === 0) {
            // Opcional: mostrar error "carrito vacío"
            return;
        }

        // 1. Preparar los datos
        $data = [
            'customer' => [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ],
            'items' => array_values($this->items), // Envía los items del carrito
            'request_type' => $this->requestType,
            'meeting_date' => $this->meetingDate,
            'notes' => $this->notes,
        ];

        // 2. LLAMAR A LA API DEL ADMIN (¡Este es el próximo paso!)
        // Http::withToken(env('ADMIN_API_TOKEN'))
        //    ->post(env('ADMIN_API_URL') . '/api/v1/bookings', $data);

        // 3. Simulación de éxito por ahora
        session()->flash('message', '¡Solicitud enviada con éxito!');
        $this->dispatch('clear-cart');
        $this->closeModal();
        $this->reset(['name', 'email', 'phone', 'requestType', 'meetingDate', 'notes']);
    }

    public function render()
    {
        return view('livewire.cart.cart-modal');
    }
}
