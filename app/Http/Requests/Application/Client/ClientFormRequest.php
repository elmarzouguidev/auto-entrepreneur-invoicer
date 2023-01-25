<?php

namespace App\Http\Requests\Application\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            'entreprise' => 'required|string',
            'contact' => 'required|string',
            'telephone' => 'required|phone:MA|unique:clients',
            'email' => 'required|email|unique:clients',
            'addresse' => 'required|string',
            'rc' => 'nullable|numeric|unique:clients',
            'ice' => 'required|numeric|digits_between:15,16|unique:clients',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'category' => 'nullable|integer',
        ];
    }
}
