@php
    session(['figura_base' => 71]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Sistema - Faturamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Explicações sobre a configuração do módulo Faturamento</h2>
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
                                <p>A tela inicial de configuração do módulo <strong>Faturamento</strong>
                                    (<x-ajuda.link-figura />) possui estrutura semelhante à do
                                    módulo Cobranças.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/sistema/faturamento/tipos-envio.png',
                                )"
                                    descricao="Tela inicial da configuração do módulo Faturamento" />
                                <p>Na seção <u>Integrações</u>, estão disponíveis os botões <strong>Whatsapp</strong> e
                                    <strong>Bling</strong>. Já na seção <u>Configurações do módulo</u>, encontram-se
                                    diversas abas, cada uma com suas respectivas opções de configuração.
                                </p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <div id="whatsapp">
                                            <p>Ao clicar no botão <strong>Whatsapp</strong>, será exibida a tela de
                                                configuração do WhatsApp (<x-ajuda.link-figura />).</p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/faturamento/whatsapp.png',
                                            )"
                                                descricao="Tela de conexão do whatsapp business" />

                                            <p>Nessa tela, um QR Code será apresentado para conectar ao WhatsApp Business,
                                                permitindo o envio das notificações posteriormente.</p>

                                            <p>Recomenda-se o uso de um número exclusivo do WhatsApp Business, devidamente
                                                aquecido, a fim de evitar bloqueios.</p>

                                            <p>Não há recarregamento automático do QR Code. Caso o código expire ou seja
                                                informado como inválido, utilize o botão <strong>Atualizar QR Code</strong>
                                                para gerar um novo. O tempo máximo de leitura é de 20 segundos.</p>

                                            <p>Para sair sem realizar a conexão, clique em <strong>Voltar</strong>. O
                                                sistema redirecionará para a tela inicial de configurações do módulo
                                                Faturamento.</p>

                                            <p>Se a conexão já estiver configurada, ao clicar no botão
                                                <strong>Whatsapp</strong>, será exibida uma tela com um card informando
                                                <u>Conexão Estabelecida</u> e o número conectado (<x-ajuda.link-figura />).
                                            </p>

                                            <x-ajuda.figure :src="asset(
                                                'assets/images/manual/configuracoes/sistema/faturamento/trocar-whatsapp.png',
                                            )"
                                                descricao="Tela de confirmação do whatsapp conectado" />

                                            <p>Para alterar o número conectado, clique em <strong>Trocar número</strong>. O
                                                sistema gerará uma nova conexão e exibirá novamente a tela de leitura do QR
                                                Code (<a href="#figura72"><strong>figura 72</strong></a>).</p>

                                            <p>Para retornar às configurações sem efetuar alterações, clique em
                                                <strong>Voltar</strong>.
                                            </p>
                                        </div>
                                    </li>



                                    <li>
                                        <div id="config-bling">
                                            <p>O botão <strong>Bling</strong> (<a href="#figura71"><strong>figura
                                                        71</strong></a>) está disponível em todos os módulos ativos para a
                                                primeira configuração. Após a configuração inicial, o botão permanece
                                                acessível apenas no módulo em que foi configurado.</p>
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
                                            <p>Para autorizar, marque a caixa de seleção e clique em
                                                <strong>Salvar</strong>.
                                            </p>
                                            <p>Em seguida, será exibida a tela de autorização do aplicativo no Bling
                                                <x-ajuda.link-figura />.
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


                                <p class="scroll-offset" id="config-faturamento">A <x-ajuda.link-figura /> exibe novamente a
                                    tela inicial do módulo Faturamento, com o
                                    objetivo de facilitar o entendimento das configurações a seguir.</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/sistema/faturamento/tipos-envio.png',
                                )"
                                    descricao="Tela inicial da configuração do módulo Faturamento" />


                                <p>A seguir, inicia-se a explicação da seção de configurações do módulo.</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p>Na primeira aba, está disponível o botão <strong>Tipos de Envio</strong>, que
                                            apresenta as opções relacionadas ao envio de documentos fiscais via
                                            notificação.</p>

                                        <p>As configurações disponíveis são:</p>

                                        <ul class="lista-personalizada">
                                            <li><u>Enviar link da nota fiscal:</u> insere o link da nota fiscal
                                                diretamente no corpo da mensagem.</li>
                                            <li><u>Enviar PDF da nota fiscal:</u> anexa o arquivo PDF da nota fiscal à
                                                mensagem de notificação.</li>
                                            <li><u>Enviar link XML:</u> insere o link do arquivo XML no corpo da
                                                mensagem.</li>
                                            <li><u>Enviar arquivo XML:</u> anexa o arquivo XML da nota fiscal à
                                                mensagem.</li>
                                            <li><u>Enviar XML para CNPJ:</u> direciona o envio do XML (arquivo ou link)
                                                para destinatários com CNPJ (pessoa jurídica).</li>
                                            <li><u>Enviar XML para CPF:</u> direciona o envio do XML (arquivo ou link)
                                                para destinatários com CPF (pessoa física).</li>
                                        </ul>

                                        <p><em>É possível selecionar uma, nenhuma ou todas as opções conforme a necessidade.</em>
                                        </p>
                                    </li>


                                    <li>
                                        <p>Na segunda aba, está disponível o botão <strong>Tipo Cliente</strong>, que
                                            permite configurar o tipo de destinatário das notificações
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/faturamento/tipo-cliente.png',
                                        )"
                                            descricao="Tela de configurações do tipo de cliente" />

                                        <p>As opções disponíveis são:</p>
                                        <ul class="lista-personalizada">
                                            <li><u>Enviar notificações para CNPJ:</u> direciona o envio para empresas
                                                (pessoa jurídica).</li>
                                            <li><u>Enviar notificações para CPF:</u> direciona o envio para pessoas
                                                físicas com CPF registrado.</li>
                                        </ul>

                                        <p><em>É necessário selecionar ao menos uma das opções. Por padrão, a opção
                                                <u>Enviar notificações para CNPJ</u> já vem marcada, sendo possível
                                                marcar as duas simultaneamente ou selecionar apenas uma delas.</em></p>

                                    </li>


                                    <li>
                                        <p>Na última aba, encontra-se o botão <strong>Opções de envio</strong>
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/sistema/faturamento/opcoes-envio.png',
                                        )"
                                            descricao="Tela das configurações das opções de envio" />

                                        <p>A seguir, estão as opções disponíveis para configuração:</p>

                                        <ul class="lista-personalizada">
                                            <li><u>Usar dados da integração:</u> utiliza os dados obtidos por meio da
                                                integração com o Bling para montar as mensagens de notificação.</li>

                                            <li>
                                                <u>Usar dados importados:</u> permite utilizar dados previamente
                                                importados no módulo Faturamento para compor as notificações.

                                                <p>Ao selecionar essa opção, será exibida uma janela com todos os grupos
                                                    de dados disponíveis (<x-ajuda.link-figura />).</p>

                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/faturamento/dados-importados.png',
                                                )"
                                                    descricao="Janela de configurar os dados importados para notificações" />

                                                <p>É possível selecionar um ou mais grupos e clicar em
                                                    <strong>Salvar</strong>.
                                                </p>

                                                <p>Caso não existam grupos cadastrados, será exibida uma mensagem
                                                    informando a necessidade de importação, juntamente com o botão
                                                    <strong>Importar Dados</strong> (<x-ajuda.link-figura />).
                                                </p>

                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/faturamento/dados-importados-novo.png',
                                                )"
                                                    descricao="Janela de configurar novos dados importados para notificações" />

                                                <p>Ao clicar no botão <strong>Importar Dados</strong>, será exibida a
                                                    tela para realizar a importação de arquivos em formato planilha
                                                    Excel ou CSV para o módulo Faturamento (<x-ajuda.link-figura />).</p>

                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/faturamento/importar-dados.png',
                                                )"
                                                    descricao="Tela para importar arquivos de dados" />

                                                <p>As instruções completas sobre a importação de dados estão disponíveis
                                                    no menu <u>Configurações &gt; Dados importados &gt; Faturamento</u>.
                                                    Para acessar diretamente, <a
                                                        href="{{ route('central.ajuda.config.dados.importados.faturamento') }}"><strong>clique
                                                            aqui</strong></a>.</p>


                                            </li>
                                            <p><em>É necessário selecionar ao menos uma das opções de origem dos dados.
                                                    Ambas podem ser utilizadas simultaneamente, se desejado.</em></p>
                                            <li>
                                                <p>A opção <u>Enviar mensagem sobre não receber mais notificações</u>
                                                    permite
                                                    configurar o envio de uma mensagem que oferece ao destinatário a
                                                    possibilidade de solicitar o cancelamento do recebimento de
                                                    notificações.
                                                </p>

                                                <p>Ao marcar essa opção, será exibida uma janela para personalização da
                                                    mensagem
                                                    (<x-ajuda.link-figura />).</p>

                                                <x-ajuda.figure :src="asset(
                                                    'assets/images/manual/configuracoes/sistema/faturamento/sair.png',
                                                )"
                                                    descricao="Janela para personalizar a mensagem para cancelar recebimento" />

                                                <p>O campo disponível permite adicionar um texto personalizado. No
                                                    entanto, a
                                                    mensagem padrão <em>"Para se retirar da lista de notificações
                                                            envie
                                                            SAIR"</em>  será automaticamente adicionada ao final de
                                                    todas as
                                                    mensagens quando essa opção estiver ativada.</p>

                                                <p>Caso não desejar adicionar texto personalizado, basta
                                                    clicar em
                                                    <strong>Salvar</strong> para ativar a mensagem padrão.
                                                </p>
                                            </li>
                                        </ul>

                                    </li>
                                </ul>
                                <hr class="linha-dupla">
                                <p>As orientações sobre a tela de configurações do módulo Faturamento encerram-se
                                    aqui.</p>
                                <p>Para continuar, acesse a seção de explicações sobre as configurações do módulo
                                    Rastreamento <a
                                        href="{{ route('central.ajuda.config.sistema.rastreamento') }}"><strong>clicando
                                            aqui</strong></a> ou pelo menu: <u>Configurações &gt; Sistema &gt;
                                        Rastreamento</u>.</p>
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
