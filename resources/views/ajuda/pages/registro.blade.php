@php
    session(['figura_base' => 1]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Página')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Instruções para cadastro no sistema Hippo Notify</h2>
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
                                <p>
                                    O processo de registro na plataforma pode ser iniciado pela
                                    <a href="https://hipponotify.com.br" target="_blank" rel="noopener noreferrer">Landing
                                        Page</a>
                                    ou pelo link
                                    <a href="https://painel.hipponotify.com.br/login" target="_blank"
                                        rel="noopener noreferrer">"Faça seu registro"</a>
                                    disponível na página de login, conforme ilustrado nas imagens abaixo.
                                </p>




                                <x-ajuda.figure :src="asset('assets/images/manual/registro/landing-page.png')" descricao="Landing Page" />


                                <x-ajuda.figure :src="asset('assets/images/manual/registro/login.png')" descricao="Registro via página login" />

                                <p>
                                    O acesso à página de planos pode ocorrer tanto pela <strong>Landing Page</strong> — ao
                                    rolar a tela até os módulos ou clicando no menu <strong>Planos</strong> —
                                    quanto pela página de login, por meio do botão <strong>"Faça seu registro"</strong>
                                    <x-ajuda.link-figura format />. Em ambos os casos, o usuário será direcionado para a
                                    tela com os planos disponíveis.
                                </p>

                                <p>
                                    A tela apresenta inicialmente os planos do módulo <strong>Remarketing</strong>
                                    <x-ajuda.link-figura format />,
                                    com a possibilidade de navegação pelas abas para visualizar os módulos de
                                    <strong>Cobranças</strong> <x-ajuda.link-figura format />,
                                    <strong>Faturamento</strong> <x-ajuda.link-figura format />
                                    e <strong>Rastreamento</strong> <x-ajuda.link-figura format />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/registro/remarketing.png')" descricao="Plano Remarketing" />
                                <x-ajuda.figure :src="asset('assets/images/manual/registro/cobrancas.png')" descricao="Plano Cobranças" />
                                <x-ajuda.figure :src="asset('assets/images/manual/registro/faturamento.png')" descricao="Plano Faturamento" />
                                <x-ajuda.figure :src="asset('assets/images/manual/registro/rastreamento.png')" descricao="Plano Rastreamento" />
                                <p>
                                    Cada módulo da plataforma disponibiliza <u>quatro opções de planos</u>, sendo possível
                                    adquirir
                                    <u>um plano por módulo</u>, conforme a necessidade de uso.
                                </p>

                                <p>
                                    Para iniciar o processo de registro, basta selecionar um dos planos disponíveis clicando
                                    no botão
                                    <strong>Selecionar</strong> correspondente ao plano e módulo desejado.
                                </p>

                                <p>
                                    Após a seleção, a tela de registro será exibida <x-ajuda.link-figura format />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/registro/registro.png')" descricao="Tela registro" />

                                <p>
                                    Todos os campos do formulário devem ser preenchidos. A senha informada deve conter no
                                    mínimo
                                    <u>8 caracteres</u>, incluindo ao menos: <u>1 letra maiúscula</u>,
                                    <u>1 número</u> e <u>1 caractere especial</u> entre os seguintes:
                                    <code>@$!%*#?&</code>.
                                </p>

                                <p>
                                    É obrigatória a marcação da caixa de seleção que confirma a leitura e aceitação dos
                                    <u>Termos de Uso</u> e da <u>Política de Privacidade</u>.
                                </p>

                                <p>
                                    Com todos os dados preenchidos e a declaração marcada, o próximo passo é clicar no botão
                                    <strong>Registrar</strong>.
                                </p>

                                <p>
                                    Em seguida, um código de <u>6 dígitos</u> será enviado automaticamente para o e-mail
                                    informado
                                    durante o cadastro, conforme ilustrado na <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/registro/email-codigo.png')" descricao="Exemplo email com código" />


                                <p>
                                    Após o envio do e-mail, o sistema redireciona automaticamente para a tela de
                                    confirmação, onde será necessário
                                    informar o código recebido. </p>
                                <p> O código pode ser copiado diretamente do e-mail e colado no primeiro campo,
                                    ou digitado manualmente, número por número, no formulário de verificação
                                    <x-ajuda.link-figura format />.
                                </p>

                                <p>
                                    Recomenda-se verificar a caixa de <u>spam</u>, pois o e-mail pode ter sido redirecionado
                                    para lá por ser o primeiro envio da plataforma.
                                </p>

                                <p>
                                    Caso o e-mail com o código de confirmação não seja recebido, existe a opção de
                                    reenviá-lo.
                                    Logo abaixo do botão <strong>Enviar</strong>, na tela de confirmação
                                    (<a href="#figura9"><strong>figura 9</strong></a>), encontra-se a pergunta
                                    <u><em>Não recebeu o e-mail?</em></u>, seguida do link <strong>Reenviar</strong>,
                                    conforme demonstrado na <a href="#figura9"><strong>figura 9</strong></a>.
                                    Ao clicar nesse link, um novo e-mail com o código será enviado.
                                </p>
                                <x-ajuda.figure :src="asset('assets/images/manual/registro/codigo-confirmacao.png')" descricao="Tela de confirmação" />


                                <p>
                                    Após a inserção do código, deve-se clicar no botão <strong>Enviar</strong>.
                                </p>

                                <p>
                                    Em seguida, um e-mail será enviado contendo os dados necessários para acesso, como o
                                    e-mail cadastrado e a senha definida, conforme ilustrado na <x-ajuda.link-figura />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/registro/email-dados.png')" descricao="Exemplo e-mail dados login" />

                                <p>
                                    Simultaneamente ao envio do e-mail com os dados de acesso, o sistema redireciona
                                    automaticamente para a tela de perfil
                                    <x-ajuda.link-figura format />.
                                </p>

                                <x-ajuda.figure :src="asset('assets/images/manual/registro/perfil.png')" descricao="Tela perfil" />


                                <p>
                                    A tela exibida, por padrão apresenta os campos para cadastro como <u>Pessoa Física</u>.
                                    Nesse caso, basta preencher as informações solicitadas e manter o campo <u>Tipo de
                                        conta</u>
                                    (destacado na <a href="#figura11"><strong>figura 11</strong></a>) selecionado como
                                    Pessoa Física.
                                </p>

                                <p>
                                    Para cadastro como <u>Pessoa Jurídica</u>, é necessário alterar a opção no campo
                                    <u>Tipo de conta</u> para Pessoa Jurídica (também destacado na
                                    <a href="#figura11"><strong>figura 11</strong></a>). Com isso, os campos
                                    <u>Razão Social</u> e <u>CNPJ</u> serão exibidos para preenchimento, conforme ilustrado
                                    em
                                    <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/registro/perfil-pj.png')" descricao="Tela perfil pj" />


                                <p>
                                    Após o preenchimento dos dados, deve-se clicar no botão <strong>Salvar</strong>.
                                </p>

                                <p>
                                    Se a opção escolhida for um plano <u>Free Trial</u>, o sistema redireciona
                                    automaticamente para o dashboard
                                    (<a href="{{ route('central.ajuda.dashboard') }}"><strong>acessar
                                            diretamente</strong></a>).
                                    No caso da seleção de um plano <u>pago</u>, o redirecionamento será para a tela de
                                    pagamento, conforme ilustrado em
                                    <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/pagamento.png')" descricao="Tela pagamento" />


                                <p>
                                    Havendo um cupom de desconto, o código deve ser inserido no campo
                                    <strong>"Cupom de desconto"</strong>, conforme indicado em <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/pagamento-add-cupom.png')" descricao="Tela pagamento informar cupom desconto" />


                                <p>
                                    Após inserir o código no campo <u>Cupom de desconto</u>, é necessário clicar no botão
                                    <strong>Aplicar</strong>.
                                </p>

                                <p>
                                    O sistema verificará a validade do cupom e aplicará o desconto automaticamente no valor
                                    do pagamento.
                                    Cada cupom possui configurações específicas, que devem ser informadas no momento do
                                    recebimento.
                                    Em caso de dúvidas, recomenda-se solicitar suporte por meio do chat (ícone azul
                                    localizado no canto inferior direito da página).
                                </p>

                                <p>
                                    Após a confirmação do cupom, uma mensagem será exibida informando o valor do desconto
                                    aplicado,
                                    e o valor final do pagamento será atualizado, conforme ilustrado em
                                    <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/pagamento-cupom-ok.png')" descricao="Tela pagamento cupom desconto aceito" />

                                <p>
                                    Após a confirmação da aplicação do cupom, deve-se clicar no botão
                                    <strong>Realizar Pagamento</strong> para prosseguir com o processo.
                                </p>

                                <p>
                                    Na tela seguinte <x-ajuda.link-figura format />, será necessário selecionar o método de
                                    pagamento desejado.
                                    As opções disponíveis são <u>Cartão de Crédito</u> e <u>Pix</u>,
                                    bastando clicar no botão correspondente.
                                </p>



                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/tipo-pagamento.png')" descricao="Tela seleção tipo pagamento" />


                                <p>
                                    Ao selecionar a opção <strong>Cartão de Crédito</strong>, será exibida a tela para
                                    preenchimento dos dados do cartão, conforme ilustrado em <x-ajuda.link-figura />.
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/pagamento-cartao.png')" descricao="Tela pagamento cartão" />


                                <p>
                                    Os dados do cartão são protegidos por criptografia <u>SSL</u>. No momento do envio, é
                                    gerado um <u>token</u> utilizado para processar o pagamento. Nenhuma informação do
                                    cartão é armazenada no banco de dados da plataforma, sendo mantido apenas o token para
                                    possíveis pagamentos futuros junto à financeira.
                                </p>

                                <p>
                                    Após o preenchimento dos dados, deve-se clicar no botão <strong>Realizar
                                        Pagamento</strong>.
                                    Caso prefira utilizar <u>Pix</u>, basta clicar no botão <strong>Pagar com Pix</strong>,
                                    que redireciona para a respectiva tela de pagamento via <u>Pix</u>
                                    <x-ajuda.link-figura />.
                                </p>

                                <p>
                                    Se o pagamento via cartão for aprovado, o redirecionamento será feito automaticamente
                                    para o dashboard
                                    (<a href="{{ route('central.ajuda.dashboard') }}"><strong>acessar
                                            diretamente</strong></a>).
                                </p>

                                <p>
                                    Para pagamentos via <strong>Pix</strong>, o sistema direciona para a tela correspondente
                                    (<a href="#figura18"><strong>figura 18</strong></a>).
                                </p>


                                <x-ajuda.figure :src="asset('assets/images/manual/financeiro/pagamento-pix.png')" descricao="Tela pagamento pix aceito" />

                                <p>
                                    Para realizar o pagamento via cartão, clique no botão <strong>Pagar com Cartão</strong>,
                                    que redireciona para a tela de pagamento com cartão
                                    (<a href="#figura17"><strong>figura 17</strong></a>).
                                </p>

                                <p>
                                    No caso do pagamento via <u>Pix</u>, é possível escanear o <u>QR Code</u> exibido ou
                                    utilizar o código no formato <u>copia e cola</u>.
                                </p>

                                <p>
                                    Após concluir o pagamento, aguarde alguns segundos e clique no botão <strong>Confirmar
                                        Pagamento</strong>.
                                </p>

                                <p>
                                    Com a confirmação do pagamento, o redirecionamento para o dashboard será realizado
                                    automaticamente
                                    (<a href="{{ route('central.ajuda.dashboard') }}"><strong>acessar
                                            diretamente</strong></a>).
                                </p>

                                <hr>

                                <p>
                                    As instruções referentes à tela de registro se encerram neste ponto. O próximo passo é a
                                    apresentação do dashboard.
                                </p>

                                <p>
                                    Para acessar o conteúdo, clique em
                                    <a href="{{ route('central.ajuda.dashboard') }}"><strong>clique aqui</strong></a>
                                    ou utilize o menu <u>Dashboard</u>.
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
