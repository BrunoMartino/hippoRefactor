@extends('ajuda.layouts.basic')
@section('title', 'Relatório - Apresentação')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Apresentação da seção dos relatórios de envios das notificações</h2>
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
                            <div class="h3 mt-2">
                                <p>Esta seção apresenta os relatórios de envios das notificações no sistema Hippo Notify.
                                </p>

                                <p>Ao acessar o menu <strong>Relatórios</strong>, são exibidos submenus com diferentes
                                    relatórios. O primeiro submenu corresponde a esta página de apresentação. Os demais
                                    estão listados a seguir:</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p><u>Cobranças</u> — disponível em <u>Relatórios > Cobranças</u> ou <a
                                                href="{{ route('central.ajuda.relat.cobrancas') }}"><strong>clicando
                                                    aqui</strong></a>.</p>
                                    </li>
                                    <li>
                                        <p><u>Faturamento</u> — disponível em <u>Relatórios > Faturamento</u> ou <a
                                                href="{{ route('central.ajuda.relat.faturamento') }}"><strong>clicando
                                                    aqui</strong></a>.</p>
                                    </li>
                                    <li>
                                        <p><u>Rastreamento</u> — disponível em <u>Relatórios > Rastreamento</u> ou <a
                                                href="{{ route('central.ajuda.relat.rastreamento') }}"><strong>clicando
                                                    aqui</strong></a>.</p>
                                    </li>
                                    <li>
                                        <p><u>Remarketing</u> — disponível em <u>Relatórios > Remarketing</u> ou <a
                                                href="{{ route('central.ajuda.relat.remarketing') }}"><strong>clicando
                                                    aqui</strong></a>.</p>
                                    </li>
                                </ul>

                                <p>Os relatórios de cada módulo apresentam campos específicos, conforme as informações
                                    utilizadas para o envio das notificações.</p>

                                <p>A seguir, será apresentada a estrutura do relatório do módulo Cobranças.</p>

                                <p>Para acessar diretamente, <a
                                        href="{{ route('central.ajuda.relat.cobrancas') }}"><strong>clique aqui</strong></a>
                                    ou utilize o menu <u>Relatórios > Cobranças</u>.</p>
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
