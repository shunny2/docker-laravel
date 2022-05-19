<?php

namespace App\Http\Requests;

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
            'name' => 'required|string|min:6|max:80',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma cadeia de caracteres.',
            'name.min' => 'O campo nome deve ter pelo menos 6 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 80 caracteres.',
            'email.required' => 'O e-mail preço é obrigatório.',
            'email.email' => 'O campo deve ter o formato de e-mail.',
            'email.unique' => 'Este e-mail já existe.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter pelo menos 6 caracteres.',
        ];
    }
}
