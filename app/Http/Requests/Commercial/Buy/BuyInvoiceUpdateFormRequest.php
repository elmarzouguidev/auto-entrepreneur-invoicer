<?php

declare(strict_types=1);

namespace App\Http\Requests\Commercial\Buy;

use Illuminate\Foundation\Http\FormRequest;

class BuyInvoiceUpdateFormRequest extends FormRequest
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
            'provider' => ['required', 'integer', 'exists:providers,id'],
            'code' => ['required', 'string'],
            'taxe' => ['nullable', 'integer', 'exists:taxes,id'],
            'price_ht' => ['required', 'numeric'],
            'invoice_date' => ['required', 'date', 'date_format:Y-m-d'],
            'notes' => ['nullable', 'string'],

            'invoice_file' => ['nullable', 'file', 'mimes:png,jpg,pdf', 'max:2048'],
        ];
    }
}
