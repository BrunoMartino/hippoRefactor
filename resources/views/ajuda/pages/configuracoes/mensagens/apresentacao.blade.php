@php
    session(['figura_base' => 106]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagens - Apresentação')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Apresentação da página de configuração das mensagens
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-2">
                        <div class="lh-1">
                            <div class="h3 mt-4">
                                <p>Nessa seção são explicadas as configurações das mensagens, fundamentais para o envio de
                                    notificações.</p>
                                <p>Exceto no módulo Rastreamento, onde as mensagens são configuradas diretamente no tipo de
                                    envio.</p>
                                <p>Ao acessar <u>Configurações &gt; Mensagens</u>, apresenta a tela com a lista de
                                    mensagens cadastradas <x-ajuda.link-figura format />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/index.png')" descricao="Tela da listagem de mensagens cadastradas" />

                                <p>Se ainda não houver mensagens, essa tela aparecerá vazia, como mostrado no exemplo.</p>

                                <p>Para cadastrar uma nova mensagem, clique no botão <strong>Nova mensagem</strong>.</p>
                                <p>Será exibido um formulário para escolher o tipo desejado <x-ajuda.link-figura format />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/nova.png')"
                                    descricao="Tela para selecionar o tipo de nova mensagem" />

                                <p>Ao clicar no seletor do campo <u>Tipo</u>, será exibida uma lista com os tipos disponíveis, conforme
                                    os módulos adquiridos <x-ajuda.link-figura format />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/tipos.png')"
                                    descricao="Lista com os tipos de mensagens disponíveis para cadastro" />

                                <p>Basta selecionar o tipo desejado para continuar com o cadastro e configuração da
                                    mensagem.</p>
                                <p>As configurações de cada tipo serão explicadas separadamente nas páginas específicas,
                                    acessíveis pelos menus e/ou links a seguir:</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p><u>Agradecimento</u><br>
                                            Configurações &gt; Mensagens &gt; Agradecimento ou
                                            <a href="{{ route('central.ajuda.config.mensagens.agradecimento') }}"><strong>Clique
                                                    aqui</strong></a>
                                        </p>
                                    </li>

                                    <li>
                                        <p><u>Aniversário</u><br>
                                            Configurações &gt; Mensagens &gt; Aniversário ou
                                            <a href="{{ route('central.ajuda.config.mensagens.aniversario') }}"><strong>Clique
                                                    aqui</strong></a>
                                        </p>
                                    </li>

                                    <li>
                                        <p><u>Pesquisa de Satisfação</u><br>
                                            Configurações &gt; Mensagens &gt; Pesquisa Satisfação ou
                                            <a href="{{ route('central.ajuda.config.mensagens.pesquisa.satisfacao') }}"><strong>Clique
                                                    aqui</strong></a>
                                        </p>
                                    </li>
                                </ul>
                                <p>
                                    As configurações para o envio das notificações dos tipos abaixo são feitas diretamente
                                    na tela de configuração do módulo Cobranças:
                                </p>
                                <ul class="lista-personalizada">
                                    <li>Cobrança Gerada</li>
                                    <li>Cobrança Vencendo</li>
                                    <li>Cobrança Vencimento</li>
                                    <li>Cobrança Vencida</li>
                                </ul>
                                <p>
                                    Em <u>Configurações &gt; Mensagens &gt; Cobranças</u> apresentamos como gerenciar as mensagens desses tipos. Acesse
                                    pelo menu laretal ou <a
                                        href="{{ route('central.ajuda.config.mensagens.cobrancas') }}"><strong>clique
                                            aqui</strong></a> para visualizar as explicações necessárias.
                                </p>
                                <p>Da mesma forma, as configurações para o envio das notificações dos tipos abaixo são
                                    configurados diretamente no módulo Faturamento:</p>
                                <ul class="lista-personalizada">
                                    <li>Faturamento - Pedido Recebido</li>
                                    <li>Faturamento - Pedido em Andamento</li>
                                    <li>Faturamento - Pedido Atendido</li>
                                    <li>Faturamento - Pedido em Separação</li>
                                    <li>Faturamento - Pedido Verificado</li>
                                </ul>
                                <p>
                                    Em <u>Configurações &gt; Mensagens &gt; Faturamento</u> apresentamos como gerenciar as mensagens desses tipos. Acesse
                                    pelo menu lateral ou <a
                                        href="{{ route('central.ajuda.config.mensagens.faturamento') }}"><strong>clique
                                            aqui</strong></a> para visualizar as explicações necessárias.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
