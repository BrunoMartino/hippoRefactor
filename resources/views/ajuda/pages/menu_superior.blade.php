@php
    session(['figura_base' => 31]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Menu superior')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Apresentação do menu superior (header)</h2>
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
                                <p>Todos os dados apresentados nas telas a seguir são fictícios, utilizados apenas para fins
                                    de demonstração do manual.</p>

                                <p>Na <x-ajuda.link-figura /> é exibida a parte superior do sistema Hippo Notify, denominada aqui como <u>
                                    Menu
                                        superior
                                </u>.</p>
                                <p>Esse menu inclui a logo e botões funcionais que serão detalhados adiante. Ele permanece
                                    visível em todas as telas do sistema.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/header.png')" descricao="Menu superior" />

                                <p>Clicar na logo direciona para a tela do <a
                                        href="{{ route('central.ajuda.dashboard') }}"><strong>dashboard</strong></a>.</p>
                                <p>O botão tipo “hamburguer”, em destaque vermelho, alterna entre exibir e ocultar o menu
                                    lateral. A visualização ocorre na tela do dashboard.</p>

                                <p>A <x-ajuda.link-figura /> exibe o menu lateral maximizado e a <x-ajuda.link-figura /> mostra o
                                    mesmo menu minimizado.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/menu-max.png')" descricao="Exemplo menu lateral maximizado" />
                                <x-ajuda.figure :src="asset('assets/images/manual/header/menu-min.png')" descricao="Exemplo menu lateral minimizado" />

                                <p>Com o menu minimizado (<a href="#figura33"><strong>figura 33</strong></a>), há mais
                                    espaço disponível na tela.</p>
                                <p>Para alternar entre os modos, basta clicar novamente no botão "hamburguer".</p>

                                <div class="scroll-offset" id="trocar-adquirir-plano">
                                    <p>O botão <strong>Trocar/Adquirir plano</strong> (destaque azul em <a
                                            href="#figura31"><strong>figura 31</strong></a>) direciona para a tela de planos.
                                    </p>
                                    <p>Ao clicar nesse botão, o sistema exibe a tela mostrada em <x-ajuda.link-figura />.</p>
                                    <x-ajuda.figure :src="asset('assets/images/manual/header/trocar-plano.png')" descricao="Tela trocar/adquirir plano" />
                                    <p>Nessa página, é possível alterar planos ativos ou contratar novos módulos.</p>
                                    <p>No módulo <u>Faturamento</u>, o botão <u>Teste grátis por 7 dias</u> indica
                                        ausência de plano ativo.</p>
                                    <p>Os demais módulos exibem o plano ativo com aparência ofuscada.</p>
                                </div>

                                <hr>

                                <p>O botão com ícone de engrenagem (destaque verde) permite configurar o tema (claro ou
                                    escuro).</p>
                                <p>As telas apresentadas até aqui estão no tema claro. A escolha do tema ocorre na janela
                                    aberta após clicar no botão <x-ajuda.link-figura />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/conf-tema.png')" descricao="Janela configuração estilo do tema" />

                                <p>O botão do tema ativo aparece selecionado. Para alterar, basta clicar em
                                    <strong>Escuro</strong> ou <strong>Claro</strong>, conforme desejado.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/tema-escuro.png')" descricao="Sistema com tema escuro" />

                                <p>O botão final do menu superior exibe as informações do usuário (destaque preto com ícone
                                    ou imagem).</p>
                                <p>Ao clicar, a janela será aberta conforme mostra a <x-ajuda.link-figura />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/botao-user.png')" descricao="Janela informações do usuário" />

                                <p>Na <a href="#figura37"><strong>figura 37</strong></a>, o destaque verde mostra foto/logo,
                                    nome, tipo de usuário e e-mail.</p>
                                <p>No destaque azul, o botão <strong>Meu Perfil</strong> direciona para a tela de
                                    configurações da conta (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/perfil.png')" descricao="Tela de configuração do perfil do usuário" />

                                <p>As configurações de perfil são explicadas separadamente. Para acessar, <a
                                        href="{{ route('central.ajuda.perfil') }}"><strong>clique aqui</strong></a>.</p>

                                <p>No destaque vermelho, o botão <strong>Cancelar Conta</strong> inicia o processo de
                                    cancelamento. A confirmação aparece no topo da tela, como mostra a <x-ajuda.link-figura />.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/header/cancelar-conta.png')" descricao="Confirmação do cancelamento da conta" />

                                <p>Ao clicar em <strong>Sim</strong>, a conta é encerrada e ocorre o logout do sistema. Caso
                                    contrário, basta clicar em <strong>Não</strong> para cancelar a ação.</p>

                                <p>As explicações sobre o menu superior se encerram aqui.</p>
                                    <p>Para continuar, acesse as
                                    informações sobre Usuários clicando <a
                                        href="{{ route('central.ajuda.usuarios') }}"><strong>aqui</strong></a> ou utilize o
                                    menu lateral.</p>
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
