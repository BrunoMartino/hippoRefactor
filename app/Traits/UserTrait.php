<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

trait UserTrait
{
    public function gerarDigitos()
    {
        for ($i = 0; $i < 6; $i++) {
            $digitos[] = random_int(0, 9);
        }
        $digitos = implode("", $digitos);
        return $digitos;
    }

    function gerarToken($largura, $tamanho_pedacos, $separador)
    {
        $token = Str::random($largura);
        $pedacos = str_split($token, $tamanho_pedacos);

        return implode($separador, $pedacos);
    }

    function gerarUrl($email, $token)
    {
        $token_base_64 = base64_encode($email . "===" . $token);
        $url = route('nova.senha', ['token' => $token_base_64]);

        return $url;
    }
}
