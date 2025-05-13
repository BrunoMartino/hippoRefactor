@php
    session(['figura_base' => 183]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Dados Importados - Rastreamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a importação de dados para o módulo Rastreamento
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
                                <p><u><em>Todos os dados utilizados nesta seção são fictícios e têm finalidade
                                            exclusivamente ilustrativa.</em></u></p>

                                <p>Ao acessar a configuração de dados importados do módulo Rastreamento, será exibida a
                                    página apresentada na <x-ajuda.link-figura />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/index.png',
                                )"
                                    descricao="Relatório dos grupos de dados importados do módulo Rastreamento" />

                                <p>Trata-se do relatório dos grupos de dados importados (identificação para o conjunto de
                                    dados) referente ao módulo Rastreamento.</p>
                                <p>O relatório apresenta 10 (dez) resultados por página, com navegação disponível no canto
                                    inferior direito da tela.</p>

                                <hr>

                                <p>Na parte superior da tela encontra-se o botão <strong>Filtrar</strong> (botão laranja).
                                    Ao acioná-lo, será aberta a janela de filtros conforme mostra a <x-ajuda.link-figura />.
                                </p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/filtro.png',
                                )" descricao="Janela de filtros para o relatório" />

                                <p>Após selecionar os filtros desejados, clique em <strong>Filtrar</strong> para atualizar o
                                    conteúdo. </p>
                                <p>Para remover os filtros aplicados, clique novamente em <strong>Filtrar</strong> e
                                    selecione <strong>Limpar filtro</strong>. Ao fechar a janela, o relatório exibirá todos
                                    os dados disponíveis.</p>

                                <hr>

                                <p>Também acima do relatório está o botão <strong>Importar Dados</strong> (botão azul). Ao
                                    clicar, será aberta a janela de importação conforme a <x-ajuda.link-figura />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/importar-dados.png',
                                )" descricao="Tela de importação de dados" />

                                <p>Nessa etapa, deve-se selecionar o arquivo a ser importado. Estão disponíveis dois modelos
                                    de referência: um em <strong>xlsx</strong> (Excel) e outro em <strong>csv</strong>
                                    (texto).</p>

                                <p>Esses arquivos servem como padrão para estruturar os dados, permitindo a adequação de
                                    arquivos exportados por outros sistemas. Também é possível utilizar diretamente os
                                    modelos fornecidos, bastando preenchê-los conforme a necessidade.</p>

                                <p>Para que o rastreamento funcione corretamente, é necessário preencher o campo
                                    <u>Transportadora</u> com o nome exato de uma transportadora integrada ao sistema. A
                                    lista de transportadoras disponíveis está acessível em <a
                                        href="{{ route('central.ajuda.config.sistema.rastreamento') }}"><strong>clique
                                            aqui</strong></a> ou no menu <u>Configurações > Sistema > Rastreamento</u>, na
                                    aba <u>Opções de envio</u>.</p>

                                <p>O sistema permite o envio de códigos de rastreio para qualquer transportadora informada,
                                    mas o acompanhamento completo só estará disponível para aquelas com integração ativa.
                                </p>

                                <p>Com o arquivo pronto, clique em <strong>Escolher arquivo</strong>, selecione o documento
                                    no computador e confirme em <strong>Abrir</strong>.</p>

                                <p>A tela será atualizada com a seleção do arquivo, conforme ilustrado na
                                    <x-ajuda.link-figura />. Verifique se o nome do arquivo aparece corretamente no campo ao lado do botão.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/arquivo-selecionado.png',
                                )" descricao="Tela de importação com arquivo selecionado" />

                                <p> Em seguida, preencha o campo <u>Nome do grupo</u> para nomear o conjunto de dados que
                                    será importado.</p>

                                <p>Após essas etapas, clique em <strong>Importar</strong> para concluir a operação. O
                                    sistema retornará à tela do relatório de grupos (<x-ajuda.link-figura />).</p>

                                <hr>

                                <p>Cada linha do relatório apresenta dois ícones de ação:</p>
                                <ul>
                                    <li>Ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) – visualizar os
                                        dados do grupo</li>
                                    <li>Ícone laranja (<i class="ti ti-trash fs-7 text-danger"></i>) – excluir o grupo</li>
                                </ul>

                                <p>Para visualizar os dados de um grupo, clique no ícone <i
                                        class="ti ti-eye fs-7 text-secondary"></i> na linha correspondente. Será aberta uma
                                    página com os registros importados (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/view-grupo.png',
                                )" descricao="Relatório dos registros importados do grupo" />

                                <p>Assim como no relatório principal, o sistema apresenta 10 (dez) registros por página.
                                    Para visualizar os demais, utilize os botões localizados no canto inferior direito da
                                    tela.</p>
                                <p> Cada linha do relatório de dados contém um ícone de exclusão (<i class="ti ti-trash fs-7 text-danger"></i>).</p>

                                <p>Ao clicar nesse ícone, será exibida uma mensagem de confirmação, conforme a
                                    <x-ajuda.link-figura />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/deletar-item-grupo.png',
                                )" descricao="Confirmação de exclusão de item do grupo" />

                                <p>Para confirmar, clique em <strong>Sim</strong>. Para cancelar a operação, clique em
                                    <strong>Cancelar</strong>. Em ambos os casos, o sistema atualizará a tela
                                    automaticamente.</p>

                                <p>Para retornar à tela de grupos, utilize o botão <strong>Voltar</strong> localizado abaixo
                                    do relatório de registros.</p>

                                <hr>

                                <p>O ícone <i class="ti ti-trash fs-7 text-danger"></i> no relatório principal permite a
                                    exclusão completa de um grupo.</p>

                                <p>Ao acioná-lo, será exibida a mensagem de confirmação conforme mostra a
                                    <x-ajuda.link-figura />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/dados-importados/rastreamento/deletar-grupo.png',
                                )" descricao="Confirmação de exclusão do grupo de dados" />

                                <p>Para concluir a exclusão, clique em <strong>Sim</strong>. Caso deseje cancelar, clique em
                                    <strong>Cancelar</strong> e o grupo permanecerá inalterado.</p>

                                <hr class="linha-dupla">

                                <p>As instruções sobre as configurações de Dados Importados para o módulo Rastreamento
                                    encerram-se aqui. A próxima seção aborda as configurações de Dados Importados para o
                                    módulo Remarketing.</p>

                                <p>Para acessar esse conteúdo, <a
                                        href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Configurações > Dados Importados >
                                        Remarketing</u>.</p>
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
