@php
    session(['figura_base' => 40]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Usuários')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Informações sobre Usuários</h2>
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
                                <p>Esta seção apresenta o menu Usuários e suas funções: cadastrar, visualizar, configurar
                                    permissões e deletar usuários. Por segurança, apenas o próprio usuário pode editar seus
                                    dados.</p>

                                <p>Se ainda não houver usuários cadastrados, a tela será exibida sem dados, conforme mostra
                                    a
                                    <x-ajuda.link-figura />.
                                </p>
                                <p>O objetivo é explicar como realizar cadastros e utilizar as funcionalidades disponíveis.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/vazio.png')" descricao="Tela usuários sem dados" />

                                <p>Acima do botão <strong>Novo Usuário</strong>, há um aviso em vermelho informando o número
                                    atual de usuários e o limite permitido conforme o plano. No exemplo, é possível
                                    cadastrar até 3 novos usuários.</p>

                                <p>Para iniciar um novo cadastro, clique em <strong>Novo Usuário</strong>. A tela
                                    correspondente será aberta (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/novo.png')" descricao="Tela de cadastro novo usuário" />

                                <p>Após preencher os dados e clicar em <strong>Salvar</strong>, o sistema envia um e-mail ao
                                    novo usuário com as credenciais de acesso (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/email-dados.png')" descricao="E-mail com os dados de acesso" />

                                <p>O sistema redireciona então para a tela de configuração das permissões
                                    (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/permissoes.png')"
                                    descricao="Tela de configurações das permissões do usuário" />

                                <p>Após selecionar as permissões desejadas, clique em <strong>Salvar</strong> para concluir.
                                </p>

                                <p>A tela de usuários será exibida com os dados atualizados (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/dados.png')" descricao="Relatório usuários" />

                                <p>A <x-ajuda.link-figura /> apresenta a visualização de todos os usuários cadastrados no
                                    limite do plano.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/limite.png')" descricao="Relatório usuários limite atingido" />

                                <p>Se for necessário adicionar mais usuários além do limite, utilize o botão <strong>Liberar
                                        mais usuários</strong>, que leva à tela de compra (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/comprar.png')" descricao="Tela de compra de usuário(s)" />

                                <p>O limite máximo permitido é de 10 usuários. Basta ajustar a quantidade com a barra
                                    (destaque vermelho) e clicar em <strong>Comprar</strong>.</p>

                                <p>A tela seguinte apresenta a quantidade selecionada, o valor total e a informação de
                                    cobrança na próxima fatura (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/finalizar-compra.png')" descricao="Tela de finalizar compra de usuário(s)" />

                                <p>Para concluir, clique em <strong>Efetuar Compra</strong>. A tela será redirecionada para
                                    o relatório de usuários atualizado (<x-ajuda.link-figura />).</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/relatorio.png')" descricao="Relatório de usuários" />

                                <p>Na <a href="#figura48"><strong>figura 48</strong></a>, é possível observar o novo limite
                                    de usuários disponíveis para cadastro, considerando a compra realizada.</p>

                                <p>Cada linha do relatório exibe os dados principais de um usuário, com ícones de ação na
                                    última coluna. A <x-ajuda.link-figura /> mostra os ícones destacados.</p>

                                <x-ajuda.figure :src="asset('assets/images/manual/usuarios/acoes.png')"
                                    descricao="Exemplo para explicação das funções dos ícones" />

                                <ul class="lista-personalizada">
                                    <li>
                                        <p>O ícone preto corresponde à função <u>Editar Permissões</u>. Ao clicar,
                                            a tela de permissões será aberta (<x-ajuda.link-figura />).</p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/usuarios/permissoes-user.png')"
                                            descricao="Tela de configuração das permissões do usuário" />
                                        <p>É possível adicionar ou remover permissões e salvar as alterações.</p>
                                    </li>

                                    <li>
                                        <p>O ícone azul corresponde à função <u>Visualizar</u>. Ao clicar, será
                                            exibida a tela com os dados do usuário (<x-ajuda.link-figura />).</p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/usuarios/view-user.png')"
                                            descricao="Tela de visualização dos dados do usuário" />
                                        <p>A tela é apenas para consulta. Para retornar ao relatório, clique em
                                            <strong>Voltar</strong>.
                                        </p>
                                    </li>

                                    <li>
                                        <p>O ícone laranja (que fica preto ao passar o mouse) corresponde à função
                                            <u>Deletar</u>. Ao clicar, uma confirmação será exibida conforme mostra a
                                            (<x-ajuda.link-figura />).
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/usuarios/deletar-user.png')"
                                            descricao="Mensagem de confirmação de deleção do usuário" />
                                        <p>Para confirmar, clique em <strong>Sim</strong>. Para cancelar, clique em
                                            <strong>Cancelar</strong>. O sistema retornará à lista de usuários ativos.
                                        </p>
                                    </li>
                                </ul>

                                <p>As explicações sobre usuários encerram aqui. O próximo passo trata das configurações da
                                    conta, sobre o plano atual. Para continuar, <a
                                        href="{{ route('central.ajuda.config.conta.plano.atual') }}"><strong>clique
                                            aqui</strong></a> ou utilize o menu lateral: <u>Configurações > Conta > Plano
                                        atual</u>.</p>
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
