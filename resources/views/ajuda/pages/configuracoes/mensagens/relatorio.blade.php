@php
    session(['figura_base' => 151]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Configuração - Mensagens - Relatório')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">
                        Apresentação da página de relatório das mensagens
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
    <p>Esta é a página que apresenta o relatório das mensagens cadastradas (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/index-sem-erro.png')" descricao="Página de relatório das mensagens" />

    <p>No relatório, cada linha apresenta os ícones de ação que permitem visualizar, editar suas configurações de envio, editar o texto da ou excluir a mensagem.</p>

    <ul class="lista-personalizada">

    <li">
        <p>O ícone em azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite visualizar a mensagem e suas configurações.</p>
    </li>
    <li">
        <p>O ícone em preto (<i style="color: black;" class="ti ti-settings fs-7"></i>) abre a página de edição das configurações de envio.</p>
    </li>
    <li">
        <p>O ícone em azul escuro (<i class="ti ti-edit fs-7 text-primary"></i>) permite editar o conteúdo da mensagem.</p>
    </li>
    <li">
        <p>O ícone em laranja (<i class="ti ti-trash fs-7 text-danger"></i>) exclui a mensagem cadastrada.</p>
    </li>
    </ul>

    <p>Caso exista alguma mensagem cadastrada sem configuração de envio, será exibida uma notificação na página de relatório, e a linha correspondente ficará destacada em vermelho (<x-ajuda.link-figura />).</p>
    <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/index.png')" descricao="Relatório com destaque de mensagens sem configuração de envio" />

    <p>Para configurar o envio, clique no ícone <i style="color: black;" class="ti ti-settings fs-7"></i>, selecione as opções desejadas, configure conforme necessário e clique em <strong>Atualizar</strong>.</p>

    <p>A seguir, serão demonstradas todas as telas relacionadas a cada um dos ícones de ação.</p>

    <p><em>Como os dados exibidos no relatório são fictícios, foi incluído um exemplo de cada tipo de mensagem para fins de explicação detalhada.</em></p>

    <ul class="lista-personalizada">
    <li>
        <p><u>Visualização da mensagem</u></p>
        <p>Ao clicar no ícone de visualização (<i class="ti ti-eye fs-7 text-secondary"></i>), será exibida a tela com os detalhes da mensagem.</p>
        <ul style="list-style-type: disc; padding-left: 20px; margin-left: 20px;">
            <li>
                <p>A página de visualização dos subtipos do tipo Faturamento possui estrutura padronizada (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/view-faturamento.png')" descricao="Visualização da mensagem de Faturamento" />
                <p>São exibidos: <u>Nome da mensagem</u>, <u>Tipo</u> e <u>Descrição</u>.</p>
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> exibe a visualização da mensagem do tipo Pesquisa Satisfação.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/view-pesquisa.png')" descricao="Visualização da mensagem Pesquisa Satisfação" />
                <p>São exibidos: <u>Nome da mensagem</u>, <u>Tipo</u>, <u>Pesquisa Satisfação</u> e <u>Opções de envio</u>.</p>
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> mostra a visualização da mensagem do tipo Aniversário.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/view-aniversario.png')" descricao="Visualização da mensagem Aniversário" />
                <p>São exibidos: <u>Nome da mensagem</u>, <u>Tipo</u>, <u>Descrição</u> e <u>Opções de envio</u>.</p>
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> mostra a visualização da mensagem do tipo Agradecimento.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/view-agradecimento.png')" descricao="Visualização da mensagem Agradecimento" />
                <p>São exibidos: <u>Nome da mensagem</u>, <u>Tipo</u>, <u>Descrição</u> e <u>Opções de envio</u>.</p>
            </li>
            <li>
                <p>A visualização dos subtipos do tipo Cobranças segue o mesmo padrão (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/view-cobrancas.png')" descricao="Visualização da mensagem Cobranças" />
                <p>São exibidos: <u>Nome da mensagem</u>, <u>Tipo</u> e <u>Descrição</u>.</p>
            </li>
        </ul>
        <p>Para retornar ao relatório, clique em <strong>Voltar</strong>.</p>
    </li>


    <li>
        <p><u>Edição das configurações de envio</u></p>
        <p>Ao clicar no ícone (<i style="color: black;" class="ti ti-settings fs-7"></i>), será aberta a página de edição das configurações de envio.</p>
        <ul style="list-style-type: disc; padding-left: 20px; margin-left: 20px;">
            <li>
                <p>No caso das mensagens do tipo Faturamento, será exibida uma notificação informando que a configuração deve ser realizada diretamente no módulo Faturamento (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/erro-config-faturamento.png')" descricao="Aviso de configuração via módulo Faturamento" />
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> mostra a edição da configuração da mensagem do tipo Pesquisa Satisfação.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-config-pesquisa.png')" descricao="Configuração de envio da mensagem Pesquisa Satisfação" />
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> mostra a edição da configuração da mensagem do tipo Aniversário.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-config-aniversario.png')" descricao="Configuração de envio da mensagem Aniversário" />
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> mostra a edição da configuração da mensagem do tipo Agradecimento.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-config-agradecimento.png')" descricao="Configuração de envio da mensagem Agradecimento" />
            </li>
            <li>
                <p>No caso das mensagens do tipo Cobranças, também será exibida uma notificação indicando que a configuração deve ser feita no módulo Cobranças (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/erro-config-cobrancas.png')" descricao="Aviso de configuração via módulo Cobranças" />
            </li>
        </ul>
        <p>Após configurar conforme necessário, clique em <strong>Atualizar</strong> para salvar e retornar ao relatório.</p>
    </li>

    <li>
        <p><u>Edição da mensagem</u></p>
        <p>Ao clicar no ícone (<i class="ti ti-edit fs-7 text-primary"></i>), será aberta a página para editar a descrição da mensagem.</p>
        <p>Em destaque, é informado que os textos entre <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong> podem ser arrastados para o campo da mensagem. Caso sejam digitados, devem ser mantidos exatamente como o padrão para que sejam substituídos corretamente.</p>
        <p>Emojis utilizados no WhatsApp podem ser inseridos no texto.</p>
        <p>Para remover os textos entre <strong>&#123;&#123;&nbsp;&nbsp;&#125;&#125;</strong>, é necessário excluir manualmente cada caractere (as chaves, o conteúdo e os espaços).</p>
        <ul style="list-style-type: disc; padding-left: 20px; margin-left: 20px;">
            <li>
                <p>A página de edição das mensagens do tipo Faturamento segue um modelo padronizado (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-faturamento.png')" descricao="Edição da mensagem do tipo Faturamento" />
                <p>Se houver alteração nas opções de envio de links, adicione ou remova o conteúdo <strong>&#123;&#123; link-xml &#125;&#125;</strong> ou <strong>&#123;&#123; link-nfe &#125;&#125;</strong> conforme necessário.</p>
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> apresenta a edição da mensagem do tipo Pesquisa Satisfação.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-pesquisa.png')" descricao="Edição da mensagem Pesquisa Satisfação" />
                <p>Para mais detalhes sobre esse tipo de mensagem, acesse o conteúdo <a href="{{ route('central.ajuda.config.mensagens.pesquisa.satisfacao') }}"><strong>clicando aqui</strong></a>.</p>
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> apresenta a edição da mensagem do tipo Aniversário.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-aniversario.png')" descricao="Edição da mensagem Aniversário" />
            </li>
            <li>
                <p>A <x-ajuda.link-figura /> apresenta a edição da mensagem do tipo Agradecimento.</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-agradecimento.png')" descricao="Edição da mensagem Agradecimento" />
            </li>
            <li>
                <p>A página de edição das mensagens do tipo Cobranças segue estrutura semelhante (<x-ajuda.link-figura />).</p>
                <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/edit-cobrancas.png')" descricao="Edição da mensagem Cobranças" />
            </li>
        </ul>
        <p>Após realizar as alterações, clique em <strong>Atualizar</strong> para salvar e retornar ao relatório.</p>
    </li>

    <li>
        <p><u>Exclusão da mensagem</u></p>
        <p>Ao clicar no ícone (<i class="ti ti-trash fs-7 text-danger"></i>), será exibida uma confirmação de exclusão na parte superior da página (<x-ajuda.link-figura />).</p>
        <x-ajuda.figure :src="asset('assets/images/manual/configuracoes/mensagens/relatorio/deletar.png')" descricao="Confirmação de exclusão de mensagem" />
        <p>Para confirmar a exclusão, clique em <strong>Sim</strong>. Para cancelar, clique em <strong>Cancelar</strong>, retornando ao relatório sem excluir a mensagem.</p>
    </li>
    <hr class="linha-dupla">

    <p>As instruções sobre o relatório das mensagens encerram-se aqui. <br> O próximo tópico aborda os Dados Importados.</p>
    <p>Para acessar esse conteúdo, <a href="{{ route('central.ajuda.config.dados.importados.apresentacao') }}"><strong>clique aqui</strong></a> ou navegue até o menu <u>Configurações > Dados Importados > Apresentação</u>.</p>
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
