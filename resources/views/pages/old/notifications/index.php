<?php include_once APP . "/Views/layouts/header.php"; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Notificações</h2>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a data-bs-toggle="modal" data-bs-target="#modalFiltro" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center btn-filtro">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 24 24">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            Filtrar informações
        </a>
    </div>
</div>
<div class="card card-body border-0 shadow table-wrapper table-responsive">
    <table class="table table-hover datatable">
        <thead class="thead-light">
            <tr>
                <th class="border-gray-200">#</th>
                <th class="border-gray-200">contrato</th>
                <th class="border-gray-200">nome</th>
                <th class="border-gray-200">Vencimento</th>
                <th class="border-gray-200">Valor</th>
                <th class="border-gray-200">situacao</th>
                <th class="border-gray-200">data e hora</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cont = 1;
            foreach (Notificacoes::listar() as $notificacao) : ?>
                <tr>
                    <td class="fw-bold"><?= $cont ?></td>
                    <td class="fw-bold tb-notif"><?= $notificacao->numeroContrato != 0 ? $notificacao->numeroContrato : '' ?></td>
                    <td class="fw-bold"><?php echo substr($notificacao->nome, 0, 30); ?></td>
                    <td class="fw-bold"><?= $notificacao->venc ?></td>
                    <td class="fw-bold tb-notif"><?= $notificacao->valor ?></td>
                    <?php if ($notificacao->situacao == 'Notificado') { ?>
                        <td class="fw-bold"><button type="button" class="btn btn-success btn-fino"><?= $notificacao->situacao ?></button></td>
                    <?php } else { ?>
                        <td class="fw-bold"><button type="button" class="btn btn-danger btn-fino"><?= $notificacao->situacao ?></button></td>
                    <?php } ?>
                    <td class="fw-bold"><?= $notificacao->dataehora ?></td>
                </tr>
            <?php $cont++;
            endforeach; ?>
        </tbody>
    </table>
</div>
<?php include_once APP . "/Views/notificacoes/modal_filtro.php"; ?>
<?php include_once APP . "/Views/layouts/footer.php"; ?>