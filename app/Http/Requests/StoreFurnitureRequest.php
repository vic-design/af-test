<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFurnitureRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min: 5', 'max: 255', 'string'],
            'description' => ['string', 'nullable'],
            'price' => ['required', 'numeric', 'min: 0.01'],
            'quantity' => ['required', 'integer', 'min: 0'],
        ];
    }
}
