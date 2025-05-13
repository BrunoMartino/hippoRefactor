@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Dados Importados - Apresentação')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Apresentação da página de configuração dos Dados Importados
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
    <p>Esta seção apresenta as instruções referentes à configuração dos Dados Importados.</p>

    <p>Esses dados são utilizados para o envio de notificações quando selecionados nas configurações de envio dos módulos contratados e/ou nas configurações de envio das mensagens.</p>

    <p>No sistema Hippo Notify, ao acessar o menu <u>Configurações > Dados Importados</u>, são exibidos submenus com diferentes funcionalidades.</p>

    <p>O primeiro submenu corresponde a esta página de apresentação. Os demais, listados a seguir, direcionam às configurações específicas de cada módulo:</p>

    <ul class="lista-personalizada">
        <li>
            <p><u>Cobranças</u> — disponível em <u>Configurações > Dados Importados > Cobranças</u> ou <a href="{{ route('central.ajuda.config.dados.importados.cobrancas') }}"><strong>clicando aqui</strong></a>.</p>
        </li>
        <li>
            <p><u>Faturamento</u> — disponível em <u>Configurações > Dados Importados > Faturamento</u> ou <a href="{{ route('central.ajuda.config.dados.importados.faturamento') }}"><strong>clicando aqui</strong></a>.</p>
        </li>
        <li>
            <p><u>Rastreamento</u> — disponível em <u>Configurações > Dados Importados > Rastreamento</u> ou <a href="{{ route('central.ajuda.config.dados.importados.rastreamento') }}"><strong>clicando aqui</strong></a>.</p>
        </li>
        <li>
            <p><u>Remarketing</u> — disponível em <u>Configurações > Dados Importados > Remarketing</u> ou <a href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"><strong>clicando aqui</strong></a>.</p>
        </li>
    </ul>

    <p>Cada módulo possui requisitos distintos de dados e configurações para geração das notificações, o que torna necessária a importação individualizada para cada um.</p>

    <p>A seguir, serão apresentadas as instruções de importação de dados para o módulo <strong>Cobranças</strong>.</p>

    <p>Para acessar diretamente, <a href="{{ route('central.ajuda.config.dados.importados.cobrancas') }}"><strong>clique aqui</strong></a> ou utilize o menu <u>Configurações > Dados Importados > Cobranças</u>.</p>
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
