<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateUpdateRequest extends FormRequest
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
            'name' => 'required:max:255',
            'email' => 'required:max:255|email|unique:users,email,' . $this->affiliate->user_id,
            'address' => 'required:max:255',
            'city' => 'required:max:255',
            'comission' => 'required|numeric|max:9999999999',
            'state' => 'required:max:255',
            'whatsapp' => 'required:max:255|unique:users,whatsapp,' . $this->affiliate->user_id,
        ];
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'whatsapp' => extrairNumeros($this->input('whatsapp')),
        ]);
    }

    public function attributes()
    {
        return [
            'address' => 'endereço',
            'city' => 'cidade',
            'comission' => 'comissão',
            'state' => 'uf',
        ];
    }
}
