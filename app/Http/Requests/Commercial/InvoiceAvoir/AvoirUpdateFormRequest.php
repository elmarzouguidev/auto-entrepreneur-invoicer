<?php

namespace App\Http\Requests\Commercial\InvoiceAvoir;

use Illuminate\Foundation\Http\FormRequest;

class AvoirUpdateFormRequest extends FormRequest
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

    public function getArticles()
    {
        $articles = $this->articlesnew ?? [];

        return collect($articles)
            ->whereNull('montant_ht')
            ->collect();
    }

    public function getOlderArticles()
    {
        $articles = $this->articles ?? [];

        return collect($articles)
            ->whereNotNull('articleuuid')
            ->collect();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client' => ['required', 'integer'],

            'invoice_number' => ['required', 'numeric'], //avoir invoice

            'invoice_date' => ['required', 'date'],
            //'due_date' => ['required', 'date'],

            'admin_notes' => ['nullable', 'string'],
            'payment_mode' => ['required', 'integer', 'exists:payment_types,id'],
            'condition_general' => ['nullable', 'string'],

            'articlesnew' => ['nullable', 'array'],

            'articlesnew.*.articleuuid' => ['nullable', 'uuid'],

            'articlesnew.*.designation' => ['nullable', 'string'],
            //'articlesnew.*.description' => ['nullable', 'string'],
            'articlesnew.*.quantity' => ['nullable', 'integer'],
            'articlesnew.*.prix_unitaire' => ['nullable', 'numeric', 'digits_between:1,20'],
            //'articlesnew.*.montant_ht' => ['nullable', 'numeric'],
            'articlesnew.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],
        ];
    }
}
