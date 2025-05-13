<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "nome_usuario" => ['required', 'string', 'max:255'],
            "cidade" => ['required',  'max:255'],
            "estado" => ['required',  'max:255'],
            "foto_perfil" => ['nullable', 'image', 'max:10000']
        ];
    }

    public function messages()
    {
        return [
            'foto_perfil' => 'A foto de perfil não pode ser superior a 10mb'
        ];
    }

    public function attributes()
    {
        return [
            'nome_usuario' => 'nome',
            'estado' => 'UF'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'whatsapp' => extrairNumeros($this->input('whatsapp')),
        ]);
    }
}
