<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
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
            "name" => ['required', 'max:255'],
            "description" => ['required', 'max:5000'],
            "value" => ['nullable', 'numeric', 'max:999999999'],
            "qtd_total" => ['required', 'min:1', 'max:999999999'],
            "qtd_uso" => ['required', 'min:1', 'max:999999999', 'lte:qtd_total'],
            "percent" => ['nullable', 'numeric', 'max:999'],
            "code" => ['required', 'max:20', 'unique:discount_coupons,code'],
            "expiration_date" => ['required', 'date_format:Y-m-d', 'after_or_equal:' . date('Y-m-d')],
            'rec_duration' => ['max:255']
        ];
    }

    public function attributes()
    {
        return [
            "value" => 'valor',
            "percent" => 'porcentagem',
            "code" => 'código',
            "expiration_date" => 'validade',
            'qtd_total' => 'quantidade total',
            'qtd_uso' => 'qtd. de uso por cliente',
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
        $value = str_replace(['.', ',', ' '], ['', '.', ''], $this->input('value'));

        $this->merge([
            'value' => $value,
        ]);
    }
}
