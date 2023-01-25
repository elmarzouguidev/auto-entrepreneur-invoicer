<?php

declare(strict_types=1);

namespace App\Http\Requests\Setting\Taxes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxeFormRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'taux_percent' => ['required', 'numeric', Rule::unique('taxes')],
        ];
    }
}
