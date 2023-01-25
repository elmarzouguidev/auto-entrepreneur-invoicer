<?php

declare(strict_types=1);

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdjustmentFormRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getProducts()
    {
        $products = $this->products ?? [];

        return collect($products)
            ->collect();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'warehouse' => ['required', 'integer', 'exists:warehouses,id'],

            'reference' => ['nullable', 'string'],

            'products' => ['required', 'array'],
            'products.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'products.*.type' => ['required', 'string', Rule::in(['add', 'sub'])],
            'products.*.qte' => ['required', 'integer'],
        ];
    }
}
