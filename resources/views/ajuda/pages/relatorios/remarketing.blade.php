@php
    session(['figura_base' => 212]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Relatório - Remarketing')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre o relatório de envios de notificações do módulo Remarketing
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
                                    Remarketing</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/remarketing/index.png')"
                                    descricao="Tela do relatório de envios de notificações do módulo Remarketing" />

                                <p>Na parte superior do relatório, ao lado do título, são apresentados dois cards
                                    informativos:</p>
                                <ul class="lista-personalizada">
                                    <li>Total de mensagens enviadas.</li>
                                    <li>Quantidade de mensagens restantes disponíveis.</li>
                                </ul>

                                <p>O relatório exibe até 10 (dez) registros por página, com paginação disponível no canto
                                    inferior direito do relatório.</p>

                                <hr>

                                <p>Acima do relatório está disponível o botão <strong>Filtrar</strong> (botão laranja).</p>
                                <p>Ao clicar, será exibida uma janela com filtros que podem ser utilizados para refinar os
                                    resultados (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset('assets/images/manual/relatorios/remarketing/filtro.png')"
                                    descricao="Janela de filtros para o relatório" />

                                <p>Após configurar os filtros desejados, clique em <strong>Filtrar</strong> para atualizar o
                                    relatório conforme os critérios definidos.</p>
                                <p>Para retornar à visualização completa, clique novamente em <strong>Filtrar</strong> e
                                    selecione <strong>Limpar filtro</strong>. O fechamento da janela exibe todos os
                                    registros disponíveis.</p>

                                <hr>

                                <p>Também está disponível o botão <strong>Exportar para Excel</strong> (botão azul).</p>
                                <p>Ao acioná-lo, será gerado automaticamente um arquivo Excel com o nome “Relatório
                                    Remarketing + data e hora atuais”, iniciando o download do documento.</p>

                                <hr>

                                <p>Cada linha do relatório apresenta um ícone para consulta dos detalhes do envio.</p>
                                <p>O ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite visualizar as
                                    informações completas da notificação.</p>
                                <p>As mensagens podem estar em uma das seguintes situações: <u>Não entregue</u>,
                                    <u>Entregue</u> ou <u>Visualizado</u>. A seguir, são apresentadas as telas
                                    correspondentes a cada status:</p>
                                <ul class="lista-personalizada">

                                    <li>
                                        <p>Na situação <u>Não entregue</u>, a tela exibida será como demonstrado na
                                            <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/relatorios/remarketing/nao-entregue.png',
                                        )"
                                            descricao="Situação 'Não entregue'" />
                                        <p>Essa situação indica que a mensagem foi enviada, porém o número de celular
                                            informado não possui WhatsApp ativo.</p>
                                    </li>

                                    <li>
                                        <p>Para mensagens com status <u>Entregue</u>, a tela apresentada será semelhante à
                                            demonstrada na <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/remarketing/entregue.png')" descricao="Situação 'Entregue'" />
                                        <p>Essa situação indica que a mensagem foi recebida pelo destinatário, mas ainda não
                                            visualizada.</p>
                                    </li>

                                    <li>
                                        <p>No caso da situação <u>Visualizado</u>, a visualização segue o modelo exibido na
                                            <x-ajuda.link-figura />.</p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/remarketing/visualizado.png')" descricao="Situação 'Visualizado'" />
                                        <p>Essa situação indica que a mensagem foi entregue e aberta pelo destinatário,
                                            concluindo o ciclo do envio.</p>
                                    </li>
                                </ul>
                                <hr class="linha-dupla">

                                <p>As instruções sobre o relatório de envios de notificações do módulo Remarketing terminam
                                    aqui. A próxima seção apresenta a área de Sugestões, destinada ao envio e acompanhamento
                                    de ideias para aprimoramento do sistema Hippo Notify.</p>

                                <p>Para acessar essa seção, <a href="{{ route('central.ajuda.sugestoes') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Sugestões</u>.</p>
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
