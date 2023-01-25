<?php

namespace App\Http\Requests\Commercial\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceFormRequest extends FormRequest
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

            'client' => ['required', 'integer'],
            'invoice' => ['nullable', 'numeric'], //avoir invoice
            'bl_code' => ['nullable', 'string'],
            'bc_code' => ['nullable', 'string'],
            'invoice_date' => ['required', 'date', 'date_format:Y-m-d'],
            'due_date' => ['required', 'date', 'date_format:Y-m-d'],
            'payment_mode' => ['required', 'integer', 'exists:payment_types,id'],
            'admin_notes' => ['nullable', 'string'],
            'condition_general' => ['nullable', 'string'],

            'estimated' => ['nullable', 'uuid'],

            'hasproducts' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],

            'articles' => ['required_if:hasproducts,false', 'array'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.description' => ['nullable', 'string'],
            'articles.*.quantity' => ['required', 'integer'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'digits_between:1,20'],
            //'articles.*.montant_ht' => ['nullable', 'numeric'],
            'articles.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],

            'orderProducts' => ['required_if:hasproducts,true', 'array'],
            'orderProducts.*.designation' => ['required', 'string'],
            'orderProducts.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'orderProducts.*.quantity' => ['required', 'integer'],
            'orderProducts.*.prix_unitaire' => ['required', 'numeric'],
            //'orderProducts.*.montant_ht' => ['nullable', 'numeric'],
            'orderProducts.*.remise' => ['nullable', 'numeric', 'digits_between:1,20'],

        ];
    }
}
