<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CartModal extends Component
{
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

    /**
     * Resetea el estado del formulario (errores, éxito)
     * Se llama desde el frontend al abrir el modal.
     */
    public function resetState(): void
    {
        $this->reset(['success', 'errorMessage', 'name', 'email', 'phone', 'requestType', 'meetingDate', 'notes']);
    }

    /**
     * El paso final: enviar todo a la API del Admin
     * Acepta los items directamente desde el frontend (Alpine.js)
     */
    public function handleSubmit(array $items): void
    {
        \Illuminate\Support\Facades\Log::info('CartModal: handleSubmit called', ['items_count' => count($items), 'items' => $items]);
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'requestType' => 'required|in:whatsapp,reunion',
            'meetingDate' => 'nullable|required_if:requestType,reunion|date',
            'notes' => 'nullable|string|max:500',
        ]);

        if (empty($items)) {
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
            'items' => $items, // Items recibidos desde el frontend
            'request_type' => $this->requestType, // Debe ser 'whatsapp' o 'reunion' (no 'meeting')
            'meeting_date' => $this->meetingDate,
            'notes' => $this->notes,
        ];

        try {
            // 2. LLAMAR A LA API DEL ADMIN
            \Illuminate\Support\Facades\Log::info('CartModal: Sending request to Admin API', ['url' => env('ADMIN_API_URL').'/api/v1/bookings', 'data' => $data]);
            $response = Http::withToken(env('ADMIN_API_TOKEN'))
                ->acceptJson() // Forzar respuesta JSON
                ->timeout(30) // Timeout de 30s (aumentado porque el servidor puede tardar)
                ->post(env('ADMIN_API_URL').'/api/v1/bookings', $data);

            \Illuminate\Support\Facades\Log::info('CartModal: API Response', ['status' => $response->status(), 'body' => $response->body()]);

            // 3. Verificar respuesta
            if ($response->successful()) {
                $this->success = true;
                $this->dispatch('budget-sent');
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
        \Illuminate\Support\Facades\Log::info('CartModal: render called');

        return view('livewire.cart.cart-modal', [
            'requestType' => $this->requestType,
        ]);
    }
}
