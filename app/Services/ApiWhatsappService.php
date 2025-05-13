<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use App\Traits\ApiWhatsappTrait;

class ApiWhatsappService
{
    use ApiWhatsappTrait;

    private $client;
    private $adm_key_whatsapp;
    private $host_whatsapp;
    private $whatsappConfig = null;

    public function __construct()
    {
        $this->client = new Client();
        $this->adm_key_whatsapp = env('ADM_KEY_WHATSAPP');
        $this->host_whatsapp = env('HOST_WHATSPAPP');
    }

    public function __get($name)
    {
        if ($name == 'token' || $name == 'connectionKey' || $name == 'whatsapp') {
            if ($this->whatsappConfig === null) {
                $this->whatsappConfig = $this->getConfigWhatsapp();
            }
            return $this->whatsappConfig[$name];
        }
    }

    // Manager Controller = criar nova conexao
    public function criarConexao($connectionKey)
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = [
            "connectionKey" => $connectionKey,
            "webhook" => [
                "connectionWebhook" => env('CONNECTION_WEBHOOK'),
                "messageWebhook" => env('MESSAGE_WEBHOOK'),
                "messageStatusWebhook" => env('MESSAGE_STATUS'),
                "groupWebhook" => "",
                "presenceWebhook" => ""
            ]
        ];
        $body = json_encode($body, JSON_UNESCAPED_UNICODE);

        $request = new Request('POST', "$this->host_whatsapp/manager/create?adm_key=$this->adm_key_whatsapp", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }

    // Manager Controller = listar conexoes
    public function listarConexoes()
    {
        $request = new Request('GET', "$this->host_whatsapp/manager/list?adm_key=$this->adm_key_whatsapp");
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }


    // Manager Controller = deletar conexoes
    public function deletarConexao()
    {
        $request = new Request('DELETE', "$this->host_whatsapp/manager/delete?connectionKey=$this->connectionKey&adm_key=$this->adm_key_whatsapp");
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }

    // Manager Controller = BLOQUEAR CONEXÃO
    public function bloquearConexao()
    {
        $request = new Request('PUT', "$this->host_whatsapp/manager/block?connectionKey=$this->connectionKey&block=false&adm_key=$this->adm_key_whatsapp");
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }

    // 𝗖𝗼𝗻𝗻𝗲𝗰𝘁𝗶𝗼𝗻 𝗖𝗼𝗻𝘁𝗿𝗼𝗹𝗹𝗲𝗿 = QRCode - BASE64 Este método retorna os bytes do QRCode. Você poderá renderizar em um componente do tipo QRCode compatível com sua linguagem de programação.
    public function qrcodeBase64()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $request = new Request('GET', "$this->host_whatsapp/instance/qrcode?connectionKey=$this->connectionKey", $headers);
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }

    // conectar no whatsapp pelo numero sem precisar ler qrcode
    public function emparelhamento()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $request = new Request('GET', "$this->host_whatsapp/instance/phoneCode?connectionKey=$this->connectionKey&phoneNumber=$this->whatsapp", $headers);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //INF. DA CONEXÃO Este método te permite descobrir se sua instância está ou não conectada a uma conta de Whatsapp.
    public function infoConexao()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        
        try {
            $request = new Request('GET', "$this->host_whatsapp/instance/info?connectionKey=$this->connectionKey", $headers);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $responseData = json_decode($e->getResponse()->getBody()->getContents(), true);
                if($responseData['message'] === 'connectionKey inválida'){
                    return false;
                }
            }
        }
    }

    //DESLOGAR -  Este método desconecta seu número da AP
    public function deslogar()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        try{
            $request = new Request('DELETE', "$this->host_whatsapp/instance/logout?connectionKey=$this->connectionKey", $headers);
            $res = $this->client->sendAsync($request)->wait();
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $responseData = json_decode($e->getResponse()->getBody()->getContents(), true);
                return $responseData;
            }
        }
    }

    //Verifique se o número existe no whatsapp
    public function checarNumero()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $request = new Request('GET', "$this->host_whatsapp/actions/onwhatsapp?connectionKey=$this->connectionKey&phoneNumber=$this->whatsapp", $headers);
        $res = $this->client->sendAsync($request)->wait();
        return $res->getBody();
    }

    //pegar foto do perfil
    public function pegarFotoPerfil()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $request = new Request('GET', "$this->host_whatsapp/actions/downProfile?connectionKey=$this->connectionKey&phoneNumber=$this->whatsapp", $headers);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    public function bloquearDesbloquearContato($body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];

        // $body = '{
        //     "phoneNumber": "5599992249708",
        //     "blockStatus": "unblock"
        // }';
        $request = new Request('PUT', "$this->host_whatsapp/actions/blockUser?connectionKey=$this->connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //Método utilizado para marcar uma mensagem em um chat como lida.
    public function marcarMensagemLida(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        // $body = '{
        //     "messageId": {
        //       "remoteJid": "559991989446@s.whatsapp.net",

        //       "id": "C005B513D5709BF40DF3AD2CC783DDA5"
        //     }
        // }';
        $request = new Request('POST', "$this->host_whatsapp/actions/readMessage?connectionKey=$this->connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //Este método é reponsavel por baixar a midia recebida na mensagem.
    public function baixarMidia(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        // $body = '{
        //     "messageKeys": {
        //         "mediaKey": "",
        //         "directPath": "",
        //         "url": ""
        //     },
        //     "type": "",
        //     "mimetype": ""
        // }';
        $request = new Request('POST', "$this->host_whatsapp/actions/downloadMidiaMessage?connectionKey=$this->connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //definir o webhook
    public function setWebhook(string $conexao)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $body = '{
            "webhook": {
                "connectionWebhook": "",
                "messageWebhook": "",
                "messageStatusWebhook": "",
                "groupWebhook": "",
                "presenceWebhook": ""
            }
        }';
        $request = new Request('POST', "$this->host_whatsapp/webhook/updateWebhook?connectionKey=$this->connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //pegar o webhook
    public function getWebhook()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $request = new Request('GET', "$this->host_whatsapp/webhook/getWebhook?connectionKey=$this->connectionKey", $headers);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /* Neste método você tem a possibilidade de publicar mensagens básicas, mas pode melhorá-las com o uso de formatações e emojis, por exemplo.

    Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

    Se for para grupos, porém, a identificação deve ser @g.us.
    */
    public function texto()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $body = '{
          "phoneNumber": "5511983743416",
          "message": "Olá, testando envio de mensagens via API da Hippo",
          "delayMessage": "1000"
        }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendText?connectionKey=$this->connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        return json_decode($res->getBody());
    }

    /*
        Neste método você envia uma mensagem para várias pessoas.

        Você também pode definir personalizado delay entre cada mensagem adicionando o atraso ( em milissegundos ) ao delay propriedades.

        Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

        Se for para grupos, porém, a identificação deve ser @g.us.
     */
    public function textoVariosNumeros(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //   "numbers": [
        //     "5599999999991",
        //     "5599999999992",
        //     "5599999999993"
        //   ],
        //   "message": {
        //     "text": "Esta mensagem vai para 3 numeros diferentes"
        //   },
        //   "delayMessage": 5000
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendTextMany?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /*
        O recurso de envio de links é uma função que permite enviar links aos seus contatos. É uma maneira conveniente de compartilhar links para direcionar os usuários a um site específico.

        Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

        Se for para grupos, porém, a identificação deve ser @g.us.
     */
    public function link(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        // "phoneNumber": "5599999999999",
        // "text": "Texto sobre seu link. (Não esqueça de informar o mesmo valor do *url* no final deste texto.)",
        // "url": "Url do seu link",
        // "description": "descrição do link",
        // "title": "Titulo para o link",
        // "thumbnail": "Link da imagem em Base64"
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendLink?connectionKey=connectionKey", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /*
    O recurso de envio de links é uma função que permite enviar links aos seus contatos. É uma maneira conveniente de compartilhar links para direcionar os usuários a um site específico.

    Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

    Se for para grupos, porém, a identificação deve ser @g.us.
     */
    public function contato(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //     "id": "Código do país, número de contato com o DDD",
        //     "vcard": {
        //         "fullName": "ZAPI",
        //         "displayName": "ZAPI",
        //         "organization": "API DO WHATSAPP (NÃO OFICIAL)",
        //         "phone": "5599992249708"
        //     }
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendContact?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /*
    Método responsavel por enviar imagens para os seus contatos ou grupos.
    Neste link você encontra tudo que precisa saber sobre formatos e tamanhos de arquivos.

    Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

    Se for para grupos, porém, a identificação deve ser @g.us.
     */
    public function imagem(string $conexao, array $options)
    {
        $headers = [
            'Authorization' => 'Bearer token'
        ];
        $options = [
            'multipart' => [
                [
                    'name' => 'phoneNumber',
                    'contents' => '551199999999'
                ],
                [
                    'name' => 'file',
                    'contents' => Utils::tryFopen('/path/to/file', 'r'),
                    'filename' => '/path/to/file',
                    'headers'  => [
                        'Content-Type' => '<Content-type header>'
                    ]
                ],
                [
                    'name' => 'caption',
                    'contents' => 'legenda'
                ]
            ]
        ];
        $request = new Request('POST', "$this->host_whatsapp/message/sendImage?connectionKey=$conexao", $headers);
        $res = $this->client->sendAsync($request, $options)->wait();
        echo $res->getBody();
    }

    //Método responsavel por enviar imagens para os seus contatos ou grupos.
    public function imagemURL(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //     "phoneNumber": "5599999999999",
        //     "url": "https://s1.static.brasilescola.uol.com.br/be/conteudo/images/4a76fbaae2a4fd307372fbccd107e8fd.jpg",
        //     "caption": "Legenda da imagem",
        //     "delayMessage": "5000"
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendImageUrl?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /*
     Método responsavel por enviar imagens para os seus contatos ou grupos.
    Neste link você encontra tudo que precisa saber sobre formatos e tamanhos de arquivos.

    Lembre-se que, se for para um chat individual, o identificador não precisa ter @s.whatsapp.net.

    Se for para grupos, porém, a identificação deve ser @g.us.
     */
    public function imagemBase64(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '
        //     {
        //       "id": "5599999999999",
        //       "base64Image": "",
        //       "caption": "Legenda da imagem",
        //         "delayMessage": 2000
        //     }';
        $request = new Request('POST', "$this->host_whatsapp/message/imagebase64?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        return $res->getBody();
    }

    //Método responsavel por enviar video para os seus contatos ou grupos.
    public function videoURL(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //     "phoneNumber": "551199999999",
        //     "url": "https://link",
        //     "caption": "legenda",
        //     "delayMessage": "5000"
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendVideoUrl?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    public function audio(string $conexao, array $options)
    {
        $headers = [
            'Authorization' => 'Bearer token'
        ];
        // $options = [
        //     'multipart' => [
        //         [
        //             'name' => 'phoneNumber',
        //             'contents' => '551199999999'
        //         ],
        //         [
        //             'name' => 'file',
        //             'contents' => Utils::tryFopen('5BR3I9IH3/mpthreetest.mp3', 'r'),
        //             'filename' => '5BR3I9IH3/mpthreetest.mp3',
        //             'headers'  => [
        //                 'Content-Type' => '<Content-type header>'
        //             ]
        //         ],
        //         [
        //             'name' => 'delayMessage',
        //             'contents' => '5000'
        //         ]
        //     ]
        // ];
        $request = new Request('POST', "$this->host_whatsapp/message/sendAudio?connectionKey=$conexao", $headers);
        $res = $this->client->sendAsync($request, $options)->wait();
        echo $res->getBody();
    }

    public function audioURL(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //     "phoneNumber": "551199999999",
        //     "url": "Url do audio",
        //     "delayMessage": "5000"
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendAudioUrl?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    //Envie uma mensagem de documento para os seus contatos ou grupos.
    public function documento(string $conexao, array $options)
    {
        $headers = [
            'Authorization' => 'Bearer token'
        ];
        $options = [
            'multipart' => [
                [
                    'name' => 'phoneNumber',
                    'contents' => '5599992249708'
                ],
                [
                    'name' => 'file',
                    'contents' => Utils::tryFopen('/path/to/file', 'r'),
                    'filename' => '/path/to/file',
                    'headers'  => [
                        'Content-Type' => '<Content-type header>'
                    ]
                ],
                [
                    'name' => 'filename',
                    'contents' => 'teste'
                ]
            ]
        ];
        $request = new Request('POST', "$this->host_whatsapp/message/sendDoc?connectionKey=$conexao", $headers);
        $res = $this->client->sendAsync($request, $options)->wait();
        echo $res->getBody();
    }

    public function midiaURL(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        // $body = '{
        //     "phoneNumber": "5511999999999",
        //     "url": "<url>",
        //     "type": "image",
        //     "filename": "ok"
        // }';
        $request = new Request('POST', "$this->host_whatsapp/message/sendMediaUrl?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    /*
    Simula eventos do whatsapp
    Eventos:
        composing - Digitando...
        recording - Gaavando aúdio...
        available - Online
        unavailable - Visto por ultimo hoje as ...
    */
    public function presenca(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        $body = '{
            "phoneNumber": "Código do país, número de contato com o DDD",
            "status": "composing"
        }';
        $request = new Request('POST', "$this->host_whatsapp/message/setStatus?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    public function deletarMensagem(string $conexao, string $body)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer token'
        ];
        $body = '{
          "phoneNumber": "5599992249708",
          "messageKey": {
            "remoteJid": "5599992249708@s.whatsapp.net",
            "fromMe": true,
            "id": "BAE5DF0C952F1122"
          }
        }';
        $request = new Request('POST', "$this->host_whatsapp/message/delete?connectionKey=$conexao", $headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        echo $res->getBody();
    }
}
