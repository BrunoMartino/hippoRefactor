<?php include_once APP . "/Views/layouts/header.php"; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Mensagens</h2>
    </div>
</div>
<div class="card card-body border-0 shadow table-wrapper table-responsive">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th class="border-gray-200 text-center">#</th>
                <th class="border-gray-200 text-center">Tipo</th>
                <th class="border-gray-200 text-center">qtd dias <br> antecipados</th>
                <th class="border-gray-200 text-center">qtd envios <br> antecipados</th>
                <th class="border-gray-200 text-center">qtd envios <br> vencidos</th>
                <th class="border-gray-200 text-center">intervalo <br> dias envio</th>
                <th class="border-gray-200 text-center">intervalo <br> horas vencimento</th>
                <th class="border-gray-200 text-center">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cont = 1;
            foreach (Mensagens::listar() as $mensagem) : ?>
                <tr>
                    <td class="fw-bold"><?= $cont ?></td>
                    <td><?= $mensagem->tipo ?></td>
                    <td class="text-center"><?= $mensagem->qtd_dias_antecipado ?></td>
                    <td class="text-center"><?= $mensagem->qtd_envios_antecipados ?></td>
                    <td class="text-center"><?= $mensagem->qtd_envios_vencidos ?></td>
                    <td class="text-center"><?= $mensagem->intervalo_dias_envio ?></td>
                    <td class="text-center"><?= $mensagem->intervalo_horas_vencimento ?></td>
                    <td class="text-center">
                        <a type="button" href="<?= URL ?>/mensagens/edit/<?= $mensagem->id ?>" class="btn btn-light border-0 py-0 px-1 pt-1" title="Editar">
                            <i class='fas fa-edit' style='font-size:1rem'></i>
                        </a>
                    </td>
                </tr>
            <?php $cont++;
            endforeach; ?>
        </tbody>
    </table>
    <!-- <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination mb-0">
                <li class="page-item">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">5</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <div class="fw-normal small mt-4 mt-lg-0">Showing <b>5</b> out of <b>25</b> entries</div>
    </div> -->
</div>
<?php include_once APP . "/Views/layouts/footer.php"; ?>