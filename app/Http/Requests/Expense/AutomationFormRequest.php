<?php

declare(strict_types=1);

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class AutomationFormRequest extends FormRequest
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
            'schedule' => ['required', 'integer', 'exists:schedules,id'],
            'provider' => ['required', 'integer', 'exists:providers,id'],

            'name' => ['required', 'string'],
            'note' => ['nullable', 'string'],
            'price_ht' => ['required', 'numeric'],
            'expense_date' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
