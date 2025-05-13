@php
    session(['figura_base' => 202]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Relatório - Faturamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre o relatório de envios de notificações do módulo Faturamento
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
                                <p><u><em>Os dados apresentados nesta seção são fictícios e utilizados apenas para fins
                                            ilustrativos.</em></u></p>

                                <p>A <x-ajuda.link-figura /> exibe a tela do relatório de envios de notificações do módulo
                                    Faturamento.</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/faturamento/index.png')"
                                    descricao="Tela do relatório de envios de notificações do módulo Faturamento" />

                                <p>Acima do relatório, ao lado do título, são apresentados dois cards informativos:</p>
                                <ul class="lista-personalizada">
                                    <li>Total de mensagens enviadas.</li>
                                    <li>Quantidade de mensagens restantes disponíveis.</li>
                                </ul>

                                <p>O relatório exibe 10 (dez) registros por página, com navegação localizada no canto
                                    inferior direito do relatório.</p>

                                <hr>

                                <p>O botão <strong>Filtrar</strong> (botão laranja) está disponível na parte superior da
                                    tela.</p>
                                <p>Ao clicar, será aberta uma janela com filtros para refinar os resultados do relatório
                                    (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/faturamento/filtro.png')" descricao="Janela de filtros do relatório" />

                                <p>Após aplicar os filtros desejados, clique em <strong>Filtrar</strong> para exibir os
                                    resultados conforme os critérios selecionados.</p>
                                <p>Para restaurar o relatório completo, clique novamente em <strong>Filtrar</strong> e
                                    selecione <strong>Limpar filtro</strong>. O fechamento da janela restaurará a
                                    visualização total.</p>

                                <hr>

                                <p>Ao lado do botão de filtro, está o botão <strong>Exportar para Excel</strong> (botão
                                    azul).</p>
                                <p>Ao acioná-lo, será gerado automaticamente um arquivo com o nome “Relatório Faturamento +
                                    data e hora atuais” e o download será iniciado.</p>

                                <hr>

                                <p>Cada linha do relatório contém um ícone para consulta detalhada da notificação enviada.
                                </p>
                                <p>O ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite visualizar os
                                    detalhes do envio.</p>
                                <p>As notificações podem estar nas seguintes situações: <u>Não entregue</u>, <u>Entregue</u>
                                    ou <u>Visualizado</u>. Veja abaixo a visualização correspondente a cada uma:</p>

                                    <ul class="lista-personalizada">

                                <li>
                                    <p>Ao clicar no ícone referente a um envio com situação <u>Não entregue</u>, será exibida a
                                        visualização ilustrada na <x-ajuda.link-figura />.</p>
                                    <x-ajuda.figure :src="asset('assets/images/manual/relatorios/faturamento/nao-entregue.png')" descricao="Situação 'Não entregue'" />
                                    <p>Essa situação indica que a notificação foi enviada, porém o número não possui WhatsApp
                                        ativo no dispositivo.</p>
                                </li>

                                <li>
                                    <p>Para a situação <u>Entregue</u>, a visualização será semelhante à apresentada na
                                        <x-ajuda.link-figura />.</p>
                                    <x-ajuda.figure :src="asset('assets/images/manual/relatorios/faturamento/entregue.png')" descricao="Situação 'Entregue'" />
                                    <p>Nesse caso, a mensagem foi entregue ao destinatário, mas ainda não foi aberta.</p>
                                </li>

                                <li>
                                    <p>Quando a situação for <u>Visualizado</u>, a visualização será como a demonstrada na
                                        <x-ajuda.link-figura />.</p>
                                    <x-ajuda.figure :src="asset('assets/images/manual/relatorios/faturamento/visualizado.png')" descricao="Situação 'Visualizado'" />
                                    <p>Essa situação confirma que a mensagem foi recebida e aberta pelo destinatário, encerrando
                                        o ciclo de envio.</p>
                                </li>
                                    </ul>
                                    <hr class="linha-dupla">

                                <p>Encerram-se aqui as instruções referentes ao relatório de envios do módulo Faturamento. A
                                    próxima seção aborda os relatórios de envios do módulo Rastreamento.</p>

                                <p>Para acessar o conteúdo, <a
                                        href="{{ route('central.ajuda.relat.rastreamento') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Relatórios > Rastreamento</u>.</p>
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
