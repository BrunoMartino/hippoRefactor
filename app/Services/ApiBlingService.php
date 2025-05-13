<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use App\Models\ConfSistema;
use App\Models\FormasPagamento;

class ApiBlingService
{
	private $client;

	public function __construct()
	{
		$this->client = new Client();
	}

	public function authBling($dataBling)
	{
		$url = 'https://www.bling.com.br/Api/v3/oauth/token';
		$headers = [
			'Content-Type' => 'application/x-www-form-urlencoded',
			'Accept' => '1.0',
			'Authorization' => "Basic $dataBling->basic"
		];
		$data = [
			'grant_type' => 'authorization_code',
			'code' => $dataBling->code
		];
		try {
			$response = $this->client->post($url, [
				'headers' => $headers,
				'form_params' => $data
			]);
			return json_decode($response->getBody()->getContents());
		} catch (ClientException $e) {
			$response = $e->getResponse();
			$statusCode = $response->getStatusCode();
			$errorMessage = json_decode($response->getBody()->getContents());
		}
	}

    public function getFormasPagamento($moduloId) {
		$url = 'https://www.bling.com.br/Api/v3/formas-pagamentos';
        $bling = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', $moduloId)
            ->where('tipo', 'bling')
            ->first();

        $page = 1;
        $hasNextPage = true;
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $bling->integracao['access_token'],
        ];

        $formasPagamento = [];
        while ($hasNextPage) {
            $request = new Request('GET', "$url?pagina=$page&situacao=1", $headers);
            $res = $this->client->sendAsync($request)->wait();
            $formasPag = json_decode($res->getBody(), true)['data'];
            if (empty($formasPag)) :
                $hasNextPage = false;
            else:
                $formasPagamento = array_merge($formasPagamento, $formasPag);
                $page++;
            endif;
        }

        $dataToInsert = [];
        foreach ($formasPagamento as $forma) {
            $dataToInsert[] = [
                'user_id' => user_princ()->id,
                'idBling' => $forma['id'],
                'descricao' => $forma['descricao'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        FormasPagamento::insert($dataToInsert);
	}
}
