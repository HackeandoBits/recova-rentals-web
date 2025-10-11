<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        $id = $this->route('category'); // null en store, id en update
        return [
            'name'        => ['required','string','max:160'],
            'slug'        => ['required','string','max:160','unique:categories,slug'.($id?','.$id:'')],
            'description' => ['nullable','string'],
            'parent_id'   => ['nullable','exists:categories,id'],
        ];
    }
}
