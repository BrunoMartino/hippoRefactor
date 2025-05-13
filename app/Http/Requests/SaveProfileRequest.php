<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProfileRequest extends FormRequest
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
            "tipo_usuario" => ['nullable', 'in:PF,PJ'],
            // "nome_usuario" => ['nullable', 'string', 'max:255'],
            // "email" => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            "whatsapp" => ['required', 'max:255', 'unique:users,whatsapp,' . auth()->user()->id],
            "cidade" => ['required', 'max:255'],
            "estado" => ['required', 'max:255'],
            "foto_perfil" => ['nullable', 'image', 'max:500'],
            "cpf" => ['nullable', 'cpf', 'unique:users,cpf,' . auth()->user()->id],
            "cnpj" => ['nullable', 'cnpj'],
            "razao_social" => ['nullable', 'max:255'],
            "endereco" => ['required', 'max:255'],
            "bairro" => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'foto_perfil' => 'A foto de perfil não pode ser superior a 500kb'
        ];
    }

    public function attributes()
    {
        return [
            'nome_usuario' => 'nome',
            'estado' => 'UF',
            'endereco' => 'endereço',
            'bairro' => 'bairro/setor',
            'cpf' => 'CPF',
            'cnpj' => 'CNPJ',
            'tipo_usuario' => 'tipo de usuário',
            'razao_social' => 'razão social'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => extrairNumeros($this->input('cnpj')),
            'cpf' => extrairNumeros($this->input('cpf')),
            'whatsapp' => extrairNumeros($this->input('whatsapp')),
        ]);
    }
}
