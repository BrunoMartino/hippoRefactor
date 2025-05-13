@php
    session(['figura_base' => 197]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Relatório - Cobranças')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre o relatório de envios de notificações do módulo Cobranças
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
    <p><u><em>Os dados utilizados nesta seção são fictícios e têm caráter meramente ilustrativo.</em></u></p>

    <p>A <x-ajuda.link-figura /> apresenta a tela do relatório de envios de notificações do módulo Cobranças.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/relatorios/cobrancas/index.png')" descricao="Tela do relatório de envios de notificações do módulo Cobranças" />

    <p>Logo acima do relatório, ao lado do título, são exibidos dois cards informativos:</p>
    <ul class="lista-personalizada">
        <li>Total de mensagens enviadas.</li>
        <li>Quantidade de mensagens restantes disponíveis.</li>
    </ul>

    <p>O relatório é paginado, apresentando até 10 (dez) registros por página. A navegação entre as páginas é feita pelos botões localizados no canto inferior direito do relatório.</p>

    <hr>

    <p>Na parte superior da tela, encontra-se o botão <strong>Filtrar</strong> (botão laranja).</p>
    <p>Ao clicar, será aberta uma janela com filtros para refinar os dados do relatório (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/relatorios/cobrancas/filtro.png')" descricao="Janela de filtros para o relatório" />

    <p>Após definir os critérios desejados, clique em <strong>Filtrar</strong> para aplicar os filtros. </p>
    <p>
        Para restaurar os dados originais, clique novamente em <strong>Filtrar</strong> e selecione <strong>Limpar filtro</strong>. Ao fechar a janela, o relatório será recarregado com todos os registros.</p>

    <hr>

    <p>Também acima do relatório está o botão <strong>Exportar para Excel</strong> (botão azul).</p>
    <p>Ao acioná-lo, será gerado automaticamente um arquivo Excel com o nome “Relatório Cobranças Enviadas” seguido da data e hora atuais. O download será iniciado imediatamente.</p>

    <hr>

    <p>Cada linha do relatório contém um ícone para visualização detalhada do envio.</p>
    <p>O ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite consultar as informações completas da notificação.</p>
    <p>As notificações podem estar em três situações: <u>Não entregue</u>, <u>Entregue</u> ou <u>Visualizado</u>. Abaixo, detalhamos as telas para cada uma dessas situações:</p>

    <ul class="lista-personalizada">


    <li>
        <p>Ao clicar no ícone <i class="ti ti-eye fs-7 text-secondary"></i> em um registro com situação <u>Não entregue</u>, será exibida a visualização representada na <x-ajuda.link-figura />.</p>
        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/cobrancas/nao-entregue.png')" descricao="Situação 'Não entregue'" />
        <p>Essa situação indica que a notificação foi enviada para o número cadastrado, mas o dispositivo não possui o WhatsApp ativo.</p>
    </li>

    <li>
        <p>Ao clicar no mesmo ícone em registros com situação <u>Entregue</u>, será exibida a tela ilustrada na <x-ajuda.link-figura />.</p>
        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/cobrancas/entregue.png')" descricao="Situação 'Entregue'" />
        <p>Nessa situação, a mensagem foi recebida, mas ainda não foi aberta pelo destinatário.</p>
    </li>
    </ul>

    <li>
        <p>Já ao clicar no ícone em registros com situação <u>Visualizado</u>, será apresentada a visualização correspondente na <x-ajuda.link-figura />.</p>
        <x-ajuda.figure :src="asset('assets/images/manual/relatorios/cobrancas/visualizado.png')" descricao="Situação 'Visualizado'" />
        <p>Essa situação confirma que a mensagem foi entregue e aberta pelo destinatário, concluindo o processo de envio.</p>
    </li>
    <hr class="linha-dupla">

    <p>Com isso, encerram-se as explicações sobre o relatório de envios do módulo Cobranças. A próxima seção aborda o relatório de envios do módulo Faturamento.</p>

    <p>Para acessar, <a href="{{ route('central.ajuda.relat.faturamento') }}"><strong>clique aqui</strong></a> ou acesse via menu <u>Relatórios > Faturamento</u>.</p>
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
