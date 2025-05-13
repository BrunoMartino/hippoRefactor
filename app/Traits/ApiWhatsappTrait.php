<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\ConfSistema;
use App\Models\Modulo;

trait ApiWhatsappTrait
{
    public function gerarConnectionKey()
    {
        $token = hash('sha256', Str::random(10) . '-' . time());
        $token = substr($token, 0, 25);

        $registros = ConfSistema::all();
        if (is_null($registros)) {
            return $token;
        } else {
            $existeRegistro = $registros->contains(function ($registro) use ($token) {
                return isset($registro->integracao['connection_key']) &&
                    in_array($token, $registro->integracao['connection_key']);
            });
            if ($existeRegistro) {
                return $this->gerarConnectionKey();
            } else {
                return $token;
            }
        }
    }

    public function getConfigWhatsapp()
    {
        $modulo = Modulo::find(session('modulo_id_executando'));

        $config = ConfSistema::where('modulo_id', $modulo->id)->where('user_id', user_princ()->id)
            ->where('modulo_id', $modulo->id)
            ->where('tipo', 'whatsapp')
            ->first();

        if (is_null($config)) :
            $integracao = [
                "nome" => null,
                "whatsapp" => null,
                "connectionKey" => null,
                "token" => null,
            ];
        else :
            $integracao = $config->integracao;
        endif;

        return $integracao;
    }
}
