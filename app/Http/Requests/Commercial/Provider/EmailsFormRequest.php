<?php

declare(strict_types=1);

namespace App\Http\Requests\Commercial\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailsFormRequest extends FormRequest
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
            'secend_email' => ['required', 'email', Rule::unique('emails', 'email')],
        ];
    }
}
