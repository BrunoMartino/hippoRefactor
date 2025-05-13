<?php

namespace App\Services;

use App\Models\ConfSistema;
use App\Services\ApiWhatsappService;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;

class SystemService
{
    protected $apiWhatsapp;

    public function __construct(ApiWhatsappService $apiWhatsapp)
    {
        $this->apiWhatsapp = $apiWhatsapp;
    }

    public function getInfoConexao()
    {
        $infoConexao = $this->apiWhatsapp->infoConexao();

        if (isset($infoConexao->connection_data)) :
            $infoConexao = $infoConexao->connection_data;
        endif;

        if (!$infoConexao or !isset($infoConexao->phone_connected) or $infoConexao->phone_connected !== true) :
            return "nao_conectado";
        else :
            return 'conectado';
        endif;
    }

    public function conferirTelefone($newTelefone)
    {
        $newTelefoneLength = strlen($newTelefone);

        if($newTelefoneLength == 11 || $newTelefoneLength < 10):
            return redirect()->back()->with('error', 'Não foi possível realizar alteração. <br> Favor conferir o número informado e solicite novamente');
        endif;

        $connectionKey = $this->apiWhatsapp->connectionKey;
        $confSistema = ConfSistema::where('user_id', user_princ()->id)
            ->where('tipo', 'whatsapp')
            ->where('integracao->connectionKey', $connectionKey)
            ->first();

        if (!$confSistema) :
            return 'numero_novo';
        endif;

        $telefone = $confSistema->integracao['whatsapp'];
        $codPais = substr($telefone, 0, 2);
        $telefoneLength = strlen($telefone);

        if ($codPais != '55' || $newTelefoneLength == 13) :
            $situacao = $telefone === $newTelefone ? 'numeros_iguais' : 'numeros_diferentes';
        else :
            $numero = substr($telefone, -8);
            $newNumero = substr($newTelefone, -8);
    
            if ($numero !== $newNumero) :
                $situacao = 'numeros_diferentes';
            else :
                $nonoDigitoTelefone = $telefoneLength == 13;
                $nonoDigitoNewTelefone = $newTelefoneLength == 11;
    
                $DDDTelefone = $nonoDigitoTelefone ? substr($telefone, -11, 2) : substr($telefone, -10, 2);
                $DDDNewTelefone = $nonoDigitoNewTelefone ? substr($newTelefone, -11, 2) : substr($newTelefone, -10, 2);
    
                $situacao = $DDDTelefone === $DDDNewTelefone ? 'numeros_iguais' : 'numeros_diferentes';
            endif;
        endif;
            // dd([
        //     'telefone' => $telefone,
        //     'cod_pais' => $codPais,
        //     'telefoneLength' => $telefoneLength,
        //     'newTelefoneLenght' => $newTelefoneLength,
        //     'numero' => $numero,
        //     'newNumero' => $newNumero,
        //     'nonoDigitoTelefone' => $nonoDigitoTelefone,
        //     'nonoDigitoNewTelefone' => $nonoDigitoNewTelefone,
        //     'dddtelefone' => $DDDTelefone,
        //     'dddnewtelefone' => $DDDNewTelefone
        // ]);
        if ($situacao === 'numeros_iguais') :
            return redirect()->back()->with('error', 'Não foi possível realizar a alteração. <br> Número informado já se encontra em uso e conectado.');
        endif;
    
        return $situacao;
    }

    public function trocarNumeroWhatsapp()
    {
        $infoConexao = $this->getInfoConexao();
        if ($infoConexao === 'nao_conectado') :
            return redirect()->back()->with('error', 'Não foi possível deslogar o whatsapp. Para trocar de número, solicite novamente.');
        endif;

        $respDeslogar = $this->apiWhatsapp->deslogar();
        if (!isset($respDeslogar->error) and $respDeslogar->error !== false) :
            return redirect()->back()->with('error', 'Não foi possível deslogar o whatsapp. Para trocar de número, solicite novamente.');
        endif;

        $respDeletarConexao = $this->apiWhatsapp->deletarConexao();
        if (!isset($respDeletarConexao->error) and $respDeletarConexao->error !== false) :
            return redirect()->back()->with('error', 'Não foi possível deletar a conexão com o whatsapp. Para trocar de número, favor conectar novamente e solicitar uma nova troca.');
        endif;
    }

    public function gerarTokenCorreios($contrato, $basicAuth){
        $url = 'https://api.correios.com.br/token/v1/autentica/contrato';

        $client = new Client();

        try {
            $response = $client->post($url, [
                'json' => [
                    'numero' => $contrato,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . $basicAuth,
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return json_decode(json_encode($result));
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());
            echo $errorMessage;
            return false;
        }
    }
}
