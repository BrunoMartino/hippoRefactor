<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageSatisfactionStoreRequest extends FormRequest
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
            'pergunta_inicial' => ['required'],
            'caso_nao_perg_inicial' => ['required'],
            'pergunta1' => ['required'],
            'pergunta2' => ['required'],
            'pergunta3' => ['required'],
            'agradecimento' => ['required'],
            'pergunta4' => ['required'],
            'caso_resp_perg4' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'pergunta_inicial' => 'mensagem',
            'caso_nao_perg_inicial' => 'caso não',
            'pergunta1' => 'pergunta #1',
            'pergunta2' => 'pergunta #2',
            'pergunta3' => 'pergunta #3',
            'pergunta4' => 'pergunta #4',
            'caso_resp_perg4' => 'caso resposta da pergunta #4',
        ];
    }
}
