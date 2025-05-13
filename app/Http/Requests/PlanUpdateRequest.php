<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanUpdateRequest extends FormRequest
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
            // 'nome' => 'required|string|max:255',
            'limite_mensagens' => 'required|integer|max:99999999',
            'valor' => 'required|numeric|max:9999999999',
            'qtd_usuarios' => 'required|integer|max:99999999',
            'qtd_instancias' => 'required|integer|max:99999999',
            'custo_excedente' => 'nullable|numeric|max:9999999999',
        ];
    }

    public function attributes()
    {
        return [
            'limite_mensagens' => 'limite de mensagens',
            'qtd_usuarios' => 'Qtd. de usuários',
            'qtd_instancias' => 'Qtd. Instâncias',
            'custo_excedente' => 'custo por mensagem excedente',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // converter string e número // 3.999,99 -> 3999.99
        $value = str_replace(['.', ',', ' '], ['', '.', ''], $this->input('valor'));
        $valueMsg = str_replace(['.', ',', ' '], ['', '.', ''], $this->input('custo_excedente'));

        $this->merge([
            'valor' => $value,
            'custo_excedente' => $valueMsg
        ]);
    }
}
