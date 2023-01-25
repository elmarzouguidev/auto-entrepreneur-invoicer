<?php

namespace App\Http\Requests\Commercial\Provider;

use Illuminate\Foundation\Http\FormRequest;

class ProviderFormRequest extends FormRequest
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
            'entreprise' => 'required|string',
            'contact' => 'required|string',
            'telephone' => 'required|phone:MA|unique:providers',
            'email' => 'required|email|unique:providers',
            'addresse' => 'required|string',
            'rc' => 'nullable|numeric|unique:providers',
            'ice' => 'required|numeric|digits_between:15,16|unique:providers',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:600',
            'category' => 'nullable|integer',
        ];
    }
}
