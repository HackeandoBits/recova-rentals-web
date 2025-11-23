<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Http;
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

    // --- Estado del Envío ---
    public bool $success = false;

    public ?string $errorMessage = null;

    public function mount()
    {
        $this->items = session('cart') ?? [];
    }

    /**
     * Listener: Escucha el evento disparado
     * desde el ícono del carrito (CartManager)
     */
    #[On('open-cart-modal')]
    public function openModal(): void
    {
        $this->loadCart();
        $this->isOpen = true;
        $this->reset(['success', 'errorMessage']); // Resetear estado al abrir
    }

    /**
     * Listener: Escucha a CartManager por si
     * un item se borra MIENTRAS el modal está abierto.
     */
    #[On('cart-updated')]
    public function loadCart(): void
    {
        \Illuminate\Support\Facades\Log::info('CartModal: loadCart triggered');
        $this->items = session('cart') ?? [];
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    // Llama al CartManager para borrar un item
    public function removeItem($itemId): void
    {
        // 1. Eliminar localmente
        if (isset($this->items[$itemId])) {
            unset($this->items[$itemId]);
        }

        // 2. Actualizar la sesión DIRECTAMENTE (Evita race conditions y roundtrips)
        session(['cart' => $this->items]);

        // 3. Avisar al resto de la app (ej: ícono del carrito) que se actualizó
        $this->dispatch('cart-updated');
    }

    // Hook de Livewire: Se ejecuta cuando cualquier propiedad 'items' cambia
    public function updatedItems(): void
    {
        // 1. Actualizar la sesión
        session(['cart' => $this->items]);

        // 2. Avisar al resto de la app (ej: ícono del carrito)
        $this->dispatch('cart-updated');
    }

    // Mantenemos increment/decrement por si se llaman desde otro lado,
    // pero la UI principal usará binding directo.
    public function increment($itemId): void
    {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId]['quantity']++;
            $this->updatedItems();
        }
    }

    public function decrement($itemId): void
    {
        if (isset($this->items[$itemId])) {
            if ($this->items[$itemId]['quantity'] > 1) {
                $this->items[$itemId]['quantity']--;
                $this->updatedItems();
            } else {
                $this->removeItem($itemId);
            }
        }
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
            $this->errorMessage = 'El carrito está vacío.';

            return;
        }

        $this->errorMessage = null;

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

        try {
            // 2. LLAMAR A LA API DEL ADMIN
            $response = Http::withToken(env('ADMIN_API_TOKEN'))
                ->timeout(10) // Timeout de 10s
                ->post(env('ADMIN_API_URL').'/api/v1/bookings', $data);

            // 3. Verificar respuesta
            if ($response->successful()) {
                $this->success = true;
                $this->dispatch('clear-cart');
                $this->reset(['name', 'email', 'phone', 'requestType', 'meetingDate', 'notes']);

                // Opcional: cerrar modal después de unos segundos o dejarlo abierto con el mensaje
                // $this->closeModal();
            } else {
                $this->errorMessage = 'Error del servidor: '.$response->status();
                \Illuminate\Support\Facades\Log::error('Booking Error', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'No se pudo conectar con el servidor. Intente más tarde.';
            \Illuminate\Support\Facades\Log::error('Booking Exception', ['message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.cart.cart-modal');
    }
}
