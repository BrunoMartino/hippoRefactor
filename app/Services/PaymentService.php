<?php

namespace App\Services;

use App\Models\User;
use App\Models\Plano;
use App\Models\Invoice;
use App\Models\CardToken;
use App\Models\UsedCoupons;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\CompraUsuario;
use App\Models\DiscountCoupon;
use App\Models\PaymentInvoice;
use App\Services\InvoiceService;
use PhpParser\Node\FunctionLike;
use App\Models\UsuariosComprados;
use App\Services\ApiLytexService;
use App\Models\ControlQuantMessage;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $apiLytex;
    protected $invoiceService;

    public function __construct(ApiLytexService $apiLytex, InvoiceService $invoiceService)
    {
        $this->apiLytex = $apiLytex;
        $this->invoiceService = $invoiceService;
    }

    /**
     * Confirmar pagamento para cartão
     *
     * @param  string $typeAction contratar|alterar
     * @return void
     */
    public function confirmPaymentPlan($cartao, $plan, $invoiceId, $typeAction)
    {
        $user = user_princ();

        if (session()->has('change_card')) :
            $cardTokenData = null;
        else :
            $cardTokenData = CardToken::where('user_id', $user->id)
                ->where('situacao', 'ativo')
                ->first()
                ?->toArray();
        endif;

        if (!$cardTokenData) :
            $cartao['num_cartao'] = str_replace(" ", "", $cartao['num_cartao']);

            $cardToken = $this->apiLytex->invoicesCardToken($cartao);

            if (!$cardToken) :
                return redirect()->back()->with('error', 'Não foi possível utilizar seu cartão, confira os dados informados.');
            endif;

            $cardTokenData = [
                'user_id' => $user->id,
                'card_token_id' => $cardToken->_id,
                'card_number' => $cardToken->cardNumber,
                'brand' => $cardToken->brand,
                'status' => $cardToken->status
            ];

            CardToken::updateOrCreate(
                ['user_id' => $user->id],
                $cardTokenData
            );
        endif;

        $cardTokenId = $cardTokenData['card_token_id'];

        $invoicePay = $this->apiLytex->invoicesPay($invoiceId, $cardTokenId);
        if ($invoicePay->statusCode !== 200 && $invoicePay->statusCode !== 201) :
            return redirect()->back()->with('error', 'Não foi possível realizar o pagamento, confira os dados informados.');
        endif;

        if ($invoicePay->status === 'paid') :
            $paymentInvoiceData = [
                'user_id' => $user->id,
                'invoice_id' => $invoiceId,
                'payment_method' => $invoicePay->paymentMethod,
                'status' => $invoicePay->status,
                'transaction_id' => $invoicePay->_id,
                'payed_at' => $invoicePay->payedAt,
                'card_token_id' => $cardTokenId,
                'credit_card' => json_encode($invoicePay->creditCard),
                'request_meta_data' => json_encode($invoicePay->requestMetadata)
            ];
            PaymentInvoice::create($paymentInvoiceData);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoicePay->status,
                    'date_payment' => now(),
                    'situation' => null
                ]);
        elseif ($invoicePay->status === 'processing') :
            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoicePay->status,
                    'situation' => 'processing'
                ]);
        elseif ($invoicePay->status === 'waitingPayment') :
            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'situation' => 'unpaid'
                ]);

            if ($typeAction == 'contratar') :
                return redirect()->route('buy-plan.invoice.regenerate');
            endif;
            if ($typeAction == 'alterar') :
                return redirect()->route('change-plan.invoice.regenerate');
            endif;
        endif;

        $subscription = $this->setUserNewPlan($user->id, $plan);

        // salvar registro de cupom utilizado depois de fazer o pagamento
        if (!is_null(session('discount_coupon'))) :
            $couponCode = session('discount_coupon');
            $this->saveUsedCoupon($plan, $couponCode, $subscription->id);
        endif;

        $this->setQuantMessage($user->id, $plan);

        session()->forget('discount_coupon');
        session()->forget('invoiceId');
        session()->forget('fatura_gerada');
        session()->forget('change_card');
        session()->forget('fatura_cartao');
        session()->forget('fatura_pix');
        session()->forget('fatura_erro_pagamento');

        if ($typeAction == 'contratar') :
            return redirect()->route('dashboard')->withSuccess('Plano contratado com sucesso!');
        endif;
        if ($typeAction == 'alterar') :
            return redirect()->route('config.user-account.current-plan')->withSuccess('Plano alterado com sucesso!');
        endif;
    }

    /**
     * Salvar cupom se foi enviado e se é valido
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function saveSessionCouponExists($couponCode): array
    {
        // resetar session
        session()->forget('discount_coupon');

        // se tem cupom
        if ($couponCode != null) :
            $validateCoupon = (new CouponService)->validateCoupon($couponCode);

            // se cupom tem erro
            if ($validateCoupon['error']) :
                $msgErro = $validateCoupon['response']->original['message'];
                return [
                    'error' => true,
                    'redir' => redirect()->back()->withInput()->withWarning($msgErro)
                ];
            else :
                // criar session com cupom valido
                session()->put('discount_coupon', $couponCode);
            endif;
        endif;

        return [
            'error' => false,
            'redir' => null,
        ];
    }

    /**
     * Alocar usuário ao novo plano
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Plano $plan
     * @param  $couponId  id/null
     * @return null|object
     */
    public function setUserNewPlan($userId, $plan): ?object
    {
        // $plan = Plano::find(session('change_plan_id'));
        $couponId = null;
        if (!is_null(session('discount_coupon'))) :
            $coupon = DiscountCoupon::where('code', session('discount_coupon'))
                ->first();
            $couponId = $coupon->id;
        endif;

        $user = User::find($userId);
        $user->plano_id = $plan->id;
        $user->save();

        // a inscrição atual
        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'ativo')
            ->whereHas('plan', function ($q) use ($plan) {
                return $q->where('modulo_id',  $plan->modulo_id);
            })
            ->whereNull('data_change')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($subscription) :


            /* Desabilitar plano atual se a alteração for para um plano do mesmo módulo */
            if ($subscription->plan->modulo_id == $plan->modulo_id && $subscription->days_expire_paid_plan != 'Expirado') :
                $subscription->status = 'inativo';
                $subscription->data_change = now();
                $subscription->save();

                // criar nova inscrição
                return Subscription::create([
                    'user_id' => $userId,
                    'plan_id' => $plan->id,
                    'valor_plano' => (float) $plan->valor,
                    'coupon_id' => $couponId,
                    'status' => 'ativo'
                ]);
            else: //se for apenas plano expirado, renovar ele
                if ($subscription->days_expire_paid_plan == 'Expirado'):
                    $subscription->created_at = now();
                    $subscription->status = 'ativo';
                    $subscription->save();
                endif;

                return $subscription;
            endif;


        else :
            // $subscription = Subscription::where('user_id', $userId)->first();
            // if ($subscription) :
            //     $subscription->update([
            //         'valor_plano' => (float) $plan->valor,
            //         'coupon_id' => $couponId,
            //         'status' => 'ativo'
            //     ]);
            // endif;
            // $subscription->refresh();
            return Subscription::create([
                'user_id' => $userId,
                'plan_id' => $plan->id,
                'valor_plano' => (float) $plan->valor,
                'coupon_id' => $couponId,
                'status' => 'ativo'
            ]);
        endif;
    }

    /**
     * Salvar cupom utilizado pro usuário
     *
     * @param  \App\Models\Plano $plan
     * @param  string $couponCode
     * @param   $subscription
     * @return object|null
     */
    public function saveUsedCoupon($plan, $couponCode, $subscriptionId): ?object
    {
        // $plan = Plano::find(session('change_plan_id'));
        $coupon = DiscountCoupon::where('code', $couponCode)
            ->first();

        return UsedCoupons::create([
            'user_id' => user_princ()->id,
            'modulo_id' => $plan->modulo_id,
            'plano_id' => $plan->id,
            'cupom_id'  => $coupon->id,
            'subscription_id' => $subscriptionId
        ]);
    }

    public function getDiscount(DiscountCoupon $coupon, Plano $plan): float
    {
        // se desconto for em valor
        if (!is_null($coupon->value)) :
            $valorDescontoCupom = $coupon->value;
        else : // se deconto for em porcentagem
            $porcentagemCalculada = ($coupon->percent / 100) * $plan->valor;
            $valorDescontoCupom = $porcentagemCalculada;
        endif;

        if ($valorDescontoCupom < 0)
            $valorDescontoCupom = 0;

        return $valorDescontoCupom;
    }

    /**
     * Obter validação de cupom e valor de desconto
     *
     * @param  string $couponCode
     * @param  \App\Models\Plano $plan
     * @return array
     */
    public function getValidCouponDiscountValue(String $couponCode, Plano $plan): array
    {
        $coupon = DiscountCoupon::where('code', $couponCode)->first();
        $validateCoupon = (new CouponService)->validateCoupon($couponCode);

        $data = [
            'error' => false,
            'msg' => null,
            'discountValue' => 0
        ];

        if ($validateCoupon['error']) :
            $data['error'] = true;
            $data['msg'] = $validateCoupon['response']->original['message'];
        else :
            $data['discountValue'] = $this->getDiscount($coupon, $plan);
        endif;

        return $data;
    }

    public function redirectBackCouponInvalid(String $couponCode): array
    {
        $coupon = DiscountCoupon::where('code', $couponCode)->first();
        $validateCoupon = (new CouponService)->validateCoupon($couponCode);

        // se cupom é invalido
        if ($validateCoupon['error']) :
            $msgErro = $validateCoupon['response']->original['message'];

            return [
                'error' => true,
                'redirect' => redirect()->back()->withInput()->withWarning($msgErro),
            ];
        endif;

        return [
            'error' => false,
            'redirect' => null,
            'coupon' => $coupon
        ];
    }

    public function setQuantMessage($userId, $plan)
    {
        // $plan = Plano::find(session('change_plan_id'));
        $controlQuantMessage = ControlQuantMessage::firstOrNew(['user_id' => $userId]);
        $controlQuantMessage->quant_mensagens = $controlQuantMessage->quant_mensagens + $plan->limite_mensagens;
        $controlQuantMessage->save();
    }

    public function getDiscountCoupon($planId)
    {
        $plan = Plano::find($planId);
        $valorDescontoCupom = 0;
        // Se tiver cupom
        if (session('discount_coupon')) :
            $couponCode = session('discount_coupon');
            $validCouponDiscountValue = $this->getValidCouponDiscountValue($couponCode, $plan);

            if ($validCouponDiscountValue['error']) :
                return redirect()
                    ->route('payment.change-plan', $plan->id)
                    ->withInput()
                    ->withWarning($validCouponDiscountValue['msg']);
            endif;

            $valorDescontoCupom = $validCouponDiscountValue['discountValue'];
        endif;
        return $valorDescontoCupom;
    }

    public function gerarFatura(Plano $plan, $valorPagar, $valorPagarCentavos, $type)
    {
        $userId = user_princ()->id;
        $invoiceId = session('invoiceId');
        $data = [
            'valorPagar' => intval(round($valorPagar * 100)),
            'plan' => $plan
        ];

        if (session('fatura_gerada')) :
            $invoiceData = Invoice::where('invoice_id', $invoiceId)
                ->first()
                ?->toArray();
            if ($invoiceData) :
                if ($invoiceData['total_value'] !== $valorPagarCentavos) :
                    $invoice = $this->apiLytex->updateInvoice($invoiceId, $data);
                    if ($invoice->statusCode !== 200 && $invoice->statusCode !== 201) :
                        return redirect()->back()->with('error', 'Não foi possível processar o pagamento, por favor tente daqui alguns instantes');
                    endif;

                    $invoiceData['total_value'] = $invoice->totalValue;
                    $invoiceData['qrcode'] = $invoice->paymentMethods->pix->qrcode;

                    Invoice::where('invoice_id', $invoiceId)
                        ->update([
                            'total_value' => $invoice->totalValue,
                            'qrcode' => $invoice->paymentMethods->pix->qrcode
                        ]);
                else :
                    $invoiceData = Invoice::where('invoice_id', $invoiceId)
                        ->first()
                        ?->toArray();
                endif;
            endif;
        elseif (session()->has('fatura_cartao') || session()->has('fatura_pix') || session()->has('fatura_erro_pagamento')) :
            $invoiceData = Invoice::where('invoice_id', $invoiceId)
                ->first()
                ?->toArray();
        else :
            $invoice = $this->apiLytex->invoices($data);
            if ($invoice->statusCode != 200 && $invoice->statusCode != 201) :
                return redirect()->back()->with('error', 'Fatura não gerada, favor confirmar seus dados de cadastro e tentar novamente.');
            endif;


            $invoiceData = [
                'user_id' => $userId,
                'plan_id' => $plan->id,
                'client_id' => $invoice->_clientId,
                'invoice_id' => $invoice->_id,
                'type' => $type,
                'status' => $invoice->status,
                'total_value' => $invoice->totalValue,
                'qrcode' => $invoice->paymentMethods['pix']['qrcode'],
                'discount_coupon' => session('discount_coupon')
            ];

            Invoice::create($invoiceData);
        endif;

        return $invoiceData;
    }

    public function gerarFaturaUsers($data)
    {
        $userId = user_princ()->id;
        $invoiceId = $data['invoiceId'];
        $plan = $data['plan'];

        if (session('fatura_gerada_users') || session()->has('fatura_cartao') || session()->has('fatura_pix')) :
            $invoiceData = Invoice::where('invoice_id', $invoiceId)
                ->first()
                ?->toArray();
        else :
            $invoice = $this->apiLytex->invoices($data);

            if ($invoice->statusCode !== 200 && $invoice->statusCode !== 201) :
                return redirect()->back()->with('error', 'Fatura não gerada, favor tentar novamente.');
            endif;

            $invoiceData = [
                'user_id' => $userId,
                'plan_id' => $plan->id,
                'client_id' => $invoice->_clientId,
                'invoice_id' => $invoice->_id,
                'type' => 'buy_user',
                'status' => $invoice->status,
                'total_value' => $invoice->totalValue,
                'qrcode' => $invoice->paymentMethods->pix->qrcode,
                'quant_users' => $data['total']
            ];
            Invoice::create($invoiceData);
        endif;

        return $invoiceData;
    }

    public function verifyMethodPayment()
    {
        // Se tem cartão cadastrado
        $card = CardToken::where('user_id', user_princ()->id)
            ->where('situacao', 'ativo')
            ->first();
        if ($card) :
            return $card;
        else :
            return false;
        endif;
    }

    public function getTipoVenda($request)
    {
        $subTitulo = '';
        if ($request->segment(1) == 'trocar-plano') :
            $subTitulo = 'Trocar Plano';
        endif;
        return $subTitulo;
    }

    public function faturaCanceladaCliente()
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'change_plan')
            ->where('status', 'waitingPayment')
            ->where('situation', 'cancel_client')
            ->first();
        return $invoice;
    }

    public function confirmPaymentUsersCard($cartao, $invoiceId)
    {
        $user = user_princ();
        $data = $this->getDataInvoice($invoiceId);

        if (session()->has('change_card')) :
            $cardTokenData = null;
        else :
            $cardTokenData = CardToken::where('user_id', $user->id)
                ->where('situacao', 'ativo')
                ->first()
                ?->toArray();
        endif;

        if (!$cardTokenData) :
            $cartao['num_cartao'] = str_replace(" ", "", $cartao['num_cartao']);

            $cardToken = $this->apiLytex->invoicesCardToken($cartao);

            if (!$cardToken) :
                return redirect()->back()->with('error', 'Não foi possível utilizar seu cartão, confira os dados informados.');
            endif;

            $cardTokenData = [
                'user_id' => $user->id,
                'card_token_id' => $cardToken->_id,
                'card_number' => $cardToken->cardNumber,
                'brand' => $cardToken->brand,
                'status' => $cardToken->status
            ];

            CardToken::updateOrCreate(
                ['user_id' => $user->id],
                $cardTokenData
            );
        endif;

        $cardTokenId = $cardTokenData['card_token_id'];

        $invoicePay = $this->apiLytex->invoicesPay($invoiceId, $cardTokenId);
        if ($invoicePay->statusCode !== 200 && $invoicePay->statusCode !== 201) :
            return redirect()->back()->with('error', 'Não foi possível realizar o pagamento, confira os dados informados.');
        endif;

        if ($invoicePay->status === 'paid') :
            $paymentInvoiceData = [
                'user_id' => $user->id,
                'invoice_id' => $invoiceId,
                'payment_method' => $invoicePay->paymentMethod,
                'status' => $invoicePay->status,
                'transaction_id' => $invoicePay->_id,
                'payed_at' => $invoicePay->payedAt,
                'card_token_id' => $cardTokenId,
                'credit_card' => json_encode($invoicePay->creditCard),
                'request_meta_data' => json_encode($invoicePay->requestMetadata)
            ];
            PaymentInvoice::create($paymentInvoiceData);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoicePay->status,
                    'date_payment' => now(),
                    'situation' => null
                ]);
        elseif ($invoicePay->status === 'processing') :
            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoicePay->status,
                    'situation' => 'processing'
                ]);
        elseif ($invoicePay->status === 'waitingPayment' || $invoicePay->status === 'recused') :
            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'situation' => 'unpaid'
                ]);

            return redirect()->route('buy-users.invoice.regenerate');
        endif;

        $usuariosComprados = UsuariosComprados::where('situacao', 'pagar')->first();
        $usuariosComprados->situacao = 'pago';
        $usuariosComprados->save();

        // UsuariosComprados::create([
        //     'user_id' => user_princ()->id,
        //     'modulo_id' => $data->modulo_id,
        //     'plano_id' => $data->plan_id,
        //     'total' => $data->quant_users,
        // ]);

        session()->forget('invoiceId');
        session()->forget('change_card');
        session()->forget('fatura_gerada_users');
        session()->forget('existe_fatura');
        session()->forget('fatura_cartao');
        session()->forget('fatura_pix');
        session()->forget('fatura_erro_pagamento');

        return redirect()->route('usuarios')->withSuccess('Usuário(s) comprado(s) com sucesso!');
    }

    public function confirmPaymentUsersPix()
    {
        $invoiceId = session('invoiceId');
        $data = $this->getDataInvoice($invoiceId);

        $detPayment = $this->apiLytex->invoicePaymentDetail($invoiceId);

        if ($detPayment->statusCode !== 200 && $detPayment->statusCode !== 201) :
            session()->put('tipoPagamento', 'pix');
            return redirect()->back()->with('error', 'Pix ainda não foi compensado, favor confirmar novamente dentro de alguns instantes.');
        endif;

        if (isset($detPayment->paymentMethod) && $detPayment->paymentMethod == 'pix') :
            $invoice = $this->apiLytex->invoice($invoiceId);
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

            CompraUsuario::create([
                'user_id' => user_princ()->id,
                'modulo_id' => $data->modulo_id,
                'plano_id' => $data->plan_id,
                'total' => $data->quant_users,
            ]);

            session()->forget('invoiceId');
            session()->forget('fatura_gerada_users');
            session()->forget('existe_fatura');
            session()->forget('fatura_cartao');
            session()->forget('fatura_pix');
            session()->forget('fatura_erro_pagamento');
            session()->forget('change_card');

            return redirect()->route('usuarios')->withSuccess('Usuário(s) comprado(s) com sucesso!');
        endif;
    }

    private function getDataInvoice($invoiceId): object
    {
        $invoice = Invoice::find($invoiceId);
        $plano = Plano::find($invoice->plan_id);
        return (object) [
            'plan_id' => $plano->id,
            'modulo_id' => $plano->modulo_id,
            'quant_users' => $invoice->quant_users
        ];
    }

    public function processingChangePlanPayment($invoiceId)
    {
        $user = user_princ();

        $detPayment = $this->apiLytex->invoicePaymentDetail($invoiceId);
        $invoice = $this->apiLytex->invoice($invoiceId);
        if (!$invoice) {
            return redirect()->back()->withErrors('Erro ao consultar a fatura. Tente novamente mais tarde.');
        }
        if (isset($detPayment->paymentMethod)) :
            $paymentInvoiceData = [
                'user_id' => $user->id,
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
                    'date_payment' => now()
                ]);
            return true;
        endif;
        if ($invoice->status === 'waitingPayment') :

            $subscription = $this->returnUserPlan($user->id);
            $this->deleteUsedCoupon($subscription->id);
            $this->deleteQuantMessage($user->id, $invoiceId);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoice->status,
                    'situation' => 'unpaid'
                ]);

            return redirect()->route('change-plan.invoice.regenerate');
        endif;
        if ($invoice->status === 'processing') :
            return false;
        endif;
        return true;
    }

    public function processingPlanPayment($invoiceId)
    {
        $user = user_princ();

        $detPayment = $this->apiLytex->invoicePaymentDetail($invoiceId);
        $invoice = $this->apiLytex->invoice($invoiceId);
        if (!$invoice) {
            return redirect()->back()->withErrors('Erro ao consultar a fatura. Tente novamente mais tarde.');
        }
        if (isset($detPayment->paymentMethod)) :
            $paymentInvoiceData = [
                'user_id' => $user->id,
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
                    'date_payment' => now()
                ]);
            return true;
        endif;
        if ($invoice->status === 'waitingPayment') :

            $subscription = $this->setUserFreePlan($user->id);
            $this->deleteUsedCoupon($subscription->id);
            $this->setQtdMsgFreePlan($user->id);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoice->status,
                    'situation' => 'unpaid'
                ]);

            return redirect()->route('buy-plan.invoice.regenerate');
        endif;
        if ($invoice->status === 'processing') :
            return false;
        endif;
        return true;
    }

    public function returnUserPlan($userId)
    {
        $oldSubscription = Subscription::where('user_id', $userId)
            ->where('status', 'inativo')
            ->orderBy('data_change', 'desc')
            ->first();

        if ($oldSubscription) :
            $oldSubscription->update([
                'status' => 'ativo',
                'data_change' => null
            ]);
        endif;

        $user = User::find($userId);
        $user->plano_id = $oldSubscription->plan_id;
        $user->save();

        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'ativo')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($subscription) :
            $subscription->delete();
        endif;
        return $subscription;
    }

    public function setUserFreePlan($userId)
    {
        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'ativo')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($subscription) :
            $subscription->delete();
        endif;

        Subscription::create([
            'user_id' => $userId,
            'plan_id' => 4,
            'status' => 'ativo'
        ]);

        $user = User::find($userId);
        $user->plano_id = 4;
        $user->save();

        return $subscription;
    }

    public function deleteUsedCoupon($subscriptionId)
    {
        $usedCoupon = UsedCoupons::where('subscription_id', $subscriptionId)
            ->first();
        if ($usedCoupon) :
            $usedCoupon->forceDelete();
        endif;
    }

    public function deleteQuantMessage($userId, $invoiceId)
    {
        $invoice = Invoice::with('plan')->find($invoiceId);

        $controlQuantMessage = ControlQuantMessage::firstOrNew(['user_id' => $userId]);
        $controlQuantMessage->quant_mensagens = $controlQuantMessage->quant_mensagens - $invoice->plan->limite_mensagens;
        $controlQuantMessage->save();
    }

    public function setQtdMsgFreePlan($userId)
    {
        ControlQuantMessage::where('user_id', $userId)
            ->update([
                'quant_mensagens' => 1000,
            ]);
    }

    public function processingUsersPayment($invoiceId)
    {
        $user = user_princ();

        $detPayment = $this->apiLytex->invoicePaymentDetail($invoiceId);
        $invoice = $this->apiLytex->invoice($invoiceId);
        if (!$invoice) {
            return redirect()->back()->withErrors('Erro ao consultar a fatura. Tente novamente mais tarde.');
        }
        if (isset($detPayment->paymentMethod)) :
            $paymentInvoiceData = [
                'user_id' => $user->id,
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
                    'date_payment' => now()
                ]);
            return true;
        endif;
        if ($invoice->status === 'waitingPayment') :

            $this->deleteQuantUsers($user->id);

            Invoice::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $invoice->status,
                    'situation' => 'unpaid'
                ]);

            return redirect()->route('buy-users.invoice.regenerate');
        endif;
        if ($invoice->status === 'processing') :
            return false;
        endif;
        return true;
    }

    public function deleteQuantUsers($userId)
    {
        $usuarios = CompraUsuario::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($usuarios) :
            $usuarios->delete();
        endif;
    }
}
