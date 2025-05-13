<?php

namespace App\Http\Controllers\Payment;

use App\Models\User;
use App\Models\Plano;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\PaymentInvoice;
use App\Services\PaymentService;
use App\Services\ApiLytexService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use chillerlan\QRCode\{QRCode, QROptions};

class PaymentPlanController extends Controller
{
    protected $paymentService;
    protected $lytexService;

    public function __construct(PaymentService $paymentService, ApiLytexService $lytexService)
    {
        $this->middleware('auth');
        $this->paymentService = $paymentService;
        $this->lytexService = $lytexService;
    }

    public function paymentPlan()
    {
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;
        

        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });
        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;


        if (session()->has('existe_fatura')) :
            if (session()->has('tipoPagamento') && session('tipoPagamento') === 'pix') :
                return redirect()->route('payment.pix');
            else:
                return redirect()->route('payment.methods');
            endif;
        endif;

        return view('pages.payment.plan.payment_plan', compact('plan'));
    }

    public function saveCouponExists(Request $request)
    {
        $saveCouponExists = $this->paymentService->saveSessionCouponExists($request->cupom_valido);

        if ($saveCouponExists['error']) :
            return $saveCouponExists['redir'];
        endif;

        return redirect()->route('payment.methods');
    }

    public function paymentMethods()
    {
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;
        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });

        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;

        $valorDescontoCupom = $this->paymentService->getDiscountCoupon($plan->id);
        $valorPagar = $plan->valor - $valorDescontoCupom;

        // itens compra
        $itensCompra = "{$plan->modulo->titulo}/Plano " . ucfirst($plan->nome);
        $itensCompra .= " - {$plan->qtd_usuarios} " . ($plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário');
        $itensCompra .= " - $plan->qtd_instancias " . ($plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância');
        $itensCompra .= " - " . number_format($plan->limite_mensagens, 0, ',', '.') . ' Mensagens';

        return view('pages.payment.plan.opcoes', compact('valorPagar', 'itensCompra'));
    }

    public function checkoutCartao()
    {
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;
        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });

        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;

        $responsePrepare = $this->preparePayment($plan);
        $valorPagar = $responsePrepare['valorPagar'];

        $response = $this->paymentService->verifyMethodPayment();

        if (!session('change_card')) :
            if (isset($response->card_token_id)) :
                $card = $response;
                return view('pages.payment.plan.payment_plan_cartao', compact('plan', 'card', 'valorPagar'));
            endif;
        endif;

        // itens
        $itensCompra = "{$plan->modulo->titulo}/Plano " . ucfirst($plan->nome);
        $itensCompra .= " - {$plan->qtd_usuarios} " . ($plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário');
        $itensCompra .= " - $plan->qtd_instancias " . ($plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância');
        $itensCompra .= " - " . number_format($plan->limite_mensagens, 0, ',', '.') . ' Mensagens';

        session()->put('fatura_cartao', true);

        return view('pages.payment.plan.cartao', compact('valorPagar', 'itensCompra'));
    }

    public function checkoutPix()
    {
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;
        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });

        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;

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

        return view('pages.payment.plan.pix', compact('valorPagar', 'itensCompra', 'imgQRCode', 'qrcode'));
    }

    public function changeCard(Plano $plan)
    {
        session()->put('change_card', true);
        return redirect()->route('payment.cartao');
    }

    public function preparePayment(Plano $plan)
    {
        $valorDescontoCupom = $this->paymentService->getDiscountCoupon($plan->id);
        $valorPagar = $plan->valor - $valorDescontoCupom;
        $valorPagarCentavos = (string) intval(round($valorPagar * 100));

        try {
            $invoiceData = $this->paymentService->gerarFatura($plan, $valorPagar, $valorPagarCentavos, 'buy_plan');
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
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;

        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });

        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;

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
        $typeAction = 'contratar';

        $responsePayment = $this->paymentService->confirmPaymentPlan($cartao, $plan, $invoiceId, $typeAction);
        if ($responsePayment instanceof \Illuminate\Http\RedirectResponse) :
            return $responsePayment;
        endif;
    }

    public function confirmPaymentPix()
    {
        $invoiceId = session()->get('invoiceId');
        $user = User::find(user_princ()->id);
        // $plan = $user->subscription()->plan;

        $plan = $user->subscriptionAll()
            // ->where('status', 'ativo')
            ->whereHas('plan', function ($q) {
                return $q->where('valor', '>', 0);
            });

        if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
        } else {
            return redirect()->route('config.user-account.change-plan');
        }

        $plan = $plan->latest()->first()->plan;

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

            Subscription::where('user_id', $user->id)
                ->where('plan_id', $plan->id)
                // ->where('status', 'inativo')
                ->update([
                    'created_at' => now(),
                    'status' => 'ativo',
                ]);

            // salvar registro de cupom utililzado depois de fazer o pagamento
            if (!is_null(session('discount_coupon'))) :
                $couponCode = session('discount_coupon');

                $plan = $user->subscriptionAll()
                    // ->where('status', 'ativo')
                    ->whereHas('plan', function ($q) {
                        return $q->where('valor', '>', 0);
                    });

                if (isset($plan->latest()->first()->plan) || !is_null($plan->latest()->first()->plan)) {
                } else {
                    return redirect()->route('config.user-account.change-plan');
                }

                $subsc = $plan->latest()->first();

                $this->paymentService->saveUsedCoupon($plan, $couponCode, $subsc->id);
            endif;

            $this->paymentService->setQuantMessage($user->id, $plan);

            session()->forget('discount_coupon');
            session()->forget('invoiceId');
            session()->forget('fatura_gerada');
            session()->forget('fatura_cartao');
            session()->forget('fatura_pix');
            session()->forget('fatura_erro_pagamento');

            return redirect()->route('dashboard')->withSuccess('Plano contratado com sucesso!');
        endif;
    }
}
