@php
    session(['figura_base' => 217]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Sugestões')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="fw-semibold m-8">Explicações sobre a seção de Sugestões</h2>
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
    <p>Esta é a seção Sugestões, um espaço colaborativo
        dedicado à melhoria contínua do sistema Hippo Notify.</p>
    <p>Nessa área, os usuários podem compartilhar ideias, propor melhorias e contribuir com
        comentários tanto em suas próprias publicações quanto nas de outros usuários.</p>
    <p>O objetivo é promover a troca de experiências e estimular a construção coletiva de
        soluções que tornem o sistema cada vez melhor para todos.</p>

    <br>
    <p><u><em>
        Antes de continuarmos, informamos que os dados apresentados são
                fictícios.
    </em></u></p>
    <br>

    <p>A <x-ajuda.link-figura />
        exibe a página do relatório de
        publicações da seção Sugestões.</p>

    <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/index.png')"
        descricao="Tela com relatório das publicações de sugestões" />

    <p>Na parte superior do relatório, está disponível o botão <strong>Nova Sugestão</strong>
        (botão azul), que, ao ser acionado, abre a página para adicionar uma nova publicação
        (<x-ajuda.link-figura format />).</p>

    <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/novo.png')" descricao="Tela para adicionar uma publicação" />

    <p>O campo <u>Texto da sugestão</u> deve ser preenchido conforme a ideia a ser sugerida. Em
        seguida, ao clicar em <strong>Publicar</strong>, a sugestão será salva e a tela
        retornará ao relatório.</p>
    <p><em>O texto da sugestão pode incluir emojis, como os utilizados no WhatsApp.</em></p>
    <hr>

    <p>Como pode observar no relatório (<a href="#figura217"><strong>Figura 217</strong></a>),
        cada linha apresenta ícones de ação. Quando o autor da
        publicação for o usuário atual do sistema, serão exibidos os ícones de visualizar,
        editar e deletar a publicação. Caso contrário, será exibido apenas o ícone de
        visualizar.</p>

    <p>O ícone azul claro (<i class="ti ti-eye fs-7 text-secondary"></i>) permite visualizar a
        publicação, os comentários e também adicionar um novo comentário.</p>
    <p>O ícone azul escuro (<i class="ti ti-edit fs-7 text-primary"></i>) permite editar o
        conteúdo da publicação.</p>
    <p>O ícone laranja (<i class="ti ti-trash fs-7 text-danger"></i>) permite excluir a
        publicação. No entanto, caso a publicação já tenha comentários, o botão de exclusão não
        será exibido na linha do registro.</p>

    <p>Mostraremos todas as telas correspondentes ao clique em todos os ícones de ação.</p>
    <ul class="lista-personalizada">
        <li>
            <p>Ao clicar no ícone para visualizar ( <i
                    class="ti ti-eye fs-7 text-secondary"></i> ) de cada registro, vai abrir a
                tela de
                visualização <x-ajuda.link-figura format />
                , contendo
                possíveis comentários e um campo onde poderá adicionar seu próprio comentário
                sobre a sugestão.</p>
            <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/view.png')"
                descricao="Tela de visualização da sugestão e comentários" />

            <p>À direita de cada sugestão, há um botão azul com o rótulo <strong>Votar</strong>,
                que permite registrar seu voto na publicação.</p>
            <p>As sugestões mais votadas terão prioridade na análise e possível implementação.
            </p>
            <p><em>Observação: o autor da sugestão não pode votar na própria publicação.</em>
            </p>
            <p>Ao acionar o botão <strong>Votar</strong>, ele será alterado para <strong>Remover
                    voto</strong> (botão laranja) e a contagem de votos, exibida à esquerda do
                botão, será aumentada em uma unidade, conforme ilustrado na
                <x-ajuda.link-figura />
                .</p>
            <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/votado.png')"
                descricao="Tela de visualização da publicação com voto ativo" />

            <p>Ao clicar no botão <strong>Remover voto</strong> (botão laranja), um voto é
                subtraído da contagem exibida à esquerda. Em seguida, o botão retorna ao estado
                anterior:
                <strong>Votar</strong> (botão azul).
            </p>


            <hr>
            <p>Conforme apresentado na <a href="#figura219"><strong>Figura 219</strong></a>, os
                comentários não podem ser editados. No entanto, quando o comentário for do
                próprio autor, será exibido o botão <strong>Deletar</strong> (botão laranja),
                posicionado à frente do nome do autor.</p>
            <p>Ao acionar o botão <strong>Deletar</strong>, uma mensagem de confirmação será
                exibida conforme mostra a <x-ajuda.link-figura />
                .
            </p>
            <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/deletar-comentario.png')"
                descricao="Mensagem de confirmação para deletar o comentário" />

            <p>Caso a opção <strong>Sim</strong> seja escolhida, o comentário será excluído e a
                visualização retornará à publicação original, já sem o comentário removido.</p>
            <p>Ao selecionar <strong>Cancelar</strong>, a mensagem de confirmação será apenas
                ocultada, sem que nenhuma alteração seja feita nos comentários.</p>

            <p>Na tela de visualização da publicação (<a href="#figura219"><strong>Figura
                        219</strong></a>), está disponível o campo <u>Adicionar comentário</u>.
            </p>
            <p>Esse campo permite a inserção de um comentário, que será salvo ao clicar no
                botão <strong>Comentar</strong>, retornando à visualização da publicação com o
                novo comentário exibido no topo.</p>
            <p><em>O texto do comentário pode incluir emojis, como os utilizados no
                    WhatsApp.</em></p>
        </li>
        <li>
            <p>Ao clicar no ícone para editar a publicação ( <i
                    class="ti ti-edit fs-7 text-primary"></i> ), vai
                abrir a tela <x-ajuda.link-figura format />
                .</p>
            <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/editar.png')"
                descricao="Tela para editar o texto da publicação" />

            <p>É possível editar o texto da sugestão, incluindo emojis utilizados no WhatsApp.
            </p>
            <p>Após realizar as alterações desejadas, clique em <strong>Atualizar</strong> para
                salvar e retornar ao relatório.</p>
            <p>Se optar por não editar, clique em <strong>Cancelar</strong>.</p>
            <p><em>Observação: ao editar uma publicação, a data da última edição será exibida na
                    visualização,
                    com a palavra <u>(Editado)</u> à direita da data.</em></p>
        </li>
        <li>
            <p>Para deletar uma publicação (desde que não possua comentários), clique no ícone
                <i class="ti ti-trash fs-7 text-danger"></i> localizado na linha correspondente
                à publicação que se deseja excluir.
            </p>
            <p>Ao clicar, será exibida uma mensagem de confirmação perguntando se a exclusão
                deve realmente ser realizada, conforme mostrado na <x-ajuda.link-figura />.</p>

            <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/deletar.png')" descricao="Mensagem de confirmação da exclusão" />


            <p>Para confirmar a exclusão, clique em <strong>Sim</strong>. A publicação será
                removida e a tela retornará ao relatório.</p>
            <p>Caso desista, clique em <strong>Cancelar</strong>, o que apenas fechará a
                mensagem sem alterar as publicações.</p>
        </li>
    </ul>
    <hr>
    <p>A <x-ajuda.link-figura /> exibe novamente a tela do
        relatório de publicações, destacando o funcionamento do campo
        <u>Votos</u> no relatório.
    </p>

    <x-ajuda.figure :src="asset('assets/images/manual/sugestoes/index-voto.png')" descricao="Tela do relatório das publicações com voto" />

    <p><u>
        <em>
            O relatório exibe as publicações ordenadas pela data mais recente e, entre elas, prioriza
                aquelas com maior número de votos contabilizados.
        </em>
    </u></p>
    <hr class="linha-dupla">
    <br>
    <p>Chegamos ao fim da apresentação do sistema Hippo Notify, passando por todas as
        funcionalidades ao longo das seções desta Central de Ajuda.</p>
    <p>Agradecemos por acompanhar este tutorial até aqui.</p>
    <p>Se ainda restarem dúvidas, nossa equipe está sempre disponível para ajudar.</p>
    <p>Basta clicar
        no botão azul de chat (localizado no canto inferior direito da tela) para falar conosco.
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
