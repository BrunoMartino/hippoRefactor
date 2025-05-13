@php
    session(['figura_base' => 121]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagem - Aniversário')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração da mensagem do tipo Aniversário
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
                                    tipo Aniversário.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/aniversario/index.png')" descricao="Tela de cadastro da mensagem de aniversário" />

                                <p>Se o cadastro das mensagens for iniciado antes da configuração do(s) módulo(s), ao tentar
                                    realizar o cadastro será exibido um aviso solicitando a integração do WhatsApp no módulo
                                    Remarketing (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/aniversario/erro-whatsapp.png',
                                )"
                                    descricao="Tela de cadastro da mensagem do tipo aniversário com erro WhatsApp" />


                                <p>Ao clicar no botão <strong>Configurar Whatsapp</strong>, será redirecionado para a página
                                    de configuração do WhatsApp no módulo Remarketing, conforme descrito em <u>Configurações
                                        > Sistema > Remarketing</u>. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.sistema.remarketing') }}#whatsapp"><strong>clique
                                            aqui</strong></a>.</p>

                                <p>Após a configuração ou, caso já tenha sido realizada previamente, as orientações para o
                                    cadastro e a configuração da mensagem do tipo Aniversário são apresentadas a seguir.</p>

                                <p>Conforme indicado no destaque acima do botão <strong>Salvar</strong>, os textos entre
                                    <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> podem ser arrastados e soltos diretamente no campo
                                    da mensagem. Esses elementos serão substituídos automaticamente pelas informações
                                    utilizadas no envio das notificações.</p>

                                <p>Caso a inserção seja feita manualmente, é imprescindível que o texto esteja exatamente
                                    igual ao modelo para que a transcrição ocorra corretamente.</p>

                                <p>É possível utilizar emojis no conteúdo da mensagem, como os comumente usados no WhatsApp.
                                </p>

                                <p>Ao clicar em <strong>Salvar</strong>, será exibida a tela de configurações de envio da
                                    mensagem (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/aniversario/configuracao.png',
                                )"
                                    descricao="Tela de configurações de envio da mensagem aniversário" />

                                <p>As opções disponíveis são detalhadas a seguir:</p>

                                <ul style="list-style-type: disc; padding-left: 20px; margin-left: 20px;">
                                    <li>
                                        <p><u>Enviar mensagem sobre não receber mais notificações</u> – permite o envio de
                                            uma mensagem para que o cliente, ao receber a notificação, possa indicar que não
                                            deseja mais recebê-las.</p>

                                        <p>Ao selecionar esta opção, será exibida uma janela para personalização da mensagem
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/aniversario/sair.png',
                                        )"
                                            descricao="Janela para personalizar mensagem sair" />

                                        <p>No campo disponível, é possível inserir uma mensagem personalizada. No entanto, a
                                            frase <em>“Para se retirar da lista de notificações envie SAIR”</em> será
                                            automaticamente adicionada ao final da mensagem, sendo um conteúdo padrão.</p>

                                        <p>Ao abrir a janela de personalização, caso nenhuma mensagem seja inserida, basta
                                            clicar em <strong>Salvar</strong> para ativar a mensagem padrão.</p>
                                    </li>


                                    <li>
                                        <p><u>Usar dados da integração</u> – define a utilização dos dados provenientes da
                                            integração com o Bling para compor automaticamente as mensagens de notificação.
                                        </p>
                                    </li>

                                    <li>
                                        <p><u>Usar dados importados</u> – configura a utilização de dados importados para a
                                            montagem das notificações.</p>

                                        <p>Ao selecionar esta opção, será exibida uma janela com todos os grupos de dados
                                            importados no módulo Remarketing (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/aniversario/dados-importados.png',
                                        )"
                                            descricao="Janela para selecionar o(s) grupo(s) dados importados" />

                                        <p>É possível selecionar um ou mais grupos e salvar a seleção.</p>

                                        <p>Se não houver nenhum grupo de dados importados, será exibida uma janela com uma
                                            mensagem informando a necessidade de importação e o botão <strong>Importar
                                                Dados</strong> (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/aniversario/importar-novo.png',
                                        )"
                                            descricao="Janela solicitando importar dados para usar na configuração" />

                                        <p>Ao clicar em <strong>Importar Dados</strong>, será exibida a tela para realizar a
                                            importação da planilha Excel ou arquivo CSV no módulo Remarketing
                                            (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/aniversario/importar-dados.png',
                                        )"
                                            descricao="Tela para cadastrar grupos e importar dados" />

                                        <p>As instruções detalhadas sobre a importação de arquivos de dados serão
                                            apresentadas no menu <u>Configurações > Dados importados > Remarketing</u>. Para
                                            acesso direto, <a
                                                href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"><strong>clique
                                                    aqui</strong></a>.</p>
                                    </li>

                                    <li>
                                        <p><u>Data específica</u> – configura o envio da notificação com essa mensagem
                                            exclusivamente na data selecionada.</p>
                                    </li>

                                    <li>
                                        <p><u>Enviar imagem junto com a mensagem</u> – permite o envio de uma imagem antes
                                            da mensagem de texto. Ao selecionar esta opção, será exibida uma janela para
                                            escolha da imagem (<x-ajuda.link-figura />).</p>

                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/aniversario/imagem.png',
                                        )" descricao="Janela para selecionar a imagem" />
                                    </li>
                                </ul>
                                <p>Após selecionar as opções desejadas, clique em <strong>Salvar</strong> para concluir o
                                    cadastro e a configuração da mensagem.</p>
                                <p>Será exibida a tela de relatório das mensagens (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/aniversario/relatorio.png',
                                )" descricao="Tela de relatório de mensagens" />

                                <p>Os detalhes sobre o relatório e os ícones presentes em cada linha serão abordados em
                                    outra seção. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique
                                            aqui</strong></a> ou acesse pelo menu <u>Configurações > Mensagens >
                                        Relatório</u>.</p>
                                <hr class="linha-dupla">
                                <p>As instruções sobre o cadastro e a configuração da mensagem do tipo Aniversário
                                    encerram-se neste ponto. A próxima etapa aborda o cadastro e as configurações da
                                    mensagem do tipo Pesquisa de Satisfação.</p>

                                <p>Para acessar este conteúdo, <a
                                        href="{{ route('central.ajuda.config.mensagens.pesquisa.satisfacao') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu <u>Configurações > Mensagens > Pesquisa
                                        Satisfação</u>.</p>

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
