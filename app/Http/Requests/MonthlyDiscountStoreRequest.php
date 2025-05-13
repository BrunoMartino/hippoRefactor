<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyDiscountStoreRequest extends FormRequest
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
            "user_id" => ['required', 'exists:users,id'],
            "modulo_id" => ['required', 'exists:modulos,id'],
            "plano_id" => ['required', 'exists:planos,id'],
            "valor" => ['nullable', 'numeric', 'max:999999999'],
            "porcentagem" => ['nullable', 'numeric', 'max:999'],
            "dt_inicio" => ['required', 'date_format:Y-m', 'after_or_equal:' . date('Y-m')],
            "dt_termino" => ['required', 'date_format:Y-m', 'after_or_equal:dt_inicio'],
        ];
    }

    public function attributes()
    {
        return [
            "user_id" => 'cliente',
            "modulo_id" => 'modulo',
            "plano_id" => 'plano',
            "dt_inicio" => 'data ínicio',
            "dt_termino" => 'data termino',
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
        $valor = str_replace(['.', ',', ' '], ['', '.', ''], $this->input('valor'));

        $this->merge([
            'valor' => $valor,
        ]);
    }
}
