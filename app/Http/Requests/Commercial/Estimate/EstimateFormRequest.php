<?php

namespace App\Http\Requests\Commercial\Estimate;

use Illuminate\Foundation\Http\FormRequest;

class EstimateFormRequest extends FormRequest
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
            'client' => ['required', 'integer', 'exists:clients,id'],

            'estimate_date' => ['required', 'date', 'date_format:Y-m-d'],
            'due_date' => ['required', 'date', 'date_format:Y-m-d'],
            'payment_mode' => ['required', 'integer', 'exists:payment_types,id'],

            'admin_notes' => ['nullable', 'string'],
            'condition_general' => ['nullable', 'string'],

            'articles' => ['required', 'array'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.description' => ['nullable', 'string'],
            'articles.*.quantity' => ['required', 'integer'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'digits_between:1,20'],
            //'articles.*.montant_ht' => ['nullable', 'numeric'],
            'articles.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],
        ];
    }
}
