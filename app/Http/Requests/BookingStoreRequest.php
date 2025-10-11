<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'customer_name'     => ['required','string','max:160'],
        'customer_email'    => ['required','email','max:160'],
        'customer_phone'    => ['nullable','string','max:40'],
        'event_date'        => ['required','date','after_or_equal:today'],
        'meeting_type'      => ['required','in:none,virtual,whatsapp,in_person'],
        'meeting_date'      => ['nullable','date'],
        'meeting_time_note' => ['nullable','string','max:120'],
        'service_type'      => ['required','string','max:120'],
        'notes'             => ['nullable','string'],
        'status'            => ['in:pending,confirmed,cancelled'],
        // items de la reserva (si cargas en el mismo endpoint)
        'items'                         => ['array','min:1'],
        'items.*.product_type'          => ['required','in:App\Models\Item,App\Models\Combo'],
        'items.*.product_id'            => ['required','integer','min:1'],
        'items.*.quantity'              => ['required','integer','min:1'],
        'items.*.note'                  => ['nullable','string','max:160'],
    ];
    }
}
