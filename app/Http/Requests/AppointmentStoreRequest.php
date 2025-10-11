<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'booking_id'       => ['required','exists:bookings,id'],
            'assigned_user_id' => ['required','exists:users,id'],
            'starts_at'        => ['required','date'],
            'ends_at'          => ['required','date','after:starts_at'],
            'channel'          => ['required','in:office,whatsapp,email'],
            'location_note'    => ['nullable','string','max:120'],
            'status'           => ['nullable','in:scheduled,done,cancelled'],
        ];
    }
}
