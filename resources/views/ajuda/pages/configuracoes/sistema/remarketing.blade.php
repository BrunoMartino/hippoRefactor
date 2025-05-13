@php
    session(['figura_base' => 101]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Sistema - Remarketing')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Explicações sobre a configuração do módulo Remarketing
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
  <p>A tela de configuração do módulo Remarketing <x-ajuda.link-figura format /> contém apenas a seção <u>Integrações</u>, com os botões <strong>Whatsapp</strong> e <strong>Bling</strong>.</p>

  <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/sistema/remarketing/index.png')" descricao="Tela de configurações do módulo Remarketing" />

  <p>As notificações são configuradas diretamente nas mensagens criadas.</p>
    <p>A explicação completa está disponível no menu <u>Configurações &gt; Mensagens</u>, ou acesse diretamente <a href="{{ route('central.ajuda.config.mensagens.apresentacao') }}"><strong>clicando aqui</strong></a>.</p>

  <ul class="lista-personalizada">
    <li>
      <div class="scroll-offset" id="config-whatsapp">
        <p>Ao clicar no botão <strong>Whatsapp</strong>, será exibida a tela de configuração da conexão com o WhatsApp Business <x-ajuda.link-figura format />.</p>

        <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/sistema/rastreamento/whatsapp.png')" descricao="Tela de conexão do whatsapp business" />

        <p>Nessa tela, um QR Code será exibido para leitura com o aplicativo WhatsApp Business, permitindo a conexão necessária para envio das notificações.</p>

        <p>Recomenda-se utilizar um número exclusivo e aquecido do WhatsApp Business para evitar bloqueios.</p>

        <p>Não há atualização automática do QR Code. Caso expire ou seja inválido, clique em <strong>Atualizar QR Code</strong> para gerar um novo. O tempo de leitura é de 20 segundos.</p>

        <p>Se não desejar conectar no momento, clique em <strong>Voltar</strong> para retornar à tela inicial de configurações.</p>

        <p>Se a conexão já estiver ativa, ao clicar no botão <strong>Whatsapp</strong> será exibido um card com a mensagem <em>Conexão Estabelecida</em> e o número vinculado <x-ajuda.link-figura format />.</p>

        <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/sistema/rastreamento/trocar-whatsapp.png')" descricao="Tela de confirmação do whatsapp conectado" />

        <p>Para trocar o número, clique em <strong>Trocar número</strong>. A tela de conexão será exibida novamente com um novo QR Code (<a href="#figura102"><strong>figura 102</strong></a>).</p>

        <p>Para manter a conexão atual, clique em <strong>Voltar</strong>.</p>
      </div>
    </li>

    <li>
      <div class="scroll-offset" id="config-bling">
        <p>O botão <strong>Bling</strong> (<a href="#figura101"><strong>figura 101</strong></a>) está disponível em todos os módulos ativos apenas na primeira configuração. Após isso, ficará acessível apenas no módulo onde foi integrado.</p>

        <p>Ao clicar no botão <strong>Bling</strong>, será exibida a tela de autorização para uso dos dados da conta Bling no envio de notificações <x-ajuda.link-figura />.</p>

        <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/sistema/faturamento/bling.png')" descricao="Tela de autorização para uso dos dados do Bling" />

        <p><em>Acima da caixa de seleção, há um link que leva diretamente a esta seção, com instruções detalhadas sobre a integração com o Bling.</em></p>

        <p>Para autorizar, marque a caixa de seleção e clique em <strong>Salvar</strong>.</p>

        <p>Em seguida, será exibida a tela de autorização do aplicativo Bling <x-ajuda.link-figura format />.</p>

        <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/sistema/cobrancas/bling-auth.png')" descricao="Tela de autorização do aplicativo Bling" />

        <p>A autorização é obrigatória para que os dados da plataforma Bling sejam utilizados nas notificações.</p>

        <p><em>Após esse processo, com ou sem autorização concedida, o sistema redirecionará automaticamente para a tela inicial do módulo Rastreamento.</em></p>
      </div>
    </li>
  </ul>

  <hr class="linha-dupla">

  <p>As explicações sobre a tela de configurações do módulo Remarketing finalizam por aqui.</p>

  <p>O próximo passo é entender a criação e gestão de mensagens, incluindo as configurações específicas para envio de notificações. Acesse pelo menu <u>Configurações &gt; Mensagens &gt; Apresentação</u> ou <a href="{{ route('central.ajuda.config.mensagens.apresentacao') }}"><strong>clicando aqui</strong></a>.</p>
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
