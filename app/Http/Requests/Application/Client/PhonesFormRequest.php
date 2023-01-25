<?php

declare(strict_types=1);

namespace App\Http\Requests\Application\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhonesFormRequest extends FormRequest
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
            'telephone' => ['required', 'phone:MA', Rule::unique('telephones', 'telephone')],
            'type' => ['required', 'string'],
        ];
    }
}
