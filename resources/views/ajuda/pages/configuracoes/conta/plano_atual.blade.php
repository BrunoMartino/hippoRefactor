@php
    session(['figura_base' => 53]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Conta - Plano atual')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Explicações sobre a página do Plano atual</h2>
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
                                <p>A tela do plano atual apresenta um card com informações do plano vigente e botões
                                    referentes aos módulos disponíveis <x-ajuda.link-figura format />.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/conta/plano-atual/plano-atual.png',
                                )" descricao="Tela do plano atual" />

                                <p>O botão com destaque em azul indica o módulo atualmente exibido. Os botões com destaque
                                    em vermelho representam os demais módulos ativos. Ao clicar em um desses botões, o card
                                    do plano correspondente será carregado.</p>

                                <p>Em cada módulo, é possível utilizar o botão <strong>Trocar de Plano</strong>, que
                                    direciona para a tela de troca <x-ajuda.link-figura format />.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/conta/plano-atual/trocar-plano.png',
                                )" descricao="Tela de trocar de plano" />

                                <p>Na <a href="#figura53"><strong>figura 53</strong></a>, o botão laranja maior identifica o
                                    módulo e o plano ativos. Os demais cards exibem os planos disponíveis para troca. O card
                                    desfocado representa o plano atual, que não pode ser selecionado.</p>

                                <p>Os botões menores servem para trocar os planos de outros módulos ativos.</p>

                                <p>Para contratar um plano de um módulo ainda não adquirido, utilize o botão
                                    <strong>Trocar/Adquirir plano</strong> disponível no menu superior.</p>
                                <p>A explicação completa sobre <strong>Trocar/Adquirir plano</strong> está na seção
                                    referente ao menu superior. Para acessá-la, <a
                                        href="{{ route('central.ajuda.menu.superior') }}#trocar-adquirir-plano"><strong>clique
                                            aqui</strong></a>.</p>

                                <p>Para cancelar um plano, utilize o botão <strong>Cancelar Plano</strong>. Ao clicar, será
                                    exibida uma mensagem de confirmação conforme a <x-ajuda.link-figura format />.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/conta/plano-atual/cancelar-plano.png',
                                )"
                                    descricao="Mensagem de confirmação de cancelamento do plano" />

                                <p>Para confirmar o cancelamento, clique em <strong>Sim</strong>. Para manter o plano,
                                    clique em <strong>Cancelar</strong>.</p>

                                <p>As orientações sobre a tela do plano atual encerram-se aqui.</p>
                                <p>Para continuar, acesse a seção sobre o relatório financeiro <a
                                        href="{{ route('central.ajuda.config.conta.financeiro') }}"><strong>clicando aqui</strong></a>
                                    ou através do menu lateral: <u>Configurações &gt; Conta &gt; Financeiro</u>.</p>
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
