<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
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
            'assigned_user_id' => ['sometimes','exists:users,id'],
            'starts_at'        => ['sometimes','date'],
            'ends_at'          => ['sometimes','date','after:starts_at'],
            'channel'          => ['sometimes','in:office,whatsapp,email'],
            'location_note'    => ['nullable','string','max:120'],
            'status'           => ['sometimes','in:scheduled,done,cancelled'],
        ];
    }
}
