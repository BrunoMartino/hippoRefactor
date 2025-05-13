@extends('ajuda.layouts.basic')
@section('title', 'Integrações - Correios')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre a Integração API Correios → SRO - Rastro</h2>
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
                            <div class="h3 mt-2">
                                <p><u>Antes de continuarmos, informamos que os dados apresentados são
                                        fictícios.</u></p>
                                <br>
                                <p>Para realizar a integração com a <u>API STO - Rastro dos Correios</u>, é
                                    necessário atender a alguns pré-requisitos:</p>

                                <ul class="lista-personalizada">
                                    <li>Possuir um <u>contrato ativo</u> com os Correios para serviços de
                                        encomendas ou mensagens;</li>
                                    <li>Ter um <u>cadastro válido</u> no portal Meu Correios:
                                        <a href="https://meucorreios.correios.com.br/" target="_blank"
                                            rel="noopener noreferrer">https://meucorreios.correios.com.br/</a>;
                                    </li>
                                    <li>Obter uma <u>senha de acesso à API</u> no portal Correios API:
                                        <a href="https://cws.correios.com.br/" target="_blank"
                                            rel="noopener noreferrer">https://cws.correios.com.br/</a>.
                                    </li>
                                </ul>

                                <p>Sem um contrato com os Correios, não é possível utilizar a API. Caso ainda não exista um
                                    contrato ativo, é necessário providenciar a contratação diretamente pelo site dos
                                    Correios ou em uma agência autorizada.</p>

                                <p>Com todos os pré-requisitos atendidos, a integração poderá ser realizada normalmente por
                                    meio do sistema <strong>Hippo Notify</strong>.</p>
                                <hr>

                                <p>Para acessar diretamente o tutorial de configuração no sistema, basta
                                    <a href="#integracao-hippo"><strong>clicar aqui</strong></a>.
                                </p>

                                <p>Iremos dar início às explicações de como se cadastrar no Meu Correios e configurar a
                                    chave de acesso da API.</p>
                                <p>Se mesmo com o passo a passo a seguir ainda surgir alguma dúvida, não se preocupe — nossa
                                    equipe está pronta para ajudar.</p>
                                <p>É só clicar no botão azul de chat, no canto inferior direito da tela, e falar com a
                                    gente.</p>

                                <p>O cadastro no portal Meu Correios pode ser feito 👉 <a
                                        href="https://meucorreios.correios.com.br/" target="_blank"
                                        rel="noopener noreferrer">
                                        <strong>clicando aqui</strong>
                                    </a>, que direciona à página
                                    inicial do serviço (<a href="#figura213"><strong>figura 213</strong></a>). </p>

                                <figure class="text-center scroll-offset" id="figura213">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/tela-meu-correios.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela inicial do site Meu Correios">
                                    <figcaption class="mt-2 text-muted">Figura 213 - Tela inicial do site Meu Correios
                                    </figcaption>
                                </figure>
                                <p>Para fazer o cadastro, basta clicar no botão destacado: Fazer
                                    cadastro</p>
                                <p>Abrirá a tela de seleção do tipo de perfil desejado para o cadastro (<a
                                        href="#figura214"><strong>figura 214</strong></a>).</p>
                                <figure class="text-center scroll-offset" id="figura214">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/cadastrar.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela de seleção do perfil para cadastro">
                                    <figcaption class="mt-2 text-muted">Figura 214 - Tela de seleção do perfil para cadastro
                                    </figcaption>
                                </figure>
                                <p>A maioria dos clientes é formada por empresas, por isso o exemplo será com o cadastro de
                                    <strong>Pessoa Jurídica</strong>. No caso de <strong>Pessoa Física</strong>, é só
                                    escolher essa opção e preencher os dados.
                                </p>

                                <p>Para cadastrar como <u>Pessoa Jurídica</u>, basta escolher a opção e clicar em
                                    <strong>Prosseguir</strong>.
                                </p>

                                <p>Após isso, a tela de cadastro de Pessoa Jurídica será exibida (<a
                                        href="#figura215"><strong>figura 215</strong></a>).</p>


                                <figure class="text-center scroll-offset" id="figura215">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/tela-cadastro.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela de cadastro da pessoa jurídica">
                                    <figcaption class="mt-2 text-muted">Figura 215 - Tela de cadastro da pessoa jurídica
                                    </figcaption>
                                </figure>
                                <p>Escolha se é contribuinte ICMS. Se não for, deixe desmarcado. Depois, selecione como
                                    prefere receber o token de confirmação (controle dos Correios). Após preencher todos os
                                    dados, clique em <strong>Salvar</strong>.</p>
                                <hr>

                                <p>Se a opção escolhida for celular, será exibida a janela mostrada na <a
                                        href="#figura216"><strong>figura 216</strong></a>.</p>
                                <figure class="text-center scroll-offset" id="figura216">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/celular.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Janela para informar código recebido via celular">
                                    <figcaption class="mt-2 text-muted">Figura 216 - Janela para informar código recebido
                                        via celular</figcaption>
                                </figure>
                                <p>O código chega por SMS no celular cadastrado. Informe os 6 dígitos e clique em
                                    <strong>Enviar</strong>.
                                </p>
                                <hr>

                                <p>Se a opção escolhida for e-mail, a janela exibida será a da <a
                                        href="#figura217"><strong>figura 217</strong></a>.</p>
                                <figure class="text-center scroll-offset" id="figura217">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/email.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Janela para informar código recebido via email">
                                    <figcaption class="mt-2 text-muted">Figura 217 - Janela para informar código recebido
                                        via email</figcaption>
                                </figure>
                                <p>O código chega no e-mail cadastrado. Informe os 6 dígitos e clique em
                                    <strong>Enviar</strong>.
                                </p>
                                <hr>

                                <p>Com o código correto, a página do perfil no Meu Correios será exibida (<a
                                        href="#figura218"><strong>figura 218</strong></a>).</p>
                                <figure class="text-center scroll-offset" id="figura218">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/perfil.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela de perfil do site Meu Correios">
                                    <figcaption class="mt-2 text-muted">Figura 218 - Tela de perfil do site Meu Correios
                                    </figcaption>
                                </figure>
                                <p>Pronto! O cadastro no Meu Correios foi finalizado com sucesso.</p>
                                <hr class="linha-dupla">

                                <p>Para criar a senha de acesso à API Correios SRO-Rastro, acesse o site <a
                                        href="https://cws.correios.com.br/" target="_blank"
                                        rel="noopener noreferrer">https://cws.correios.com.br/</a>.</p>
                                <p>Ao entrar no site, abrirá a janela inicial (<a href="#figura219"><strong>figura
                                            219</strong></a>).</p>
                                <figure class="text-center scroll-offset" id="figura219">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/cws.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela inicial do site Correios Web Service">
                                    <figcaption class="mt-2 text-muted">Figura 219 - Tela inicial do site Correios Web
                                        Service
                                    </figcaption>
                                </figure>
                                <p>Clique em <strong>Entrar</strong> (canto superior direito) para abrir a tela de login (<a
                                        href="#figura220"><strong>figura 220</strong></a>).</p>
                                <figure class="text-center scroll-offset" id="figura220">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/login-cws.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela de login do site CWS">
                                    <figcaption class="mt-2 text-muted">Figura 220 - Tela de login do site CWS
                                    </figcaption>
                                </figure>
                                <p>Informe o usuário e a senha <u>cadastrados em Meu Correios</u> e clique em
                                    <strong>Entrar</strong>.
                                </p>
                                <p>Abrirá a tela apresentada na <a href="#figura221"><strong>figura 221</strong></a>.</p>


                                <figure class="text-center scroll-offset" id="figura221">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/gestao-api.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela inicial CWS">
                                    <figcaption class="mt-2 text-muted">Figura 221 - Tela inicial CWS
                                    </figcaption>
                                </figure>
                                <p>Primeiro precisamos gerar a senha de acesso a API, para isso clique no link
                                    <strong>Gestão de acesso a API's</strong>.
                                </p>
                                <p>Ao clicar no link, abrirá a tela onde iremos gerar a senha (<a
                                        href="#figura222"><strong>figura 222</strong></a>).</p>

                                <figure class="text-center scroll-offset" id="figura222">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/gerar-codigo.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela para gerar a senha da API">
                                    <figcaption class="mt-2 text-muted">Figura 222 - Tela para gerar a senha da API
                                    </figcaption>
                                </figure>
                                <p>
                                <p>Nessa tela, os campos de usuário e senha do Meu Correios geralmente já vêm preenchidos
                                    com os dados do login. Se estiverem preenchidos, clique em <strong>Gerar
                                        código</strong>. Caso contrário, preencha os dados e depois clique em <strong>Gerar
                                        código</strong>.</p>
                                </p>
                                <p>ao clicar no botão, abrirá a janela com o código de acesso (<a
                                        href="#figura223"><strong>figura 223</strong></a>).</p>

                                <figure class="text-center scroll-offset" id="figura223">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/codigo.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Janela de confirmação com o código de acesso">
                                    <figcaption class="mt-2 text-muted">Figura 223 - Janela de confirmação com o código de
                                        acesso
                                    </figcaption>
                                </figure>

                                <p>Este é o seu código (senha) para acesso à API. Ele será exibido apenas uma vez, então
                                    copie e salve em um local seguro para usar na configuração do sistema Hippo Notify.</p>

                                <p>Se perder o código, é possível gerar um novo, mas será necessário aguardar alguns minutos
                                    novamente.</p>

                                <p>Depois do tempo indicado na janela do código, clique em <strong>Fechar</strong> e retorne
                                    à tela inicial (<a href="#figura224"><strong>figura 224</strong></a>).</p>
                                <figure class="text-center scroll-offset" id="figura224">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/credenciais.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela inicial do site CWS">
                                    <figcaption class="mt-2 text-muted">Figura 224 - Tela inicial do site CWS
                                    </figcaption>
                                </figure>

                                <p>Agora é hora de gerar o token de acesso à API para confirmar o uso da <u>API SRO -
                                        Rastro</u>.</p>
                                <p>
                                    Para isso, clique no botão <strong>Credenciais</strong>.</p>

                                <p>Ao clicar, será exibida a janela para geração do token (<a
                                        href="#figura225"><strong>figura 225</strong></a>).</p>

                                <figure class="text-center scroll-offset" id="figura225">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/gerar-token.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Janela para gerar token de acesso a API">
                                    <figcaption class="mt-2 text-muted">Figura 225 - Janela para gerar token de acesso a
                                        API
                                    </figcaption>
                                </figure>
                                <p>O campo de usuário geralmente já aparece preenchido. Caso não esteja, informe o usuário
                                    manualmente.</p>
                                <p>Em seguida, cole o código de acesso no campo correspondente e preencha o número do
                                    contrato firmado com os Correios no campo de contrato.</p>

                                <p>O cartão de postagem não é obrigatório, pode deixar em branco.</p>

                                <p>Após verificar que os campos de usuário, código de acesso e contrato estão preenchidos
                                    corretamente, clique em <strong>Gerar token</strong>.</p>

                                <p>O token será gerado e exibido no campo <u>Token</u>, como mostrado na <a
                                        href="#figura226"><strong>figura 226</strong></a>.</p>


                                <figure class="text-center scroll-offset" id="figura226">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/token.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Janela com o token de acesso a API">
                                    <figcaption class="mt-2 text-muted">Figura 226 - Janela com o token de acesso a API
                                    </figcaption>
                                </figure>
                                <p>Os campos de usuário e contrato foram ocultados por se tratar de um exemplo. No retorno
                                    real, os campos de usuário, código e contrato estarão preenchidos, e o campo
                                    <u>Token</u> mostrará o token gerado.
                                </p>

                                <p>Não é necessário copiar nada. Basta fechar a janela de credenciais para voltar à tela
                                    inicial (<a href="#figura221"><strong>figura 221</strong></a>).</p>

                                <p>No campo de pesquisa ao lado do botão <strong>Credenciais</strong>, digite <u>rastro</u>.
                                </p>

                                <p>Verifique se a opção <strong>SRO - Rastro</strong> aparece, conforme mostrado na <a
                                        href="#figura227"><strong>figura 227</strong></a>.</p>

                                <figure class="text-center scroll-offset" id="figura227">
                                    <img src="{{ asset('assets/images/manual/integracoes/correios/conferir-api.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Tela inicial com pesquisa pela API Rastro">
                                    <figcaption class="mt-2 text-muted">Figura 227 - Tela inicial com pesquisa pela API
                                        Rastro</figcaption>
                                </figure>

                                <p>Se a opção <strong>SRO - Rastro</strong> for exibida, a configuração da API está
                                    concluída com sucesso.</p>

                                <hr class="linha-dupla"><br>

                                <div class="scroll-offset" id="integracao-hippo">
                                    <p>Pronto! Agora está tudo certo para integrar o sistema Hippo Notify com a API dos
                                        Correios e começar a rastrear suas encomendas.</p>
                                    <p>Para continuar, <a
                                            href="{{ route('central.ajuda.config.sistema.rastreamento') }}#integracao-correios"><strong>clique
                                                aqui</strong></a> ou acesse o menu <u>Configurações > Sistema >
                                            Rastreamento</u> e role a página até encontrar a explicação sobre o botão e o
                                        formulário de integração com os Correios.</p>
                                </div>
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
