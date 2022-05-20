<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|',
            'password' => 'required|string|min:8|'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail é inválido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
        ];
    }
}
