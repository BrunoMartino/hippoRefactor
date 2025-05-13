<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Plano;
use App\Models\Invoice;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\MessageReport;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_disabled_account']);
    }

    public function financial(Request $request)
    {
        authorizePermissions(['ver-relat-financ']);
        $faturas = $this->filterFinancial($request);
        return view('pages.reports.financial.index', compact('faturas'));
    }

    public function filterFinancial($request)
    {

        $invoices = Invoice::where('user_id', '>', 0);


        // cliente
        if ($request->has('cliente') && $request->cliente != '') :
            $invoices->where('user_id', $request->cliente);
        endif;

        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $invoices->whereHas('plan', function ($query) use ($request) {
                return $query->where('modulo_id', $request->modulo);
            });
        endif;


        // Plano
        if ($request->has('plano') && $request->plano != '') :
            $invoices->where('plan_id', $request->plano);
        endif;

        // valor
        if ($request->has('valor_min') && $request->valor_min != '') :
            $valorMin = str_replace(',', '', $request->valor_min);
            $invoices->where('total_value', '>=', $valorMin);
        endif;
        if ($request->has('valor_max') && $request->valor_max != '') :
            $valorMax = str_replace(',', '', $request->valor_max);
            $invoices->where('total_value', '<=', $valorMax);
        endif;


        // data compra
        if ($request->has('dt_compra_min') && $request->dt_compra_min != '') :
            $invoices->whereBetween('created_at', [$request->dt_compra_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_compra_max') && $request->dt_compra_max != '') :
            $invoices->whereBetween('created_at', ['1970-01-01', $request->dt_compra_max . " 23:59"]);
        endif;

        // data pagamenot
        if ($request->has('dt_paga_min') && $request->dt_paga_min != '') :
            $invoices->whereBetween('date_payment', [$request->dt_paga_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_paga_max') && $request->dt_paga_max != '') :
            $invoices->whereBetween('date_payment', ['1970-01-01', $request->dt_paga_max . " 23:59"]);
        endif;

        if ($request->has('s1') || $request->has('s2') || $request->has('s3') || $request->has('s4')) :
            $status = [];
            if ($request->has('s1'))
                $status[] = $request->s1;
            if ($request->has('s2'))
                $status[] = $request->s2;
            if ($request->has('s3'))
                $status[] = $request->s3;
            if ($request->has('s4'))
                $status[] = $request->s4;

            $invoices->whereIn('status', $status);
        endif;


        $invoices = $invoices->latest()->paginate(10);

        return $invoices;
    }

    public function freePlan(Request $request)
    {
        authorizePermissions(['ver-relat-plano']);

        // return Subscription::where('plan_id', 4)->get();
        // return Subscription::get();

        $freePlan = $this->filterFreePlan($request);

        return view('pages.reports.free_plan.index', compact('freePlan'));
    }

    public function filterFreePlan($request)
    {
        $subscriptions = Subscription::whereIn('plan_id', [4,8,12,16]);

        // cliente
        if ($request->has('cliente') && $request->cliente != '') :
            $subscriptions->where('user_id', $request->cliente);
        endif;

        if ($request->has('cpf_cnpj') && $request->cpf_cnpj != '') :
            $subscriptions->whereHas('user', function ($query) use ($request) {
                return $query->where('cpf', 'like', "%{$request->cpf_cnpj}%")->orWhere('cnpj',  'like', "%{$request->cpf_cnpj}%");
            });
        endif;

        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $subscriptions->whereHas('plan', function ($query) use ($request) {
                return $query->where('modulo_id', $request->modulo);
            });
        endif;

        // data cadastro
        if ($request->has('dt_cadastro_min') && $request->dt_cadastro_min != '') :
            $subscriptions->whereBetween('created_at', [$request->dt_cadastro_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_cadastro_max') && $request->dt_cadastro_max != '') :
            $subscriptions->whereBetween('created_at', ['1970-01-01', $request->dt_cadastro_max . " 23:59"]);
        endif;

        // data troca
        if ($request->has('dt_troca_min') && $request->dt_up_min != '') :
            $subscriptions->whereBetween('data_change', [$request->dt_up_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_troca_max') && $request->dt_up_max != '') :
            $subscriptions->whereBetween('data_change', ['1970-01-01', $request->dt_up_max . " 23:59"]);
        endif;

        // data cancel
        if ($request->has('dt_cancel_min') && $request->dt_cancel_min != '') :
            $subscriptions->whereBetween('data_cancel', [$request->dt_cancel_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_cancel_max') && $request->dt_cancel_max != '') :
            $subscriptions->whereBetween('data_cancel', ['1970-01-01', $request->dt_cancel_max . " 23:59"]);
        endif;

        // data expiração
        if ($request->has('dt_exp_min') && $request->dt_exp_min != '') :
            $subscriptions->whereBetween('created_at', [date('Y-m-d 00:00', strtotime($request->dt_exp_min . " - 7 days")), '2099-01-01']);
        endif;
        if ($request->has('dt_exp_max') && $request->dt_exp_max != '') :
            $subscriptions->whereBetween('created_at', ['1970-01-01', date("Y-m-d 23:59", strtotime($request->dt_exp_max . " - 7 days"))]);
        endif;


        // qtd min msgs
        if ($request->has('qtd_min') && $request->qtd_min != '') :

            $subscriptions->whereHas('user', function ($query) use ($request) {
                // return $query->whereHas('messageReports', function ($q) use ($request) {
                //     return $q->havingRaw('COUNT(*) >= ?', [$request->qtd_min]);
                // });
                return $query->whereHas('controlQuantMessage', function ($q) use ($request) {
                    return $q->where('mensagens_restantes', '>=', $request->qtd_min);
                });
            });

        endif;

        // qtd max msgs
        if ($request->has('qtd_max') && $request->qtd_max != '') :

            $subscriptions->whereHas('user', function ($query) use ($request) {
                // return $query->whereHas('messageReports', function ($q) use ($request) {
                //     return $q->havingRaw('COUNT(*) <= ?', [$request->qtd_max]);
                // });
                return $query->whereHas('controlQuantMessage', function ($q) use ($request) {
                    return $q->where('mensagens_restantes', '<=', $request->qtd_max);
                });
            });

        endif;


        $subscriptions = $subscriptions->latest()->paginate(10);

        return $subscriptions;
    }

    public function paidPlan(Request $request)
    {
        authorizePermissions(['ver-relat-plano-pago']);

        $subscriptions = $this->filterPaidPlan($request);
        return view('pages.reports.paid_plan.index', compact('subscriptions'));
    }

    public function filterPaidPlan($request)
    {
        $subscriptions = Subscription::where('id', '>', 0);

        // cliente
        if ($request->has('cliente') && $request->cliente != '') :
            $subscriptions->where('user_id', $request->cliente);
        endif;

        if ($request->has('cpf_cnpj') && $request->cpf_cnpj != '') :
            $subscriptions->whereHas('user', function ($query) use ($request) {
                return $query->where('cpf', 'like', "%{$request->cpf_cnpj}%")->orWhere('cnpj',  'like', "%{$request->cpf_cnpj}%");
            });
        endif;

        // plano
        if ($request->has('plano') && $request->plano != '') :
            $subscriptions->where('plan_id', $request->plano);
        endif;

        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $subscriptions->whereHas('plan', function ($query) use ($request) {
                return $query->where('modulo_id', $request->modulo);
            });
        endif;

        // cupom
        if ($request->has('cupom') && $request->cupom != '') :
            $subscriptions->whereHas('coupon', function ($query) use ($request) {
                return $query->where('code', 'like', "%{$request->cupom}%");
            });
        endif;

        // data compra
        if ($request->has('dt_compra_min') && $request->dt_compra_min != '') :
            $subscriptions->whereBetween('created_at', [$request->dt_compra_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_compra_max') && $request->dt_compra_max != '') :
            $subscriptions->whereBetween('created_at', ['1970-01-01', $request->dt_compra_max . " 23:59"]);
        endif;

        // data troca
        if ($request->has('dt_troca_min') && $request->dt_troca_min != '') :
            $subscriptions->whereBetween('data_change', [$request->dt_troca_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_troca_max') && $request->dt_troca_max != '') :
            $subscriptions->whereBetween('data_change', ['1970-01-01', $request->dt_troca_max . " 23:59"]);
        endif;

        // data cancel
        if ($request->has('dt_cancel_min') && $request->dt_cancel_min != '') :
            $subscriptions->whereBetween('data_cancel', [$request->dt_cancel_min . " 00:00", '2099-01-01']);
        endif;
        if ($request->has('dt_cancel_max') && $request->dt_cancel_max != '') :
            $subscriptions->whereBetween('data_cancel', ['1970-01-01', $request->dt_cancel_max . " 23:59"]);
        endif;

        $subscriptions = $subscriptions->latest()->paginate(10);

        return $subscriptions;
    }

    public function showPaidPlan(Subscription $paid)
    {
        authorizePermissions(['ver-relat-plano-pago']);

        $sub= $paid;
        $dataPaidPlan = [
            'cliente' => Str::limit($sub->user->nome_usuario, 25),
            'modulo' => $sub->plan->modulo->titulo,
            'plano' => ucfirst($sub->plan->nome),
            'valor_plano' => number_format($sub->plan->valor, 2, ',', '.'),
            'valor_pago' => $this->getValuePaidPlan($sub),
            'cupom' => is_null($sub->coupon) ? '-' : $sub->coupon->code,
            'valor_cupom' => $this->getValueCouponPaidPlan($sub),
            'data_compra' => $sub->created_at->format('d/m/Y'),
            'data_troca_plano' => is_null($sub->data_change) ? '-' : date('d/m/Y', strtotime($sub->data_change)),
            'data_cancelamento' => is_null($sub->data_cancel) ? '-' : date('d/m/Y', strtotime($sub->data_cancel)),
        ];
        
        return view('pages.reports.paid_plan.show', compact('dataPaidPlan'));
    }


    public function getDataPaidJson($paid)
    {
        $sub = Subscription::find($paid);
        $data = [
            'cliente' => Str::limit($sub->user->nome_usuario, 25),
            'modulo' => $sub->plan->modulo->titulo,
            'plano' => ucfirst($sub->plan->nome),
            'valor_plano' => number_format($sub->plan->valor, 2, ',', '.'),
            'valor_pago' => $this->getValuePaidPlan($sub),
            'cupom' => is_null($sub->coupon) ? '-' : $sub->coupon->code,
            'valor_cupom' => $this->getValueCouponPaidPlan($sub),
            'data_compra' => $sub->created_at->format('d/m/Y'),
            'data_troca_plano' => is_null($sub->data_change) ? '-' : date('d/m/Y', strtotime($sub->data_change)),
            'data_cancelamento' => is_null($sub->data_cancel) ? '-' : date('d/m/Y', strtotime($sub->data_cancel)),
        ];

        return $data;
    }

    public function getValuePaidPlan($sub)
    {
        $valorPago = '-';
        if (!is_null($sub->coupon)) :
            // se desconto for em valor
            $valorDescontoCupom = 0;
            if (!is_null($sub->coupon->value)) :
                $valorDescontoCupom = $sub->coupon->value; // se deconto for em porcentagem
            else :
                $porcentagemCalculada =
                    ($sub->coupon->percent / 100) * $sub->plan->valor;
                $valorDescontoCupom = $porcentagemCalculada;
            endif;

            if ($valorDescontoCupom < 0)
                $valorDescontoCupom = 0;

            $valorTotal = $sub->plan->valor - $valorDescontoCupom;
            $valorPago = number_format($valorTotal, 2, ',', '.');
        else :
            $valorPago = number_format($sub->plan->valor, 2, ',', '.');
        endif;

        return $valorPago;
    }

    public function getValueCouponPaidPlan($sub)
    {
        $valorCupom = '-';
        if ($sub->coupon != null) :
            if (is_null($sub->coupon->value)) :
                $valorCupom = "{$sub->coupon->percent}%";
            else :
                $valorCupom = number_format($sub->coupon->value, 2, ',', '.');
            endif;
        endif;

        return $valorCupom;
    }

    public function sendedMessages(Request $request)
    {
        authorizePermissions(['ver-relat-mensagens-env']);
        $usersReport = $this->filterSendedMessages($request);

        return view('pages.reports.sended_messages.index', compact('usersReport'));
    }

    public function filterSendedMessages($request)
    {
        $reports = User::role('usuario_princ')->whereHas('controlQuantMessage');

        // cliente
        if ($request->has('cliente') && $request->cliente != '') :
            $reports->where('id', $request->cliente);
        endif;

        // cpf_cnpj
        if ($request->has('cpf_cnpj') && $request->cpf_cnpj != '') :
            $reports->where('cpf', $request->cpf_cnpj)->orWhere('cnpj', $request->cpf_cnpj);
        endif;

        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $reports->whereHas('plano', function ($query) use ($request) {
                return $query->where('modulo_id', $request->modulo);
            });
        endif;
        // plano
        if ($request->has('plano') && $request->plano != '') :
            $reports->whereHas('plano', function ($query) use ($request) {
                return $query->where('plano_id', $request->plano);
            });
        endif;

        // data cadastro
        if ($request->has('dt_cad_min') && $request->dt_cad_min != '') :
            $reports->whereBetween('created_at', [$request->dt_cad_min . ' 00:00', '2099-01-01']);
        endif;
        if ($request->has('dt_cad_max') && $request->dt_cad_max != '') :
            $reports->whereBetween('created_at', ['1970-01-01', $request->dt_cad_max . ' 23:59:59']);
        endif;

        // qtd min msgs
        if ($request->has('qtd_enviadas_min') && $request->qtd_enviadas_min != '') :
            $reports->whereHas('controlQuantMessage', function ($q) use ($request) {
                return $q->where('mensagens_enviadas', '>=', [$request->qtd_enviadas_min]);
            });
        endif;

        // qtd max msgs
        if ($request->has('qtd_enviadas_max') && $request->qtd_enviadas_max != '') :
            $reports->whereHas('controlQuantMessage', function ($q) use ($request) {
                return $q->where('mensagens_enviadas', '<=', [$request->qtd_enviadas_max]);
            });
        endif;


        // qtd min msgs restantes
        if ($request->has('qtd_rest_min') && $request->qtd_rest_min != '') :
            $reports->whereHas('controlQuantMessage', function ($q) use ($request) {
                return $q->where('mensagens_restantes', '>=', [$request->qtd_rest_min]);
            });
        endif;

        // qtd max msgs restantes
        if ($request->has('qtd_rest_max') && $request->qtd_rest_max != '') :
            $reports->whereHas('controlQuantMessage', function ($q) use ($request) {
                return $q->where('mensagens_restantes', '<=', [$request->qtd_rest_max]);
            });
        endif;

        // qtd min msgs visualizadas
        if ($request->has('qtd_visu_min') && $request->qtd_visu_min != '') :
            $reports->whereHas('messageReports', function ($q) use ($request) {
                return $q->where('situacao', 'visualizado')->havingRaw('COUNT(*) >= ?', [$request->qtd_visu_min]);
            });
        endif;

        // qtd max msgs visualizadas
        if ($request->has('qtd_visu_max') && $request->qtd_visu_max != '') :
            $reports->whereHas('messageReports', function ($q) use ($request) {
                return $q->where('situacao', 'visualizado')->havingRaw('COUNT(*) <= ?', [$request->qtd_visu_max]);
            });
        endif;

        $reports = $reports->latest()->paginate(10);
        return $reports;
    }

}
