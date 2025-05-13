@php
    session(['figura_base' => 83]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Sistema - Rastreamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração do módulo Rastreamento
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
                                <p>A tela inicial de configuração do módulo Rastreamento <x-ajuda.link-figura format />
                                    possui estrutura semelhante à do módulo Faturamento.</p>

                                <p>Na seção <u>Integrações</u>, estão disponíveis os botões <strong>Whatsapp</strong>,
                                    <strong>Bling</strong> e <strong>Correios</strong>.
                                </p>

                                <p>Na seção <u>Configurações do módulo</u>, encontram-se diversas abas, cada uma com suas
                                    respectivas opções de configuração.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/sistema/rastreamento/tipos-envio.png',
                                )"
                                    descricao="Tela inicial da configuração do módulo Rastreamento" />

                                <ul class="lista-personalizada">
                                    <li>
                                        <div class="scroll-offset" id="config-whatsapp">
                                            <p>Ao clicar no botão <strong>Whatsapp</strong>, será exibida a tela de
                                                configuração da conexão com o WhatsApp Business <x-ajuda.link-figura
                                                    format />.</p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/rastreamento/whatsapp.png',
                                            )"
                                                descricao="Tela de conexão do whatsapp business" />

                                            <p>Nessa tela, é apresentado um QR Code que deve ser lido com o aplicativo
                                                WhatsApp Business, permitindo a conexão necessária para envio das
                                                notificações.</p>

                                            <p>Recomenda-se utilizar um número exclusivo do WhatsApp Business, devidamente
                                                aquecido, para minimizar o risco de bloqueios.</p>

                                            <p>Não há recarregamento automático do QR Code. Caso o código expire ou seja
                                                considerado inválido, clique no botão <strong>Atualizar QR Code</strong>
                                                para gerar um novo. O tempo limite para leitura é de 20 segundos.</p>

                                            <p>Se preferir não realizar a conexão no momento, clique em
                                                <strong>Voltar</strong> para retornar à tela inicial de configurações do
                                                módulo Rastreamento.
                                            </p>

                                            <p>Caso a conexão já esteja configurada, ao clicar no botão
                                                <strong>Whatsapp</strong>, será exibido um card indicando <em>Conexão
                                                    Estabelecida</em> e o número conectado <x-ajuda.link-figura format />.
                                            </p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/rastreamento/trocar-whatsapp.png',
                                            )"
                                                descricao="Tela de confirmação do whatsapp conectado" />

                                            <p>Para trocar o número conectado, clique em <strong>Trocar número</strong>.
                                                Será gerada uma nova conexão e exibida novamente a tela com o QR Code para
                                                leitura (<a href="#figura84"><strong>figura 84</strong></a>).</p>

                                            <p>Para retornar às configurações sem alterar o número conectado, clique em
                                                <strong>Voltar</strong>.
                                            </p>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="scroll-offset" id="config-bling">
                                            <p>O botão <strong>Bling</strong> (<a href="#figura83"><strong>figura
                                                        83</strong></a>) está disponível em todos os módulos ativos apenas
                                                durante a primeira configuração. Após essa etapa, o botão permanecerá
                                                acessível somente no módulo onde a integração foi concluída.</p>

                                            <p>Ao clicar no botão <strong>Bling</strong>, será exibida a tela de autorização
                                                para uso dos dados da conta Bling no envio de notificações
                                                (<x-ajuda.link-figura />).</p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/faturamento/bling.png',
                                            )"
                                                descricao="Tela de autorização para uso dos dados do Bling" />

                                            <p><em>Acima da caixa de seleção há um link que direciona exatamente para esta
                                                    seção, com instruções detalhadas sobre o botão Bling e o processo de
                                                    integração.</em></p>

                                            <p>Para concluir a autorização, marque a caixa de seleção e clique em
                                                <strong>Salvar</strong>.
                                            </p>

                                            <p>Em seguida, será exibida a tela de autorização do aplicativo Bling
                                                <x-ajuda.link-figura format />.
                                            </p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/cobrancas/bling-auth.png',
                                            )"
                                                descricao="Tela de autorização do aplicativo Bling" />

                                            <p>A autorização é obrigatória para que os dados da plataforma Bling possam ser
                                                utilizados no envio de notificações.</p>

                                            <p><em>
                                                    Após esse processo, independentemente da autorização ser concedida ou
                                                    não, o
                                                    sistema redirecionará automaticamente para a tela inicial do módulo
                                                    Rastreamento.
                                                </em></p>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="scroll-offset" id="integracao-correios">
                                            <p>O botão <strong>Correios</strong> (<a href="#figura83"><strong>figura
                                                        83</strong></a>) é utilizado para configurar a integração
                                                responsável pelo rastreamento de encomendas enviadas pelos Correios.</p>


                                            <p>Ao clicar no botão <strong>Correios</strong>, será exibida a tela de cadastro
                                                para inserir os dados de acesso à API dos Correios, necessária para o
                                                rastreio de encomendas e posterior envio de notificações de acompanhamento
                                                <x-ajuda.link-figura format />.
                                            </p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/rastreamento/correios.png',
                                            )"
                                                descricao="Tela de cadastro dados para acesso a API Correios" />

                                            <p>Preencha o formulário com os dados solicitados e clique em
                                                <strong>Salvar</strong> para concluir a configuração.
                                            </p>

                                            <p><em>Acima do formulário, há uma mensagem com link que direciona para a seção
                                                    com o passo a passo sobre como obter os dados de acesso à API dos
                                                    Correios. Para visualizar o tutorial, <a
                                                        href="{{ route('central.ajuda.integracao.correios') }}"><strong>clique
                                                            aqui</strong></a>.</em></p>
                                        </div>
                                    </li>

                                </ul>

                                <p>A <x-ajuda.link-figura /> apresenta novamente a tela inicial, com o objetivo de reforçar
                                    a visualização do processo e facilitar a compreensão das instruções.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/sistema/rastreamento/tipos-envio.png',
                                )"
                                    descricao="Tela inicial da configuração do módulo Rastreamento" />

                                <p>Inicia-se a seção com explicações sobre as configurações do módulo.</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p>Na primeira aba, está disponível o botão <strong>Tipos de Envio</strong>, que
                                            reúne
                                            as opções de notificações configuráveis. Cada uma permite a personalização do
                                            texto
                                            que será enviado ao destinatário.</p>

                                        <p>A seguir, as configurações disponíveis:</p>

                                        <ul class="lista-personalizada">

                                            <li>
                                                <p><u>Enviar código de rastreamento</u> – envia uma notificação com o código
                                                    de
                                                    rastreamento assim que a encomenda for postada.</p>
                                                <p>Ao ativar a opção, uma janela para personalização do texto será exibida
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/enviar-codigo-rastreamento.png',
                                                )"
                                                    descricao="Janela para personalizar texto código de rastreamento" />
                                            </li>

                                            <li>
                                                <p><u>Enviar mensagem de confirmação de entrega</u> – envia uma notificação
                                                    quando o status do rastreio for alterado para <em>"entregue"</em>.</p>
                                                <p>Ao ativar a opção, será exibida uma janela para personalização do texto
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/enviar-msg-confirm-entrega.png',
                                                )"
                                                    descricao="Janela para personalizar texto situação entregue" />
                                            </li>
                                            <li>
                                                <p><u>Enviar mensagem de localização atual e próxima cidade da
                                                        mercadoria</u> –
                                                    envia uma notificação quando o status do rastreio indicar
                                                    <em>"transferência"</em>.
                                                </p>
                                                <p>A janela para personalização será exibida ao marcar a opção
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/enviar-loc-atual-prox.png',
                                                )"
                                                    descricao="Janela para personalizar texto situação transferência" />
                                            </li>
                                            <li>
                                                <p><u>Enviar mensagem de aviso 'Saiu para Entrega'</u> – envia uma
                                                    notificação
                                                    quando o status da entrega for alterado para <em>"saiu para entregar"</em>.</p>
                                                <p>Ao ativar, uma janela será exibida para personalização do texto
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/enviar-saiu-entrega.png',
                                                )"
                                                    descricao="Janela para personalizar texto saiu para entregar" />
                                            </li>
                                            <li>
                                                <p><u>Enviar mensagem de aviso de destinatário ausente</u> – envia uma
                                                    notificação quando o status da entrega for <em>"ausente"</em>.</p>
                                                <p>Ao marcar essa opção, será exibida a janela de personalização
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/enviar-dest-ausente.png',
                                                )"
                                                    descricao="Janela para personalizar texto situação ausente" />
                                            </li>
                                        </ul>

                                        <p>Em todas as janelas de personalização, é possível utilizar variáveis no formato <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> que podem ser arrastadas para o campo da mensagem.</p>

                                        <p>Essas variáveis são substituídas automaticamente pelos dados correspondentes no
                                            momento do envio da notificação. Para que a substituição ocorra corretamente, é
                                            necessário que os nomes estejam exatamente iguais aos apresentados.</p>

                                        <p>Também é possível incluir emojis, como os utilizados no WhatsApp.</p>

                                    </li>


                                    <li>
                                        <p>Na segunda aba, encontra-se o botão <strong>Tipo Cliente</strong>, que permite
                                            configurar o público destinatário das notificações <x-ajuda.link-figura />.</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/rastreamento/tipo-cliente.png',
                                        )"
                                            descricao="Tela de configurações do tipo de cliente" />

                                        <p>As opções disponíveis são:</p>

                                        <ul class="lista-personalizada">
                                            <li><u>Enviar notificações para CNPJ:</u> direciona as mensagens para empresas
                                                (pessoa jurídica).</li>
                                            <li><u>Enviar notificações para CPF:</u> direciona as mensagens para pessoas
                                                físicas
                                                com CPF registrado.</li>
                                        </ul>

                                        <p><em>
                                            É necessário selecionar pelo menos uma das opções. Por padrão, a opção <u>Enviar
                                                    notificações para CNPJ</u> já vem marcada. Ambas as opções podem ser
                                                ativadas
                                                simultaneamente, se desejado.
                                        </em></p>
                                    </li>


                                    <li>
                                        <p>Na última aba encontra-se o botão <strong>Opções de envio</strong>
                                            <x-ajuda.link-figura format />.
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/rastreamento/opcoes-envio.png',
                                        )"
                                            descricao="Tela das configurações das opções de envio" />

                                        <p>A seguir, as configurações disponíveis:</p>
                                        <ul class="lista-personalizada">
                                            <li>
                                                <p><u>Usar dados da integração:</u> configura o uso de dados provenientes da
                                                    integração com o Bling para compor as mensagens de notificação.</p>
                                            </li>
                                            <li>
                                                <p><u>Usar dados importados:</u> permite utilizar dados previamente
                                                    importados
                                                    no módulo Rastreamento.</p>
                                                <p>Ao selecionar essa opção, será exibida uma janela contendo os grupos de
                                                    dados
                                                    disponíveis <x-ajuda.link-figura format />.</p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/dados-importados.png',
                                                )"
                                                    descricao="Janela de configurar os dados importados para notificações" />
                                                <p>É possível selecionar um ou mais grupos e clicar em
                                                    <strong>Salvar</strong>.
                                                </p>
                                                <p>Caso não haja grupos cadastrados, será exibida uma mensagem com o botão
                                                    <strong>Importar Dados</strong> <x-ajuda.link-figura format />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/importar-novo.png',
                                                )"
                                                    descricao="Janela de configurar novos dados importados para notificações" />
                                                <p>Ao clicar no botão <strong>Importar Dados</strong>, será exibida a tela
                                                    para
                                                    envio de arquivos no formato planilha Excel ou CSV para o módulo
                                                    Rastreamento <x-ajuda.link-figura format />.</p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/importar-dados.png',
                                                )"
                                                    descricao="Tela para importar arquivos de dados" />
                                                <p>As instruções detalhadas sobre a importação estão disponíveis no menu
                                                    <u>Configurações &gt; Dados importados &gt; Rastreamento</u>. Para
                                                    acessar
                                                    diretamente, <a
                                                        href="{{ route('central.ajuda.config.dados.importados.rastreamento') }}"><strong>clique
                                                            aqui</strong></a>.
                                                </p>
                                                <p><em>É necessário selecionar ao menos uma das opções de origem de dados.
                                                        Ambas
                                                        podem ser ativadas simultaneamente, se desejado.</em></p>
                                            </li>

                                            <li>
                                                <p><u>Enviar mensagem sobre não receber mais notificações:</u> ativa o envio
                                                    de
                                                    uma mensagem com instruções para que o destinatário possa optar por não
                                                    receber mais notificações.</p>
                                                <p>Ao marcar essa opção, será exibida uma janela para personalização da
                                                    mensagem
                                                    <x-ajuda.link-figura format />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/rastreamento/sair.png',
                                                )"
                                                    descricao="Janela para personalizar a mensagem para cancelar recevimento" />
                                                <p>O campo de texto permite adicionar uma mensagem personalizada. No
                                                    entanto, a
                                                    frase padrão <em>"Para se retirar da lista de notificações envie
                                                        SAIR"</em>
                                                    será sempre incluída ao final da notificação.</p>
                                                <p>Caso nenhuma mensagem personalizada seja inserida, basta clicar em
                                                    <strong>Salvar</strong> para ativar apenas a mensagem padrão.
                                                </p>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <hr class="linha-dupla">

                                    <p>As orientações sobre a tela de configurações do módulo Rastreamento encerram-se aqui.
                                    </p>

                                    <p>Para continuar, acesse a seção de explicações sobre as configurações do módulo
                                        Remarketing <a
                                            href="{{ route('central.ajuda.config.sistema.remarketing') }}"><strong>clicando
                                                aqui</strong></a> ou pelo menu: <u>Configurações &gt; Sistema &gt;
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
