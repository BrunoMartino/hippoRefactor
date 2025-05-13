<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendingSettingStoreRequest extends FormRequest
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
            'module_id' => ['required', 'exists:modulos,id'],

            'every_day_at_specific_time' => 'nullable',
            'specific_date' => 'nullable',
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png', 'max:500'],
        ];
    }

    public function attributes()
    {
        return [
            'every_day_at_specific_time_value' => 'hora em "todos os dias" ',
            'specific_date_value_date' => 'data em "data específica" ',
            'specific_date_value_time' => 'hora em "data específica" ',
            'send_to_sales_from_date' => 'data em "enviar para vendas a partir de:" ',
            'image_file' => "Imagem"
        ];
    }

    /**
     * Configure o validador adicional.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Adiciona a regra 'required' para 'minha_data' somente se 'data_permitido' estiver marcado
        $validator->sometimes('every_day_at_specific_time_value', 'required|date_format:H:i', function ($input) {
            return $input->every_day_at_specific_time == 'on';
        });
        $validator->sometimes('specific_date_value_date', 'required|date_format:Y-m-d', function ($input) {
            return $input->specific_date == 'on';
        });
        $validator->sometimes('specific_date_value_time', 'required|date_format:H:i', function ($input) {
            return $input->specific_date == 'on';
        });
        $validator->sometimes('send_to_sales_from_date', 'required|date_format:Y-m-d', function ($input) {
            return $input->send_to_sales_from == 'on';
        });
    }
}
