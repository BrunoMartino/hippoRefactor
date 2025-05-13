<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Traits\ApiLytexTrait;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;


class ApiLytexService
{
    use ApiLytexTrait;

    private $client;
    private $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = "https://api-pay.lytex.com.br/v2";
    }

    public function obtainToken()
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = json_encode([
            "grantType" => "clientCredentials",
            "clientId" => env('LYTEX_CLIENT_ID'),
            "clientSecret" => env('LYTEX_CLIENT_SECRET'),
            "scopes" => [
                "invoice"
            ]
        ]);
        try {
            $request = new Request('POST', 'https://api-pay.lytex.com.br/v2/auth/obtain_token', $headers, $body);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = $response->getBody()->getContents();

            Log::error('Erro ao gerar fatura: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'errorMessage' => $errorMessage
            ]);

            // echo "Código de Status: $statusCode\n";
            // echo "Mensagem de Erro: $errorMessage\n";
        }
    }

    // criar fatura
    public function invoices($data)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];
            $body = $this->bodyInvoices($data);
            $request = new Request('POST', "$this->url/invoices", $headers, $body);
            $res = $this->client->sendAsync($request)->wait();

            $invoice = json_decode($res->getBody(), true);
            $invoice['statusCode'] = $res->getStatusCode();

            return (object) $invoice;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());
            Log::error('Erro ao gerar fatura: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'errorMessage' => $errorMessage
            ]);

            return $errorMessage;
        }
    }

    // listar faturas
    public function listInvoices()
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];
            $options = $this->optionsListInvoices();
            $parametros = '?';

            $url = "$this->url/invoices/$parametros";

            $request = new Request('GET', $url, $headers);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return $errorMessage;
        }
    }

    // Detalhes da fatura
    public function invoice(string $id)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];

            $url = "$this->url/invoices/$id";

            $request = new Request('GET', $url, $headers);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return false;
        }
    }

    // Atualizar fatura
    public function updateInvoice(string $id, $data)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];
            $body = $this->bodyUpdateInvoice($data);

            $request = new Request('PUT', "$this->url/invoices/$id", $headers, $body);
            $res = $this->client->sendAsync($request)->wait();

            $updateInvoice = json_decode($res->getBody(), true);
            $updateInvoice['statusCode'] = $res->getStatusCode();

            return (object) $updateInvoice;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return $errorMessage;
        }
    }

    // cancelar fatura
    public function cancelInvoice(string $id)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];

            $url = "$this->url/invoices/cancel/$id";

            $request = new Request('PUT', $url, $headers);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return false;
        }
    }

    // Detalhes do pagamento da fatura
    public function invoicePaymentDetail(string $invoiceId)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];

            $url = "$this->url/invoices/$invoiceId/payment-detail";

            $request = new Request('GET', $url, $headers);
            $res = $this->client->sendAsync($request)->wait();

            $invoicePaymentDetail = json_decode($res->getBody(), true);
            $invoicePaymentDetail['statusCode'] = $res->getStatusCode();

            return (object) $invoicePaymentDetail;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return $errorMessage;
        }
    }

    // Criar token de cartão
    public function invoicesCardToken($cartao)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];

            $body = $this->bodyInvoicesCardToken($cartao);

            $request = new Request('POST', "$this->url/invoices/card_token", $headers, $body);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = $response->getBody()->getContents();


            return false;
        }
    }

    // Pagar fatura com token de cartão
    public function invoicesPay($invoiceId, $cardTokenId)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
            ];
            $body = $this->bodyInvoicesPay($invoiceId, $cardTokenId);

            $request = new Request('POST', "$this->url/invoices/pay", $headers, $body);
            $res = $this->client->sendAsync($request)->wait();

            $invoicePay = json_decode($res->getBody(), true);
            $invoicePay['statusCode'] = $res->getStatusCode();

            return (object) $invoicePay;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = json_decode($response->getBody()->getContents());

            return $errorMessage;
        }
    }


    // // Validar valor mínimo para Split
    // public function invoicesSplitMinValue()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyInvoicesSplitMinValue();
    //     try {
    //         $request = new Request('POST', "$this->url/invoices/split-min-value", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Retornar taxas com base no valor
    // public function invoicesRacesMethods()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyInvoicesRacesMethods();
    //     try {
    //         $request = new Request('POST', "$this->url/invoices/rates/methods", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Pagar fatura (sandbox)
    // public function invoicesManualLiquidate($invoiceId)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyInvoicesManualLiquidate($invoiceId);
    //     try {
    //         $request = new Request('POST', "$this->url/invoices/$invoiceId/manual-liquidate", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // Listar todos os recebíveis gerados
    // public function receivables()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/receivables";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // Listar todos os recebíveis gerados atravez de uma transação
    // public function receivablesByTransaction(string $transaction_id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/receivables/$transaction_id";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Adiciona um novo cliente a base de clientes
    // public function clients()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyClients();
    //     try {
    //         $request = new Request('POST', "$this->url/clients", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Lista a base de clientes do estabelecimento
    // public function listClients()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $options = $this->optionsListClients();
    //     $parametros = '?';

    //     $url = "$this->url/clients/$parametros";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Retorna dados do cliente com base em uma pesquisa
    // public function clientsAutocomplete()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $options = [
    //         'search' => ''
    //     ];
    //     $parametros = '?';

    //     $url = "$this->url/clients/autocomplete/$parametros";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Retorna detalhamento de um cliente
    // public function clientsDetails(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/clients/$id";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Atualiza dados de um cliente
    // public function updateClient(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyUpdateClient();
    //     try {
    //         $request = new Request('PUT', "$this->url/clients/$id", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Remove um cliente
    // public function deleteClient(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/clients/$id";
    //     try {
    //         $request = new Request('DELETE', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Adiciona um novo produto ao catálogo
    // public function products()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyProducts();
    //     try {
    //         $request = new Request('POST', "$this->url/clients", $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Listar produtos
    // public function listProducts()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $options = $this->optionsListProducts();
    //     $parametros = '?';

    //     $url = "$this->url/products/$parametros";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Retorna dados do produtos com base em uma pesquisa
    // public function productsAutocomplete()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $options = [
    //         'search' => ''
    //     ];
    //     $parametros = '?';

    //     $url = "$this->url/products/autocomplete/$parametros";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Retorna detalhamento de um produto
    // public function productsDetails(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/products/$id";
    //     try {
    //         $request = new Request('GET', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Atualiza dados de um produto
    // public function updateProduct(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $body = $this->bodyUpdateProduct();
    //     $url = "$this->url/products/$id";
    //     try {
    //         $request = new Request('PUT', $url, $headers, $body);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }

    // // Remove um produto
    // public function deleteProduct(string $id)
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $this->obtainToken()->accessToken
    //     ];
    //     $url = "$this->url/products/$id";
    //     try {
    //         $request = new Request('DELETE', $url, $headers);
    //         $res = $this->client->sendAsync($request)->wait();
    //         return json_decode($res->getBody());
    //     } catch (ClientException $e) {
    //         $response = $e->getResponse();
    //         $statusCode = $response->getStatusCode();
    //         $errorMessage = $response->getBody()->getContents();

    //         echo "Código de Status: $statusCode\n";
    //         echo "Mensagem de Erro: $errorMessage\n";
    //         exit();
    //     }
    // }
}
