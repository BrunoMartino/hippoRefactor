<?php include_once APP . "/Views/layouts/header.php"; ?>
<?php $mensagem = Mensagens::showById();?>
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="<?= URL ?>/dashboard">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="<?= URL ?>/mensagens">Mensagens</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Editar Mensagem </h1>
        </div>
    </div>
</div>

<form method="POST" action="<?= URL ?>/mensagens/update" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">
    <input type="hidden" name="id" value="<?= $mensagem->id ?>">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <label for="tipo">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $mensagem->tipo ?>" required readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <label for="descricao">Mensagem</label>
                            <textarea type="text" class="form-control" id="descricao" name="descricao" rows="10" autofocus required><?= $mensagem->descricao ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="qtd_dias_antecipado">Qtd dias antecipados</label>
                            <input type="text" class="form-control" id="qtd_dias_antecipado" name="qtd_dias_antecipado" value="<?= $mensagem->qtd_dias_antecipado ?>" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="qtd_envios_antecipados">Qtd envios antecipados</label>
                            <input type="text" class="form-control" id="qtd_envios_antecipados" name="qtd_envios_antecipados" value="<?= $mensagem->qtd_envios_antecipados ?>" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="qtd_envios_vencidos">Qtd envios vencidos</label>
                            <input type="text" class="form-control" id="qtd_envios_vencidos" name="qtd_envios_vencidos" value="<?= $mensagem->qtd_envios_vencidos ?>" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="intervalo_dias_envio">Intervalo Dias Envio</label>
                            <input type="text" class="form-control" id="intervalo_dias_envio" name="intervalo_dias_envio" value="<?= $mensagem->intervalo_dias_envio ?>" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="intervalo_horas_vencimento">Intervalo horas vencimento</label>
                            <input type="text" class="form-control" id="intervalo_horas_vencimento" name="intervalo_horas_vencimento" value="<?= $mensagem->intervalo_horas_vencimento ?>" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <button class="btn btn-primary w-100" type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once APP . "/Views/layouts/footer.php"; ?>