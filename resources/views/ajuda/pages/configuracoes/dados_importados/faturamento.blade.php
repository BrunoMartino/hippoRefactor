@php
    session(['figura_base' => 176]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Dados Importados - Faturamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Explicações sobre a importação de dados para o módulo Faturamento</h2>
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
    <p><u><em>Todos os dados utilizados nesta seção são fictícios e têm finalidade exclusivamente ilustrativa.</em></u></p>

    <p>Ao acessar a configuração de dados importados do módulo Faturamento, será exibida a página apresentada na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/index.png')" descricao="Relatório dos grupos de dados importados do módulo Faturamento" />

    <p>Trata-se do relatório dos grupos de dados importados (identificação para o conjunto de dados) referente ao módulo Faturamento.</p>

    <p>Abaixo do relatório, há um sistema de paginação que exibe 10 (dez) registros por página. Para visualizar os demais, utilize os botões localizados no canto inferior direito da tela.</p>

    <hr>

    <p>Na parte superior da tela encontra-se o botão <strong>Filtrar</strong> (botão laranja). Ao acioná-lo, será aberta uma janela de filtros conforme ilustrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/filtro.png')" descricao="Janela de filtros para o relatório" />

    <p>Após selecionar os filtros desejados, clique em <strong>Filtrar</strong> para atualizar os dados.</p>
        <p>Para retornar ao estado original do relatório, clique novamente em <strong>Filtrar</strong> e selecione <strong>Limpar filtro</strong>. Ao fechar a janela, todos os dados existentes serão exibidos.</p>

    <hr>

    <p>Também na parte superior está o botão <strong>Importar Dados</strong> (botão azul). Ao clicar, será aberta a página de importação, conforme mostra a <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/importar-dados.png')" descricao="Tela para seleção e envio de arquivos de dados" />

    <p>Nesta página, selecione o arquivo que será importado. Acima do campo de escolha, estão disponíveis dois modelos: um no formato <strong>xlsx</strong> (compatível com Excel) e outro no formato <strong>csv</strong> (compatível com planilhas ou texto).</p>

    <p>Esses modelos servem como referência para estruturação dos dados, permitindo que arquivos exportados de outros sistemas sejam ajustados aos campos esperados. Também é possível utilizar diretamente os modelos disponibilizados.</p>

    <p>Para garantir o envio correto das notificações, é fundamental dedicar atenção especial ao campo <u>Situação</u>(situação em que o pedido se encontra), que deve conter exatamente uma das situações listadas abaixo:</p>

    <ul class="lista-personalizada">
        <li>Em aberto</li>
        <li>Em andamento</li>
        <li>Atendido</li>
        <li>Em separação</li>
        <li>Verificado</li>
    </ul>

    <p>O sistema utiliza o conteúdo deste campo para determinar o tipo de notificação a ser enviada.</p>
    <p><em>Na <a href="#figura178">figura178</a> detalha melhor as situações.</em></p>

    <p>Com o arquivo ajustado, clique em <strong>Escolher arquivo</strong>, selecione o documento no seu dispositivo e confirme em <strong>Abrir</strong>.</p>

    <p>Após o envio, a tela será atualizada conforme ilustrado na <x-ajuda.link-figura />. Verifique se o nome do arquivo aparece corretamente no campo ao lado do botão.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/arquivo-selecionado.png')" descricao="Tela de importação com arquivo selecionado" />

    <p>Em seguida, preencha o campo <u>Nome do grupo</u> para identificar o conjunto de dados importado.</p>

    <p>Com o arquivo e o nome do grupo definidos, clique em <strong>Importar</strong> para concluir a operação. O sistema retornará ao relatório de grupos (<x-ajuda.link-figura />).</p>

    <hr>

    <p>Cada linha do relatório apresenta dois ícones de ação:</p>
    <ul class="lista-personalizada">
        <li>Ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) – visualizar os dados do grupo</li>
        <li>Ícone laranja (<i class="ti ti-trash fs-7 text-danger"></i>) – excluir o grupo</li>
    </ul>

    <p>Para visualizar os dados, clique no ícone <i class="ti ti-eye fs-7 text-secondary"></i> na linha correspondente ao grupo desejado. Será aberta a página com os registros importados (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/view-grupo.png')" descricao="Relatório dos registros do grupo de dados importado" />

    <p>Assim como no relatório de grupos, há paginação com 10 (dez) itens por página. Cada linha apresenta um ícone para exclusão de registro (<i class="ti ti-trash fs-7 text-danger"></i>).</p>

    <p>Ao clicar no ícone de exclusão, será exibida uma mensagem de confirmação conforme mostrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/deletar-item-grupo.png')" descricao="Confirmação de exclusão de registro" />

    <p>Para confirmar, clique em <strong>Sim</strong>. Para cancelar, clique em <strong>Cancelar</strong>. Em ambos os casos, a tela será atualizada mantendo os dados do grupo correspondente.</p>

    <p>Para retornar ao relatório de grupos, utilize o botão <strong>Voltar</strong> localizado ao final da página.</p>

    <hr>

    <p>No relatório principal (<a href="#figura178">figura 178</a>), o ícone <i class="ti ti-trash fs-7 text-danger"></i> permite excluir um grupo completo de dados.</p>

    <p>Ao clicar, será exibida uma mensagem de confirmação conforme ilustrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/faturamento/deletar-grupo.png')" descricao="Confirmação de exclusão do grupo de dados" />

    <p>Para excluir o grupo, clique em <strong>Sim</strong>. Para cancelar, clique em <strong>Cancelar</strong>. Nenhuma alteração será feita caso a ação seja cancelada.</p>

    <hr class="linha-dupla">

    <p>As instruções sobre as configurações de Dados Importados para o módulo Faturamento encerram-se aqui. O próximo tópico aborda as configurações de Dados Importados para o módulo Rastreamento.</p>

    <p>Para acessar esse conteúdo, <a href="{{ route('central.ajuda.config.dados.importados.rastreamento') }}"><strong>clique aqui</strong></a> ou acesse o menu <u>Configurações > Dados Importados > Rastreamento</u>.</p>
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
