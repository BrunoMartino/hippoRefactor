<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntegrationUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'max:255'],
            'description' => ['nullable', 'max:5000'],
            'access_token' => ['nullable', 'max:1000'],
            'refresh_token' => ['nullable', 'max:1000'],
            'whatsapp_number' => ['nullable', 'max:30'],
            'module_id' => ['exists:modulos,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'whatsapp_number' => extrairNumeros($this->input('whatsapp_number')),
        ]);
    }
}
