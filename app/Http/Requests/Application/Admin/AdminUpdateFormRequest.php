<?php

namespace App\Http\Requests\Application\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminUpdateFormRequest extends FormRequest
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

            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => ['required', 'phone:MA', Rule::unique('users')->ignore($this->route('admin'), 'uuid')],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('admin'), 'uuid')],
            'password' => ['nullable', Password::defaults()],
            'role' => ['nullable', 'string', 'exists:roles,name'],
            'active' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],
        ];
    }
}
