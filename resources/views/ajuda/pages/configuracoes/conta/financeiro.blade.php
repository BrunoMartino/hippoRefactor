@php
    session(['figura_base' => 56]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Conta - Financeiro')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Apresentação do relatório Financeiro
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
                                <p>A tela do relatório financeiro exibe informações relacionadas às faturas geradas
                                    <x-ajuda.link-figura format />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/conta/financeiro/relatorio.png')" descricao="Tela do relatório financeiro" />

                                <p>As faturas são apresentadas com status como <u>Aberto</u> ou <u>Pago</u>.</p>

                                <p>Em cada linha do relatório, há um ícone azul claro (<i
                                        class="ti ti-eye fs-7 text-secondary"></i>) que permite visualizar detalhes da
                                    fatura.</p>

                                <p>Ao clicar no ícone, será exibida a tela com as informações completas da fatura
                                    correspondente <x-ajuda.link-figura />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/conta/financeiro/view-fatura.png')" descricao="Visualização da fatura" />

                                <p><em>As informações exibidas em cada fatura variam conforme os dados do registro.</em></p>

                                <p>Para retornar ao relatório, utilize o botão <strong>Voltar</strong>.</p>

                                <hr>

                                <p><em>Observação: na próxima atualização do sistema, o relatório financeiro contará com
                                        novos dados e um filtro completo.</em></p>

                                <hr>
                                <p>As orientações sobre a tela do relatório financeiro encerram-se aqui.</p>
                                <p>Para prosseguir, acesse a seção com explicações sobre as configurações do módulo
                                    Cobranças <a
                                        href="{{ route('central.ajuda.config.sistema.cobrancas') }}"><strong>clicando
                                            aqui</strong></a> ou utilize o menu lateral: <u>Configurações &gt; Sistema &gt;
                                        Cobranças</u>.</p>
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
