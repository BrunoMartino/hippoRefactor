@php
    session(['figura_base' => 190]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Dados Importados - Remarketinig')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Explicações sobre a importação de dados para o módulo Remarketing</h4>
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

    <p>Ao acessar a configuração de dados importados do módulo Remarketing, será exibida a página apresentada na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/index.png')" descricao="Relatório dos grupos de dados importados do módulo Remarketing" />

    <p>Trata-se do relatório dos grupos de dados importados (identificação para o conjunto de dados) referente ao módulo Remarketing.</p>
    <p>O relatório apresenta 10 (dez) resultados por página, com navegação disponível no canto inferior direito da tela.</p>

    <hr>

    <p>Na parte superior da tela encontra-se o botão <strong>Filtrar</strong> (botão laranja). Ao acioná-lo, será exibida uma janela de filtros conforme mostra a <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/filtro.png')" descricao="Janela de filtros para o relatório" />

    <p>Após aplicar os filtros desejados, clique em <strong>Filtrar</strong> para atualizar os dados do relatório. </p>
        <p>Para exibir todos os registros novamente, clique em <strong>Filtrar</strong> e selecione <strong>Limpar filtro</strong>. Ao fechar a janela, o relatório retornará ao estado original.</p>

    <hr>

    <p>Também na parte superior está o botão <strong>Importar Dados</strong> (botão azul). Ao clicar, será aberta a janela para envio de novos arquivos, conforme ilustrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/importar-dados.png')" descricao="Tela para seleção de arquivo de dados a ser importado" />

    <p>Nessa etapa, selecione o arquivo que será importado. Estão disponíveis dois modelos de referência: um em <strong>xlsx</strong> (Excel) e outro em <strong>csv</strong> (texto ou planilha).</p>

    <p>Esses modelos auxiliam na estruturação dos dados e permitem adaptar arquivos exportados de outros sistemas. Também é possível utilizar diretamente os modelos disponibilizados.</p>

    <p>Com o arquivo pronto, clique em <strong>Escolher arquivo</strong>, localize-o no computador e clique em <strong>Abrir</strong>.</p>

    <p>Após a seleção, a tela será atualizada conforme apresentado na <x-ajuda.link-figura />. Verifique se o nome do arquivo aparece corretamente no campo ao lado do botão.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/arquivo-selecionado.png')" descricao="Tela de importação com arquivo selecionado" />

    <p> Em seguida, preencha o campo <u>Nome do grupo</u> para identificar esse conjunto de dados.</p>

    <p>Com o arquivo e o grupo nomeado, clique em <strong>Importar</strong> para concluir a operação. O sistema retornará ao relatório de grupos (<x-ajuda.link-figura />).</p>

    <hr>

    <p>Cada linha do relatório apresenta dois ícones de ação:</p>
    <ul>
        <li>Ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) – visualizar os dados do grupo</li>
        <li>Ícone laranja (<i class="ti ti-trash fs-7 text-danger"></i>) – excluir o grupo</li>
    </ul>

    <p>Para visualizar os dados de um grupo, clique no ícone <i class="ti ti-eye fs-7 text-secondary"></i>. Será exibido o relatório com os registros importados (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/view-grupo.png')" descricao="Relatório dos registros importados do grupo" />

    <p>O sistema exibe 10 (dez) registros por página. Para visualizar os demais, utilize os botões localizados no canto inferior direito da
                                    tela.</p>
        <p>Cada linha do relatório de dados contém um ícone de exclusão (<i class="ti ti-trash fs-7 text-danger"></i>).</p>

    <p>Ao clicar nesse ícone, será exibida uma mensagem de confirmação conforme ilustrado na <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/deletar-item-grupo.png')" descricao="Confirmação de exclusão de item do grupo" />

    <p>Para confirmar a exclusão, clique em <strong>Sim</strong>. Para cancelar a ação, clique em <strong>Cancelar</strong>.</p>

    <p>Para retornar ao relatório de grupos, utilize o botão <strong>Voltar</strong> ao final da página.</p>

    <hr>

    <p>Para excluir um grupo completo, utilize o ícone <i class="ti ti-trash fs-7 text-danger"></i> ao final da linha correspondente.</p>

    <p>Ao clicar, será exibida uma mensagem de confirmação conforme mostra a <x-ajuda.link-figura />.</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/dados-importados/cobrancas/deletar-grupo.png')" descricao="Confirmação de exclusão do grupo de dados" />

    <p>Para concluir a exclusão, clique em <strong>Sim</strong>. Caso deseje cancelar, clique em <strong>Cancelar</strong> e nenhuma alteração será feita.</p>

    <hr class="linha-dupla">

    <p>As instruções sobre as configurações de Dados Importados para o módulo Remarketing encerram-se aqui. A próxima seção aborda a apresentação dos relatórios de envios das mensagens.</p>

    <p>Para acessar esse conteúdo, <a href="{{ route('central.ajuda.relat.apresentacao') }}"><strong>clique aqui</strong></a> ou utilize o menu <u>Relatórios > Apresentação</u>.</p>
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
