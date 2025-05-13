@php
    session(['figura_base' => 19]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Dashboard')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Detalhamento das informações do Dashboard</h2>
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
                                <p><strong>Parabéns!</strong></p>

                                <p>
                                    A chegada ao dashboard indica que o registro foi concluído. Seja em um plano "Free
                                    trial" ou um plano pago (com pagamento confirmado), o próximo passo esperado era acessar
                                    esta tela.
                                    <x-ajuda.link-figura format />
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/dashboard/principal.png')" descricao="Tela dashboard" />

                                <p>
                                    Os dados apresentados na tela do dashboard (<a href="#figura19"><strong>figura
                                            19</strong></a>) são fictícios, utilizados exclusivamente para demonstração do
                                    manual.
                                </p>

                                <p>Detalhes de cada parte do dashboard são apresentados a seguir:</p>

                                <ul class="lista-personalizada">

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> exibe os cards com a quantidade de mensagens por
                                            status de envio.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/card-status-msg.png')" descricao="Card status das mensagens" />
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> apresenta o gráfico com a situação das entregas de
                                            mensagens.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-entregas.png')" descricao="Gráfico de entregas das mensagens" />
                                        <p>É possível aplicar filtro por datas clicando no ícone específico.</p>
                                        <p>Ao aplicar o filtro com data inicial e final, o gráfico será atualizado com as
                                            quantidades entregues e não entregues no período.</p>
                                        <p>
                                            Ao passar o mouse sobre a parte laranja do gráfico, a quantidade de mensagens
                                            não entregues será exibida; na parte azul, a quantidade de mensagens entregues.
                                        </p>
                                        <p>O percentual inferior indica a maior proporção — neste exemplo, 67% das mensagens
                                            foram entregues.</p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> mostra o gráfico de visualizações de mensagens.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-visualizacoes.png')"
                                            descricao="Gráfico de visualizações das mensagens" />
                                        <p>Filtro de datas pode ser aplicado clicando no ícone do gráfico.</p>
                                        <p>Após selecionar data inicial e final, clicar em <strong>Aplicar</strong> exibe os
                                            dados de mensagens visualizadas e não visualizadas.</p>
                                        <p>Na parte laranja, visualizam-se mensagens não vistas; na azul, as visualizadas. O
                                            percentual inferior indica o valor mais alto — 51% de visualizações neste
                                            exemplo.</p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> destaca o card de boas-vindas com o número de
                                            mensagens enviadas no dia e nos últimos 30 dias.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/card-msg-enviadas.png')"
                                            descricao="Card de boas-vindas e quantidade de mensagens enviadas" />
                                        <p>O filtro permite definir período específico para visualização de envios.</p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> exibe o gráfico de comparação anual da situação das
                                            mensagens enviadas.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-comp-anual.png')" descricao="Gráfico de comparação anual" />
                                        <p>É possível selecionar dois anos e o tipo da situação da mensagem para comparar os
                                            dados.</p>
                                        <p>O gráfico mostra as quantidades por ano e situação selecionada. Na parte laranja,
                                            o ano mais antigo; na azul, o mais recente.</p>
                                    </li>

                                    <li>
                                        <div id="satisfacao-clientes">
                                            <p>
                                                A <x-ajuda.link-figura /> apresenta o gráfico de satisfação dos clientes com
                                                base nas respostas de pesquisas.
                                            </p>
                                            <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-satisfacao.png')"
                                                descricao="Gráfico de satisfacao dos clientes" />
                                            <p>Filtros por pergunta e intervalo de datas permitem refinar os dados
                                                apresentados.</p>
                                            <p>
                                                O gráfico exibe a quantidade de respostas para cada opção da pergunta
                                                selecionada. A legenda mostra o que representa cada cor.
                                            </p>
                                        </div>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> mostra a média geral das respostas das pesquisas de
                                            satisfação.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/card-media-satisfacao.png')"
                                            descricao="Card da media de satisfação dos clientes" />
                                        <p>
                                            Ao selecionar a pergunta e o intervalo de datas no filtro, o gráfico exibirá o
                                            valor médio baseado nas respostas.
                                        </p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> mostra o gráfico em formato de mapa do Brasil com as
                                            notificações enviadas por estado.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-envios-estados.png')" descricao="Mapa de envios por estado" />
                                        <p>O filtro por datas possibilita a exibição de dados conforme o período escolhido.
                                        </p>
                                        <p>
                                            Ao posicionar o mouse sobre um estado no mapa, a quantidade de notificações
                                            enviadas será exibida.
                                        </p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> exibe o gráfico com a faixa etária das pessoas
                                            destinatárias das mensagens.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-faixa-etaria.png')" descricao="Gráfico de envios por faixa etária" />
                                        <p>O gráfico permite aplicar filtro por datas para refinar a análise.</p>
                                        <p>Ao passar o mouse sobre as barras, será exibida a quantidade de mensagens
                                            enviadas por faixa etária.</p>
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> apresenta o card com a idade média das pessoas físicas
                                            destinatárias das mensagens.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/card-media-idade.png')" descricao="Card media da idade" />
                                    </li>

                                    <li>
                                        <p>
                                            A <x-ajuda.link-figura /> mostra o gráfico de gênero (masculino/feminino) das
                                            pessoas destinatárias das mensagens.
                                        </p>
                                        <x-ajuda.figure :src="asset('assets/images/manual/dashboard/grafico-genero.png')" descricao="Gráfico de envios por gênero" />
                                        <p>Ao posicionar o mouse na parte laranja, visualiza-se os envios para o gênero
                                            feminino; na parte azul, para o masculino.</p>
                                        <p>O percentual inferior indica a maior proporção — neste exemplo, 51% de mensagens
                                            foram enviadas para o público feminino.</p>
                                    </li>

                                </ul>

                                <p>
                                    As explicações sobre o dashboard finalizam aqui. O próximo passo para melhor
                                    entendimento é conhecer o <u>Menu superior</u> (header).</p>
                                <p>Para isso, é possível <a href="{{ route('central.ajuda.menu.superior') }}"><strong>clicar
                                            aqui</strong></a> ou utilizar o menu lateral.
                                </p>
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
