@php
    session(['figura_base' => 207]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Relatório - Rastreamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre o relatório de envios de notificações do módulo
                        Rastreamento
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
                            <div class="h3 mt-2">
                                <p><u>Os dados apresentados nesta seção são fictícios e utilizados apenas para fins
                                        ilustrativos.</u></p>

                                <p>A <x-ajuda.link-figura /> exibe a tela do relatório de envios de notificações do módulo
                                    Rastreamento.</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/rastreamento/index.png')"
                                    descricao="Tela do relatório de envios de notificações do módulo Rastreamento" />

                                <p>Logo acima do relatório, ao lado do título, são apresentados dois cards informativos:</p>
                                <ul class="lista-personalizada">
                                    <li>Total de mensagens enviadas.</li>
                                    <li>Quantidade de mensagens restantes disponíveis.</li>
                                </ul>

                                <p>O relatório apresenta 10 (dez) registros por página, com navegação disponível no canto
                                    inferior direito do relatório.</p>

                                <hr>

                                <p>Na parte superior, encontra-se o botão <strong>Filtrar</strong> (botão laranja).</p>
                                <p>Ao clicar, será exibida uma janela com filtros para refinar os resultados do relatório
                                    (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/rastreamento/filtro.png')"
                                    descricao="Janela de filtros para o relatório" />

                                <p>Após aplicar os filtros desejados, clique em <strong>Filtrar</strong> para exibir os
                                    dados conforme os critérios selecionados.</p>
                                <p>Para restaurar a visualização original, clique novamente em <strong>Filtrar</strong> e
                                    selecione <strong>Limpar filtro</strong>. O fechamento da janela atualizará o relatório
                                    com todos os registros disponíveis.</p>

                                <hr>

                                <p>Ao lado do botão de filtro, encontra-se o botão <strong>Exportar para Excel</strong>
                                    (botão azul).</p>
                                <p>Ao acioná-lo, será gerado um arquivo com o nome “Relatório Rastreamento + data e hora
                                    atuais” e o download será iniciado automaticamente.</p>

                                <hr>

                                <p>Cada linha do relatório possui um ícone para consulta detalhada da notificação enviada.
                                </p>
                                <p>O ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite visualizar os
                                    detalhes do envio.</p>
                                <p>As notificações podem apresentar uma das três situações: <u>Não entregue</u>,
                                    <u>Entregue</u> ou <u>Visualizado</u>. A seguir, são descritas as telas correspondentes
                                    a cada status:</p>

                                <ul class="lista-personalizada">

                                    <li>
                                        <p>Para registros com status <u>Não entregue</u>, ao clicar no ícone será exibida a
                                            tela representada na <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/relatorios/rastreamento/nao-entregue.png',
                                        )"
                                            descricao="Situação 'Não entregue'" />
                                        <p>Essa situação indica que a mensagem foi enviada para o número informado, porém o
                                            dispositivo não possui WhatsApp ativo.</p>
                                    </li>

                                    <li>
                                        <p>Para a situação <u>Entregue</u>, a visualização será semelhante à exibida na
                                            <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/rastreamento/entregue.png')" descricao="Situação 'Entregue'" />
                                        <p>Nesse caso, a mensagem foi entregue ao destinatário, mas ainda não foi
                                            visualizada.</p>
                                    </li>

                                    <li>
                                        <p>Se a situação for <u>Visualizado</u>, a tela apresentada será como a mostrada na
                                            <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/relatorios/rastreamento/visualizado.png',
                                        )" descricao="Situação 'Visualizado'" />
                                        <p>Essa situação indica que a mensagem foi entregue e aberta pelo destinatário,
                                            finalizando o ciclo de envio da notificação.</p>
                                    </li>
                                </ul>
                                <hr class="linha-dupla">

                                <p>As instruções sobre o relatório de envios do módulo Rastreamento terminam aqui. A próxima
                                    seção apresenta o relatório de envios do módulo Remarketing.</p>

                                <p>Para acessar o conteúdo, <a
                                        href="{{ route('central.ajuda.relat.remarketing') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Relatórios > Remarketing</u>.</p>
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
