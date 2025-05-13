<?php

namespace App\Http\Controllers\Config\System;

use App\Models\Modulo;
use App\Models\ConfSistema;
use Illuminate\Http\Request;
use App\Models\ConfigCorreio;
use App\Services\SystemService;
use App\Traits\ApiWhatsappTrait;
use App\Services\ApiBlingService;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;
use App\Services\ApiWhatsappService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreBlingRequest;
use Carbon\Carbon;

class SystemController extends Controller
{
    use ApiWhatsappTrait;

    protected $apiWhatsapp;
    protected $systemService;
    protected $apiBling;

    public function __construct(ApiWhatsappService $apiWhatsapp, SystemService $systemService, ApiBlingService $apiBling)
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
        $this->apiWhatsapp = $apiWhatsapp;
        $this->systemService = $systemService;
        $this->apiBling = $apiBling;
    }

    public function bling(Modulo $modulo)
    {
        $this->authorizePermissionEditModule($modulo->id);

        session()->put('modulo_id_executando_bling', $modulo->id);

        $configOutroModulo = ConfSistema::where('modulo_id', '!=', $modulo->id)
            ->where('user_id', user_princ()->id)
            ->where('tipo', 'bling');

        $configAtualModulo = ConfSistema::where('modulo_id', $modulo->id)
            ->where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->first();

        $getConfigModuleExist = $this->getConfigModuleExist();

        if ($getConfigModuleExist && $modulo->id != $getConfigModuleExist->id):
            session()->put('modulo_id_para_redirect', $modulo->id);
        endif;

        return view('pages.config.system.bling', compact('modulo', 'configAtualModulo', 'configOutroModulo', 'getConfigModuleExist'));
    }

    public function authBling(Request $request)
    {
        if ($request->query('error') === 'access_denied') :
            switch (session('modulo_id_executando_bling')) {
                case 1:
                    return redirect()->route('config.sistema.charges.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 3:
                    return redirect()->route('config.sistema.remarketing.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 4:
                    return redirect()->route('config.sistema.rastreamento.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 2:
                    return redirect()->route('config.sistema.faturamento.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
            }
        endif;

        $code = $request->query('code');
        $state = $request->query('state');

        if (!empty($code) && $state == '891616151415209625') {
            $modulo = Modulo::find(session('modulo_id_executando_bling'));
            $bling = ConfSistema::where('user_id', user_princ()->id)
                ->where('modulo_id', $modulo->id)
                ->where('tipo', 'bling')
                ->first();

            $client_id = env('BLING_CLIENT_ID');
            $client_secret = env('BLING_CLIENT_SECRET');

            $basic = base64_encode($client_id . ':' . $client_secret);

            $data = (object) [
                'basic' => $basic,
                'code' => $code,
            ];

            $token = $this->apiBling->authBling($data);
            $integracao = $bling->integracao;
            $integracao['access_token'] = $token->access_token;
            $integracao['refresh_token'] = $token->refresh_token;
            $integracao['autorizacao_bling'] = true;

            $saveToken = ConfSistema::where('user_id', user_princ()->id)
                ->where('modulo_id', $modulo->id)
                ->where('tipo', 'bling')
                ->update(['integracao' => $integracao]);

            $this->apiBling->getFormasPagamento($modulo->id);

            switch (session('modulo_id_executando_bling')) {
                case 1:
                    return redirect()->route('config.sistema.charges.index')
                        ->withSuccess('Dados de integração Bling atualizados com sucesso.');
                case 3:
                    return redirect()->route('config.sistema.remarketing.index')
                        ->withSuccess('Dados de integração Bling atualizados com sucesso.');
                case 4:
                    return redirect()->route('config.sistema.rastreamento.index')
                        ->withSuccess('Dados de integração Bling atualizados com sucesso.');
                case 2:
                    return redirect()->route('config.sistema.faturamento.index')
                        ->withSuccess('Dados de integração Bling atualizados com sucesso.');
            }
        } else {
            switch (session('modulo_id_executando_bling')) {
                case 1:
                    return redirect()->route('config.sistema.charges.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 3:
                    return redirect()->route('config.sistema.remarketing.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 4:
                    return redirect()->route('config.sistema.rastreamento.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
                case 2:
                    return redirect()->route('config.sistema.faturamento.index')
                        ->with('error', 'Erro na autorização do aplicativo Bling, tente novamente.');
            }
        }
    }


    /**
     * Config correios
     *
     * @param  mixed $modulo
     * @return void
     */
    public function correios(Modulo $modulo)
    {
        $this->authorizePermissionEditModule($modulo->id);
        session()->put('modulo_id_para_redirect', $modulo->id);

        $config = ConfigCorreio::where('user_id', user_princ()->id)->first();

        if ($config && $config->modulo_id != $modulo->id || $modulo->id != 4) // 4 -> rastreamento
            abort(403);

        return view('pages.config.system.correios', compact('modulo', 'config'));
    }

    public function storeCorreios(Request $request, Modulo $modulo)
    {

        $request->validate([
            'codigo_api' => 'required|max:191',
            'contrato' => 'required|max:191',
            'user' => 'required|max:191',
            // 'password' => 'required|max:191',
        ], [], [
            'user' => 'usuário',
            'codigo_api' => 'código da API'
        ]);

        $user = null;
        // retirar '.', '-' ou '/' se o valor for tipo um cnpj como 70.449.886/0001-30 etc... deixando apenas números
        if (preg_match('/^[0-9\/\-.]+$/',  $request->user)):
            $user = preg_replace('/[^0-9]/', '', $request->user);
        else:
            $user = $request->user;
        endif;

        // $pass = str_replace(' ', '', $request->password);
        $basicAuth = base64_encode("$user:$request->codigo_api");

        $token = $this->systemService->gerarTokenCorreios($request->contrato, $basicAuth);

        $emissaoFormatada = Carbon::parse($token->emissao)->format('Y-m-d H:i:s');
        $expiraEmFormatada = Carbon::parse($token->expiraEm)->format('Y-m-d H:i:s');

        ConfigCorreio::updateOrCreate([
            'user_id' => user_princ()->id,
            'modulo_id' => $modulo->id,
        ], [
            'codigo_api' => $request->codigo_api,
            'contrato' => $request->contrato,
            'basic_auth' => $basicAuth,
            'token' => $token->token,
            'emissao' => $emissaoFormatada,
            'expiraEm' => $expiraEmFormatada
        ]);

        // para redirecinar a outro modulo
        if ($modulo->id == 1)
            return redirect()->route('config.sistema.charges.index')->withSuccess('Configuração correios salva com sucesso!');

        if ($modulo->id == 3)
            return redirect()->route('config.sistema.remarketing.index')->withSuccess('Configuração correios salva com sucesso!');

        if ($modulo->id == 4)
            return redirect()->route('config.sistema.rastreamento.index')->withSuccess('Configuração correios salva com sucesso!');

        if ($modulo->id == 2)
            return redirect()->route('config.sistema.faturamento.index')->withSuccess('Configuração correios salva com sucesso!');

        return redirect()->back()->withSuccess('Configuração salva com sucesso!');
    }

    /**
     * Obter config de integração de modulo que já foi configurado
     *
     */
    public function getConfigModuleExist()
    {
        $config = ConfSistema::where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->where('integracao->autorizacao_bling', true)
            // ->where('integracao->access_token', "!=", null)
            // ->where('integracao->refresh_token', "!=", null)
            ->first();

        if ($config)
            return $config;

        return null;
    }

    public static function getConfigModuleExist2()
    {
        $config = ConfSistema::where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->where('integracao->autorizacao_bling', true)
            ->first();

        return $config;
    }

    public static function configBlingExist(): bool
    {
        $config = ConfSistema::where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->where('integracao->autorizacao_bling', true)
            ->first();

        return $config ? true : false;
    }

    public function storeBling(StoreBlingRequest $request)
    {

        $modulo = Modulo::find(session('modulo_id_executando_bling'));
        if (is_null($modulo)) :
            return back()
                ->withErrors(['error' => 'Modulo não encontrado'])
                ->withInput();
        endif;

        $this->authorizePermissionEditModule($modulo->id);


        $integracao = [
            'nf_situation' => $this->prepareNfSituation($request),
            'order_situation' => $this->prepareOrderSituation($request),
            'autorizacao_bling' => $request->has('autorizacao_bling') ? true : false,
            'access_token' => null,
            'refresh_token' => null,
        ];


        $conf = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', $modulo->id)
            ->where('tipo', 'bling')
            ->first();

        // se já existe, atualizar
        if ($conf):

            // permanecer os dados de token
            $integracao['access_token'] = $conf->integracao['access_token'];
            $integracao['refresh_token'] = $conf->integracao['refresh_token'];
            $integracao['autorizacao_bling'] = $conf->integracao['autorizacao_bling'];

            $conf->integracao = $integracao;
            $conf->save();
        else: // se não exist, criar

            $conf = ConfSistema::create([
                'user_id' => user_princ()->id,
                'modulo_id' => $modulo->id,
                'tipo' => 'bling',
                'integracao' => $integracao
            ]);
        endif;

        // redirecionar para o bling
        if (is_null($conf->integracao['access_token']) || $conf->integracao['refresh_token']):
            return redirect(env('BLING_CONVITE'));
        endif;



        // para redirecinar a outro modulo
        if (session('modulo_id_para_redirect') == 1)
            return redirect()->route('config.sistema.charges.index')->withSuccess('Configuração salva com sucesso!');

        if (session('modulo_id_para_redirect') == 3)
            return redirect()->route('config.sistema.remarketing.index')->withSuccess('Configuração salva com sucesso!');

        if (session('modulo_id_para_redirect') == 4)
            return redirect()->route('config.sistema.rastreamento.index')->withSuccess('Configuração salva com sucesso!');

        if (session('modulo_id_para_redirect') == 2)
            return redirect()->route('config.sistema.faturamento.index')->withSuccess('Configuração salva com sucesso!');


        // para redirecinar a outro modulo
        if ($modulo->id == 1)
            return redirect()->route('config.sistema.charges.index')->withSuccess('Configuração salva com sucesso!');

        if ($modulo->id == 3)
            return redirect()->route('config.sistema.remarketing.index')->withSuccess('Configuração salva com sucesso!');

        if ($modulo->id == 4)
            return redirect()->route('config.sistema.rastreamento.index')->withSuccess('Configuração salva com sucesso!');

        if ($modulo->id == 2)
            return redirect()->route('config.sistema.faturamento.index')->withSuccess('Configuração salva com sucesso!');


        return redirect()->back()->withSuccess('Configuração salva com sucesso!');
    }

    /**
     * Adicionar configuração já existente em um outro módulo
     *
     * @return void
     */
    public function setConBlingOutroModulo(Request $request)
    {

        $configOutroModulo = ConfSistema::where('id', $request->config[0])
            ->where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->first();

        ConfSistema::updateOrCreate(
            [
                'user_id' => user_princ()->id,
                'modulo_id' => session('modulo_id_executando_bling'),
                'tipo' => 'bling',
            ],
            ['integracao' => $configOutroModulo->integracao]
        );

        return redirect()->back();
    }

    public static function blingConnectionStatus(): bool
    {
        $modulo = Modulo::where('nome', 'remarketing')->first();
        $configBling = ConfSistema::where('user_id', user_princ()->id)
            ->where('status', 'ativo')
            ->where('modulo_id', $modulo->id)
            ->where('tipo', 'bling');

        return $configBling->exists();
    }

    /**
     * Preparar e formata os dados nf_situation para o bling
     *
     * @param  mixed $request
     * @return void
     */
    public function prepareNfSituation($request)
    {
        $nf_situation = [];
        if ($request->has('autorizada'))
            $nf_situation[] = 5;
        if ($request->has('emitida_danfe'))
            $nf_situation[] = 6;

        return $nf_situation;
    }

    /**
     * Preparar e formata os dados order_situation para o bling
     *
     * @param  mixed $request
     * @return void
     */
    public function prepareOrderSituation($request)
    {
        $order_situation = [];
        if ($request->has('em_aberto'))
            $order_situation[] = 6;
        if ($request->has('atendido'))
            $order_situation[] = 9;
        if ($request->has('em_andamento'))
            $order_situation[] = 15;
        if ($request->has('verificado'))
            $order_situation[] = 24;
        if ($request->has('em_separacao'))
            $order_situation[] = 382716;

        return $order_situation;
    }

    public function generateConnectionWhatsapp($moduloId)
    {
        $connectionKey = $this->gerarConnectionKey();
        $responseConexao = $this->apiWhatsapp->criarConexao($connectionKey);

        // $modulo = Modulo::find($moduloId);
        $user = user_princ();
        $nome = $user->tipo_usuario == 'PF' ? $user->nome_usuario : $user->razao_social;

        $integracao = [
            "nome" => $nome,
            "whatsapp" => null,
            "connectionKey" => $responseConexao->connectionKey->connectionKey,
            "token" => $responseConexao->token
        ];

        return ConfSistema::updateOrCreate(
            [
                'user_id' => $user->id,
                'modulo_id' => $moduloId,
                'tipo' => 'whatsapp',
            ],
            ['integracao' => $integracao]
        );
    }

    public function connectWhatsapp(Modulo $modulo)
    {
        $this->authorizePermissionEditModule($modulo->id);
        session()->put('modulo_id_executando', $modulo->id);

        $config = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', $modulo->id)
            ->where('tipo', 'whatsapp')->first();

        // se existe conexão de um outro modulo
        $configOutroModulo = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', "!=", $modulo->id)
            ->where('integracao->whatsapp', "!=", null)
            ->where('tipo', 'whatsapp');




        // não gerar qr code se já tiver um módulo configurado
        if ($configOutroModulo->count() >= 1 && is_null($config) && is_null(session('gerar_qrcode_conexao_whatsapp'))) {
            return view('pages.config.system.connect_whatsapp', compact('configOutroModulo', 'modulo'));
        } else {
            if (is_null($config)) : // criar conexão
                $this->generateConnectionWhatsapp($modulo->id);
            endif;


            if (is_null($this->getConfigWhatsapp())) :
                return redirect()->route('config.sistema.index');
            endif;

            $infoConexao = $this->apiWhatsapp->infoConexao();

            if (isset($infoConexao->connection_data)) :
                $infoConexao = $infoConexao->connection_data;
            endif;

            if ($infoConexao === 'gerarQrCode' or !isset($infoConexao->phone_connected) or $infoConexao->phone_connected !== true) :
                $qrcodeBase64 = $this->apiWhatsapp->qrcodeBase64();
                $whatsapp = $this->apiWhatsapp->whatsapp;

                return view('pages.config.system.connect_whatsapp', compact('qrcodeBase64', 'whatsapp', 'configOutroModulo', 'modulo'));
            else :
                $connected = true;
                $whatsapp = explode(':', $infoConexao->user->id)[0];
                $statusSessionCon = session('success_connection');
                session()->put('success_connection', false);
                return view('pages.config.system.connect_whatsapp', compact('connected', 'whatsapp', 'statusSessionCon', 'modulo'));
            endif;
        }
    }

    /**
     * Criar session para permitir criar qr code para fazer conexão
     *
     * @return void
     */
    public function fazerConexaoWhatsapp($moduloId)
    {
        session()->flash('gerar_qrcode_conexao_whatsapp', true);
        return redirect()->route('config.sistema.connect-whatsapp', $moduloId);
    }

    public function reloadQrCode()
    {
        $infoConexao = $this->systemService->getInfoConexao();
        if ($infoConexao === 'nao_conectado') :
            return $this->apiWhatsapp->qrcodeBase64()->qrcode;
        else :
            return "conectado";
        endif;
    }

    /**
     * Adicionar a config whatsapp de um módulo para outro, se cliente deseja utilizar uma conexão existente
     *
     * @return void
     */
    public function setConWhatsappOutroModulo(Request $request)
    {

        if (is_null(session('modulo_id_executando')))
            return redirect()->back();

        // se existe conexão de um outro modulo
        $configOutroModulo = ConfSistema::where('user_id', user_princ()->id)
            ->where('id', $request->config[0])
            ->where('modulo_id', "!=", session('modulo_id_executando'))
            ->where('tipo', 'whatsapp')->first();

        $configNovoModulo = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', session('modulo_id_executando'))
            ->where('tipo', 'whatsapp')->first();

        if (is_null($configNovoModulo)):
            $configNovoModulo = ConfSistema::create([
                'user_id' => user_princ()->id,
                'modulo_id' => session('modulo_id_executando'),
                'tipo' => 'whatsapp',
                'status' => 'ativo',
                'integracao' => ''
            ]);
        endif;

        $configNovoModulo->status = $configOutroModulo->status;
        $configNovoModulo->integracao = $configOutroModulo->integracao;
        $configNovoModulo->save();

        return redirect()->back()->with('usar_conexao_outro_modulo', true);
    }

    public function statusConexao()
    {
        if (isset($this->apiWhatsapp->infoConexao()->connection_data)) :
            $con = $this->apiWhatsapp->infoConexao()->connection_data;
            if (isset($con->phone_connected) && $con->phone_connected) :

                // atualizar num whatsapp no banco de dados
                if (session('modulo_id_executando') && isset(explode(':', $this->apiWhatsapp->infoConexao()->connection_data->user->id)[0])) :

                    $whatsapp = explode(':', $this->apiWhatsapp->infoConexao()->connection_data->user->id)[0];
                    $config = ConfSistema::where('modulo_id', session('modulo_id_executando'))
                        ->where('user_id', user_princ()->id)->where('tipo', 'whatsapp')->first();

                    if ($config) {
                        $integracao = $config->integracao;
                        $integracao['whatsapp'] = $whatsapp;

                        $config->integracao = $integracao;
                        $config->save();
                    }
                endif;

                return 'conectado';
            endif;
        endif;

        return 'nao_conectado';
    }



    public function changeWhatsapp()
    {

        $respTrocaNumero = $this->systemService->trocarNumeroWhatsapp();
        if ($respTrocaNumero instanceof RedirectResponse) :
            return $respTrocaNumero;
        endif;


        $configCurrent = ConfSistema::where('user_id', user_princ()->id)
            ->where('modulo_id', session('modulo_id_executando'))
            ->where('tipo', 'whatsapp')->first();

        $connectionKey = $configCurrent->integracao['connectionKey'];


        $confs = ConfSistema::where('user_id', user_princ()->id)
            ->where('tipo', 'whatsapp');

        foreach ($confs->get() as $key => $confi) :

            if ($confi->integracao['connectionKey'] == $connectionKey) :
                ConfSistema::where('id', $confi->id)->first()->forceDelete();
            endif;
        endforeach;

        return redirect()->back();
    }

    public function abortAccessForModule($moduloId)
    {
        if (userHasModule($moduloId) === false) :
            abort(403);
        endif;
    }

    public function changeBlingRedirect()
    {
        return redirect()->back()->with('trocar_bling', true);
    }

    public function destroyBling(Modulo $modulo)
    {
        $this->authorizePermissionEditModule($modulo->id);
        ConfSistema::where('modulo_id', $modulo->id)
            ->where('user_id', user_princ()->id)
            ->where('tipo', 'bling')
            ->forceDelete();

        switch (session('modulo_id_executando_bling')) {
            case 1:
                return redirect()->route('config.sistema.charges.index')
                    ->with('success', 'Integração Bling removida com sucesso.');
            case 3:
                return redirect()->route('config.sistema.remarketing.index')
                    ->with('success', 'Integração Bling removida com sucesso.');
            case 4:
                return redirect()->route('config.sistema.rastreamento.index')
                    ->with('success', 'Integração Bling removida com sucesso.');
            case 2:
                return redirect()->route('config.sistema.faturamento.index')
                    ->with('success', 'Integração Bling removida com sucesso.');
        }
    }

    public function authorizePermissionEditModule($moduloId)
    {
        if ($moduloId == 1)
            authorizePermissions(['edit-modulo-cobrancas']);
        if ($moduloId == 2)
            authorizePermissions(['edit-modulo-faturamento']);
        if ($moduloId == 3)
            authorizePermissions(['edit-modulo-remarketing']);
        if ($moduloId == 4)
            authorizePermissions(['edit-modulo-rastreamento']);
    }
}
