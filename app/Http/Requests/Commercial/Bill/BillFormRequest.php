<?php

namespace App\Http\Requests\Commercial\Bill;

use Illuminate\Foundation\Http\FormRequest;

class BillFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice' => ['nullable', 'uuid'],
            'price_total' => ['nullable', 'string'],
            'bill_date' => ['required', 'date'],
            'bill_mode' => ['nullable', 'integer', 'exists:payment_types,id'],
            'reference' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
