<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|max:255',
            'in_stock' => 'required|boolean',
        ];
    }


    public function messages(): array
    {
        return [
            'category.regex' => 'The category must be a valid slug (lowercase letters, numbers, and hyphens only).',
        ];
    }
}
