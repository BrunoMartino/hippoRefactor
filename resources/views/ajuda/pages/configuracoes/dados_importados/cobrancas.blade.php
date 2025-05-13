@php
    session(['figura_base' => 169]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Dados Importados - Cobranças')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a importação de dados para o módulo Cobranças
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
    <p><u><em>Todos os dados utilizados nesta seção são fictícios e servem apenas para fins ilustrativos.</em></u></p>

    <p>Ao acessar a configuração de Dados Importados do módulo Cobranças, será exibida a página apresentada na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/index.png')" descricao="Página de relatório dos grupos de dados importados" />

    <p>Trata-se do relatório dos grupos de dados importados (identificação para o conjunto de dados) referentes ao módulo Cobranças.</p>

    <p><em>Abaixo do relatório, há um sistema de paginação com exibição de 10 (dez) registros por página. Para visualizar os demais, utilize os botões localizados no canto inferior direito da tela.</em></p>

    <hr>

    <p>Na parte superior do relatório, está disponível o botão <strong>Filtrar</strong> (botão laranja). Ao acioná-lo, será aberta a janela de filtros conforme mostrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/filtro.png')" descricao="Janela de filtros para o relatório" />

    <p>Após aplicar os filtros desejados, clique em <strong>Filtrar</strong> para atualizar os dados exibidos.</p>
        <p>Para remover os filtros aplicados, clique novamente em <strong>Filtrar</strong> e selecione <strong>Limpar filtro</strong>. Ao fechar a janela, o relatório será exibido com todos os registros disponíveis.</p>

    <hr>

    <p>Também na parte superior do relatório, encontra-se o botão <strong>Importar Dados</strong> (botão azul), responsável pela inclusão de novos grupos e dados.</p>

    <p>Ao clicar nesse botão, será aberta a página apresentada na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/importar-dados.png')" descricao="Tela de importação de dados" />

    <p>Nesta página, deve-se selecionar o arquivo a ser importado. Acima do campo de seleção, estão disponíveis dois modelos de arquivos: um no formato <strong>xlsx</strong> (Excel) e outro no formato <strong>csv</strong> (texto), ambos prontos para adaptação.</p>

    <p><em>Esses arquivos servem como referência para estruturação dos dados, já que diferentes sistemas exportam informações em formatos variados. É possível adaptar seus próprios arquivos ao modelo disponibilizado ou utilizar diretamente os exemplos fornecidos.</em></p>

    <p>Após preparar o arquivo, clique em <strong>Escolher arquivo</strong>. Será aberta a janela do sistema operacional para seleção do documento. Após escolher o arquivo, clique em <strong>Abrir</strong>.</p>

    <p>Com o arquivo selecionado, a página de importação será atualizada conforme a <x-ajuda.link-figura />. Verifique se o nome do arquivo aparece corretamente no campo ao lado do botão.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/arquivo-selecionado.png')" descricao="Tela de importação com arquivo selecionado" />

    <p>Em seguida, preencha o campo <u>Nome do grupo</u>, definindo uma identificação para o conjunto de dados que será importado.</p>

    <p>Com o arquivo e o nome do grupo informados, clique em <strong>Importar</strong>. O sistema processará os dados e retornará para a página do relatório de grupos (<a href="#figura169">figura169</a> ).</p>

    <hr>

    <p>Cada linha do relatório de grupos apresenta ícones de ação específicos:</p>
    <ul class="lista-personalizada">
        <li>Ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) – visualizar os dados do grupo</li>
        <li>Ícone laranja (<i class="ti ti-trash fs-7 text-danger"></i>) – excluir o grupo</li>
    </ul>

    <p>Para visualizar os dados de um grupo, clique no ícone <i class="ti ti-eye fs-7 text-secondary"></i> da linha correspondente. Será exibido um relatório com os registros importados para o grupo selecionado (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/view-grupo.png')" descricao="Relatório dos dados do grupo importado" />

    <p>Assim como no relatório de grupos, há paginação para visualização dos registros. Cada linha do relatório de dados contém um ícone de exclusão (<i class="ti ti-trash fs-7 text-danger"></i>).</p>

    <p>Ao clicar nesse ícone, será exibida uma mensagem de confirmação conforme apresentado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/deletar-item-grupo.png')" descricao="Confirmação para exclusão de item do grupo" />

    <p>Para confirmar a exclusão, clique em <strong>Sim</strong>. Caso deseje cancelar a ação, clique em <strong>Cancelar</strong>.</p>

    <p>Para retornar ao relatório de grupos, utilize o botão <strong>Voltar</strong> localizado abaixo do relatório de itens.</p>

    <hr>

    <p>Retornando aos ícones do relatório de grupos (<x-ajuda.link-figura />), o ícone <i class="ti ti-trash fs-7 text-danger"></i> permite excluir o grupo com todos os registros correspondentes.</p>

    <p>Ao clicar, será exibida uma mensagem de confirmação conforme a <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/deletar-grupo.png')" descricao="Confirmação para exclusão do grupo" />

    <p>Confirme a exclusão clicando em <strong>Sim</strong>. Para cancelar, clique em <strong>Cancelar</strong> e nenhuma alteração será feita.</p>

    <hr class="linha-dupla">

    <p>As instruções sobre as configurações de Dados Importados para o módulo Cobranças encerram-se aqui. O próximo tópico aborda as configurações de Dados Importados para  o módulo Faturamento.</p>

    <p>Para acessar esse conteúdo, <a href="{{ route('central.ajuda.config.dados.importados.faturamento') }}"><strong>clique aqui</strong></a> ou utilize o menu <u>Configurações > Dados Importados > Faturamento</u>.</p>
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
