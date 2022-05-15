<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'cost' => 'required|numeric|min:0|max:100000000000',
            'description' => 'required|string|min:10|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma cadeia de caracteres.',
            'name.min' => 'O campo nome deve ter pelo menos 6 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 80 caracteres.',
            'cost.required' => 'O campo preço é obrigatório.',
            'cost.numeric' => 'O campo preço deve ser um numérico.',
            'cost.min' => 'O campo preço não deve ser negativo.',
            'cost.max' => 'O campo preço deve ter no máximo 8 casas após a vírgula.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma cadeia de caracteres.',
            'description.min' => 'O campo descrição deve ter pelo menos 10 caracteres.',
            'description.max' => 'O campo descrição deve ter no máximo 1000 caracteres.'
        ];
    }
}
