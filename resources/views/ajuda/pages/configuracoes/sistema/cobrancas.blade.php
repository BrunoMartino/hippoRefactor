@php
    session(['figura_base' => 58]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Sistema - Cobranças')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração do módulo Cobranças
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
                                <p>Ao acessar <u>Configurações &gt; Sistema &gt; Cobranças</u>, a tela inicial
                                    será exibida <x-ajuda.link-figura />.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/sistema/cobrancas/tipos-envio.png',
                                )" descricao="Tela inicial configurações módulo Cobranças" />

                                <p>Na seção Integrações, estão disponíveis os botões <strong>Whatsapp</strong> e
                                    <strong>Bling</strong>.
                                </p>

                                <ul class="lista-personalizada">

                                    <li>
                                        <div class="scroll-offset" id="whatsapp">
                                            <p>Ao clicar em <strong>Whatsapp</strong>, será exibida a tela de conexão
                                                com
                                                o WhatsApp Business <x-ajuda.link-figura />.</p>
                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/cobrancas/whatsapp.png',
                                            )"
                                                descricao="Tela de conexão do whatsapp business" />
                                            <p>Nessa tela, um QR Code será apresentado para conectar ao WhatsApp Business,
                                                permitindo o envio das notificações posteriormente.</p>

                                            <p>Recomenda-se o
                                                uso
                                                de número exclusivo e aquecido para evitar bloqueios.</p>
                                            <p>Não há atualização automática do QR Code. Caso expire, clique em
                                                <strong>Atualizar QR
                                                    Code</strong> para gerar um novo. O tempo de leitura é de 20 segundos.
                                            </p>
                                            <p>Para retornar à tela anterior sem conectar, clique em
                                                <strong>Voltar</strong>.
                                            </p>
                                            <p>Se a conexão já estiver configurada, será exibido um card indicando que a
                                                conexão
                                                está
                                                estabelecida <x-ajuda.link-figura />.</p>
                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/cobrancas/trocar-whatsapp.png',
                                            )"
                                                descricao="Tela de confirmação do whatsapp conectado" />
                                            <p>Para alterar o número, clique em <strong>Trocar número</strong>, e uma nova
                                                tela com
                                                QR
                                                Code será exibida para reconexão.</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div id="config-bling">
                                            <p>O botão <strong>Bling</strong> está disponível em todos os módulos ativos
                                                para a
                                                primeira
                                                configuração. Após a configuração inicial, o botão permanece apenas no
                                                módulo em
                                                que foi
                                                configurado.</p>
                                            <p>Ao clicar em <strong>Bling</strong>, será exibida a tela para autorização de
                                                uso
                                                dos
                                                dados da conta <x-ajuda.link-figura />.</p>
                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/cobrancas/bling.png',
                                            )"
                                                descricao="Tela de autorização para uso dos dados do Bling" />
                                            <p><em>Acima da caixa de seleção há um link que direciona exatamente para esta
                                                    seção, com instruções detalhadas sobre o botão Bling e o processo de
                                                    integração.</em></p>

                                            <p>Para autorizar, marque a caixa de seleção e clique em
                                                <strong>Salvar</strong>.
                                            </p>
                                            <p>Em seguida, será exibida a tela de autorização do aplicativo no Bling
                                                <x-ajuda.link-figura format />.
                                            </p>
                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/cobrancas/bling-auth.png',
                                            )"
                                                descricao="Tela de autorização do aplicativo Bling" />
                                            <p>A autorização é obrigatória para que os dados da plataforma possam ser
                                                utilizados
                                                nas
                                                notificações.</p>
                                            <p>Independentemente da autorização, o sistema retornará à tela inicial do
                                                módulo
                                                Cobranças.
                                            </p>
                                        </div>
                                    </li>
                                </ul>

                                <div class="scroll-offset" id="config-cobrancas">
                                    <p>A tela inicial do módulo Cobranças é exibida novamente <x-ajuda.link-figura format />
                                        para facilitar a explicação.</p>
                                    <x-ajuda.figure :src="asset(
                                        'assets/images/manual/configuracoes/sistema/cobrancas/tipos-envio.png',
                                    )"
                                        descricao="Tela inicial configurações módulo Cobranças" />
                                </div>

                                <p>Inicia-se agora a seção de Configurações do Módulo.</p>
                                <ul class="lista-personalizada">
                                    <li>
                                        <p>A primeira aba apresenta o botão <strong>Tipos de envio</strong>, onde estão
                                            disponíveis as opções para configuração das notificações.</p>
                                        <ul class="lista-personalizada">
                                            <li>
                                                <p>A opção <u>Enviar notificação de fatura a vencer</u> permite configurar o
                                                    envio
                                                    de notificações referentes a <u>contas a receber</u> que ainda não
                                                    venceram.</p>
                                                <p>Essa opção contém três campos para configuração:</p>
                                                <ul class="lista-personalizada">
                                                    <li><u>Quantidade de envios:</u> define quantas notificações serão
                                                        enviadas
                                                        antes do vencimento.</li>
                                                    <li><u>Intervalo de dias:</u> determina o intervalo, em dias, entre os
                                                        envios.
                                                    </li>
                                                    <li><u>Dias antes do vencimento:</u> informa quantos dias antes do
                                                        vencimento a
                                                        primeira notificação deve ser enviada.</li>
                                                </ul>
                                                <p class="h4"><em>
                                                        Após o preenchimento, o sistema validará os valores informados
                                                        para
                                                        garantir que
                                                        os envios ocorram corretamente.
                                                    </em></p>
                                            </li>


                                            <li>
                                                <p>A opção <u>Enviar notificação após vencimento da fatura</u> permite
                                                    configurar o
                                                    envio de notificações para contas a receber em aberto que já estão
                                                    vencidas.</p>

                                                <p>Esta configuração possui dois campos:</p>

                                                <ul class="lista-personalizada">
                                                    <li><u>Quantidade de envios:</u> define o número de notificações que
                                                        serão
                                                        enviadas após o vencimento.</li>
                                                    <li><u>Intervalo de dias:</u> determina o intervalo, em dias, entre os
                                                        envios.
                                                    </li>
                                                </ul>

                                                <p class="h4"><em>
                                                        Após o preenchimento, o sistema validará os valores informados
                                                        para
                                                        garantir que
                                                        os envios ocorram corretamente.
                                                    </em></p>
                                            </li>


                                            <li>
                                                <p>A opção <u>Enviar notificação de fatura no vencimento</u> permite
                                                    configurar o
                                                    envio de notificações no exato dia de vencimento das contas a receber.
                                                </p>
                                            </li>

                                            <li>
                                                <p>A opção <u>Enviar notificação de fatura emitida</u> permite configurar o
                                                    envio de
                                                    notificações para contas a receber no momento em que forem geradas
                                                    (emitidas).
                                                </p>
                                            </li>
                                        </ul>
                                    </li>



                                    <li>
                                        <p>A segunda aba apresenta o botão <strong>Tipo cliente</strong>
                                            <x-ajuda.link-figura />, onde são definidas as categorias de destinatários das
                                            notificações.
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/cobrancas/tipo-cliente.png',
                                        )" descricao="Tela de opções de tipo cliente" />

                                        <p>As opções disponíveis são:</p>
                                        <ul class="lista-personalizada">
                                            <li><u>Enviar notificações para CNPJ:</u> direciona os envios para empresas
                                                (pessoa jurídica).</li>
                                            <li><u>Enviar notificações para CPF:</u> direciona os envios para pessoas
                                                físicas.</li>
                                        </ul>

                                        <p>É obrigatório selecionar pelo menos uma das opções, sendo possível ativar ambas
                                            simultaneamente.</p>
                                    </li>


                                    <li>
                                        <p>Na terceira aba está disponível o botão <strong>Tipo de envio do boleto</strong>
                                            <x-ajuda.link-figura />, onde são definidas as formas de apresentação do boleto
                                            nas notificações.
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/cobrancas/tipo-envio-boleto.png',
                                        )"
                                            descricao="Tela de opções do tipo de envio do boleto" />

                                        <p>As opções disponíveis são:</p>

                                        <ul>
                                            <li><u>Enviar link do boleto:</u> insere o link diretamente no campo da mensagem
                                                da notificação.</li>
                                            <li><u>Enviar PDF do boleto:</u> anexa o boleto em PDF após a mensagem da
                                                notificação.</li>
                                        </ul>

                                        <p>É necessário selecionar ao menos uma das opções, sendo possível marcar ambas
                                            simultaneamente.</p>
                                    </li>


                                    <li>
                                        <p>A quarta aba apresenta o botão <strong>Opções de envio</strong>
                                            <x-ajuda.link-figura />.
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/cobrancas/opcoes-envio.png',
                                        )" descricao="Tela das opções de envio" />

                                        <p>Existem duas formas de origem de dados para o envio de notificações:</p>

                                        <ul class="lista-personalizada">
                                            <li>
                                                <u>Usar dados importados:</u> permite utilizar grupos de dados previamente
                                                importados no módulo Cobranças.
                                                <p>Ao selecionar essa opção, será exibida uma janela com os grupos
                                                    disponíveis <x-ajuda.link-figura />.</p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/cobrancas/dados-importados.png',
                                                )"
                                                    descricao="Janela de configurar os dados importados para notificações" />

                                                <p>Caso não existam dados importados, será apresentada uma mensagem com o
                                                    botão <strong>Importar Dados</strong> <x-ajuda.link-figura />.</p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/cobrancas/dados-importados-novo.png',
                                                )"
                                                    descricao="Janela de configurar novos dados importados para notificações" />

                                                <p>Ao clicar em <strong>Importar Dados</strong>, será aberta a tela de
                                                    importação de arquivos no formato planilha do excel ou CSV
                                                    <x-ajuda.link-figura />.
                                                </p>
                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/cobrancas/importar-dados.png',
                                                )"
                                                    descricao="Tela para importar arquivos de dados" />

                                                <p>Mais detalhes sobre essa funcionalidade estão disponíveis na seção
                                                    <u>Configurações &gt; Dados importados &gt; Cobranças</u>. Para acessar
                                                    diretamente, <a
                                                        href="{{ route('central.ajuda.config.dados.importados.cobrancas') }}"><strong>clique
                                                            aqui</strong></a>.
                                                </p>
                                            </li>

                                            <li>
                                                <strong>Usar dados integrados:</strong> permite utilizar informações
                                                diretamente da conta Bling.
                                            </li>
                                        </ul>

                                        <p>É obrigatório selecionar ao menos uma das opções, sendo possível ativar ambas
                                            simultaneamente.</p>

                                        <p>Após definir a origem dos dados, é necessário selecionar a <u>data inicial de
                                                vencimento</u> das faturas que serão utilizadas para montar as notificações.
                                        </p>

                                        <p class="h4"><em>A data inicial pode ser configurada em até 364 dias anteriores
                                                à data atual.</em></p>
                                    </li>


                                    <li>
                                        <p>A última aba apresenta o botão <strong>Formas de pagamento</strong>
                                            <x-ajuda.link-figura format />.
                                        </p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/cobrancas/formas-pagamento.png',
                                        )"
                                            descricao="Tela de selecionar as formas de pagamento" />

                                        <p>Nessa aba, são exibidas as formas de pagamento configuradas no Bling para as
                                            contas a receber.</p>

                                        <p>É necessário selecionar quais formas de pagamento devem receber notificações.
                                        </p>
                                        <p>No caso de uso de dados importados, todas as contas vinculadas ao grupo
                                            selecionado serão incluídas no envio de notificações.</p>

                                        <p>É possível selecionar uma ou mais formas de pagamento simultaneamente.</p>
                                    </li>

                                    <p>Após concluir as configurações, clique em <strong>Salvar</strong>. Caso prefira
                                        salvar aba por aba, o botão passará a ser exibido como <strong>Atualizar</strong>
                                        após o primeiro salvamento.</p>
                                    <hr>

                                    <p>As orientações sobre a tela de configurações do módulo Cobranças finalizam aqui.</p>
                                    <p>Para acessar as orientações sobre as configurações do módulo Faturamento, <a
                                            href="{{ route('central.ajuda.config.sistema.faturamento') }}"><strong>clique
                                                aqui</strong></a> ou utilize o menu lateral em <u>Configurações &gt; Sistema
                                            &gt; Faturamento</u>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    @endsection
