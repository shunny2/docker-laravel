<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:80',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:8|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma cadeia de caracteres.',
            'name.min' => 'O campo nome deve ter pelo menos :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail é inválido.',
            'email.unique' => 'Este e-mail já existe.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'Os campos de senha e confirme senha devem ser iguais.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
        ];
    }
}
