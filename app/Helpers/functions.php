<?php

use App\Models\ConfigSistemaModulo;
use App\Models\User;
use App\Models\ConfSistema;
use App\Models\Subscription;

/**
 * Autoriazar usuários pelo role (Role do spatie/permission)
 *
 * @param  mixed $rolesName
 * @return void
 */
function authorizeRoles(array $rolesName)
{
    $user = User::find(auth()->user()->id);
    $bool = $user->hasAnyRole($rolesName);

    if (!$bool)
        abort(403, 'unauthorized user');
}

/**
 * Autorizar usuários por permissions (Permissions do spatie/permissions)
 *
 * @param  mixed $permissionsName
 * @return void
 */
function authorizePermissions(array $permissionsName)
{
    $user = User::find(auth()->user()->id);
    $bool = $user->hasAnyPermission($permissionsName);

    if (!$bool)
        abort(403, 'unauthorized user');
}

function formatarTelefoneBr($numero)
{
    // Verifica se o número tem o comprimento esperado de 11 caracteres
    if (strlen($numero) == 11) {
        $codigoPais = substr($numero, 0, 2); // Obtém o código do país (primeiros 2 dígitos)
        $primeiraParte = substr($numero, 2, 5); // Obtém os 5 dígitos seguintes
        $segundaParte = substr($numero, 7, 4); // Obtém os últimos 4 dígitos

        // Formata e retorna o número de telefone
        return "$codigoPais $primeiraParte-$segundaParte";
    } else {
        // Retorna o número original se ele não tiver 11 caracteres
        return "$numero";
    }
}

function dataInvoice()
{
    $dataAtual = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $dataAtual->modify('+1 day');
    $dataFormatada = $dataAtual->format('Y-m-d\TH:i:s.v\Z');
    return $dataFormatada;
}

function extrairNumeros($texto)
{
    $soNumeros = preg_replace('/[^0-9]/', '', $texto);
    return trim($soNumeros);
}

function typeInvoice($type)
{
    switch ($type) {
        case 'change_plan':
            return 'Troca Plano';
        case 'buy_plan':
            return 'Compra Plano';
        case 'buy_user':
            return 'Compra Usuário(s)';
    }
}

function convertStringNumber($valor)
{
    return number_format($valor / 100, 2, ',', '.');
}

function convertStringDate($dateString)
{
    if (is_null($dateString)) :
        return '';
    endif;
    $date = new DateTime($dateString);
    return $date->format('d/m/Y');
}

function converterDataParaFormatoISO($dataBrasileira)
{
    // Verifica se a data está no formato brasileiro esperado
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dataBrasileira)) {
        // Separa os componentes da data (dia, mês, ano)
        list($dia, $mes, $ano) = explode('/', $dataBrasileira);

        // Formata a data no padrão YY-mm-dd
        $dataISO = sprintf('%02d-%02d-%02d', substr($ano, 2), $mes, $dia);

        return $dataISO;
    } else {
        return null; // Retorna null se a data não estiver no formato esperado
    }
}

/**
 * Formatar número celular
 *
 * @param  mixed $numero
 * @return void
 */
function fmtNumCelular($numero)
{
    // Remove todos os caracteres que não são números
    $numero = preg_replace('/\D/', '', $numero);

    // Verifica se o número tem 11 dígitos
    if (strlen($numero) == 11) {
        // Formata o número no padrão (99) 99999-9999
        $numeroFormatado = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 5) . '-' . substr($numero, 7);
        return $numeroFormatado;
    } else {
        // Retorna se o número não tiver 11 dígitos
        return $numero;
    }
}

function formatarCPF($cpf)
{
    // Remove qualquer caractere que não seja número
    $cpf = preg_replace('/\D/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return $cpf;
    }

    // Formata o CPF
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

function formatarCNPJ($cnpj)
{
    // Remove qualquer caractere que não seja número
    $cnpj = preg_replace('/\D/', '', $cnpj);

    // Verifica se o CNPJ tem 14 dígitos
    if (strlen($cnpj) != 14) {
        return $cnpj;
    }

    // Formata o CNPJ
    return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
}


/**
 * Se usuário logado tem modulo com um de seus planos
 *
 * @param  int $moduleId
 * @return bool
 */
function userHasModule($moduleId)
{
    $sub = Subscription::where('user_id', user_princ()->id)
        ->where('status', 'ativo')
        ->whereHas('plan', function ($query) use ($moduleId) {
            return $query->where('modulo_id', $moduleId);
        })->latest()->first();

    // permitir usário beta
    if ($sub && user_princ()->beta_user)
        return true;

    // verificar se sub tá expirado
    if ($sub && $sub->days_expire_paid_plan == 'Expirado')
        return false;

    return $sub ? true : false;
}

/**
 * Impedir acesso caso nãotenha modulo com o usuário logado
 *
 * @param  int $moduleId Modulo ativo
 * @return void
 */
function abortAccessForModule($moduleId)
{
    if (userHasModule($moduleId) === false) :
        abort(403);
    endif;
}


/**
 * existCodSituacaoPedido
 *
 * @param  mixed $cod
 * @return bool
 */
function existCodSituacaoPedido($cod): bool
{
    $conf = ConfSistema::where('status', 'ativo')->where('tipo', 'bling')->where('user_id', user_princ()->id)->first();
    if (isset($conf->integracao['order_situation']) && is_array($conf->integracao['order_situation'])):
        return in_array($cod, $conf->integracao['order_situation']);
    else:
        return false;
    endif;
}


// enviar_notificacao_de_fatura_emitida

function existOpcaoConfigEnvioCobranca($opcao): bool
{
    $exist = ConfigSistemaModulo::where('user_id', user_princ()->id)
        ->where('modulo_id', 1)
        ->where($opcao, true)
        ->exists();

    return $exist;
}


/**
 * Se usuário logado for um usuário secundario, irá retornar o usuário principal q o cadastrou, caso seja outro usuário
 * vai retornar ele normal
 *
 * @return null | object
 */
function user_princ(): ?object
{
    // o relatóirio de msgs é relacionada ao usuário princ, pegar o id
    $userCurrente = User::find(auth()->user()->id);
    $user = $userCurrente;

    if ($userCurrente->hasRole('usuario_sec')):

        if ($userCurrente->cadastrado_por != null) :
            // user principal
            $user = User::find($userCurrente->cadastrado_por);
            if ($user == null) :
                $user = User::find(auth()->user()->id);
            endif;
        endif;
    endif;

    return $user;
}

if (!function_exists('figuras')) {
    function figuras(string $pagina): array
    {
        $arquivo = resource_path('views/ajuda/figuras.php');

        if (!file_exists($arquivo)) {
            return [];
        }

        $dados = include $arquivo;

        return $dados[$pagina] ?? [];
    }
}
