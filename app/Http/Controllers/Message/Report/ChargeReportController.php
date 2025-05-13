<?php

namespace App\Http\Controllers\Message\Report;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\ContasReceber;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatorioCobrancasExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ChargeReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index(Request $request)
    {
        authorizePermissions(['ver-relat-notif']);
        $totalMessagesSent = $this->totalMessagesSent();
        $totalMessagesRemaining = $this->totalMessagesRemaining();
        $reports = $this->filtro($request);
        $allReport = $this->geAllReport();
        return view('pages.messages.reports.cobrancas.index', compact('totalMessagesSent', 'totalMessagesRemaining', 'reports', 'allReport'));
    }

    public function geAllReport()
    {
        $report = BillingsReport::where('billings_reports.user_id', user_princ()->id)
            ->join('contas_receber', function ($join) {
                $join->on('billings_reports.idCobrancaBling', '=', 'contas_receber.idBling');
            })->get();

        return $report;
    }

    public function filtro($request)
    {
        $billingsReport = BillingsReport::where('billings_reports.user_id', user_princ()->id)
            ->join('contas_receber', function ($join) use ($request) {
                $join->on('billings_reports.idCobrancaBling', '=', 'contas_receber.idBling');

                /* Filtros */

                /* nome */
                if ($request->has('nome') && $request->nome != '') :
                    $join->where('billings_reports.nome_cliente', $request->nome);
                endif;
                /* pedido */
                if ($request->has('pedido') && $request->pedido != '') :
                    $join->where('billings_reports.idPedido', $request->pedido);
                endif;
                /* nf */
                if ($request->has('nf') && $request->nf != '') :
                    $join->where('billings_reports.idNotaFiscal', $request->nf);
                endif;
                /* contrato */
                if ($request->has('contrato') && $request->contrato != '') :
                    $join->where('billings_reports.idContrato', $request->contrato);
                endif;
                /* situcao */
                if ($request->has('sit') && $request->sit != '' && $request->sit != 'todos') :
                    $join->where('billings_reports.situacao', $request->sit);
                endif;

                /* dt vencimento */
                if ($request->has('dt_venc_min') && $request->dt_venc_min != '') :
                    $join->whereDate('contas_receber.vencimento', '>=', $request->dt_venc_min);
                endif;
                if ($request->has('dt_venc_max') && $request->dt_venc_max != '') :
                    $join->whereDate('contas_receber.vencimento', '<=', $request->dt_venc_max);
                endif;

                /* dt envio */
                if ($request->has('dt_envio_min') && $request->dt_envio_min != '') :
                    $join->whereDate('billings_reports.data_envio', '>=', $request->dt_envio_min);
                endif;
                if ($request->has('dt_envio_max') && $request->dt_envio_max != '') :
                    $join->whereDate('billings_reports.data_envio', '<=', $request->dt_envio_max);
                endif;
                /* dt visualização */
                if ($request->has('dt_visu_min') && $request->dt_visu_min != '') :
                    $join->whereDate('billings_reports.data_visualizado', '>=', $request->dt_visu_min);
                endif;
                if ($request->has('dt_visu_max') && $request->dt_visu_max != '') :
                    $join->whereDate('billings_reports.data_visualizado', '<=', $request->dt_visu_max);
                endif;
            });

        /* tipo */
        if ($request->has('t') && $request->t != '') :
        else :

            $types = [];
            if ($request->has('t1') && $request->t1 != '')
                $types[] = 'COBRANÇA GERADA';
            if ($request->has('t2') && $request->t2 != '')
                $types[] = 'COBRANÇA VENCENDO';
            if ($request->has('t3') && $request->t3 != '')
                $types[] = 'COBRANÇA VENCIMENTO';
            if ($request->has('t4') && $request->t4 != '')
                $types[] = 'COBRANÇA VENCIDA';

            if (count($types) > 0) :
                $billingsReport->whereHas('message', function ($q) use ($types) {
                    return $q->whereIn('type', $types);
                });
            endif;

        endif;

        $billingsReport = $billingsReport->orderBy('data_envio', 'desc')->paginate(15);

        return $billingsReport;
    }

    public function show(BillingsReport $report)
    {

        if ($report->user_id != user_princ()->id) :
            abort(403);
        endif;

        $billingsReport = $report;
        $contasReceber = ContasReceber::where('idBling', $report->idCobrancaBling)->first();

        return view('pages.messages.reports.cobrancas.show', compact('billingsReport', 'contasReceber'));
    }

    public function totalMessagesSent(): int
    {
        $totalReportMsg = MessageReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 1);
            })->count();

        $totalReportBiling = BillingsReport::where('user_id', user_princ()->id)->count();

        return $totalReportMsg  + $totalReportBiling;
    }

    public function totalMessagesRemaining(): int
    {
        $userPrinc = User::find(user_princ()->id);
        if ($userPrinc) :
            $sub = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 1);
                })
                ->first();

            $totalRemaining = ($sub->plan->limite_mensagens - $this->totalMessagesSent());
        else :
            $totalRemaining = 0;
        endif;

        return $totalRemaining;
    }

    public function exportExcel(Request $request)
    {
        request()->getQueryString();
        return Excel::download(new RelatorioCobrancasExport($request), 'Relatório Cobranças Enviadas ' . date('Y-m-d H.i.s') . '.xlsx');
    }

    public function exportPdf()
    {
        $reports = BillingsReport::where('billings_reports.user_id', user_princ()->id)
            ->join('contas_receber', function ($join) {
                $join->on('billings_reports.idCobrancaBling', '=', 'contas_receber.idBling');
            })->get();

        // return view('pages.messages.reports.pdf.cobrancas');
        $pdf = Pdf::loadView('pages.messages.reports.pdf.cobrancas', compact('reports'));
        return $pdf->download('Relatório Cobranças Enviadas ' . date('Y-m-d H.i.s') . '.pdf');
        // return $pdf->stream('Relatório Cobranças Enviadas ' . date('Y-m-d H.i.s') . '.pdf');
    }
}
