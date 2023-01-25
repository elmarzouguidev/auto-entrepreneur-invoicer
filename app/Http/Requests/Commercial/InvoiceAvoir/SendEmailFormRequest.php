<?php

declare(strict_types=1);

namespace App\Http\Requests\Commercial\InvoiceAvoir;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailFormRequest extends FormRequest
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
            'invoice' => 'required|uuid',
            'emails.*.*' => ['nullable', 'email'],
        ];
    }
}
