<?php

declare(strict_types=1);

namespace App\Http\Requests\Commercial\BCommand;

use Illuminate\Foundation\Http\FormRequest;

class EmailFormRequest extends FormRequest
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
            'bc' => 'required|uuid',
            'emails.*.*' => ['nullable', 'email'],
        ];
    }
}
