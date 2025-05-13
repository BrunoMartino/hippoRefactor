<?php

namespace App\Http\Controllers\Payment;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\CompraUsuario;
use App\Services\PaymentService;
use App\Models\UsuariosComprados;
use App\Services\ApiLytexService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use chillerlan\QRCode\{QRCode, QROptions};

class PaymentUsersController extends Controller
{
    protected $paymentService;
    protected $lytexService;

    public function __construct(PaymentService $paymentService, ApiLytexService $lytexService)
    {
        $this->middleware('auth');
        $this->paymentService = $paymentService;
        $this->lytexService = $lytexService;
    }

    /**
     * Form para selecionar quantos usuários comprar
     *
     * @return void
     */
    public function formTotal()
    {
        $totalComprado = UsuariosComprados::where('user_id', user_princ()->id)
            // ->where('situacao', 'pago')
            ->sum('qtd_compra');
        return view('pages.payment.users.total', compact('totalComprado'));
    }

    /**
     * Verificar se chegou o limite de 10 usuários comprados
     *
     * @return bool
     */
    public function verificationLimit(): bool
    {
        $totalComprado = UsuariosComprados::where('user_id', user_princ()->id)
            // ->where('situacao', 'pago')
            ->sum('qtd_compra');

        if ($totalComprado >= 10) :
            return true;
        else :
            return false;
        endif;
    }

    public function saveTotalUsersSession(Request $request)
    {
        if (!$request->has('t') || $this->verificationLimit())
            abort(403);

        session()->put('total_usuarios_comprar', $request->t);

        return redirect()->route('usuarios.comprar.detalhes');
    }

    /**
     * Tela com detalhes e botão para ir para tela de pagamento
     *
     * @return void
     */
    public function details()
    {

        if (is_null(session('total_usuarios_comprar')) || $this->verificationLimit()):
            return redirect()->back()->with('error', 'Quantidade de usuário(s) não informada ou excede o limite, tente novamente.');
        endif;

        $total = session('total_usuarios_comprar');
        $valor = $total * 4.90;

        return view('pages.payment.users.details', compact('valor', 'total'));
    }

    public function confirmDetails()
    {
        if (is_null(session('total_usuarios_comprar')) || $this->verificationLimit()):
            return redirect()->back()->with('error', 'Quantidade de usuário(s) não informada ou excede o limite, tente novamente.');
        endif;


        // CompraUsuario::create([
        //     'user_id' => user_princ()->id,
        //     'modulo_id' => $data->modulo_id,
        //     'plano_id' => $data->plan_id,
        //     'total' => $data->quant_users,
        // ]);

        UsuariosComprados::create([
            'situacao' => 'pagar',
            'user_id' => user_princ()->id,
            'qtd_compra' => session('total_usuarios_comprar'),
        ]);

        session()->forget('total_usuarios_comprar');

        // session()->forget('fatura_gerada_users');
        // session()->forget('existe_fatura');
        // session()->forget('fatura_cartao');
        // session()->forget('fatura_pix');
        // session()->forget('fatura_erro_pagamento');
        // session()->forget('change_card');

        // return redirect()->route('usuarios.comprar.pagar');
        return redirect()->route('usuarios')->withSuccess('Usuário(s) adicionado(s) à sua conta com sucesso; a cobrança será incluída na próxima fatura!');
    }

    /* TODO: talvez retirar esse pagamento, acho q agora não é mais utilizado */
    public function paymentMethods()
    {
        if (session()->has('invoiceId')) :
            $invoice = Invoice::find(session('invoiceId'));
            $total = $invoice->quant_users;
        else:
            if (is_null(session('total_usuarios_comprar')) || $this->verificationLimit()):
                return redirect()->back()->with('error', 'Quantidade de usuário(s) não informada ou excede o limite, tente novamente.');
            else:
                $total = session('total_usuarios_comprar');
            endif;
        endif;

        $valor = $total * 4.90;

        return view('pages.payment.users.opcoes', compact('total', 'valor'));
    }

    public function checkoutCartao()
    {
        $user = User::find(user_princ()->id);
        $plan = $user->subscription()->plan;
        $invoice = Invoice::find(session('invoiceId'));

        if (session()->has('fatura_gerada_users')) :
            $total = $invoice->quant_users;
        else:
            $total = session('total_usuarios_comprar');
        endif;

        $valorCentavos = $total * 490;
        $valor = $total * 4.90;

        $data = [
            'tipo' => 'user',
            'valor' => $valorCentavos,
            'total' => $total,
            'plan' => $plan,
            'invoiceId' => $invoice->invoice_id ?? null
        ];

        $this->preparePayment($data);

        $response = $this->paymentService->verifyMethodPayment();

        if (!session('change_card')) :
            if ($response) :
                $card = $response;
                return view('pages.payment.users.checkout_cartao', compact('plan', 'card', 'valor', 'total'));
            endif;
        endif;

        session()->put('fatura_cartao', true);

        return view('pages.payment.users.cartao', compact('total', 'valor'));
    }

    public function checkoutPix()
    {
        $user = User::find(user_princ()->id);
        $plan = $user->subscription()->plan;
        $invoice = Invoice::find(session('invoiceId'));

        if (session()->has('fatura_gerada_users')) :
            $total = $invoice->quant_users;
        else:
            $total = session('total_usuarios_comprar');
        endif;

        $valor = $total * 490;

        $data = [
            'tipo' => 'user',
            'valor' => $valor,
            'total' => $total,
            'plan' => $plan,
            'invoiceId' => $invoice->invoice_id ?? null
        ];

        $invoiceData = $this->preparePayment($data);

        // obter qrcode
        $imgQRCode = (new QRCode)->render($invoiceData['qrcode'] ?? null);
        $qrcode = $invoiceData['qrcode'] ?? null;
        $valor = $total * 4.90;

        session()->put('fatura_pix', true);

        return view('pages.payment.users.pix', compact('valor', 'total', 'imgQRCode', 'qrcode'));
    }

    public function changeCard()
    {
        session()->put('change_card', true);
        return redirect()->route('usuarios.comprar.pagar.cartao');
    }

    public function preparePayment($data)
    {
        try {
            $invoiceData = $this->paymentService->gerarFaturaUsers($data);
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
        session()->put('invoiceId', $invoiceData['invoice_id']);
        return $invoiceData;
    }

    public function confirmPaymentCard(Request $request)
    {
        $cartao = [];
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

        $responsePayment = $this->paymentService->confirmPaymentUsersCard($cartao, $invoiceId);
        if ($responsePayment instanceof \Illuminate\Http\RedirectResponse) :
            return $responsePayment;
        endif;
    }

    public function confirmPaymentPix()
    {
        $confirmPix = $this->paymentService->confirmPaymentUsersPix();
        if ($confirmPix instanceof \Illuminate\Http\RedirectResponse) :
            return $confirmPix;
        endif;
    }
}
