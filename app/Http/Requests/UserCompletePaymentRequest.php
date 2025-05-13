<?php

namespace App\Http\Requests;

use App\Rules\ValidarNumeroCartao;
use Illuminate\Foundation\Http\FormRequest;

class UserCompletePaymentRequest extends FormRequest
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
            'num_cartao' => ['required', new ValidarNumeroCartao],
            // "total_usuarios" => ['required', 'numeric', 'min:1', 'max:10'],
            "nome" => ['required', 'string'],
            "mes_venc" => ['required', 'numeric', 'min:1', 'max:12'],
            "ano_venc" => ['required', 'numeric', 'min:' . date('Y'), 'max:2099'],
            "cvc" => ['required', 'numeric', '', 'max:9999'],
        ];
    }

    public function attributes()
    {
        return [
            'mes_venc' => 'mês vencimento',
            'ano_venc' => 'ano de vencimento',
            'cvc' => 'CVC'
        ];
    }
}
