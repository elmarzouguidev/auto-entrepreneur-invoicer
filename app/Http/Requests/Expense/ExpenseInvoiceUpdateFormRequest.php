<?php

declare(strict_types=1);

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseInvoiceUpdateFormRequest extends FormRequest
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
            'taxe' => ['required', 'integer', 'exists:taxes,id'],
            'category' => ['required', 'integer', 'exists:expense_categories,id'],
            'currency' => ['required', 'integer', 'exists:currencies,id'],
            'provider' => ['required', 'integer', 'exists:providers,id'],
            'reference' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'price_ht' => ['required', 'numeric'],
            'invoice_date' => ['required', 'date', 'date_format:Y-m-d'],
            'expense_file' => ['nullable', 'file', 'mimes:png,jpg,pdf', 'max:2048'],
        ];
    }
}
