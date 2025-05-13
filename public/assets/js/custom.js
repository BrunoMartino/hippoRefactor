function validarInput(input) {
    input.value = input.value.replace(/\D/g, '');
    if (input.value.length > 6) {
        input.value = input.value.slice(0, 6);
    }
}

$(document).ready(function () {
    $(".pj").hide();
    $("#razao_social").removeAttr("required");
    $("#cnpj").removeAttr("required");
    $("#tipo_usuario").change(function () {
        if ($(this).val() === "PJ") {
            $(".pj").show();
            $("#razao_social").prop("required", true);
            $("#cnpj").prop("required", true);
        } else {
            $(".pj").hide();
            $("#razao_social").removeAttr("required");
            $("#cnpj").removeAttr("required");
        }
    });
});

$('.btn-voltar').click(function () {
    window.history.back();
});

function validarWhatsapp(input) {
    input.value = input.value.replace(/\D/g, '');
    if (input.value.length > 6) {
        input.value = input.value.slice(0, 6);
    }
}

function validarNumero(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > 11) {
        input.value = input.value.slice(0, 11);
    }
}

function handleColorTheme(e) {
    $("html").attr("data-color-theme", e);
    $(e).prop("checked", !0);
}

$(document).ready(function () {
    $(".numeric-input").on("input", function () {
        var $this = $(this);
        var val = $this.val();
        val = val.replace(/[^0-9]/g, '');
        $this.val(val);
        if (val.length === 1) {
            var $nextInput = $this.next(".numeric-input");
            if ($nextInput.length) {
                $nextInput.focus();
            } else {
                $this.blur();
            }
        }
    });
});

$(document).ready(function () {
    $('.datatable').DataTable({
        "scrollY": false,
        "scrollCollapse": true,
        "pageLength": 10,
        "searching": false,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }
    });
    $('.dataTables_scrollBody').css('overflow-y', 'hidden');
});

function showPass(idInpu, idEye, idEyeOff) {
    let el = document.getElementById(idInpu)
    if (el.type == 'password') {
        el.type = 'text'
        document.getElementById(idEye).style.display = 'block'
        document.getElementById(idEyeOff).style.display = 'none'
    } else {
        el.type = 'password'
        document.getElementById(idEye).style.display = 'none'
        document.getElementById(idEyeOff).style.display = 'block'
    }
}

/* Alert para cancelar conta de usuário */
function cancelAccount() {

    // card bg-info-subtle
    let html = `
    <div class="alert alert-danger text-center" role="alert">
        <strong class="fs-5">Cancelar Conta</strong>
        <div class="fs-4">
        Você tem certeza de que deseja cancelar sua conta de usuário?
        </div>
        <div class="mt-2 d-flex gap-2 justify-content-center">
        <a href="/cancelar-conta" class="btn btn-primary px-4">
                Sim
            </a>
        <button type="button" class="btn btn-light text-orange  px-4" onclick="this.parentNode.parentNode.remove()" id="btn-nao-cancelar">
            Não
        </button>
            
        </div>
    </div>
    ` ;
    document.getElementById('cancelar-conta').innerHTML = html
    document.getElementById('btn-nao-cancelar').focus()
}

// remover is-invalid quando digita
$('.is-invalid').keyup(function () {
    this.classList.remove('is-invalid')
})


/* Alert Deletar */
function serUrlDelete(url) {
    document.getElementById('form-deletar').action = url

    if (document.getElementById('form-deletar').style.display == 'block') {
        document.getElementById('form-deletar').style.transition = 'all .2s'
        document.getElementById('form-deletar').style.opacity = 0
        setTimeout(() => {
            document.getElementById('form-deletar').style.opacity = 1
        }, 200);

    } else {
        document.getElementById('form-deletar').style.display = 'block'
    }
    document.getElementById('btn-deletar-regitro').focus()
}

function closeAlertDelete() {
    document.getElementById('form-deletar').style.display = 'none'
}

/* Alert Deletar2 */
function serUrlDelete2(url) {
    document.getElementById('form-deletar2').action = url

    if (document.getElementById('form-deletar2').style.display == 'block') {
        document.getElementById('form-deletar2').style.transition = 'all .2s'
        document.getElementById('form-deletar2').style.opacity = 0
        setTimeout(() => {
            document.getElementById('form-deletar2').style.opacity = 1
        }, 200);

    } else {
        document.getElementById('form-deletar2').style.display = 'block'
    }
    document.getElementById('btn-deletar-regitro2').focus()
}

function closeAlertDelete2() {
    document.getElementById('form-deletar2').style.display = 'none'
}

/* Alert Desativar */
function serUrlDisable(url) {
    document.getElementById('form-desativar').action = url

    if (document.getElementById('form-desativar').style.display == 'block') {
        document.getElementById('form-desativar').style.transition = 'all .2s'
        document.getElementById('form-desativar').style.opacity = 0
        setTimeout(() => {
            document.getElementById('form-desativar').style.opacity = 1
        }, 200);

    } else {
        document.getElementById('form-desativar').style.display = 'block'
    }
    document.getElementById('btn-desativar-regitro').focus()
}

function closeAlertDesativar() {
    document.getElementById('form-desativar').style.display = 'none'
}
/* Alert Ativar */
function serUrlActive(url) {
    document.getElementById('form-ativar').action = url

    if (document.getElementById('form-ativar').style.display == 'block') {
        document.getElementById('form-ativar').style.transition = 'all .2s'
        document.getElementById('form-ativar').style.opacity = 0
        setTimeout(() => {
            document.getElementById('form-ativar').style.opacity = 1
        }, 200);

    } else {
        document.getElementById('form-ativar').style.display = 'block'
    }
    document.getElementById('btn-ativar-regitro').focus()
}

function closeAlertActive() {
    document.getElementById('form-ativar').style.display = 'none'
}

function resetarFiltro(formId) {
    const form = document.getElementById(formId);

    form.reset()
   
    if (form) {
        let resetou = false;

        // Limpa inputs de texto
        form.querySelectorAll('input[type="text"], input[type="date"], input[type="month"]').forEach(input => {
            if (input.value) {
                input.value = '';
                resetou = true;
            }
        });

        // Reseta selects
        form.querySelectorAll('select').forEach(select => {
            if (select.value) {
                select.value = '';
                resetou = true;
            }
        });

        form.querySelectorAll('.select2-selection__rendered').forEach(select => {
            if (select.innerHTML) {
                select.innerHTML = '';
                resetou = true;
            }
        });

        // Se pelo menos um campo foi resetado, recarrega a página sem query strings
        if (resetou && window.location.search) {
            setTimeout(() => {
                window.location.href = window.location.pathname;
            }, 500);
        }
    } else {
        console.warn(`Formulário com ID '${formId}' não encontrado.`);
    }
}