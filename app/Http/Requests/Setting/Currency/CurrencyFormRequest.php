<?php

declare(strict_types=1);

namespace App\Http\Requests\Setting\Currency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyFormRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('currencies')],
            'symbole' => ['required', 'string', Rule::unique('currencies')],
        ];
    }
}
