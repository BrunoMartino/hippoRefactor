<?php

namespace App\Http\Controllers\Payment;

use App\Models\Plano;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use App\Models\FaturaCancelada;
use App\Services\ApiLytexService;

class InvoiceController extends Controller
{

    protected $paymentService;
    protected $lytexService;

    public function __construct(PaymentService $paymentService, ApiLytexService $lytexService)
    {
        $this->middleware(['auth', 'role:usuario_princ']);
        $this->paymentService = $paymentService;
        $this->lytexService = $lytexService;
    }


    /**
     * Fatura Gerada
     *
     * @return void
     */
    public function generatedChangePlan()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'change_plan')
            ->where('status', 'waitingPayment')
            ->where('situation', null)
            ->first();

        // redir. para alterar plano
        if (is_null($invoice)) :
            return redirect()->route('config.user-account.change-plan');
        endif;
        session()->put('invoiceId', $invoice->invoice_id);

        $plan = Plano::find($invoice->plan_id);

        $valorCupom = $this->getValueCoupon($plan->valor, $invoice->discount_coupon);
        $valorPagar = $plan->valor - $valorCupom;

        $valorCupom = number_format($valorCupom, 2, ',', '.');
        session()->put('fatura_gerada', true);

        return view('pages.payment.change_plan.invoices.generated', compact('plan', 'valorPagar', 'valorCupom', 'invoice'));
    }

    public function getValueCoupon($planValor, $cupomDesconto)
    {
        $valorCupom = 0.00;
        $coupon = DiscountCoupon::where('code', $cupomDesconto)->first();
        
        if (isset($coupon->value)) :
            // $valorCupom = number_format($coupon->value, 2, ',', '.');
            $valorCupom= $coupon->value;
        endif;
        if (isset($coupon->percent)) :
            $valorCupom = ($coupon->percent / 100) * $planValor;
            // $valorCupom = number_format($valorCupom, 2, '.', '');
        endif;

        return $valorCupom;
    }

    public function cancel($invoiceId)
    {
        $faturaCancelada = $this->lytexService->cancelInvoice($invoiceId);
        if (!$faturaCancelada) :
            return redirect()->back()->with('error', 'Não foi possível cancelar esta fatura, tente novamente em alguns instantes.');
        endif;

        $invoice = Invoice::where('invoice_id', $invoiceId)->first();
        $invoice->situation = 'cancel_client';
        $invoice->status = 'canceled';
        $invoice->save();
        session()->forget('invoiceId');
        session()->forget('fatura_gerada_users');
        session()->forget('fatura_gerada');
        session()->forget('existe_fatura');
        session()->forget('fatura_cartao');
        session()->forget('fatura_pix');
        session()->forget('fatura_erro_pagamento');
        session()->forget('change_card');

        if ($invoice->type === 'buy_user') :
            return redirect()->route('usuarios')->withSuccess('Compra de usuário(s) cancelada!');
        endif;
        return redirect()->route('config.user-account.current-plan')->withSuccess('Fatura cancelada com sucesso!');
    }

    public function generatedBuyUsers()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'buy_user')
            ->where('status', 'waitingPayment')
            ->where('situation', null)
            ->first();

        if (is_null($invoice)) :
            return redirect()->route('usuarios.comprar');
        endif;
        session()->put('invoiceId', $invoice->invoice_id);

        $plan = Plano::find($invoice->plan_id);
        $valor = $invoice->total_value / 100;
        $total = $invoice->quant_users;

        session()->put('fatura_gerada_users', true);
        session()->put('existe_fatura', true);

        return view('pages.payment.users.invoices.generated', compact('plan', 'valor', 'total', 'invoice'));
    }

    public function regenerateChangePlan()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'change_plan')
            ->where('status', 'waitingPayment')
            ->where('situation', 'unpaid')
            ->first();

        if (is_null($invoice)) :
            return redirect()->route('dashboard');
        endif;
        session()->put('invoiceId', $invoice->invoice_id);

        $plan = Plano::find($invoice->plan_id);

        $valorCupom = $this->getValueCoupon($plan->valor, $invoice->discount_coupon);
        $valorPagar = $plan->valor - $valorCupom;

        $valorCupom = number_format($valorCupom, 2, ',', '.');
        session()->put('fatura_erro_pagamento', true);

        return view('pages.payment.change_plan.invoices.regenerate', compact('plan', 'valorPagar', 'valorCupom', 'invoice'));
    }

    public function invoicesProcessing()
    {
        $faturas = Invoice::with(['plan.modulo'])
            ->where('user_id', user_princ()->id)
            ->where('status', 'processing')
            ->latest()->paginate(10);
        return view('pages.payment.processing.invoices.index', compact('faturas'));
    }

    public function regenerateBuyPlan()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'buy_plan')
            ->where('status', 'waitingPayment')
            ->where('situation', 'unpaid')
            ->first();

        if (is_null($invoice)) :
            return redirect()->route('dashboard');
        endif;
        session()->put('invoiceId', $invoice->invoice_id);

        $plan = Plano::find($invoice->plan_id);

        $valorCupom = $this->getValueCoupon($plan->valor, $invoice->discount_coupon);
        $valorPagar = $plan->valor - $valorCupom;

        $valorCupom = number_format($valorCupom, 2, ',', '.');
        session()->put('fatura_erro_pagamento', true);

        return view('pages.payment.change_plan.invoices.regenerate', compact('plan', 'valorPagar', 'valorCupom', 'invoice'));
    }

    public function regenerateBuyUsers()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'buy_user')
            ->where('status', 'waitingPayment')
            ->where('situation', 'unpaid')
            ->first();

        if (is_null($invoice)) :
            return redirect()->route('dashboard');
        endif;
        session()->put('invoiceId', $invoice->invoice_id);

        $plan = Plano::find($invoice->plan_id);
        $valor = $invoice->total_value / 100;
        $total = $invoice->quant_users;
        
        session()->put('fatura_erro_pagamento', true);

        return view('pages.payment.users.invoices.regenerate', compact('plan', 'valor', 'total', 'invoice'));
    }
}