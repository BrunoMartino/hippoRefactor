<?php

namespace App\Http\Controllers\Message\Report;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\MessageReport;
use App\Models\TrackingReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioRastreamentoExport;

class RastreamentoReportController extends Controller
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
        return view('pages.messages.reports.rastreamento.index', compact('totalMessagesSent', 'totalMessagesRemaining', 'reports', 'allReport'));
    }

    public function geAllReport()
    {
        $report = TrackingReport::where('user_id', user_princ()->id)->get();
        return $report;
    }

    public function filtro($request)
    {

        /* TODO: talvez juntar com os registro de message_reports */

        $invoicingReport = TrackingReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 4);
            });

        /* Filtros */

        /* nome */
        if ($request->has('nome') && $request->nome != '') :
            $invoicingReport->where('nome_cliente', $request->nome);
        endif;
        /* pedido */
        if ($request->has('pedido') && $request->pedido != '') :
            $invoicingReport->where('idPedido', $request->pedido);
        endif;
        /* nf */
        if ($request->has('nf') && $request->nf != '') :
            $invoicingReport->where('idNotaFiscal', $request->nf);
        endif;
        /* contrato */
        if ($request->has('contrato') && $request->contrato != '') :
            $invoicingReport->where('idContrato', $request->contrato);
        endif;
        /* situcao */
        if ($request->has('sit') && $request->sit != '' && $request->sit != 'todos') :
            $invoicingReport->where('situacao', $request->sit);
        endif;

        /* dt vencimento */
        if ($request->has('dt_venc_min') && $request->dt_venc_min != '') :
            $invoicingReport->whereDate('vencimento', '>=', $request->dt_venc_min);
        endif;
        if ($request->has('dt_venc_max') && $request->dt_venc_max != '') :
            $invoicingReport->whereDate('vencimento', '<=', $request->dt_venc_max);
        endif;

        /* dt envio */
        if ($request->has('dt_envio_min') && $request->dt_envio_min != '') :
            $invoicingReport->whereDate('data_envio', '>=', $request->dt_envio_min);
        endif;
        if ($request->has('dt_envio_max') && $request->dt_envio_max != '') :
            $invoicingReport->whereDate('data_envio', '<=', $request->dt_envio_max);
        endif;
        /* dt visualização */
        if ($request->has('dt_visu_min') && $request->dt_visu_min != '') :
            $invoicingReport->whereDate('data_visualizado', '>=', $request->dt_visu_min);
        endif;
        if ($request->has('dt_visu_max') && $request->dt_visu_max != '') :
            $invoicingReport->whereDate('data_visualizado', '<=', $request->dt_visu_max);
        endif;

        /* tipo */
        if ($request->has('t') && $request->t != '') :
        else :
            $types = [];
            if ($request->has('t1') && $request->t1 != '')
                $types[] = 'postado';
            if ($request->has('t2') && $request->t2 != '')
                $types[] = 'entregue';
            if ($request->has('t3') && $request->t3 != '')
                $types[] = 'transferencia'; // LOCALIZAÇÃO ATUAL
            if ($request->has('t4') && $request->t4 != '')
                $types[] = 'saiu_entregar';
            if ($request->has('t5') && $request->t5 != '')
                $types[] = 'ausente';


            if (count($types) > 0) :
                $invoicingReport->whereIn('situacao_entrega', $types);
            endif;

        endif;

        $billingsReport = $invoicingReport->orderBy('data_envio', 'desc')->paginate(15);

        return $billingsReport;
    }

    public function show(TrackingReport $report)
    {

        if ($report->user_id != user_princ()->id) :
            abort(403);
        endif;

        return view('pages.messages.reports.rastreamento.show', compact('report'));
    }

    public function totalMessagesSent(): int
    {
        $totalReportMsg = MessageReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 4);
            })->count();

        $totalTrackingReport = TrackingReport::where('user_id', user_princ()->id)->count();

        return $totalReportMsg + $totalTrackingReport;
    }

    public function totalMessagesRemaining(): int
    {
        $userPrinc = User::find(user_princ()->id);
        if ($userPrinc) :
            $sub = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 4);
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
        return Excel::download(new RelatorioRastreamentoExport($request), 'Relatório Rastreamento ' . date('Y-m-d H.i.s') . '.xlsx');
    }

    public function exportPdf()
    {
        $reports = TrackingReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 4);
            })->latest()->get();

        // return view('pages.messages.reports.pdf.rastreamento');
        $pdf = Pdf::loadView('pages.messages.reports.pdf.rastreamento', compact('reports'));
        return $pdf->download('Relatório Rastreamento ' . date('Y-m-d H.i.s') . '.pdf');
        // return $pdf->stream('Relatório Rastreamento ' . date('Y-m-d H.i.s') . '.pdf');
    }
}
