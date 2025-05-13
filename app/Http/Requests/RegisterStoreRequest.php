<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'nome_usuario' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8', // comprimento mínimo de 8 caracteres
                'regex:/[a-z]/', // deve conter pelo menos uma letra minúscula
                'regex:/[A-Z]/', // deve conter pelo menos uma letra maiúscula
                'regex:/[0-9]/', // deve conter pelo menos um número
                'regex:/[@$!%*#?&]/', // deve conter pelo menos um caractere especial
            ],
            'conf_password' => ['required', 'same:password'],
            'termos_e_politica' => ['required'],

        ];
    }

    public function attributes()
    {
        return [
            'nome_usuario' => 'nome',
            'conf_password' => 'confirmar senha',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.regex' => 'A senha deve conter pelo menos uma letra minúscula, uma letra maiúscula, um número e um caractere especial (@$!%*#?&).',
        ];
    }
}
