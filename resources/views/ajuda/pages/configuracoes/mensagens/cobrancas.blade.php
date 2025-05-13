@php
    session(['figura_base' => 138]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagens - Cobranças')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre o cadastro das mensagens dos tipos de Cobranças
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
    <p>Esta seção apresenta as páginas de cadastro das mensagens do tipo Cobranças, organizadas em quatro subtipos:</p>

    <ul class="lista-personalizada">
        <li>Cobrança Gerada</li>
        <li>Cobrança Vencendo</li>
        <li>Cobrança Vencimento</li>
        <li>Cobrança Vencida</li>
    </ul>

    <p>As configurações de envio dessas mensagens são realizadas diretamente na página de configuração do módulo Cobranças, conforme detalhado em <u>Configurações > Sistema > Cobranças</u>. Para acesso direto, <a href="{{ route('central.ajuda.config.sistema.cobrancas') }}#config-cobrancas"><strong>clique aqui</strong></a>.</p>

    <p>Ao iniciar o cadastro das mensagens antes da configuração dos respectivos módulos, será exibido um aviso indicando a necessidade de integração do WhatsApp com o módulo Cobranças (<x-ajuda.link-figura />).</p>

    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/erro-whatsapp.png')" descricao="Página de cadastro da mensagem de cobranças com erro de integração com WhatsApp" />

    <p>Ao clicar no botão <strong>Configurar WhatsApp</strong>, será exibida a página de configuração do WhatsApp no módulo Cobranças, conforme descrito em <u>Configurações > Sistema > Cobranças</u>. Para acesso direto, <a href="{{ route('central.ajuda.config.sistema.cobrancas') }}#whatsapp"><strong>clique aqui</strong></a>.</p>

    <p>Após a configuração — ou caso já tenha sido realizada anteriormente — as instruções para o cadastro das mensagens do tipo Cobranças estão apresentadas a seguir.</p>

    <p>Em todas as páginas de cadastro, um texto padrão é previamente preenchido para facilitar o processo. Esse conteúdo pode ser mantido, editado ou substituído conforme a necessidade.</p>

    <p>Logo acima do botão <strong>Salvar</strong>, é exibido um aviso informando que os textos entre <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> podem ser arrastados e soltos nos campos da mensagem. Esses elementos são preenchidos automaticamente com base nas informações utilizadas no envio das notificações. Caso sejam digitados manualmente, é necessário que estejam exatamente conforme o padrão, para garantir o correto funcionamento.</p>

<p>O uso da variável <strong>&#123;&#123;</strong> qtd-dias <strong>&#125;&#125;</strong> é obrigatório no texto da mensagem apenas quando se deseja exibir a quantidade de dias antes ou após o vencimento da cobrança.</p>

    <p>Também é possível utilizar emojis normalmente usados no WhatsApp.</p>

    <p>Após finalizar o preenchimento dos campos e clicar em <strong>Salvar</strong>, o sistema retorna automaticamente para a página de relatório das mensagens (<x-ajuda.link-figura />).</p>

    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/relatorio.png')" descricao="Página de relatório das mensagens de cobrança" />

    <ul class="lista-personalizada">
        <li>
            <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro da mensagem do subtipo <u>Cobrança Gerada</u>, utilizada para notificar que uma cobrança foi registrada.</p>
            <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/gerada.png')" descricao="Página de cadastro da mensagem Cobrança Gerada" />
            <p>Devem ser preenchidos os campos "Nome da mensagem" e "Descrição".</p>
            <p>Após o preenchimento, clique em <strong>Salvar</strong> para concluir o cadastro e retornar à página de relatório.</p>
        </li>
        <li>
            <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro da mensagem do subtipo <u>Cobrança Vencendo</u>, destinada à notificação de cobranças próximas ao vencimento.</p>
            <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/vencendo.png')" descricao="Página de cadastro da mensagem Cobrança Vencendo" />
            <p>Devem ser preenchidos os campos "Nome da mensagem" e "Descrição".</p>
            <p>Após o preenchimento, clique em <strong>Salvar</strong> para concluir o cadastro e retornar à página de relatório.</p>
        </li>
        <li>
            <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro da mensagem do subtipo <u>Cobrança Vencimento</u>, usada para informar que a cobrança vence na data atual.</p>
            <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/vencimento.png')" descricao="Página de cadastro da mensagem Cobrança Vencimento" />
            <p>Devem ser preenchidos os campos "Nome da mensagem" e "Descrição".</p>
            <p>Após o preenchimento, clique em <strong>Salvar</strong> para concluir o cadastro e retornar à página de relatório.</p>
        </li>
        <li>
            <p>Na <x-ajuda.link-figura />, é apresentada a página de cadastro da mensagem do subtipo <u>Cobrança Vencida</u>, utilizada para notificar sobre cobranças não pagas após o vencimento.</p>
            <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/cobrancas/vencida.png')" descricao="Página de cadastro da mensagem Cobrança Vencida" />
            <p>Devem ser preenchidos os campos "Nome da mensagem" e "Descrição".</p>
            <p>Após o preenchimento, clique em <strong>Salvar</strong> para concluir o cadastro e retornar à página de relatório.</p>
        </li>
    </ul>

    <hr>

    <p>As informações detalhadas sobre o relatório e os ícones de cada linha serão apresentadas em uma seção específica. Para acesso direto, <a href="{{ route('central.ajuda.config.mensagens.relatorio') }}"><strong>clique aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens > Relatório</u>.</p>
    <hr class="linha-dupla">

    <p>Com isso, encerram-se as instruções referentes ao cadastro de mensagens do tipo Cobranças. A próxima seção aborda as mensagens do tipo Faturamento.</p>

    <p>Para acessar esse conteúdo, <a href="{{ route('central.ajuda.config.mensagens.faturamento') }}"><strong>clique aqui</strong></a> ou acesse o menu <u>Configurações > Mensagens > Faturamento</u>.</p>
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
