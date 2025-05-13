<?php

namespace App\Traits;

use App\Models\Modulo;
use App\Models\Invoice;

trait ApiLytexTrait
{
    public function bodyInvoices($data)
    {
        $user = user_princ();
        if(isset($data['plan']) AND $data['plan'] !== null):
            $modulo = Modulo::find($data['plan']->modulo_id)->titulo;
            $name = $modulo .'/'. $data['plan']->nome;
            $quantity = 1;
            $value = $data['valorPagar'] ?? null;
        endif;
        if(isset($data['tipo']) AND $data['tipo'] === 'user'):
            $name = 'Comprar Usuário(s)';
            $quantity = intval($data['total']);
            $value = 490;
        endif;
        $body = [
            "client" => [
                "type" => $user->tipo_usuario == 'PF' ? 'pf' : 'pj',
                "name" => $user->tipo_usuario == 'PJ' ? $user->razao_social : $user->nome_usuario,
                "cpfCnpj" => $user->tipo_usuario == 'PJ' ? $user->cnpj : $user->cpf,
                "email" => $user->email,
                "cellphone" => $user->whatsapp
            ],
            "items" => [
                [
                    "name" => $name,
                    "quantity" => $quantity,
                    "value" => $value
                ]
            ],
            "dueDate" => dataInvoice(),
            "paymentMethods" => [
                "pix" => [
                    "enable" => true
                ],
                "boleto" => [
                    "enable" => false
                ],
                "creditCard" => [
                    "enable" => true
                ]
            ]
        ];
        return json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    public function optionsListInvoices()
    {
        $options = [
            'search' => '',
            'clientTypes' => '',
            'startDate' => '2024-02-19',
            'endDate' => '2024-02-19',
            'status' => '',
            'paymentMethods' => '',
            'payedStartDate' => '2024-02-19',
            'payedEndDate' => '2024-02-19',
            'creationStartDate' => '2024-02-19',
            'creationEndDate' => '2024-02-19',
            'cancelStartDate' => '2024-02-19',
            'cancelEndDate' => '2024-02-19',
            'expireStartDate' => '2024-02-19',
            'expireEndDate' => '2024-02-19',
            'exportTo' => 'json', // xlsx, json
            '_invoiceI' => '',
            '_paymentLinkId' => '',
            '_subscriptionId' => '',
            '_installmentId' => '',
            'splitSelected'    => '', // none, sent, received
            'emissionMethod' => '', // manual, paymentLink, subscription, installment
            'page' => 1, // numero da pagina
            'perPage' => 10, // Número de resultados por página
            'sortField'    => '', // Campo utilizado para ordenação
            'sortOrder'    => 'DESC', // ASC , DESC
        ];
        return $options;
    }

    public function bodyInvoicesSplitMinValue()
    {
        $body = [
            "totalValue" => 200,
            "taxationMode" => "onlyPrimary"
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function bodyInvoicesRacesMethods()
    {
        $body = [
            "totalValue" => 200
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function bodyUpdateInvoice($data)
    {
        if(isset($data['plan']) AND $data['plan'] !== null):
            $modulo = Modulo::find($data['plan']->modulo_id)->titulo;
            $name = $modulo .'/'. $data['plan']->nome;
            $quantity = 1;
            $value = $data['valorPagar'];
        endif;
        if(isset($data['tipo']) AND $data['tipo'] === 'user'):
            $name = 'Licença Usuário(s)';
            $quantity = intval($data['total']);
            $value = 490;
        endif;
        $body = [
            "dueDate" => dataInvoice(),
            "items" => [
                [
                    "name" => $name,
                    "quantity" => $quantity,
                    "value" => $value
                ]
            ]
        ];
        return json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    public function bodyInvoicesManualLiquidate($invoiceId)
    {
        $paidValue = Invoice::where('invoice_id', $invoiceId)->first()->total_value;
        // paymentMethod = pix, boleto, creditCard, debitCard
        $body = [
            "paymentMethod" => "pix", 
            "parcels" => 1,
            "paidValue" => $paidValue,
            "paidDate" => "2024-04-30T22:26:22.550Z"
        ];
        return json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    public function bodyInvoicesCardToken($cartao)
    {
        $user = user_princ();
        $body = [
            "cpfCnpj" => $user->cpf != null ? $user->cpf : $user->cnpj,
            "number" => $cartao['num_cartao'],
            "holder" => $cartao['nome'],
            "expiry" => $cartao['mes_venc'].$cartao['ano_venc'],
            "cvc" => $cartao['cvc'],
            // "_clientId" => session('invoice')['client_id']
        ];
        return json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    public function bodyInvoicesPay($invoiceId, $cardTokenId)
    {
        $body = [
            "_invoiceId" => $invoiceId,
            "_cardTokenId" => $cardTokenId
        ];
        return json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    public function bodyClients()
    {
        $body = [
            "type" => "pj",
            "name" => "Lytex Soluções",
            "cpfCnpj" => "34778583000106",
            "email" => "suporte@lytex.com.br",
            "cellphone" => "3198874108",
            "address" => [
                "street" => "Rua Doutor Moacir Bairro",
                "zone" => "Centro",
                "city" => "Cel. Fabriciano",
                "state" => "MG",
                "number" => "325",
                "complement" => "1º andar",
                "zip" => "35170002"
            ],
            "referenceId" => "string"
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function optionsListClients()
    {
        $options = [
            'search' => '', // Busca por nome, cpf/cnpj, email ou celular. Aceita busca parcial.
            'clientTypes' => '', // Tipo de cliente pf|pj, para filtrar varios tipos use o separador "|"
            'startDate'    => '2024-02-21',
            'endDate' => '2024-02-21',
            '_groupId' => '', //ID do grupo
            'groupAction' => '', // Ação do grupo: include, exclude
            'page' => 1, // Número da página
            'perPage' => 100, // Número de resultados por página
            'sortField' => '', // Campo utilizado para ordenação
            'sortOrder'    => 'DESC' // Tipo de ordenação: ASC, DESC
        ];
        return $options;
    }

    public function bodyUpdateClient()
    {
        $body = [
            "type" => "pf",
            "name" => "string",
            "cpfCnpj" => "string",
            "email" => "user@example.com",
            "cellphone" => "stringstri",
            "address" => [
                "street" => "string",
                "zone" => "string",
                "city" => "string",
                "state" => "AC",
                "number" => "string",
                "complement" => "string",
                "zip" => "stringst"
            ],
            "referenceId" => "string"
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function bodyProducts()
    {
        $body = [
            "name" => "string",
            "value" => 200
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function optionsListProducts()
    {
        $options = [
            'search' => '',
            'startDate'    => '2024-02-21',
            'endDate' => '2024-02-21',
            'page' => 1, // Número da página
            'perPage' => 100, // Número de resultados por página
            'sortField' => '', // Campo utilizado para ordenação
            'sortOrder'    => 'DESC' // Tipo de ordenação: ASC, DESC
        ];
        return $options;
    }

    public function bodyUpdateProduct()
    {
        $body = [
            "name" => "string",
            "value" => 200
        ];
        return json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}