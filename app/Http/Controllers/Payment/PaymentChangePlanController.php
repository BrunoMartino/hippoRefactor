<?php

namespace App\Http\Controllers\Payment;

use App\Models\User;
use App\Models\Plano;
use App\Models\Invoice;
use App\Models\CardToken;
use App\Models\PaymentInvoice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\ApiLytexService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\ToArray;
use chillerlan\QRCode\{QRCode, QROptions};
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Redirect;


class PaymentChangePlanController extends Controller
{
    protected $paymentService;
    protected $lytexService;

    public function __construct(PaymentService $paymentService, ApiLytexService $lytexService)
    {
        $this->middleware(['auth', 'role:usuario_princ']);
        $this->middleware(['check_payment'], ['except' => ['confirmPaymentPlan']]);
        $this->paymentService = $paymentService;
        $this->lytexService = $lytexService;
    }

    /**
     * Tela para inserir cupom e botão ir para o pagamento
     *
     * @param  mixed $plan
     * @return void
     */
    public function paymentPlan(Plano $plan)
    {
        return view('pages.payment.change_plan.payment_plan', compact('plan'));
    }

    public function saveCouponExists(Request $request, Plano $plan)
    {
        $saveCouponExists = $this->paymentService->saveSessionCouponExists($request->cupom_valido);

        if ($saveCouponExists['error']) :
            return $saveCouponExists['redir'];
        endif;

        session()->put('change_plan_id', $plan->id);

        return redirect()->route('payment.change-plan.methods');
    }

    public function paymentMethods()
    {
        if (is_null(session('change_plan_id')))
            return redirect()->route('config.user-account.change-plan');

        $planId = session('change_plan_id');
        // valor a pagar
        $plan = Plano::find($planId);
        $valorDescontoCupom = $this->paymentService->getDiscountCoupon($plan->id);
        $valorPagar = $plan->valor - $valorDescontoCupom;

        // itens compra
        $itensCompra = "{$plan->modulo->titulo}/Plano " . ucfirst($plan->nome);
        $itensCompra .= " - {$plan->qtd_usuarios} " . ($plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário');
        $itensCompra .= " - $plan->qtd_instancias " . ($plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância');
        $itensCompra .= " - " . number_format($plan->limite_mensagens, 0, ',', '.') . ' Mensagens';

        return view('pages.payment.change_plan.opcoes', compact('valorPagar', 'itensCompra'));
    }

    public function checkoutCartao()
    {
        if (is_null(session('change_plan_id')))
            return redirect()->route('payment.change-plan');

        $planId = session('change_plan_id');
        $plan = Plano::find($planId);

        $responsePrepare = $this->preparePayment($plan);
        if ($responsePrepare instanceof \Illuminate\Http\RedirectResponse) :
            return $responsePrepare;
        endif;
        $valorPagar = $responsePrepare['valorPagar'];

        $response = $this->paymentService->verifyMethodPayment();

        if (!session('change_card')) :
            if (isset($response->card_token_id)) :
                $card = $response;
                return view('pages.payment.change_plan.payment_plan_cartao', compact('plan', 'card', 'valorPagar'));
            endif;
        endif;

        // itens
        $itensCompra = "{$plan->modulo->titulo}/Plano " . ucfirst($plan->nome);
        $itensCompra .= " - {$plan->qtd_usuarios} " . ($plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário');
        $itensCompra .= " - $plan->qtd_instancias " . ($plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância');
        $itensCompra .= " - " . number_format($plan->limite_mensagens, 0, ',', '.') . ' Mensagens';

        session()->put('fatura_cartao', true);

        return view('pages.payment.change_plan.cartao', compact('valorPagar', 'itensCompra'));
    }

    public function checkoutPix()
    {
        if (is_null(session('change_plan_id')))
            return redirect()->route('payment.change-plan');

        $planId = session('change_plan_id');
        $plan = Plano::find($planId);

        $responsePrepare = $this->preparePayment($plan);
        if ($responsePrepare instanceof \Illuminate\Http\RedirectResponse) :
            return $responsePrepare;
        endif;

        $valorPagar = $responsePrepare['valorPagar'];
        $invoiceData = $responsePrepare['invoiceData'];

        // obter qrcode
        $imgQRCode = (new QRCode)->render($invoiceData['qrcode'] ?? null);
        $qrcode = $invoiceData['qrcode'] ?? null;

        // itens
        $itensCompra = "{$plan->modulo->titulo}/Plano " . ucfirst($plan->nome);
        $itensCompra .= " - {$plan->qtd_usuarios} " . ($plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário');
        $itensCompra .= " - $plan->qtd_instancias " . ($plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância');
        $itensCompra .= " - " . number_format($plan->limite_mensagens, 0, ',', '.') . ' Mensagens';

        session()->put('fatura_pix', true);

        return view('pages.payment.change_plan.pix', compact('valorPagar', 'itensCompra', 'imgQRCode', 'qrcode'));
    }

    public function changeCard(Plano $plan)
    {
        session()->put('change_card', true);
        return redirect()->route('payment.change-plan.cartao');
    }

    public function preparePayment(Plano $plan)
    {
        $valorDescontoCupom = $this->paymentService->getDiscountCoupon($plan->id);
        $valorPagar = $plan->valor - $valorDescontoCupom;
        $valorPagarCentavos = (string) intval(round($valorPagar * 100));

        try {
            $invoiceData = $this->paymentService->gerarFatura($plan, $valorPagar, $valorPagarCentavos, 'change_plan');
        } catch (\Throwable $th) {
            Log::error('Erro ao gerar fatura: ' . $th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);
            return redirect()->back()->withError('Fatura não gerada, favor confirmar seus dados de cadastro e tentar novamente.');
        }

        if ($invoiceData instanceof \Illuminate\Http\RedirectResponse) :
            return $invoiceData;
        endif;
        

        session()->put('invoiceId', $invoiceData['invoice_id'] ?? null);

        if (!is_null(session('discount_coupon'))) :
            Invoice::where('invoice_id', session('invoiceId'))
                ->update(
                    ['discount_coupon' => session('discount_coupon')]
                );
        endif;

        return [
            'valorPagar' => $valorPagar,
            'invoiceData' => $invoiceData
        ];
    }

    public function confirmPaymentPlan(Request $request)
    {
        $cartao = [];
        $plan = Plano::find(session('change_plan_id'));
        if (isset($request->num_cartao) && !is_null($request->num_cartao)) :
            $cartao = [
                "num_cartao" => $request->num_cartao,
                "nome" => $request->nome,
                "mes_venc" => $request->mes_venc,
                "ano_venc" => $request->ano_venc,
                "cvc" => $request->cvc
            ];
        endif;
        $invoiceId = session('invoiceId');
        $typeAction = 'alterar';

        $responsePayment = $this->paymentService->confirmPaymentPlan($cartao, $plan, $invoiceId, $typeAction);
        if ($responsePayment instanceof \Illuminate\Http\RedirectResponse) :
            return $responsePayment;
        endif;
    }

    public function confirmPaymentPix()
    {
        $invoiceId = session()->get('invoiceId');
        $user = User::find(user_princ()->id);
        $plan = Plano::find(session('change_plan_id'));
        $detPayment = $this->lytexService->invoicePaymentDetail($invoiceId);

        if (!in_array($invoice->statusCode ?? 0, [200, 201])) :
            session()->put('tipoPagamento', 'pix');
            return redirect()->back()->with('error', 'Pix ainda não foi compensado, favor confirmar novamente dentro de alguns instantes.');
        endif;

        if (isset($detPayment->paymentMethod) && $detPayment->paymentMethod == 'pix') :
            $invoice = $this->lytexService->invoice($invoiceId);
            if (!$invoice) {
                return redirect()->back()->withErrors('Erro ao consultar a fatura. Tente novamente mais tarde.');
            }
            $paymentInvoiceData = [
                'user_id' => user_princ()->id,
                'invoice_id' => $invoiceId,
                'payment_method' => $detPayment->paymentMethod,
                'status' => $invoice->status,
                'transaction_id' => $invoice->paymentData->_transactionId,
                'payed_at' => $detPayment->payedAt,
                'parcels' => json_encode($detPayment->parcels),
                'pix' => json_encode($detPayment->pix)
            ];
            PaymentInvoice::create($paymentInvoiceData);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoice->status,
                    'date_payment' => now(),
                    'situation' => null
                ]);

            // alocar usuário a novo plano
            $newSubscription = $this->paymentService->setUserNewPlan($user->id, $plan);

            // salvar registro de cupom utililzado depois de fazer o pagamento
            if (!is_null(session('discount_coupon'))) :
                $couponCode = session('discount_coupon');
                $this->paymentService->saveUsedCoupon($plan, $couponCode, $newSubscription->id);
            endif;

            $this->paymentService->setQuantMessage($user->id, $plan);

            session()->forget('discount_coupon');
            session()->forget('invoiceId');
            session()->forget('fatura_gerada');
            session()->forget('fatura_cartao');
            session()->forget('fatura_pix');
            session()->forget('fatura_erro_pagamento');

            return redirect()->route('config.user-account.current-plan')->withSuccess('Plano alterado com sucesso!');
        endif;
    }
}
