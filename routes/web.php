<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\ApiLytexService;
use App\Services\ApiWhatsappService;
use App\Services\ApiBlingService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AfiliateController;
use App\Http\Controllers\ChartAdmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UseCouponController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ImprovementController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\SuggestionsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChartUserMainController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\DiscountCouponController;
use App\Http\Controllers\SendingSettingController;
use App\Http\Controllers\AffiliateIncomeController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\MonthlyDiscountController;
use App\Http\Controllers\Payment\InvoiceController;
use App\Http\Controllers\VotesSuggestionController;
use App\Http\Controllers\ImprovementAnswerController;
use App\Http\Controllers\SuggestionsAnswerController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Config\UserAccountController;
use App\Http\Controllers\Config\SubscriptionController;
use App\Http\Controllers\Payment\PaymentPlanController;
use App\Http\Controllers\Config\SistemaModuloController;
use App\Http\Controllers\Config\System\SystemController;
use App\Http\Controllers\Payment\PaymentUsersController;
use App\Http\Controllers\Import\CobrancaImportController;
use App\Http\Controllers\Message\MessageChargeController;
use App\Http\Controllers\Import\FaturamentoImportController;
use App\Http\Controllers\Import\RemarketingImportController;
use App\Http\Controllers\Payment\PaymentConfirmedController;
use App\Http\Controllers\Import\RastreamentoImportController;
use App\Http\Controllers\Payment\PaymentChangePlanController;
use App\Http\Controllers\Config\System\SystemChargeController;
use App\Http\Controllers\Message\MessageFaturamentoController;
use App\Http\Controllers\Message\MessageRemarketingController;
use App\Http\Controllers\Message\Report\ChargeReportController;
use App\Http\Controllers\Config\System\SystemFaturamentoController;
use App\Http\Controllers\Config\System\SystemRemarketingController;
use App\Http\Controllers\Config\System\SystemRastreamentoController;
use App\Http\Controllers\Message\Report\FaturamentoReportController;
use App\Http\Controllers\Message\Report\RemarketingReportController;
use App\Http\Controllers\Message\Report\RastreamentoReportController;
use App\Http\Controllers\HelpCenterController;

// Route::get('obter-token', function (ApiLytexService $api_lytex) {
//     dd($api_lytex->obtainToken());
// });

// Route::get('/list-invoices', function (ApiLytexService $api_lytex) {
//     dd($api_lytex->listInvoices());
// });

// Route::get('/invoice', function (ApiLytexService $api_lytex) {
//     dd($api_lytex->invoice('6656954f4a39444c20907362'));
// });

// Route::get('/detail-payment', function (ApiLytexService $api_lytex) {
//     dd($api_lytex->invoicePaymentDetail('6656954f4a39444c20907362'));
// });

// Route::get('/set-user', function (PaymentService $paymentService) {});

// Route::get('/get-token', function (ApiLytexService $api_lytex) {
//     $cartao = [
//         'num_cartao' => '4539870139388571',
//         'nome' => 'cliente teste',
//         'mes_venc' => '02',
//         'ano_venc' => '2025',
//         'cvc' => '928'
//     ];
//     dd($api_lytex->invoicesCardToken($cartao));
// });

// Route::get('/nome', function () {
//     dd(auth()->user());
// });

// Route::get('/conexoes', function (ApiWhatsappService $apizap) {
//     dd($apizap->listarConexoes());
// });

// Route::get('/conexao', function (ApiWhatsappService $apizap) {
//     dd($apizap->infoConexao());
// });

// Route::get('/qrcode', function (ApiWhatsappService $apizap) {
//     dd($apizap->qrcodeBase64());
// });

// Route::get('/deletarconex', function (ApiWhatsappService $apizap) {
//     dd($apizap->deletarConexao());
// });

// Route::get('/deslogar', function (ApiWhatsappService $apizap) {
//     dd($apizap->deslogar());
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/dashboard/home', function () {
        return redirect()->route('dashboard');
    })->name('index.dashboard');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('send.login');
    Route::get('/logout', 'logout')->name('sair');
    Route::post('/logout-da-pagina-perfil', 'changePasswordFromProfilePage')->name('logout.profile.page');
});

//! manutenção
// Route::get('/login', function () {
//     return redirect('/');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('/usuarios', 'index')->name('usuarios');
    Route::get('usuarios/new-user', 'create')->name('usuario.novo');
    Route::post('usuarios/save-user', 'store')->name('usuario.salvar.novo');
    Route::post('usuarios/restourar/{id}', 'restoreUserDeleted')->name('usuario.restourar');
    Route::get('/usuarios/edit/{id}', 'edit')->name('usuario.editar');
    Route::put('/usuarios/edit/{usuario}', 'update')->name('usuario.update');
    Route::get('/usuarios/show/{user}', 'show')->name('usuario.visualizar');
    Route::delete('/usuarios/delete/{usuario}', 'destroy')->name('usuario.deletar');
});

Route::get('/cidades', [CitiesController::class, 'indexJson'])->name('cidades.json');


Route::controller(ProfileController::class)->group(function () {
    Route::get('/perfil', 'profile')->name('profile.index');
    Route::post('/perfil', 'saveProfile')->name('profile.update');
});

Route::controller(RegisterController::class)->group(function () {
    // Route::get('/escolher-plano', 'choosePlan')->name('plano.escolher');
    Route::get('/selecionar-plano/{plano_id}', 'savePlan')->name('usuario.salvar-plano');
    Route::get('/cadastro', 'register')->name('usuario.registro');
    Route::post('/cadastro', 'saveRegister')->name('usuario.salvar.registro');

    Route::get('/cadastro/confirmar', 'formConfirmationDigits')->name('confirmacao');
    Route::post('/cadastro/confirmar', 'checkDigits')->name('send.confirmacao');

    Route::post('/cadastro/confirmar/reenviar', 'resendConfirmEmail')->name('confirmacao.reenviar');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/recuperar-senha', 'formEmail')->name('recuperar.form');
    Route::post('/enviar-token', 'sendResetToken')->name('recuperar.senha');
    Route::get('/nova-senha/{token}', 'formNewPassword')->name('nova.senha');
    Route::post('/nova-senha/{dados}', 'saveNewPassword')->name('salvar.nova.senha');
});

Route::controller(ReportsController::class)->group(function () {
    Route::get('/relatorios/financeiro', 'financial')->name('reports.financial');
    Route::get('/relatorios/plano-gratuito', 'freePlan')->name('reports.free.plan');
    Route::get('/relatorios/mensagens-enviadas', 'sendedMessages')->name('reports.sended.messages');

    Route::get('/relatorios/plano-pago', 'paidPlan')->name('reports.paid.plan');
    Route::get('/relatorios/plano-pago/{paid}', 'showPaidPlan')->name('reports.show-paid.plan');
    Route::get('/relatorios/plano-pago/{paid}/json', 'getDataPaidJson')->name('reports.paid.plan.json');
});

Route::controller(PlanController::class)->group(function () {
    Route::get('/planos', 'index')->name('planos');
    Route::get('/planos/{plan}/edit', 'edit')->name('plans.edit');
    Route::post('/planos/{plan}/edit', 'update')->name('plans.update');
});

Route::controller(SystemController::class)->group(function () {

    // bling
    Route::get('/auth-bling', 'authBling');
    Route::get('/config/sistema/{modulo}/bling/change', 'changeBlingRedirect')->name('config.sistema.change-bling');
    Route::get('/config/sistema/{modulo}/bling', 'bling')->name('config.sistema.bling');
    Route::post('/config/sistema/{modulo}/bling', 'storeBling')->name('config.sistema.store-bling');
    Route::post('/config/sistema/bling/usar-existente', 'setConBlingOutroModulo')->name('config.sistema.bling-set-outro');
    Route::delete('/config/sistema/{modulo}/bling/destroy', 'destroyBling')->name('config.sistema.destroy-bling');

    // correios
    Route::get('/config/sistema/{modulo}/correios', 'correios')->name('config.sistema.correios');
    Route::post('/config/sistema/{modulo}/correios', 'storeCorreios')->name('config.sistema.store-correios');

    // whatsapp
    Route::get('/config/sistema/{modulo}/conexao-whatsapp', 'connectWhatsapp')->name('config.sistema.connect-whatsapp');
    Route::post('/config/sistema/conexao-whatsapp/usar-existente', 'setConWhatsappOutroModulo')->name('config.sistema.connect-whatsapp.usar');
    Route::get('/config/sistema/{modulo}/fazer-conexao', 'fazerConexaoWhatsapp')->name('config.sistema.fazer-conexao');
    Route::get('/reload-qrcode', 'reloadQrCode')->name('config.reload.qrcode');
    Route::delete('/trocar-numero-whatsapp', 'changeWhatsapp')->name('config.change.whatsapp');
    Route::get('/config/status-conexao', 'statusConexao')->name('config.status-conexao');
});

/* Sistema - Cobraças */
Route::controller(SystemChargeController::class)->group(function () {
    Route::get('/config/sistema/cobrancas', 'index')->name('config.sistema.charges.index');
    Route::post('/config/sistema/cobrancas', 'storeConfigCharges')->name('config.sistema.charges.store');
});

/* Sistema - Remarketing */
Route::controller(SystemRemarketingController::class)->group(function () {
    Route::get('/config/sistema/remarketing', 'index')->name('config.sistema.remarketing.index');
});
/* Sistema - Rastreamento */
Route::controller(SystemRastreamentoController::class)->group(function () {
    Route::get('/config/sistema/rastreamento', 'index')->name('config.sistema.rastreamento.index');
    Route::post('/config/sistema/rastreamento', 'storeConfig')->name('config.sistema.rastreamento.store');
});
/* Sistema - Faturamento */
Route::controller(SystemFaturamentoController::class)->group(function () {
    Route::get('/config/sistema/faturamento', 'index')->name('config.sistema.faturamento.index');
    Route::post('/config/sistema/faturamento', 'storeConfig')->name('config.sistema.faturamento.store');
});

/* Importar - Remarketing */
Route::controller(RemarketingImportController::class)->group(function () {
    Route::get('/config/importar/rm', 'index')->name('config.import.rm.index');
    Route::post('/config/importar/rm', 'import')->name('config.import.rm.store');
    // Route::delete('/config/importar/rm', 'deleteAll')->name('config.import.rm.destroy');
    Route::get('/config/importar/rm/dados-importados', 'importedData')->name('config.import.rm.imported-data');
    Route::get('/config/importar/rm/dados-importados/{group}', 'show')->name('config.import.rm.imported-data.show');
    Route::delete('/config/importar/rm/deletar/{data}', 'destroy')->name('config.import.rm.destroy');

    Route::get('/config/importar/rm/dados-importados/json/{group}', 'getDataGroupJson')->name('config.import.rm.imported-data.group');
    Route::delete('/config/importar/item/deletar', 'destroyItem')->name('config.import.rm.destroy-item');
    // json
    Route::get('/config/rm/dados-importados/vcm', 'backEditSendignSettings')->name('config.import.imported-data.back-edit-config-msg');
});

/* Importar - Cobranças */
Route::controller(CobrancaImportController::class)->group(function () {
    Route::get('/config/importar/cobrancas', 'index')->name('config.import.cb.index');
    Route::post('/config/importar/cobrancas', 'import')->name('config.import.cb.store');
    // Route::delete('/config/importar/cobrancas', 'deleteAll')->name('config.import.cb.destroy');
    Route::get('/config/importar/cobrancas/dados-importados', 'importedData')->name('config.import.cb.imported-data');
    Route::get('/config/importar/cobrancas/dados-importados/{group}', 'show')->name('config.import.cb.imported-data.show');
    Route::delete('/config/importar/cobrancas/deletar/{data}', 'destroy')->name('config.import.cb.destroy');

    Route::get('/config/importar/cobrancas/rm/dados-importados/json/{group}', 'getDataGroupJson')->name('config.import.cb.imported-data.group');
    Route::delete('/config/importar/cobrancas/item/deletar', 'destroyItem')->name('config.import.cb.destroy-item');
    // json
    Route::get('/config/cb/dados-importados/vcm', 'backEditSendignSettings')->name('config.import.cb.imported-data.back-edit-config-msg');
});
/* Importar - Faturamento */
Route::controller(FaturamentoImportController::class)->group(function () {
    Route::get('/config/importar/faturamento', 'index')->name('config.import.ft.index');
    Route::post('/config/importar/faturamento', 'import')->name('config.import.ft.store');
    // Route::delete('/config/importar/faturamento', 'deleteAll')->name('config.import.ft.destroy');
    Route::get('/config/importar/faturamento/dados-importados', 'importedData')->name('config.import.ft.imported-data');
    Route::get('/config/importar/faturamento/dados-importados/{group}', 'show')->name('config.import.ft.imported-data.show');
    Route::delete('/config/importar/faturamento/deletar/{data}', 'destroy')->name('config.import.ft.destroy');

    Route::get('/config/importar/faturamento/rm/dados-importados/json/{group}', 'getDataGroupJson')->name('config.import.ft.imported-data.group');
    Route::delete('/config/importar/faturamento/item/deletar', 'destroyItem')->name('config.import.ft.destroy-item');
    // json
    Route::get('/config/ft/dados-importados/vcm', 'backEditSendignSettings')->name('config.import.ft.imported-data.back-edit-config-msg');
});
/* Importar - Rastreamento */
Route::controller(RastreamentoImportController::class)->group(function () {
    Route::get('/config/importar/rastreamento', 'index')->name('config.import.rt.index');
    Route::post('/config/importar/rastreamento', 'import')->name('config.import.rt.store');
    // Route::delete('/config/importar/rastreamento', 'deleteAll')->name('config.import.rt.destroy');
    Route::get('/config/importar/rastreamento/dados-importados', 'importedData')->name('config.import.rt.imported-data');
    Route::get('/config/importar/rastreamento/dados-importados/{group}', 'show')->name('config.import.rt.imported-data.show');
    Route::delete('/config/importar/rastreamento/deletar/{data}', 'destroy')->name('config.import.rt.destroy');

    Route::get('/config/importar/rastreamento/rm/dados-importados/json/{group}', 'getDataGroupJson')->name('config.import.rt.imported-data.group');
    Route::delete('/config/importar/rastreamento/item/deletar', 'destroyItem')->name('config.import.rt.destroy-item');
    // json
    Route::get('/config/rt/dados-importados/vcm', 'backEditSendignSettings')->name('config.import.rt.imported-data.back-edit-config-msg');
});



Route::controller(MessageController::class)->group(function () {
    Route::get('/mensagens', 'index')->name('messages.crud.index');
    Route::get('/mensagens/visualizar/{message}', 'show')->name('messages.crud.show');
    Route::delete('/mensagens/deletar/{message}', 'destroy')->name('messages.crud.destroy');
});

/* Remarketing */
Route::controller(MessageRemarketingController::class)->group(function () {
    /* msg */
    Route::post('/mensagens/rm', 'store')->name('messages.crud.store');
    Route::get('/mensagens/rm/criar', 'create')->name('messages.crud.new');
    Route::get('/mensagens/rm/agradecimento', 'createGratitude')->name('messages.crud.create');
    Route::get('/mensagens/rm/aniversario', 'createBirthday')->name('messages.crud.create-birthday');
    Route::put('/mensagens/rm/atualizar/{message}', 'update')->name('messages.crud.update');
    Route::get('/mensagens/rm/editar/{message}', 'edit')->name('messages.crud.edit');
    Route::get('/mensagens/rd/config-whatsapp', 'redirConfigWhatsapp')->name('messages.redir-whatsapp');
    /* Pesquisa satisfação */
    Route::get('/mensagens/rm/criar/pesquisa-satisfacao', 'createSatisfactionSurvey')->name('messages.crud.create-satisfaction');
    Route::post('/mensagens/rm/criar/pesquisa-satisfacao', 'storeSatisfactionSurvey')->name('messages.crud.store-satisfaction');
    Route::get('/mensagens/rm/editar/pesquisa-satisfacao/{message}', 'editSatisfactionSurvey')->name('messages.crud.edit-satisfaction');
    Route::put('/mensagens/rm/editar/pesquisa-satisfacao/{message}', 'updateSatisfactionSurvey')->name('messages.crud.update-satisfaction');
    /* Anexo Pesquisa Satisfação */
    Route::match(['get', 'post'], '/mensagens/rm/criar/pesquisa-satisfacao-anexo/msg/{message?}', 'createAnexoSatisfactionSurvey')->name('messages.crud.create-anexo-satisfaction');
    Route::get('/mensagens/rm/criar/pesquisa-satisfacao-anexo/c/{message?}', 'cancelAnexoSatisfactionSurvey')->name('messages.crud.cancel-anexo-satisfaction');
    Route::post('/mensagens/rm/criar/pesquisa-satisfacao-anexo/{message?}', 'storeAnexoSatisfactionSurvey')->name('messages.crud.store-anexo-satisfaction');
    /* json */
    Route::get('/mensagens/rm/criar/json/psa', 'getJsonAnexoSatisfactionSurvey')->name('messages.crud.json-psa');
});

/* Cobranças */
Route::controller(MessageChargeController::class)->group(function () {
    Route::post('/mensagens/cobrancas', 'store')->name('messages.crud.charges.store');

    Route::get('/mensagens/cobrancas/gerada/criar', 'createGenerated')->name('messages.charges.create-generated');
    Route::get('/mensagens/cobrancas/vencendo/criar', 'createExpiring')->name('messages.charges.create-expiring');
    Route::get('/mensagens/cobrancas/vencimento/criar', 'createDueDate')->name('messages.charges.create-due-date');
    Route::get('/mensagens/cobrancas/vencida/criar', 'createOverdue')->name('messages.charges.create-overdue');
    Route::get('/mensagens/cobrancas/config-whatsapp', 'redirConfigWhatsapp')->name('messages.charges.redir-config-zap');

    Route::get('/mensagens/cobrancas/editar/{message}', 'edit')->name('messages.charges.edit');
    Route::put('/mensagens/cobrancas/editar/{message}', 'update')->name('messages.charges.update');
});

/* Faturamento */
Route::controller(MessageFaturamentoController::class)->group(function () {

    // pedido
    Route::get('/mensagens/faturamento/pedido/recebido', 'createOrderRecebido')->name('messages.faturamento.recebido');
    Route::get('/mensagens/faturamento/pedido/andamento', 'createOrderAndamento')->name('messages.faturamento.andamento');
    Route::get('/mensagens/faturamento/pedido/atendido', 'createOrderAtendido')->name('messages.faturamento.atendido');
    Route::get('/mensagens/faturamento/pedido/separacao', 'createOrderSeparacao')->name('messages.faturamento.separacao');
    Route::get('/mensagens/faturamento/pedido/verificado', 'createOrderVerificado')->name('messages.faturamento.verificado');
    Route::get('/mensagens/faturamento/pedido/redir-config-whatsapp', 'redirConfigWhatsapp')->name('messages.faturamento.redi-config-whatsapp');

    Route::post('/mensagens/faturamento/pedido', 'storeOrder')->name('messages.faturamento.store');
    Route::get('/mensagens/faturamento/pedido/edit/{message}', 'editOrder')->name('messages.faturamento.edit');

    // update
    Route::put('/mensagens/faturamento/pedido/edit/{message}', 'update')->name('messages.faturamento.update');
});

/* Config Sistema Módulos */
Route::controller(SistemaModuloController::class)->group(function () {

    Route::get('/config/sistema/forma-pag', 'formaPag')->name('config.sistema.forma-pag');
});


/* Configurações de mensagens */
Route::controller(SendingSettingController::class)->group(function () {
    Route::get('/mensagens/configuracao-de-envio/redir/{msgId}', 'redirCofigWhatsapp')->name('messages.sending-settings.redi-whatsapp');
    Route::get('/mensagens/configuracao-de-envio/{message}', 'config')->name('messages.sending-settings.config');
    Route::post('/mensagens/configuracao-de-envio/{message}', 'store')->name('messages.sending-settings.store');
    Route::post('/mensagens/configuracao-de-envio/redir-importar-dados/{message}', 'redirFormImportData')->name('messages.sending-settings.redir-import-data');
});

/* Configurações de integrações */
Route::controller(SystemSettingController::class)->group(function () {
    Route::get('/integracoes/config-sistema', 'index')->name('integrations.system-settings.index');
    Route::post('/integracoes/config-sistema', 'store')->name('integrations.system-settings.store');
    Route::get('/integracoes/config-sistema/criar', 'create')->name('integrations.system-settings.create');
    Route::get('/integracoes/config-sistema/visualizar/{systemSetting}', 'show')->name('integrations.system-settings.show');
    Route::put('/integracoes/config-sistema/atualizar/{systemSetting}', 'update')->name('integrations.system-settings.update');
    Route::get('/integracoes/config-sistema/editar/{systemSetting}', 'edit')->name('integrations.system-settings.edit');
    Route::delete('/integracoes/config-sistema/deletar/{systemSetting}', 'destroy')->name('integrations.system-settings.destroy');
});

/* Integrações */
Route::controller(IntegrationController::class)->group(function () {
    Route::get('/integracoes', 'index')->name('integrations.index');
    Route::post('/integracoes', 'store')->name('integrations.store');
    Route::get('/integracoes/criar', 'create')->name('integrations.create');
    Route::get('/integracoes/visualizar/{integration}', 'show')->name('integrations.show');
    Route::put('/integracoes/atualizar/{integration}', 'update')->name('integrations.update');
    Route::get('/integracoes/editar/{integration}', 'edit')->name('integrations.edit');
    Route::delete('/integracoes/deletar/{integration}', 'destroy')->name('integrations.destroy');
});


/* Cupons */
Route::controller(DiscountCouponController::class)->group(function () {
    Route::get('/cupons', 'index')->name('coupons.index');
    Route::post('/cupons', 'store')->name('coupons.store');
    Route::get('/cupons/criar', 'create')->name('coupons.create');
    Route::get('/cupons/visualizar/{coupon}', 'show')->name('coupons.show');
    // Route::put('/cupons/atualizar/{coupon}', 'update')->name('coupons.update');
    // Route::get('/cupons/editar/{coupon}', 'edit')->name('coupons.edit');
    Route::delete('/cupons/deletar/{coupon}', 'destroy')->name('coupons.destroy');
    Route::put('/cupons/ativar/{coupon}', 'activate')->name('coupons.activate');
    Route::put('/cupons/desativar/{coupon}', 'disable')->name('coupons.disable');
});

/* Discontos mensais */
Route::controller(MonthlyDiscountController::class)->group(function () {
    Route::get('/descontos-mensais/clientes', 'clientesJson')->name('descontos-mensais.clientes');
    Route::get('/descontos-mensais/modulos', 'modulosJson')->name('descontos-mensais.modulos');
    Route::get('/descontos-mensais/planos', 'planosJson')->name('descontos-mensais.planos');
    Route::resource('/descontos-mensais', MonthlyDiscountController::class)->parameter('descontos-mensais', 'md');
});

/* Aplicar cupom */
Route::controller(UseCouponController::class)->group(function () {
    Route::get('/cupons/obter-desconto', 'getDiscount')->name('cupons.get-discount');
});

/* Conta de usuário */
Route::controller(UserAccountController::class)->group(function () {
    Route::get('/plano-atual', 'currentPlan')->name('config.user-account.current-plan');
    Route::get('/trocar-plano/adquirir', 'changePlanAdquirir')->name('config.user-account.change-plan-adquirir');
    Route::get('/trocar-plano/modulo/{modulo}', 'changePlanSetSession')->name('config.user-account.change-plan-set-session');
    Route::get('/trocar-plano', 'changePlan')->name('config.user-account.change-plan')
        ->middleware(['verify_change_plan_invoice', 'verify_buy_plan_invoice']);
    // mudar para plano gratuito
    Route::put('/trocar-plano/gratuito/{plan}', 'setFreePlan')->name('config.user-account.set-free-plan');
    // cancelar plano
    Route::put('/trocar-plano/cancelar/{plan}', 'cancelPlan')->name('config.user-account.cancel-plan');
    // financeiro
    Route::get('/financeiro', 'financial')->name('config.user-account.financial');
    Route::get('/financeiro/{invoiceId}', 'showFinancial')->name('config.user-account.financial.show');
    // cancelar conta
    Route::get('/cancelar-conta', 'cancelAccount')->name('config.user-account.cancelar');
});

Route::controller(PaymentPlanController::class)->group(function () {
    Route::get('/pagar-plano', 'paymentPlan')->name('payment-plan');
    Route::post('/pagar-plano', 'saveCouponExists')->name('payment-plan.save-coupon-exists');

    Route::get('/pagar-plano/formas-de-pagamento', 'paymentMethods')->name('payment.methods');
    Route::get('/pagar-plano/cartao', 'checkoutCartao')->name('payment.cartao');
    Route::get('/pagar-plano/pix', 'checkoutPix')->name('payment.pix');

    Route::post('/pagar-plano/confirmar/recebimento/pix', 'confirmPaymentPix')->name('payment.confirm-payment-pix');
    Route::post('/pagar-plano/confirmar/recebimento/cartao', 'confirmPaymentPlan')->name('payment.confirm-payment-plan');
});

/* Pagamento */
Route::controller(PaymentUsersController::class)->group(function () {

    Route::middleware(['check_invoice_buy_users', 'verify_buy_users_invoice'])
        ->group(function () {
            Route::get('/usuarios/comprar', 'formTotal')->name('usuarios.comprar');
            Route::post('/usuarios/comprar', 'saveTotalUsersSession')->name('usuarios.comprar.salvar-total');
            Route::get('/usuarios/comprar/detalhes', 'details')->name('usuarios.comprar.detalhes');
            Route::post('/usuarios/comprar/detalhes', 'confirmDetails')->name('usuarios.comprar.confirm-detalhes');
        });

    Route::get('/usuarios/comprar/formas-de-pagamento', 'paymentMethods')->name('usuarios.comprar.pagar');

    Route::get('/usuarios/comprar/cartao', 'checkoutCartao')->name('usuarios.comprar.pagar.cartao');
    Route::get('/usuarios/comprar/pix', 'checkoutPix')->name('usuarios.comprar.pagar.pix');

    Route::post('/usuarios/comprar/confirmar/recebimento/cartao', 'confirmPaymentCard')->name('usuarios.comprar.confirm-payment-card');
    Route::post('/usuarios/comprar/confirmar/recebimento/pix', 'confirmPaymentPix')->name('usuarios.comprar.confirm-payment-pix');

    Route::get('/usuarios/comprar/trocar-cartao', 'changeCard')->name('usuarios.comprar.change-card');
});

Route::controller(PaymentChangePlanController::class)->group(function () {
    // selecionar forma de pagamento
    Route::get('/trocar-plano/formas-de-pagamento', 'paymentMethods')->name('payment.change-plan.methods');
    Route::get('/trocar-plano/formas-de-pagamento/escolher', 'selectPaymentMethods')->name('payment.change-plan.select-method');
    // checkout
    Route::get('/trocar-plano/pagar/cartao', 'checkoutCartao')->name('payment.change-plan.cartao');
    Route::get('/trocar-plano/pagar/pix', 'checkoutPix')->name('payment.change-plan.pix');

    Route::get('/trocar-plano/{plan}/pagar', 'paymentPlan')->name('payment.change-plan');
    Route::post('/trocar-plano/{plan}/pagar', 'saveCouponExists')->name('payment.change-plan.save-coupon-exists');

    Route::post('/trocar-plano/confirmar/recebimento/cartao', 'confirmPaymentPlan')->name('payment.change-plan.confirm-payment-plan');
    Route::post('/trocar-plano/confirmar/recebimento/pix', 'confirmPaymentPix')->name('payment.change-plan.confirm-payment-pix');

    Route::get('/trocar-plano/trocar-cartao', 'changeCard')->name('payment.change-plan.change-card');
});

Route::controller(PaymentConfirmedController::class)->group(function () {
    Route::get('/pagamento-confirmado', 'index')->name('payment-confirmed');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/trocar-plano/fatura-gerada', 'generatedChangePlan')->name('change-plan.invoice');

    Route::get('/trocar-plano/fatura-em-aberto', 'regenerateChangePlan')->name('change-plan.invoice.regenerate');
    Route::get('/fatura-em-aberto', 'regenerateBuyPlan')->name('buy-plan.invoice.regenerate');

    Route::get('/usuarios/comprar/fatura-gerada', 'generatedBuyUsers')->name('usuarios.invoice');
    Route::get('/usuarios/comprar/fatura-em-aberto', 'regenerateBuyUsers')->name('buy-users.invoice.regenerate');

    Route::put('/trocar-plano/cancelar-fatura-gerada/{invoice}', 'cancel')->name('change-plan.invoice.cancel');
    Route::put('/usuarios/cancelar-fatura-gerada/{invoice}', 'cancel')->name('usuarios.invoice.cancel');

    Route::get('/faturas-em-processamento', 'invoicesProcessing')->name('invoices-processing');
});

/* Inscrições */
Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/assinaturas', 'index')->name('subscriptions.index');
    Route::post('/assinaturas', 'store')->name('subscriptions.store');
    Route::get('/assinaturas/criar', 'create')->name('subscriptions.create');
    Route::get('/assinaturas/visualizar/{subscription}', 'show')->name('subscriptions.show');
    Route::put('/assinaturas/atualizar/{subscription}', 'update')->name('subscriptions.update');
    Route::get('/assinaturas/editar/{subscription}', 'edit')->name('subscriptions.edit');
    Route::delete('/assinaturas/deletar/{subscription}', 'destroy')->name('subscriptions.destroy');
});

/* Permissões */
Route::controller(PermissionController::class)->group(function () {
    Route::get('/permissoes', 'index')->name('permissions.index');
    Route::get('/permissoes/editar/{user}', 'edit')->name('permissions.edit');
    Route::put('/permissoes/{user}', 'update')->name('permissions.update');
});

/* Afiliados */
Route::controller(AfiliateController::class)->group(function () {
    Route::get('/afiliados', 'index')->name('affiliates.crud.index');
    Route::get('/afiliados/create', 'create')->name('affiliates.crud.create');
    Route::get('/afiliados/show/{affiliate}', 'show')->name('affiliates.crud.show');
    Route::get('/afiliados/edit', 'edit')->name('affiliates.crud.edit');
    Route::post('/afiliados/store', 'store')->name('affiliates.crud.store');
    Route::post('/afiliados/update/{affiliate}', 'update')->name('affiliates.crud.update');
    Route::delete('/afiliados/delete', 'destroy')->name('affiliates.crud.delete');

    // rendimento afiliados
    Route::get('/afiliados/rendimentos', 'income')->name('affiliates.income');
    Route::get('/afiliados/rendimentos/show/{affiliate}', 'showIncome')->name('affiliates.income.show');
});

/* Rendimentos afiliados (usuário principal) */
Route::controller(AffiliateIncomeController::class)->group(function () {
    Route::get('/rend-afiliados', 'index')->name('rend.afiliados.index');
    Route::get('/rend-afiliados/xlsx', 'exportXlsx')->name('rend.afiliados.xlsx');
    Route::get('/rend-afiliados/csv', 'exportCsv')->name('rend.afiliados.csv');
});



// Relatório Remarketing
Route::controller(RemarketingReportController::class)->group(function () {
    Route::get('/relatorio-remarketing', 'index')->name('messages.rm-report.index');
    Route::get('/relatorio-remarketing/exportar-excel', 'exportExcel')->name('messages.rm-report.export-excel');
    Route::get('/relatorio-remarketing/exportar-pdf', 'exportPdf')->name('messages.rm-report.export-pdf');
    Route::get('/relatorio-remarketing/{report}', 'show')->name('messages.rm-report.show');
});

// Relatório Cobranças
Route::controller(ChargeReportController::class)->group(function () {
    Route::get('/relatorio-cobrancas', 'index')->name('messages.charge-report.index');
    Route::get('/relatorio-cobrancas/exportar-excel', 'exportExcel')->name('messages.charge-report.export-excel');
    Route::get('/relatorio-cobrancas/exportar-pdf', 'exportPdf')->name('messages.charge-report.export-pdf');
    Route::get('/relatorio-cobrancas/{report}', 'show')->name('messages.charge-report.show');
});

// Relatório Faturamento
Route::controller(FaturamentoReportController::class)->group(function () {
    Route::get('/relatorio-faturamento', 'index')->name('messages.ft-report.index');
    Route::get('/relatorio-faturamento/exportar-excel', 'exportExcel')->name('messages.ft-report.export-excel');
    Route::get('/relatorio-faturamento/exportar-pdf', 'exportPdf')->name('messages.ft-report.export-pdf');
    Route::get('/relatorio-faturamento/{report}', 'show')->name('messages.ft-report.show');
});

// Relatório Rastreamento
Route::controller(RastreamentoReportController::class)->group(function () {
    Route::get('/relatorio-rastreamento', 'index')->name('messages.rt-report.index');
    Route::get('/relatorio-rastreamento/exportar-excel', 'exportExcel')->name('messages.rt-report.export-excel');
    Route::get('/relatorio-rastreamento/exportar-pdf', 'exportPdf')->name('messages.rt-report.export-pdf');
    Route::get('/relatorio-rastreamento/{report}', 'show')->name('messages.rt-report.show');
});

/* Logs */
Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

/* Charts */
Route::controller(ChartAdmController::class)->group(function () {
    Route::get('/charts/adm/msg-enviadas', 'msgEnviadas')->name('charts.adm.msgs-sent');
    Route::get('/charts/adm/usuarios/remarketing', 'usuariosRemarketing')->name('charts.adm.users-remarketing');
    Route::get('/charts/adm/up-dow-plans', 'upgradeEndDowngradPlans')->name('charts.adm.up-dow-plans');
    Route::get('/charts/adm/novos-clientes', 'newCustomers')->name('charts.adm.new-customers');
});
Route::controller(ChartUserMainController::class)->group(function () {
    Route::get('/charts/usuario/msgs-visua', 'visuaMsgs');
    Route::get('/charts/usuario/msgs-entreg', 'entregMsgs');
    Route::get('/charts/usuario/msgs-faixa-etaria', 'msgFaixaEtaria');
    Route::get('/charts/usuario/msgs-genero', 'msgGenero');
    Route::get('/charts/usuario/entrega-msg-anual', 'entregaMsgAnual');
    Route::get('/charts/usuario/msg-enviadas-estados', 'msgEnviadasEstado');
    Route::get('/charts/usuario/satis-clients', 'satisfacaoClientes');
    Route::get('/charts/usuario/satis-media', 'satisfacaoMedia');
    Route::get('/charts/usuario/envio-notific', 'envioNotificacoes');
});

// Melhorias
Route::resource('/sugestoes', SuggestionsController::class)->parameter('sugestoes', 'sugestao');
Route::post('/sugestoes/votar/{suggestion}', [VotesSuggestionController::class, 'setVote'])->name('sugestoes.votar');
Route::post('/sugestoes/remover-voto/{suggestion}', [VotesSuggestionController::class, 'removeVote'])->name('sugestoes.remover-voto');
Route::post('/sugestoes/cometarios/store', [SuggestionsAnswerController::class, 'store'])->name('sugestoes.comentorios.store');
Route::delete('/sugestoes/cometarios/deletar/{suggestionAnswer}', [SuggestionsAnswerController::class, 'destroy'])->name('sugestoes.comentorios.destroy');

//Central de ajuda
Route::prefix('central-ajuda')->name('central.ajuda.')->controller(HelpCenterController::class)->group(function () {
    Route::get('', 'introducao')->name('introducao');
    Route::get('/registro', 'registro')->name('registro');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/menu-superior', 'menuSuperior')->name('menu.superior');
    Route::get('/usuarios', 'usuarios')->name('usuarios');
    Route::get('/plano-atual', 'configConta')->name('config.conta.plano.atual');
    Route::get('/financeiro', 'financeiro')->name('config.conta.financeiro');
    // Configurar modulos
    Route::get('/configurar-modulo-cobrancas', 'cobrancas')->name('config.sistema.cobrancas');
    Route::get('/configurar-modulo-faturamento', 'faturamento')->name('config.sistema.faturamento');
    Route::get('/configurar-modulo-rastreamento', 'rastreamento')->name('config.sistema.rastreamento');
    Route::get('/configurar-modulo-remarketing', 'remarketing')->name('config.sistema.remarketing');
    // Configurar mensagens
    Route::get('/apresentacao-mensagens', 'msgApresentacao')->name('config.mensagens.apresentacao');
    Route::get('/relatorio-mensagens', 'relatMensagens')->name('config.mensagens.relatorio');
    Route::get('/configurar-mensagem-agradecimento', 'agradecimento')->name('config.mensagens.agradecimento');
    Route::get('/configurar-mensagem-aniversario', 'aniversario')->name('config.mensagens.aniversario');
    Route::get('/configurar-mensagem-pesquisa-satisfacao', 'pesquisaSatisfacao')->name('config.mensagens.pesquisa.satisfacao');
    Route::get('/configurar-mensagens-cobrancas', 'msgCobrancas')->name('config.mensagens.cobrancas');
    Route::get('/configurar-mensagens-faturamento', 'msgFaturamento')->name('config.mensagens.faturamento');
    // Dados importados
    Route::get('/apresentacao-dados-importados', 'impApresentacao')->name('config.dados.importados.apresentacao');
    Route::get('/dados-importados-modulo-cobrancas', 'impCobrancas')->name('config.dados.importados.cobrancas');
    Route::get('/dados-importados-modulo-faturamento', 'impFaturamento')->name('config.dados.importados.faturamento');
    Route::get('/dados-importados-modulo-rastreamento', 'impRastreamento')->name('config.dados.importados.rastreamento');
    Route::get('/dados-importados-modulo-remarketing', 'impRemarketing')->name('config.dados.importados.remarketing');
    // Relatórios
    Route::get('/apresentacao-relatorios', 'relApresentacao')->name('relat.apresentacao');
    Route::get('/relatorio-cobrancas', 'relCobrancas')->name('relat.cobrancas');
    Route::get('/relatorio-faturamento', 'relFaturamento')->name('relat.faturamento');
    Route::get('/relatorio-rastreamento', 'relRastreamento')->name('relat.rastreamento');
    Route::get('/relatorio-remarketing', 'relRemarketing')->name('relat.remarketing');
    // Sugestões
    Route::get('/sugestoes', 'sugestoes')->name('sugestoes');
    // Anexos
    Route::get('/integracao-correios', 'integracaoCorreios')->name('integracao.correios');
    Route::get('/perfil', 'perfil')->name('perfil');
});

/* ================== */
// Route::get('teste', [RemarketingImportController::class, 'exportTest']);
// Route::get('teste', [CobrancaImportController::class, 'exportTest']);
// Route::get('teste', [RastreamentoImportController::class, 'exportTest']);
// Route::get('teste', [FaturamentoImportController::class, 'exportTest']);
// Route::get('teste', [RegisterController::class, 'testeEnviar']);
// Route::get('teste2', [RegisterController::class, 'teste']);
Route::get('/teste3', function (Request $request) {


    // $x = \App\Models\SendingSetting::latest()->first();
    // $x = \App\Models\ConfigSistemaModulo::latest()->first();
    // unset($x['settings']);
    // return $x;


    // $totalEnvios = 5;
    // $intervaloHrs = 3;
    // $minDiasENFV = ($totalEnvios - 1) * $intervaloHrs + $totalEnvios;

    // dd($minDiasENFV);

    // // dd(userHasModule(2));


    // return Str::slug('Enviar mensagem de localização atual e próxima cidade da mercadoria', '_');
});

use Illuminate\Support\Facades\Cookie;
Route::get('/delete_cookies', function (Request $request) {
    // session
    $allSessions = Session::all();
    Session::flush();
    // cookie
    $response = response('Removendo todos os cookies');
    foreach (request()->cookies as $name => $value) {
        $response->withCookie(Cookie::forget($name));
    }

    return ['status' => 'success'];
    return response()->json($allSessions);
});

// Route::get('/x', function () {
//     return \App\Models\ConfigSistemaModulo::find(3);
// });
