<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarNumeroCartao implements Rule
{
    public function passes($attribute, $value)
    {
        // Remover espaços em branco
        $numero = preg_replace('/\s+/', '', $value);

        // Verificar se o número está vazio ou tem caracteres não numéricos
        if (empty($numero) || !is_numeric($numero)) {
            return false;
        }

        // Verificar se o número tem um comprimento válido para um número de cartão
        if (strlen($numero) < 13 || strlen($numero) > 19) {
            return false;
        }

        // Algoritmo de Luhn para validação de números de cartão
        $soma = 0;
        $digitosPares = false;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $digito = (int) $numero[$i];

            if ($digitosPares) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9;
                }
            }

            $soma += $digito;
            $digitosPares = !$digitosPares;
        }

        return $soma % 10 === 0;
    }

    public function message()
    {
        return 'O número do cartão é inválido.';
    }
}
