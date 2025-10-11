<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
        $id = $this->route('item');
        return [
            'category_id' => ['required','exists:categories,id'],
            'name'        => ['required','string','max:160'],
            'slug'        => ['required','string','max:160','unique:items,slug'.($id?','.$id:'')],
            'description' => ['nullable','string'],
            'stock'       => ['nullable','integer','min:0'],
            'active'      => ['boolean'],
            // features/specs si los cargás en el mismo form:
            'features'                => ['array'],
            'features.*.text'         => ['required','string','max:255'],
            'features.*.sort_order'   => ['nullable','integer','min:0'],
            'specs'                   => ['array'],
            'specs.*.spec_key'        => ['required','string','max:100'],
            'specs.*.spec_value'      => ['required','string','max:255'],
            'specs.*.sort_order'      => ['nullable','integer','min:0'],
        ];
    }
}
