<?php

declare(strict_types=1);

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseFormRequest extends FormRequest
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
            'address' => ['required', 'string'],
            'map' => ['nullable', 'string'],
            'city' => ['required', 'integer', 'exists:cities,id'],
            'user' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
