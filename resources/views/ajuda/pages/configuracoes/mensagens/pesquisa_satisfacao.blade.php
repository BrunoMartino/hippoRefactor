@php
    session(['figura_base' => 130]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagem - Pesquisa Satisfação')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração da mensagem do tipo Pesquisa Satisfação
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
                                <p>A <x-ajuda.link-figura /> apresenta a página de cadastro de mensagens do tipo Pesquisa de
                                    Satisfação.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/index.png',
                                )"
                                    descricao="Página de cadastro da mensagem de pesquisa de satisfação" />

                                <p>Quando o cadastro das mensagens é realizado antes da configuração do respectivo módulo,
                                    ao tentar concluir o processo será exibido um aviso indicando a necessidade de integrar
                                    o WhatsApp ao módulo Remarketing (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/erro-whatsapp.png',
                                )"
                                    descricao="Página de cadastro da mensagem de pesquisa de satisfação com erro relacionado à integração com o WhatsApp" />


                                <p>Ao acionar o botão <strong>Configurar WhatsApp</strong>, será direcionado para a página
                                    de configuração do WhatsApp no módulo Remarketing, conforme detalhado em
                                    <u>Configurações > Sistema > Remarketing</u>. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.sistema.remarketing') }}#whatsapp"><strong>clique
                                            aqui</strong></a>.</p>

                                <p>Após a configuração — ou caso esta já tenha sido realizada previamente — as instruções
                                    para o cadastro e a configuração da mensagem do tipo Pesquisa de Satisfação estão
                                    apresentadas a seguir.</p>

                                <p>Um modelo pré-preenchido foi disponibilizado para facilitar a compreensão e o cadastro da
                                    mensagem.</p>

                                <p>É necessário preencher o campo "Nome da mensagem", bem como os demais campos
                                    correspondentes às perguntas.</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p><u>Na pergunta inicial</u>, conforme destacado acima do campo correspondente, os textos
                                            entre <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> podem ser arrastados
                                            e soltos diretamente no campo da mensagem.
                                            Esses elementos serão preenchidos automaticamente com base nas informações
                                            utilizadas para o envio das notificações.
                                            Caso sejam inseridos manualmente, é fundamental que estejam exatamente iguais ao
                                            padrão estabelecido, a fim de assegurar a correta substituição dos dados.</p>

                                        <p>Também é permitido utilizar emojis comuns do WhatsApp no conteúdo da mensagem.
                                        </p>

                                        <p>As opções apresentadas na pergunta inicial são fixas e não podem ser editadas.
                                        </p>
                                    </li>


                                    <li>
                                        <p>O campo intitulado <u>CASO NÃO</u> deve conter a mensagem exibida quando a pessoa
                                            selecionar a opção <u>1 - Não, obrigado</u>.</p>
                                        <p>Ao selecionar a opção <u>2 - Claro</u>, o fluxo prossegue para a próxima etapa.
                                        </p>
                                    </li>

                                    <li>
                                        <p><u>Pergunta 1</u> – permite a personalização tanto da pergunta quanto dos textos
                                            das opções de 1 a 5.</p>
                                    </li>

                                    <li>
                                        <p><u>Pergunta 2</u> – também permite a personalização da pergunta e dos textos das
                                            opções de 1 a 5.</p>
                                    </li>

                                    <li>
                                        <p><u>Pergunta 3</u> – possibilita a personalização da pergunta; entretanto, as
                                            opções são fixas.</p>
                                    </li>

                                    <li>
                                        <p><u>Agradecimento</u> – neste campo, configura-se a mensagem de agradecimento
                                            pelas respostas fornecidas até o momento.</p>
                                    </li>

                                    <li>
                                        <p><u>Pergunta 4</u> – é enviada após a mensagem de agradecimento. Nesta etapa, é
                                            possível solicitar sugestões ou feedback por escrito, conforme o exemplo
                                            apresentado.</p>
                                        <p>O campo <u>CASO RESPOSTA DA PERGUNTA 4</u> deve conter uma mensagem de
                                            agradecimento personalizada, direcionada àqueles que responderem essa etapa.</p>
                                    </li>
                                </ul>

                                <p>Após o preenchimento de todos os campos, selecione o botão <strong>Salvar</strong> para
                                    ser direcionado à página de configurações de envio da mensagem
                                    (<x-ajuda.link-figura />).</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/configuracao.png',
                                )"
                                    descricao="Página de configurações de envio da mensagem de pesquisa de satisfação" />

                                <p>A seguir, são detalhadas as opções disponíveis:</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p><u>Enviar mensagem sobre não receber mais notificações</u> – permite o envio de
                                            uma mensagem para que o cliente informe que não deseja mais receber
                                            notificações.</p>

                                        <p>Ao habilitar esta opção, será exibida uma janela para personalização da mensagem
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/sair.png',
                                        )"
                                            descricao="Janela para personalização da mensagem de saída da lista de notificações" />

                                        <p>Na área indicada, é possível inserir uma mensagem personalizada. No entanto, a
                                            frase <em>"Para se retirar da lista de notificações envie SAIR"</em> será
                                            adicionada automaticamente ao final de todas as mensagens em que esta
                                            funcionalidade estiver ativa.</p>

                                        <p>Se não for necessário adicionar uma mensagem personalizada, basta clicar em
                                            <strong>Salvar</strong> para que a mensagem padrão seja aplicada.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar notificações somente para clientes com NF-e emitida</u> – ao ativar
                                            esta opção, as mensagens serão enviadas exclusivamente para clientes que possuam
                                            nota fiscal eletrônica emitida. <br> Pedidos sem emissão de nota fiscal serão
                                            desconsiderados para o envio.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar PJ</u> – permite o envio da pesquisa de satisfação para empresas
                                            (pessoas jurídicas).</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar PF</u> – permite o envio da pesquisa de satisfação para pessoas físicas
                                            com CPF válido cadastrado.</p>
                                    </li>
                                    <p>É necessário selecionar pelo menos uma das opções de envio (PJ ou PF), sendo possível
                                        habilitar ambas simultaneamente.</p>

                                    <li>
                                        <p><u>Usar dados importados</u> – permite configurar o uso de dados importados para
                                            a geração das notificações.</p>

                                        <p>Ao selecionar essa opção, será exibida uma janela contendo todos os grupos de
                                            dados importados disponíveis no módulo Remarketing (<x-ajuda.link-figura />).
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/dados-importados.png',
                                        )"
                                            descricao="Janela para seleção de grupo(s) de dados importados" />

                                        <p>É possível selecionar um ou mais grupos desejados e, em seguida, salvar a
                                            configuração.</p>

                                        <p>Na ausência de grupos importados, será exibida uma janela informando a
                                            necessidade de importação de dados, juntamente com o botão <strong>Importar
                                                Dados</strong> (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/importar-novo.png',
                                        )"
                                            descricao="Janela com solicitação para importar dados" />

                                        <p>Ao clicar no botão <strong>Importar Dados</strong>, será aberta a página para
                                            realizar a importação de planilha Excel ou arquivo CSV no módulo Remarketing
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/importar-dados.png',
                                        )"
                                            descricao="Página para cadastro de grupos e importação de dados" />

                                        <p>As instruções detalhadas sobre essa funcionalidade estão disponíveis no menu
                                            <u>Configurações > Dados importados > Remarketing</u>. Para acesso direto, <a
                                                href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"><strong>clique
                                                    aqui</strong></a>.</p>

                                        <p>Como mensagens do tipo Pesquisa de Satisfação enviam notificações exclusivamente
                                            para dados importados, a opção <strong>Usar dados importados</strong> já vem
                                            previamente selecionada. Basta clicar para configurar o grupo de dados desejado.
                                        </p>
                                    </li>

                                    <li>
                                        <p><u>Enviar somente para novas vendas</u> – permite o envio de notificações apenas
                                            para pedidos emitidos após o cadastro desta mensagem.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar para vendas a partir de: xx/xx/xxxx</u> – envia notificações somente
                                            para pedidos emitidos a partir da data selecionada. <br> É possível escolher
                                            datas retroativas em até 60 dias.</p>
                                    </li>
                                    <li>
                                        <p><u>Data específica</u> – restringe o envio das notificações com essa mensagem
                                            exclusivamente para a data selecionada.</p>
                                    </li>
                                </ul>
                                <p>Após a seleção das opções desejadas, clique em <strong>Salvar</strong> para concluir o
                                    cadastro e a configuração da mensagem.</p>

                                <p>Em seguida, será exibida a página de relatório de mensagens (<x-ajuda.link-figura />).
                                </p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/pesquisa-satisfacao/relatorio.png',
                                )" descricao="Página de relatório de mensagens" />

                                <p>As informações sobre o relatório e os ícones apresentados em cada linha serão detalhadas
                                    em uma seção específica. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique
                                            aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens > Relatório</u>.
                                </p>

                                <p>Com isso, encerram-se as instruções sobre o cadastro e configuração da mensagem do tipo
                                    Pesquisa de Satisfação. <br>O próximo tópico aborda as mensagens do tipo Cobranças.</p>

                                <p>Para visualizar esse conteúdo, <a
                                        href="{{ route('central.ajuda.config.mensagens.cobrancas') }}"><strong>clique
                                            aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens > Cobranças</u>.
                                </p>

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
