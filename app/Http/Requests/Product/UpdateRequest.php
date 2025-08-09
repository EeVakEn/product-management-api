<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'category' => 'sometimes|required|string|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|max:255',
            'in_stock' => 'sometimes|required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category.regex' => 'The category must be a valid slug (lowercase letters, numbers, and hyphens only).',
        ];
    }
}
