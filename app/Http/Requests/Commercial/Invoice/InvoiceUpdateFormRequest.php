<?php

namespace App\Http\Requests\Commercial\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceUpdateFormRequest extends FormRequest
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

    public function getNewArticles()
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

            'bl_code' => ['nullable', 'string'],
            'bc_code' => ['nullable', 'string'],

            'invoice_date' => ['required', 'date', 'date_format:Y-m-d'],
            'due_date' => ['required', 'date', 'date_format:Y-m-d'],
            'payment_mode' => ['required', 'integer', 'exists:payment_types,id'],

            'admin_notes' => ['nullable', 'string'],

            'condition_general' => ['nullable', 'string'],

            'hasproducts' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],

            'articlesnew' => ['required_if:hasproducts,false', 'array'],
            'articlesnew.*.articleuuid' => ['nullable', 'uuid'],
            'articlesnew.*.designation' => ['nullable', 'string'],
            //'articlesnew.*.description' => ['nullable', 'string'],
            'articlesnew.*.quantity' => ['nullable', 'integer'],
            'articlesnew.*.prix_unitaire' => ['nullable', 'numeric', 'digits_between:1,20'],
            //'articlesnew.*.montant_ht' => ['nullable', 'numeric'],
            'articlesnew.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],

            'newOrderProducts' => ['required_if:hasproducts,true', 'array'],
            'newOrderProducts.*.designation' => ['required', 'string'],
            'newOrderProducts.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'newOrderProducts.*.quantity' => ['required', 'integer'],
            'newOrderProducts.*.prix_unitaire' => ['required', 'numeric'],
            //'newOrderProducts.*.montant_ht' => ['nullable', 'numeric'],
            'newOrderProducts.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],
        ];
    }
}
