<?php

namespace App\Livewire\Cart;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CartModal extends Component
{
    // Propiedades públicas
    public array $blockedSlots = [];
    public bool $loadingSlots = false;
    // --- Datos del Formulario ---
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $requestType = ''; // 'whatsapp' o 'reunion'

    public ?string $meetingDateOnly = null;  // Solo la fecha (YYYY-MM-DD)
    public ?string $meetingTime = null;      // Solo la hora (HH:MM)

    public string $notes = '';

    // --- Estado del Envío ---
    public bool $success = false;

    public ?string $errorMessage = null;

    //--Formatea los horarios de reunión que ve el usuario

    public function getAvailableTimeSlots(): array
    {
    return [
        'Mañana (9:00 - 13:00)' => [
            '09:00' => '09:00',
            '09:30' => '09:30',
            '10:00' => '10:00',
            '10:30' => '10:30',
            '11:00' => '11:00',
            '11:30' => '11:30',
            '12:00' => '12:00',
            '12:30' => '12:30',
            '13:00' => '13:00',
        ],
        'Tarde (14:00 - 18:00)' => [
            '14:00' => '14:00',
            '14:30' => '14:30',
            '15:00' => '15:00',
            '15:30' => '15:30',
            '16:00' => '16:00',
            '16:30' => '16:30',
            '17:00' => '17:00',
            '17:30' => '17:30',
            '18:00' => '18:00',
        ],
    ];
    }
    /**
     * Consulta horarios bloqueados para una fecha
     */
    public function fetchBlockedSlotsForDate(?string $date = null): void
    {
        Log::info('🔍 fetchBlockedSlotsForDate llamado', ['date' => $date]);
        if (!$date) {
            $this->blockedSlots = [];
            return;
        }
        $this->loadingSlots = true;
        
        try {
            $response = Http::withToken(env('ADMIN_API_TOKEN'))
                ->acceptJson()
                ->timeout(10)
                ->get(env('ADMIN_API_URL') . '/api/v1/bookings/occupied-time-slots', [
                    'date' => $date,
                ]);
            if ($response->successful()) {
                $this->blockedSlots = $response->json('blocked_slots', []);
                Log::info('✅ Slots bloqueados recibidos', ['blocked_slots' => $this->blockedSlots]); 
            } else {
                $this->blockedSlots = [];
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching blocked slots', ['message' => $e->getMessage()]);
            $this->blockedSlots = [];
        } finally {
            $this->loadingSlots = false;
        }
    }
    /**
     * Obtiene horarios disponibles filtrando los bloqueados
     */
    public function getAvailableTimeSlotsForDate(): array
    {
        $allSlots = $this->getAvailableTimeSlots();
        
        if (empty($this->blockedSlots)) {
            return $allSlots;
        }
        // Filtrar bloqueados
        foreach ($allSlots as $group => $times) {
            $allSlots[$group] = array_filter($times, function($time, $key) {
                return !in_array($key, $this->blockedSlots);
            }, ARRAY_FILTER_USE_BOTH);
        }
        return $allSlots;
    }
    /**
     * Se ejecuta automáticamente cuando cambia la fecha
     */
    public function updatedMeetingDateOnly($value): void
    {
        Log::info('📅 updatedMeetingDateOnly ejecutado', ['value' => $value]);
        $this->meetingTime = null; // Resetear hora
        
        if ($value) {
            $this->fetchBlockedSlotsForDate($value);
        } else {
            $this->blockedSlots = [];
        }
    }

    /**
     * Resetea el estado del formulario (errores, éxito)
     * Se llama desde el frontend al abrir el modal.
     */
    public function resetState(): void
    {
        $this->reset([
        'success', 
        'errorMessage', 
        'name', 
        'email', 
        'phone', 
        'requestType', 
        'meetingDateOnly', 
        'meetingTime',     
        'notes'
    ]);
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
            'meetingDateOnly' => 'nullable|required_if:requestType,reunion|date|after:today',
            'meetingTime' => 'nullable|required_if:requestType,reunion|in:09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00',
            'notes' => 'nullable|string|max:500',
        ]);

        if (empty($items)) {
            $this->errorMessage = 'El carrito está vacío.';

            return;
        }

        $this->errorMessage = null;

        // 1. Preparar los datos
        $meetingDateTime = null;
        if ($this->meetingDateOnly && $this->meetingTime) {
            $meetingDateTime = $this->meetingDateOnly . 'T' . $this->meetingTime;
        }
        $data = [
            'customer' => [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ],
            'items' => $items, // Items recibidos desde el frontend
            'request_type' => $this->requestType, // Debe ser 'whatsapp' o 'reunion' (no 'meeting')
            'meeting_date' => $meetingDateTime,
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
                $this->reset(['name', 'email', 'phone', 'requestType', 'meetingDateOnly', 'meetingTime', 'notes']);

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
