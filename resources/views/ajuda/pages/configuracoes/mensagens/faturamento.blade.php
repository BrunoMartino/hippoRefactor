@php
    session(['figura_base' => 144]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagens - Faturamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre o cadastro das mensagens dos tipos de Faturamento
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
                                <p>Esta seção apresenta as páginas de cadastro das mensagens do tipo Faturamento, que estão
                                    organizadas em cinco subtipos:</p>

                                <ul class="lista-personalizada">
                                    <li>Faturamento – Pedido Recebido</li>
                                    <li>Faturamento – Pedido em Andamento</li>
                                    <li>Faturamento – Pedido Atendido</li>
                                    <li>Faturamento – Pedido em Separação</li>
                                    <li>Faturamento – Pedido Verificado</li>
                                </ul>

                                <p>As configurações de envio dessas mensagens são realizadas diretamente na página de
                                    configuração do módulo Faturamento, conforme descrito em <u>Configurações > Sistema >
                                        Faturamento</u>. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.sistema.faturamento') }}#config-faturamento"><strong>clique
                                            aqui</strong></a>.</p>

                                <p>Ao iniciar o cadastro das mensagens antes da configuração do respectivo módulo, será
                                    exibido um aviso indicando a necessidade de integração com o WhatsApp no módulo
                                    Faturamento (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/faturamento/erro-whatsapp.png',
                                )"
                                    descricao="Página de cadastro de mensagem de faturamento com erro de integração com o WhatsApp" />

                                <p>Ao clicar no botão <strong>Configurar WhatsApp</strong>, será exibida a página de
                                    configuração do WhatsApp no módulo Faturamento. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.sistema.faturamento') }}#whatsapp"><strong>clique
                                            aqui</strong></a>.</p>

                                <p>Após a configuração — ou caso já tenha sido realizada anteriormente — as instruções para
                                    o cadastro das mensagens do tipo Faturamento estão apresentadas a seguir.</p>

                                <p>Em todas as páginas de cadastro, um texto padrão é previamente preenchido para facilitar
                                    o processo. Esse conteúdo pode ser mantido, editado ou substituído conforme a
                                    necessidade.</p>

                                <p>Logo acima do botão <strong>Salvar</strong>, é exibida uma instrução informando que os
                                    textos entre <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> podem ser arrastados
                                    para os campos da mensagem. Esses dados serão preenchidos automaticamente com base nas
                                    informações utilizadas no envio das notificações. Caso sejam digitados manualmente, é
                                    necessário que estejam exatamente conforme o padrão, a fim de garantir a correta
                                    transcrição.</p>

                                <p>Se forem selecionadas as opções para envio de links, é necessário posicionar o
                                    <strong>&#123;&#123; link-xml &#125;&#125;</strong> ou <strong>&#123;&#123; link-nfe
                                        &#125;&#125;</strong> no local desejado da mensagem, conforme a opção marcada.</p>

                                <p>Também é permitido utilizar emojis usados no WhatsApp no conteúdo das mensagens.</p>

                                <p>Após preencher os campos e clicar em <strong>Salvar</strong>, o sistema retorna
                                    automaticamente para a página de relatório de mensagens (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset(
                                    'assets/images/manual/configuracoes/mensagens/faturamento/relatorio.png',
                                )"
                                    descricao="Página de relatório das mensagens de faturamento" />

                                <p>Para todos os subtipos apresentados a seguir, é necessário preencher os campos "Nome da
                                    mensagem" e "Descrição". Após o preenchimento, clique em <strong>Salvar</strong> para
                                    concluir o cadastro e retornar à página de relatório.</p>

                                <ul class="lista-personalizada">
                                    <li>
                                        <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro do subtipo
                                            <u>Faturamento – Pedido Recebido</u>, utilizada para notificar que o pedido foi
                                            recebido e o faturamento será providenciado.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/faturamento/recebido.png',
                                        )"
                                            descricao="Página de cadastro da mensagem Pedido Recebido" />
                                    </li>
                                    <li>
                                        <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro do subtipo
                                            <u>Faturamento – Pedido em Andamento</u>, utilizada para informar que o pedido
                                            foi pago e aguarda a emissão da nota fiscal.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/faturamento/andamento.png',
                                        )"
                                            descricao="Página de cadastro da mensagem Pedido em Andamento" />
                                    </li>
                                    <li>
                                        <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro do subtipo
                                            <u>Faturamento – Pedido Atendido</u>, utilizada para notificar que a nota fiscal
                                            foi emitida e os produtos aguardam separação.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/faturamento/atendido.png',
                                        )"
                                            descricao="Página de cadastro da mensagem Pedido Atendido" />
                                    </li>
                                    <li>
                                        <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro do subtipo
                                            <u>Faturamento – Pedido em Separação</u>, utilizada para informar que o pedido
                                            está com a nota fiscal emitida e autorizada, aguardando embalagem.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/faturamento/separacao.png',
                                        )"
                                            descricao="Página de cadastro da mensagem Pedido em Separação" />
                                    </li>
                                    <li>
                                        <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro do subtipo
                                            <u>Faturamento – Pedido Verificado</u>, utilizada para informar que o pedido foi
                                            embalado, etiquetado e está pronto para envio ou coleta.</p>
                                        <x-ajuda.figure :src="asset(
                                            'assets/images/manual/configuracoes/mensagens/faturamento/verificado.png',
                                        )"
                                            descricao="Página de cadastro da mensagem Pedido Verificado" />
                                    </li>
                                </ul>
                                <p>As informações detalhadas sobre o relatório e os ícones de cada linha serão apresentadas
                                    em uma seção específica. Para acesso direto, <a
                                        href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique
                                            aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens > Relatório</u>.
                                </p>
                                <hr class="linha-dupla">

                                <p>Com isso, encerram-se as instruções sobre o cadastro de mensagens do tipo Faturamento. A
                                    próxima seção aborda a apresentação da página de relatório das mensagens e as funções dos ícones.</p>

                                <p>Para acessar esse conteúdo, <a
                                        href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique
                                            aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens >
                                        Relatório</u>.</p>
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
