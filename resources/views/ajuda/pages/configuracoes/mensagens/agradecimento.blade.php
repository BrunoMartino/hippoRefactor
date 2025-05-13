@php
    session(['figura_base' => 109]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagem - Agradecimento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração da mensagem do tipo Agradecimento
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
                                <p>Conforme ilustrado na <x-ajuda.link-figura />, esta é a tela de cadastro da mensagem do
                                    tipo Agradecimento.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/agradecimento/index.png',
                                )"
                                    descricao="Tela de cadastro da mensagem do tipo agradecimento" />

                                <p>Caso tenha iniciado o cadastro das mensagens primeiro que as configurações do(s)
                                    módulo(s), ao iniciar o cadastro da mensagem antes das configurações dos respectivos
                                    módulos, será exibido um aviso solicitando a integração com o WhatsApp no módulo
                                    Remarketing <x-ajuda.link-figura format />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/agradecimento/erro-whatsapp.png',
                                )"
                                    descricao="Tela de cadastro da mensagem do tipo agradecimento com erro whatsapp" />

                                <p>Ao acionar o botão <strong>Configurar Whatsapp</strong>, será aberta a página de
                                    configuração do WhatsApp do módulo Remarketing, conforme detalhado em <u>Configurações >
                                        Sistema > Remarketing</u> (para acesso direto, <a
                                        href="{{ route('central.ajuda.config.sistema.remarketing') }}#whatsapp"><strong>clique
                                            aqui</strong></a>).</p>

                                <p>Com o WhatsApp devidamente configurado, ou caso já esteja configurado anteriormente, as
                                    informações para cadastro e configuração da mensagem do tipo Agradecimento estão
                                    descritas a seguir.</p>

                                <p>Os campos <em>"Nome da mensagem"</em> e <em>"Descrição"</em> devem ser preenchidos.</p>

                                <p>Na campo <u>Descrição</u>, é possível utilizar variáveis no formato
                                    <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> que podem ser arrastadas para o
                                    campo da mensagem.
                                </p>

                                <p>Essas variáveis são substituídas automaticamente pelos dados correspondentes no
                                    momento do envio da notificação. Para que a substituição ocorra corretamente, é
                                    necessário que os nomes estejam exatamente iguais aos apresentados.</p>

                                <p>Podem ser utilizados emojis no corpo da mensagem, compatíveis com o WhatsApp.</p>

                                <p>Ao clicar em <strong>Salvar</strong>, será exibida a tela de configuração de envio da
                                    mensagem <x-ajuda.link-figura format />.</p>
                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/agradecimento/configuracao.png',
                                )"
                                    descricao="Tela de configurações da mensagem do tipo agradecimento" />

                                <p>Segue detalhamento das opções disponíveis:</p>
                                <ul style="list-style-type: disc; padding-left: 20px; margin-left: 20px;">
                                    <li>
                                        <p><u>Enviar mensagem sobre não receber mais notificações</u>: permite que o
                                            destinatário informe que não deseja mais receber notificações.</p>
                                        <p>Ao marcar essa opção, uma janela para personalização será aberta
                                            <x-ajuda.link-figura format />.
                                        </p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/sair.png',
                                        )"
                                            descricao="Janela para personalizar a mensagem de sair" />
                                        <p>É possível incluir uma mensagem personalizada. No entanto, a frase <em>"Para se
                                                retirar da lista de notificações envie SAIR"</em> será automaticamente
                                            incluída ao final da mensagem.</p>
                                        <p>Caso nenhuma mensagem personalizada seja inserida, basta clicar em
                                            <strong>Salvar</strong> para ativar apenas a mensagem padrão.
                                        </p>
                                    </li>
                                    <li>
                                        <p><u>Enviar mensagem para pesquisa de satisfação</u>: ativa o envio de uma pesquisa
                                            relacionada ao agradecimento.</p>
                                        <p>Ao marcar essa opção, será aberta uma janela para selecionar uma mensagem de
                                            pesquisa de satisfação existente <x-ajuda.link-figura format />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/anexo-pesquisa.png',
                                        )"
                                            descricao="Janela para selecionar a mensagem de pesquisa de satisfação anexo" />
                                        <p>Se não houver mensagens cadastradas, pode-se utilizar o botão <strong>Criar nova
                                                pesquisa de satisfação</strong> para iniciar o cadastro (<a
                                                href="#figura113"><strong>figura 113</strong></a>) que abrirá a tela de
                                            cadastro <x-ajuda.link-figura format />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/pesquisa-satisfacao-anexo.png',
                                        )"
                                            descricao="Tela de cadastro da mensagem de pesquisa de satisfação anexo" />
                                        <p>O campo <u>Tipo</u> estará preenchido como "Pesquisa Satisfação Anexo". Mensagens
                                            com esse tipo estarão disponíveis exclusivamente para uso como anexo.</p>
                                        <p>Mais informações sobre esse cadastro estão acessíveis no menu <u>Configurações
                                                > Mensagens > Pesquisa Satisfação</u> ou <a
                                                href="{{ route('central.ajuda.config.mensagens.pesquisa.satisfacao') }}"><strong>clicando
                                                    aqui</strong></a>.</p>
                                        <p>Ao finalizar o cadastro, voltará para a janela onde poderá selecionar a mensagem
                                            agora criada <x-ajuda.link-figura format />.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/selecao-anexo-pesquisa.png',
                                        )"
                                            descricao="Janela para selecionar a mensagem de pesquisa de satisfação anexo" />

                                        <p>Ao selecionar a mensagem ela ficará fixa no campo Selecione uma opção, bastando
                                            clicar em <strong>Salvar</strong> para configurar a mensagem que será enviada
                                            como pesquisa de satisfação após o envio da mensagem de agradecimento.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar notificações somente para clientes com NF-e emitida</u> - ao
                                            selecionar, enviará somente para clientes que possuem nota fiscal emitida, ou
                                            seja, pedidos que foram enviados sem nota fiscal não serão utilizados para o
                                            envio das notificações.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar PJ</u>: ativa o envio de mensagens para empresas (CNPJ).</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar PF</u>: ativa o envio de mensagens para pessoas físicas (CPF).</p>
                                    </li>
                                    <p><em>É necessário a seleção de algum tipo de envio (PJ ou PF), podendo ser os
                                            dois.</em></p>
                                    <li>
                                        <p><u>Usar dados da integração</u>: utiliza dados provenientes da integração com o
                                            Bling.</p>
                                    </li>
                                    <li>
                                        <p><u>Usar dados importados</u>: utiliza dados previamente importados para compor as
                                            mensagens.</p>
                                        <p>Uma janela será aberta com os grupos de dados existentes no módulo Remarketing
                                            <x-ajuda.link-figura format />.
                                        </p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/dados-importados.png',
                                        )"
                                            descricao="Janela de configurar os dados importados para notificações" />
                                        <p>Poderá selecionar o(s) grupo(s) que deseja e salvar.</p>
                                        <p>Caso não tenha nenhum grupo de dados importados abrirá a janela com a mensagem de
                                            que
                                            precisa importar dados e o botão <strong>Importar Dados</strong>
                                            <x-ajuda.link-figura format />.
                                        </p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/importar-novo.png',
                                        )"
                                            descricao="Janela de configurar novos dados importados para notificações" />

                                        <p>Ao clicar no botão <strong>Importar Dados</strong> abrirá a tela para fazer a
                                            importação
                                            da planilha Excel ou csv no módulo Rastreamento <x-ajuda.link-figura format />.
                                        </p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/importar-dados.png',
                                        )"
                                            descricao="Tela para importar arquivos de dados" />

                                        <p>As explicações sobre a tela para importar os arquivos de dados serão dadas no
                                            menu
                                            <u>Configurações > Dados importados > Remarketing</u>, se preferir ir direto
                                            basta <a
                                                href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"><strong>clicar
                                                    aqui</strong></a> e ser direcionado.
                                        </p>
                                    </li>
                                    <li>
                                        <p><u>Enviar somente para novas vendas</u> - envia somente para pedidos que foram
                                            emitidos após o cadastro dessa mensagem.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar para vendas a partir de: xx/xx/xxxx</u> - enviar somente para pedidos
                                            que foram emitidos a partir da data selecionada, é possível selecionar datas de
                                            até 60 dias retroativos.</p>
                                    </li>
                                    <li>
                                        <p><u>Data específica</u> - envia a notificações com essa mensagem "somente" na data
                                            em que foi escolhida.</p>
                                    </li>
                                    <li>
                                        <p><u>Enviar imagem junto com a mensagem</u> - envia uma imagem antes da mensagem,
                                            ao selecionar, abrirá a janela para escolher a imagem <x-ajuda.link-figura
                                                format />. </p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/agradecimento/imagem.png',
                                        )" descricao="Janela para selecionar a imagem" />

                                    </li>
                                    <li>
                                        <p><u>Enviar mensagem após X dia(s) da entrega do pedido</u> - a mensagem só será
                                            enviada após a quantidade de dias (informados no campo) da confirmação de
                                            entrega pelos Correios.</p>
                                        <p><em>
                                                Essa opção só é válida para encomendas enviadas pelos Correios, pois faremos
                                                o
                                                rastreio.
                                            </em></p>
                                    </li>
                                    <li>
                                        <p><u>Enviar mensagem de agradecimento após X dia(s)</u> - enviar a mensagem somente
                                            após a quantidade de dias (informados no campo) de que o pedido foi finalizado.
                                        </p>
                                        <p><em>Essa opção é válida para encomendas enviadas por qualquer meio, exceto
                                                Correios.</em>
                                        </p>
                                    </li>
                                </ul>
                                <p>Após a seleção das opções desejadas, deve-se clicar em <strong>Salvar</strong> para
                                    concluir o cadastro e a configuração da mensagem.</p>

                                <p>Em seguida, será exibida a tela de relatório das mensagens <x-ajuda.link-figura
                                        format />.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/agradecimento/relatorio.png',
                                )" descricao="Tela de relatório das mensagens" />

                                <p>Detalhamentos sobre o relatório e os ícones de cada linha serão apresentados em outra
                                    seção.</p>
                                <p>Para acessar diretamente, <a
                                        href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Configurações > Mensagens >
                                        Relatório</u>.</p>
                                <hr class="linha-dupla">

                                <p>As instruções referentes ao cadastro e à configuração da mensagem do tipo Agradecimento
                                    encerram-se neste ponto. A próxima etapa aborda o cadastro e as configurações da
                                    mensagem do tipo Aniversário.</p>

                                <p>Para acessar este conteúdo, <a
                                        href="{{ route('central.ajuda.config.mensagens.aniversario') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Configurações > Mensagens >
                                        Aniversário</u>.</p>
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
