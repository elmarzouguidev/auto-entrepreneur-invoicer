<?php

declare(strict_types=1);

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductFormRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'price_net' => ['nullable', 'numeric'],
            'price_buy' => ['required', 'numeric'],
            'price_sell' => ['required', 'numeric'],

            'sku' => ['required', 'string', Rule::unique('products')->ignore($this->route('product'), 'uuid')],

            'category' => ['nullable', 'integer', 'exists:categories,id'],
            'brand' => ['nullable', 'integer', 'exists:brands,id'],

            'unite' => ['required', 'integer', 'exists:unites,id'],
            'taxe' => ['required', 'integer', 'exists:taxes,id'],

            'photo' => 'nullable|file|mimes:png,jpg,jpeg',
        ];
    }
}
