<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Message;
use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Models\TrackingReport;
use App\Models\ImportedBilling;
use App\Models\InvoicingReport;
use App\Models\ImportedTracking;
use App\Models\ImportedInvoicing;
use Illuminate\Support\Facades\DB;
use App\Models\ImportedRemarketing;
use App\Models\RespostasPesquisaSatisfacao;
use App\View\Components\Dashboard\UserMain\MsgEnvidasEstado;

class ChartUserMainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    /**
     * Visualização de msgs
     *
     * @return void
     */
    public function visuaMsgs(Request $request)
    {

        // dd($request->all());

        $dtIni = '1970-01-01';
        $dtFin = '2099-01-01';

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;

        $visualizadas = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'visualizado')->count();
        $visualizadas += RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'visualizado')->count();
        $visualizadas += BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'visualizado')->count();
        $visualizadas += InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'visualizado')->count();
        $visualizadas += TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'visualizado')->count();


        $naoVistas = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'entregue')->count();
        $naoVistas += RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'entregue')->count();
        $naoVistas += BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'entregue')->count();
        $naoVistas += InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'entregue')->count();
        $naoVistas += TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'entregue')->count();

        $data = [
            'series' => [
                $visualizadas,
                $naoVistas
            ],
            'labels' => [
                'Visualizadas',
                'Não vistas',
            ],
        ];

        // percentual
        $somaTotal = array_sum($data['series']) <= 0 ? 1 : array_sum($data['series']);
        $percentual = [
            'visualizadas' => number_format((($data['series'][0] / $somaTotal) * 100), 0),
            'nao_vistas' => number_format((($data['series'][1] / $somaTotal) * 100), 0),
        ];
        $data['percentual'] = $percentual;

        return $data;
    }

    public function envioNotificacoes(Request $request)
    {
        $data = [
            'total' => 0,
            'text_periodo' => 'Notificações enviadas nos últimos: 30 dias.',
            'total_hoje' => 0
        ];

        $dtIni = date('Y-m-d', strtotime('-30 days'));
        $dtFin = date('Y-m-d 23:59');

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;


        /* Enviadas hoje */
        $total1 = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', date('Y-m-d'))
            ->count();
        $total2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', date('Y-m-d'))
            ->count();
        $total3 = BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', date('Y-m-d'))
            ->count();
        $total4 = InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', date('Y-m-d'))
            ->count();
        $total5 = TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', date('Y-m-d'))
            ->count();

        $totalHoje = $total1 + $total2 + $total3 + $total4 + $total5;
        $data['total_hoje'] = number_format($totalHoje, 0, ',', '.');


        /* Enviadas nos últimos 30dias */
        $totalPeriodo1 = MessageReport::where('user_id', user_princ()->id);
        $totalPeriodo2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id);
        $totalPeriodo3 = BillingsReport::where('user_id', user_princ()->id);
        $totalPeriodo4 = InvoicingReport::where('user_id', user_princ()->id);
        $totalPeriodo5 = TrackingReport::where('user_id', user_princ()->id);

        if (($request->has('dt_ini') && $request->dt_ini != '') || ($request->has('dt_fin') && $request->dt_fin != '')) :

            $totalPeriodo1 = $totalPeriodo1->whereDate('data_envio', '>=', $dtIni)->whereDate('data_envio', '<=', $dtFin);
            $totalPeriodo2 = $totalPeriodo2->whereDate('data_envio', '>=', $dtIni)->whereDate('data_envio', '<=', $dtFin);
            $totalPeriodo3 = $totalPeriodo3->whereDate('data_envio', '>=', $dtIni)->whereDate('data_envio', '<=', $dtFin);
            $totalPeriodo4 = $totalPeriodo4->whereDate('data_envio', '>=', $dtIni)->whereDate('data_envio', '<=', $dtFin);
            $totalPeriodo5 = $totalPeriodo5->whereDate('data_envio', '>=', $dtIni)->whereDate('data_envio', '<=', $dtFin);

            $data['text_periodo'] = 'Notificações enviadas no período de ' . date('d/m/Y', strtotime($dtIni)) . ' até ' . date('d/m/Y', strtotime($dtFin)) . '.';

        else :
            // perído de 30 dias
            $totalPeriodo1 = $totalPeriodo1->whereDate('data_envio', '>=', date('Y-m-d', strtotime('-30 days')));
            $totalPeriodo2 = $totalPeriodo2->whereDate('data_envio', '>=', date('Y-m-d', strtotime('-30 days')));
            $totalPeriodo3 = $totalPeriodo3->whereDate('data_envio', '>=', date('Y-m-d', strtotime('-30 days')));
            $totalPeriodo4 = $totalPeriodo4->whereDate('data_envio', '>=', date('Y-m-d', strtotime('-30 days')));
            $totalPeriodo5 = $totalPeriodo5->whereDate('data_envio', '>=', date('Y-m-d', strtotime('-30 days')));
        endif;

        $totalPeriododias = $totalPeriodo1->count() + $totalPeriodo2->count() + $totalPeriodo3->count() + $totalPeriodo4->count() + $totalPeriodo5->count();

        $data['total'] = number_format($totalPeriododias, 0, ',', '.');
        return $data;
    }

    /**
     * Entrega de msgs
     *
     * @return void
     */
    public function entregMsgs(Request $request)
    {
        $dtIni = '1970-01-01';
        $dtFin = '2099-01-01';

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;


        $entrega = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->whereIn('situacao', ['visualizado', 'entregue'])->count();
        $entrega += RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->whereIn('situacao', ['visualizado', 'entregue'])->count();
        $entrega += BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->whereIn('situacao', ['visualizado', 'entregue'])->count();
        $entrega += InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->whereIn('situacao', ['visualizado', 'entregue'])->count();
        $entrega += TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->whereIn('situacao', ['visualizado', 'entregue'])->count();

        $naoEntregue = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'nao_entregue')->count();
        $naoEntregue += RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'nao_entregue')->count();
        $naoEntregue += BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'nao_entregue')->count();
        $naoEntregue += InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'nao_entregue')->count();
        $naoEntregue += TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('situacao', 'nao_entregue')->count();

        $data = [
            'series' => [
                $entrega,
                $naoEntregue,
            ],
            'labels' => [
                'Entregue',
                'Não entregue',
            ],
        ];

        // percentual
        $somaTotal = array_sum($data['series']) <= 0 ? 1 : array_sum($data['series']);
        $percentual = [
            'entregue' => number_format((($data['series'][0] / $somaTotal) * 100), 0),
            'nao_entregue' => number_format((($data['series'][1] / $somaTotal) * 100), 0),
        ];
        $data['percentual'] = $percentual;

        return $data;
    }

    public function msgFaixaEtaria(Request $request)
    {


        $dtIni = '1970-01-01';
        $dtFin = date('Y-m-d 23:59');

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;

        $data = [
            '18a25' => 0,
            '26a35' => 0,
            '36a45' => 0,
            '46a60' => 0,
            'acima60' => 0,
        ];

        $arrayIdades = [];

        $res1 = MessageReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->get('whatsapp_enviado')->toArray();
        $res2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->where('whatsapp', "!=", null)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->get('whatsapp')->toArray();
        $res3 = BillingsReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->get('whatsapp_enviado')->toArray();
        $res4 = InvoicingReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->get('whatsapp_enviado')->toArray();
        $res5 = TrackingReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->get('whatsapp_enviado')->toArray();

        $todosWhats = array_merge($res1, $res2, $res3, $res4, $res5);
        $todosWhats = $this->removerValoresRepetidos($todosWhats);


        // foreach ($todosWhats as $key => $whats) :

        //     $impBiling = ImportedBilling::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impInvoicing = ImportedInvoicing::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impRemarketing = ImportedRemarketing::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impTracking = ImportedTracking::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();

        //     // data de nascimento em ImportedBilling
        //     if ($impBiling != null && $impBiling->birth_date != null):
        //         $timeBirth = strtotime($impBiling->birth_date);
        //         $result = $this->getAges($data, $arrayIdades, $timeBirth);
        //         $data = $result['data'];
        //         $arrayIdades = $result['arrayIdades'];
        //     elseif ($impInvoicing != null && $impInvoicing->birth_date != null): // data de nascimento em ImportedInvoicing
        //         $timeBirth = strtotime($impInvoicing->birth_date);
        //         $result = $this->getAges($data, $arrayIdades, $timeBirth);
        //         $data = $result['data'];
        //         $arrayIdades = $result['arrayIdades'];
        //     elseif ($impRemarketing != null && $impRemarketing->birth_date != null): // data de nascimento em ImportedInvoicing
        //         $timeBirth = strtotime($impRemarketing->birth_date);
        //         $result = $this->getAges($data, $arrayIdades, $timeBirth);
        //         $data = $result['data'];
        //         $arrayIdades = $result['arrayIdades'];
        //     elseif ($impTracking != null && $impTracking->birth_date != null): // data de nascimento em ImportedInvoicing
        //         $timeBirth = strtotime($impTracking->birth_date);
        //         $result = $this->getAges($data, $arrayIdades, $timeBirth);
        //         $data = $result['data'];
        //         $arrayIdades = $result['arrayIdades'];
        //     endif;

        // endforeach;


        // Buscar todos os registros de uma vez para evitar múltiplas queries dentro do loop
        $userId = user_princ()->id;
        $importedBillings = ImportedBilling::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedInvoicings = ImportedInvoicing::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedRemarketings = ImportedRemarketing::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedTrackings = ImportedTracking::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');

        $messageReports = MessageReport::where('user_id', $userId)
            ->whereIn('whatsapp_enviado', $todosWhats)
            ->get()
            ->keyBy('whatsapp_enviado');

        $respostasPesquisaSatisfacao = RespostasPesquisaSatisfacao::where('user_id', $userId)
            ->whereIn('whatsapp', $todosWhats)
            ->get()
            ->keyBy('whatsapp');

        $billingsReports = BillingsReport::where('user_id', $userId)
            ->whereIn('whatsapp_enviado', $todosWhats)
            ->get()
            ->keyBy('whatsapp_enviado');

        $invoicingReports = InvoicingReport::where('user_id', $userId)
            ->whereIn('whatsapp_enviado', $todosWhats)
            ->get()
            ->keyBy('whatsapp_enviado');

        $trackingReports = TrackingReport::where('user_id', $userId)
            ->whereIn('whatsapp_enviado', $todosWhats)
            ->get()
            ->keyBy('whatsapp_enviado');

        // dd($trackingReports);


        foreach ($todosWhats as $whats) {
            // Lista de fontes com diferentes campos para data de nascimento
            $sources = [
                ['model' => $importedBillings->get($whats), 'field' => 'birth_date'],
                ['model' => $importedInvoicings->get($whats), 'field' => 'birth_date'],
                ['model' => $importedRemarketings->get($whats), 'field' => 'birth_date'],
                ['model' => $importedTrackings->get($whats), 'field' => 'birth_date'],
                ['model' => $messageReports->get($whats), 'field' => 'dataNascimento'],
                ['model' => $respostasPesquisaSatisfacao->get($whats), 'field' => 'dataNascimento'],
                ['model' => $billingsReports->get($whats), 'field' => 'dataNascimento'],
                ['model' => $invoicingReports->get($whats), 'field' => 'dataNascimento'],
                ['model' => $trackingReports->get($whats), 'field' => 'dataNascimento'],
            ];

            foreach ($sources as $source) {
                if ($source['model'] !== null && !empty($source['model']->{$source['field']})) {
                    $timeBirth = strtotime($source['model']->{$source['field']});
                    $result = $this->getAges($data, $arrayIdades, $timeBirth);
                    $data = $result['data'];
                    $arrayIdades = $result['arrayIdades'];
                    break; // Se já encontrou uma data de nascimento, para o loop
                }
            }
        }



        // Idades médias das faixas etárias
        $idades = [21.5, 30.5, 40.5, 53, 70];
        // Número de usuários em cada faixa etária
        $usuarios = array_values($data);
        $mediaPonderada = $this->calcularMediaPonderada($idades, $usuarios);

        // média
        $media = $mediaPonderada == 0 ? 'Sem média' :  intval($mediaPonderada) . ' anos';
        $result = [
            'series' =>  [[
                'name' => ['Total'],
                'data' => array_values($data)
            ],],
            'labels' => ['18 a 25', '26 a 35', '36 a 45', '46 a 60', '+60'],
            'media' => $media,
        ];

        return $result;
    }

    public function getAges($data, $arrayIdades, $timeBirth): array
    {
        // 18 a 25 anos
        if ($timeBirth < strtotime(' - 18 years') && $timeBirth > strtotime(' - 25 years')) :
            $data['18a25']++;
            $arrayIdades[] = 22;
        endif;
        // 26 a 35 anos
        if ($timeBirth < strtotime(' - 25 years') && $timeBirth > strtotime(' - 35 years')) :
            $data['26a35']++;
            $arrayIdades[] = 31;
        endif;
        // 36 a 45 anos
        if ($timeBirth < strtotime(' - 35 years') && $timeBirth > strtotime(' - 45 years')) :
            $data['36a45']++;
            $arrayIdades[] = 41;
        endif;
        // 46 a 60 anos
        if ($timeBirth < strtotime(' - 45 years') && $timeBirth > strtotime(' - 60 years')) :
            $data['46a60']++;
            $arrayIdades[] = 52;
        endif;
        // 46 a 60 anos
        if ($timeBirth < strtotime(' - 60 years')) :
            $data['acima60']++;
            $arrayIdades[] = 61;
        endif;

        return ['data' => $data, 'arrayIdades' => $arrayIdades];
    }

    public function calcularMediaPonderada($idades, $usuarios)
    {
        $numerador = 0;
        $denominador = 0;

        for ($i = 0; $i < count($idades); $i++) {
            $numerador += $idades[$i] * $usuarios[$i];
            $denominador += $usuarios[$i];
        }

        if ($denominador == 0) {
            return 0; // Evitar divisão por zero
        }

        return $numerador / $denominador;
    }

    public function msgGenero()
    {


        $totalM = 0;
        $totalF = 0;
        $totalOutros = 0;

        $rep1 = MessageReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->where('whatsapp', "!=", null)
            ->get('whatsapp')->toArray();

        $rep3 = BillingsReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep4 = InvoicingReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep5 = TrackingReport::where('user_id', user_princ()->id)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();


        $todosWhats = array_merge($rep1, $rep2, $rep3, $rep4, $rep5);
        $todosWhats = $this->removerValoresRepetidos($todosWhats);

        // return $todosWhats;



        // $data = [];
        // foreach ($todosWhats as $key => $whats) :

        //     $impBiling = ImportedBilling::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impInvoicing = ImportedInvoicing::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impRemarketing = ImportedRemarketing::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();
        //     $impTracking = ImportedTracking::where('user_id', user_princ()->id)->where('whatsapp', $whats)->first();

        //     if ($impBiling != null) {
        //         switch ($impBiling->gender) {
        //             case 'M':
        //                 $totalM++;
        //                 break;
        //             case 'F':
        //                 $totalF++;
        //                 break;
        //             default:
        //                 $totalOutros++;
        //                 break;
        //         }
        //     } elseif ($impInvoicing != null) {
        //         switch ($impInvoicing->gender) {
        //             case 'M':
        //                 $totalM++;
        //                 break;
        //             case 'F':
        //                 $totalF++;
        //                 break;
        //             default:
        //                 $totalOutros++;
        //                 break;
        //         }
        //     } elseif ($impRemarketing != null) {
        //         switch ($impRemarketing->gender) {
        //             case 'M':
        //                 $totalM++;
        //                 break;
        //             case 'F':
        //                 $totalF++;
        //                 break;
        //             default:
        //                 $totalOutros++;
        //                 break;
        //         }
        //     } elseif ($impTracking != null) {
        //         switch ($impTracking->gender) {
        //             case 'M':
        //                 $totalM++;
        //                 break;
        //             case 'F':
        //                 $totalF++;
        //                 break;
        //             default:
        //                 $totalOutros++;
        //                 break;
        //         }
        //     }

        // endforeach;

        $data = [];
        $userId = user_princ()->id;

        // Buscar todos os registros de uma vez para evitar múltiplas queries dentro do loop
        $importedBillings = ImportedBilling::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedInvoicings = ImportedInvoicing::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedRemarketings = ImportedRemarketing::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $importedTrackings = ImportedTracking::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');

        $messageReports = MessageReport::where('user_id', $userId)->whereIn('whatsapp_enviado', $todosWhats)->get()->keyBy('whatsapp_enviado');
        $respostasPesquisaSatisfacao = RespostasPesquisaSatisfacao::where('user_id', $userId)->whereIn('whatsapp', $todosWhats)->get()->keyBy('whatsapp');
        $billingsReports = BillingsReport::where('user_id', $userId)->whereIn('whatsapp_enviado', $todosWhats)->get()->keyBy('whatsapp_enviado');
        $invoicingReports = InvoicingReport::where('user_id', $userId)->whereIn('whatsapp_enviado', $todosWhats)->get()->keyBy('whatsapp_enviado');
        $trackingReports = TrackingReport::where('user_id', $userId)->whereIn('whatsapp_enviado', $todosWhats)->get()->keyBy('whatsapp_enviado');

        $totalM = $totalF = $totalOutros = 0;

        foreach ($todosWhats as $whats) {
            $sources = [
                $importedBillings->get($whats),
                $importedInvoicings->get($whats),
                $importedRemarketings->get($whats),
                $importedTrackings->get($whats),
                $messageReports->get($whats),
                $respostasPesquisaSatisfacao->get($whats),
                $billingsReports->get($whats),
                $invoicingReports->get($whats),
                $trackingReports->get($whats),
            ];

            foreach ($sources as $source) {
                if ($source !== null) {
                    if (!empty($source->gender)) {
                        $sexo = $source->gender;
                    } elseif (!empty($source->sexo)) {
                        $sexo = $source->sexo;
                    } else {
                        continue;
                    }

                    if ($sexo === 'M') {
                        $totalM++;
                    } elseif ($sexo === 'F') {
                        $totalF++;
                    } else {
                        $totalOutros++;
                    }

                    break; // Para no primeiro encontrado
                }
            }
        }


        $data = [
            'series' => [$totalM, $totalF],
            'labels' => ['Masculino', 'Feminino'],
        ];

        // percentual
        $somaTotal = array_sum($data['series']) <= 0 ? 1 : array_sum($data['series']);
        $percentual = [
            'm' => number_format((($data['series'][0] / $somaTotal) * 100), 0),
            'f' => number_format((($data['series'][1] / $somaTotal) * 100), 0),
        ];
        $data['percentual'] = $percentual;

        return $data;
    }

    public function entregaMsgAnual(Request $request)
    {
        if ($request->has('anos') && $request->anos != '') :

            $arAnos = json_decode($request->anos);
            $ano2 = isset($arAnos[0]) ? $arAnos[0] : date('Y');
            $ano1 = isset($arAnos[1]) ? $arAnos[1] : date('Y', strtotime('-1 years'));

            if (isset($arAnos[0]) && isset($arAnos[1]) == false) :
                $ano1 = $ano2 - 1;
            endif;

        else :
            $ano1 = date('Y', strtotime('-1 years'));
            $ano2 = date('Y');
        endif;

        $dataFinAno1 = "$ano1-12-15";
        $dataFinAno2 = "$ano2-12-15";

        // Organização de dados para gráfico
        if ($request->tipo == 'entregue') {
            $textoTipo = "Entregue";
            $request['tipo'] = ['entregue'];
        }
        if ($request->tipo == 'nao_entregue') {
            $textoTipo = "Não entregue";
            $request['tipo'] = ['nao_entregue'];
        }
        if ($request->tipo == 'visualizado') {
            $textoTipo = "Visualizado";
            $request['tipo'] = ['visualizado'];
        }

        if ($request->tipo == 'todos') {
            $textoTipo = "Todos";
            $request['tipo'] = ['visualizado', 'nao_entregue', 'entregue'];
        }


        $data = [
            'series' => [
                [
                    "name" => "$ano1 | $textoTipo",
                    "data" => []
                ],
                [
                    "name" => "$ano2 | $textoTipo",
                    "data" => []
                ],
            ],
            'labels' => []
        ];


        // Array meses
        $meses = [1 => 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        if ($ano1 >= $ano2)
            $ano1 = $ano2 - 1;

        /* ============================================ */
        /* Mess Report */
        $msgResportNaoEntregue = MessageReport::where('user_id', user_princ()->id)
            // ->whereIn('situacao', ['entregue'])
            ->whereIn('situacao', $request->tipo)
            ->whereYear('data_envio', '>=', $ano1)
            ->whereYear('data_envio', '<=', $ano2)
            ->select(
                DB::raw('YEAR(data_envio) as year'),
                DB::raw('MONTH(data_envio) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('YEAR(data_envio)'), DB::raw('MONTH(data_envio)'))
            ->orderBy(DB::raw('YEAR(data_envio)'), 'asc')
            ->orderBy(DB::raw('MONTH(data_envio)'), 'asc')
            ->get()->toArray();

        // ano1
        for ($i = 0; $i < 12; $i++) :

            $month1 = date('n', strtotime($dataFinAno1 . " -$i months"));
            $year1 = date('Y', strtotime($dataFinAno1 . " -$i months"));

            // $data['labels'][] = $meses[$month1] . '/' . $ano1 . '-' . $ano2;
            $data['labels'][] = $meses[$month1];

            if (count($msgResportNaoEntregue) > 0) :
                $count1 = 0;
                foreach ($msgResportNaoEntregue as $key => $value) :
                    if ($value['month'] == $month1 && $value['year'] == $year1) :
                        $data['series'][0]['data'][] = $value['total'];
                        $count1++;
                    endif;
                endforeach;
                if ($count1 == 0) :
                    $data['series'][0]['data'][] = 0;
                endif;
            else :
                $data['series'][0]['data'][] = 0;
            endif;
        endfor;

        // ano2
        for ($i = 0; $i < 12; $i++) :

            $month2 = date('n', strtotime($dataFinAno2 . " -$i months"));
            $year2 = date('Y', strtotime($dataFinAno2 . " -$i months"));

            if (count($msgResportNaoEntregue) > 0) :
                $count1 = 0;
                foreach ($msgResportNaoEntregue as $key => $value) :
                    if ($value['month'] == $month2 && $value['year'] == $year2) :
                        $data['series'][1]['data'][] = $value['total'];
                        $count1++;
                    endif;
                endforeach;
                if ($count1 == 0) :
                    $data['series'][1]['data'][] = 0;
                endif;
            else :
                $data['series'][1]['data'][] = 0;
            endif;
        endfor;


        /* ============================================ */
        /* Registros PRS */
        $msgResportNaoEntregueRPS = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            // ->whereIn('situacao', ['entregue'])
            ->whereIn('situacao', $request->tipo)
            ->whereYear('data_envio', '>=', $ano1)
            ->whereYear('data_envio', '<=', $ano2)
            ->select(
                DB::raw('YEAR(data_envio) as year'),
                DB::raw('MONTH(data_envio) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('YEAR(data_envio)'), DB::raw('MONTH(data_envio)'))
            ->orderBy(DB::raw('YEAR(data_envio)'), 'asc')
            ->orderBy(DB::raw('MONTH(data_envio)'), 'asc')
            ->get()->toArray();

        // ano1
        for ($i = 0; $i < 12; $i++) :

            $month1 = date('n', strtotime($dataFinAno1 . " -$i months"));
            $year1 = date('Y', strtotime($dataFinAno1 . " -$i months"));

            if (count($msgResportNaoEntregueRPS) > 0) :
                foreach ($msgResportNaoEntregueRPS as $key => $value) :
                    if ($value['month'] == $month1 && $value['year'] == $year1) :
                        $data['series'][0]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        // ano2
        for ($i = 0; $i < 12; $i++) :

            $month2 = date('n', strtotime($dataFinAno2 . " -$i months"));
            $year2 = date('Y', strtotime($dataFinAno2 . " -$i months"));

            if (count($msgResportNaoEntregueRPS) > 0) :
                foreach ($msgResportNaoEntregueRPS as $key => $value) :
                    if ($value['month'] == $month2 && $value['year'] == $year2) :
                        $data['series'][1]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;


        /* ============================================ */
        /* Registros BillingsReport */
        $msgResportNaoEntregueBillingsReport = BillingsReport::where('user_id', user_princ()->id)
            ->whereIn('situacao', $request->tipo)
            ->whereYear('data_envio', '>=', $ano1)
            ->whereYear('data_envio', '<=', $ano2)
            ->select(
                DB::raw('YEAR(data_envio) as year'),
                DB::raw('MONTH(data_envio) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('YEAR(data_envio)'), DB::raw('MONTH(data_envio)'))
            ->orderBy(DB::raw('YEAR(data_envio)'), 'asc')
            ->orderBy(DB::raw('MONTH(data_envio)'), 'asc')
            ->get()->toArray();

        // ano1
        for ($i = 0; $i < 12; $i++) :

            $month1 = date('n', strtotime($dataFinAno1 . " -$i months"));
            $year1 = date('Y', strtotime($dataFinAno1 . " -$i months"));

            if (count($msgResportNaoEntregueBillingsReport) > 0) :
                foreach ($msgResportNaoEntregueBillingsReport as $key => $value) :
                    if ($value['month'] == $month1 && $value['year'] == $year1) :
                        $data['series'][0]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        // ano2
        for ($i = 0; $i < 12; $i++) :

            $month2 = date('n', strtotime($dataFinAno2 . " -$i months"));
            $year2 = date('Y', strtotime($dataFinAno2 . " -$i months"));

            if (count($msgResportNaoEntregueBillingsReport) > 0) :
                foreach ($msgResportNaoEntregueBillingsReport as $key => $value) :
                    if ($value['month'] == $month2 && $value['year'] == $year2) :
                        $data['series'][1]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;


        /* ============================================ */
        /* Registros InvoicingReport */
        $msgResportNaoEntregueInvoicingReport = InvoicingReport::where('user_id', user_princ()->id)
            ->whereIn('situacao', $request->tipo)
            ->whereYear('data_envio', '>=', $ano1)
            ->whereYear('data_envio', '<=', $ano2)
            ->select(
                DB::raw('YEAR(data_envio) as year'),
                DB::raw('MONTH(data_envio) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('YEAR(data_envio)'), DB::raw('MONTH(data_envio)'))
            ->orderBy(DB::raw('YEAR(data_envio)'), 'asc')
            ->orderBy(DB::raw('MONTH(data_envio)'), 'asc')
            ->get()->toArray();

        // ano1
        for ($i = 0; $i < 12; $i++) :

            $month1 = date('n', strtotime($dataFinAno1 . " -$i months"));
            $year1 = date('Y', strtotime($dataFinAno1 . " -$i months"));

            if (count($msgResportNaoEntregueInvoicingReport) > 0) :
                foreach ($msgResportNaoEntregueInvoicingReport as $key => $value) :
                    if ($value['month'] == $month1 && $value['year'] == $year1) :
                        $data['series'][0]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        // ano2
        for ($i = 0; $i < 12; $i++) :

            $month2 = date('n', strtotime($dataFinAno2 . " -$i months"));
            $year2 = date('Y', strtotime($dataFinAno2 . " -$i months"));

            if (count($msgResportNaoEntregueInvoicingReport) > 0) :
                foreach ($msgResportNaoEntregueInvoicingReport as $key => $value) :
                    if ($value['month'] == $month2 && $value['year'] == $year2) :
                        $data['series'][1]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        /* ============================================ */
        /* Registros TrackingReport */
        $msgResportNaoEntregueTrackingReport = TrackingReport::where('user_id', user_princ()->id)
            ->whereIn('situacao', $request->tipo)
            ->whereYear('data_envio', '>=', $ano1)
            ->whereYear('data_envio', '<=', $ano2)
            ->select(
                DB::raw('YEAR(data_envio) as year'),
                DB::raw('MONTH(data_envio) as month'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('YEAR(data_envio)'), DB::raw('MONTH(data_envio)'))
            ->orderBy(DB::raw('YEAR(data_envio)'), 'asc')
            ->orderBy(DB::raw('MONTH(data_envio)'), 'asc')
            ->get()->toArray();

        // ano1
        for ($i = 0; $i < 12; $i++) :

            $month1 = date('n', strtotime($dataFinAno1 . " -$i months"));
            $year1 = date('Y', strtotime($dataFinAno1 . " -$i months"));

            if (count($msgResportNaoEntregueTrackingReport) > 0) :
                foreach ($msgResportNaoEntregueTrackingReport as $key => $value) :
                    if ($value['month'] == $month1 && $value['year'] == $year1) :
                        $data['series'][0]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        // ano2
        for ($i = 0; $i < 12; $i++) :

            $month2 = date('n', strtotime($dataFinAno2 . " -$i months"));
            $year2 = date('Y', strtotime($dataFinAno2 . " -$i months"));

            if (count($msgResportNaoEntregueTrackingReport) > 0) :
                foreach ($msgResportNaoEntregueTrackingReport as $key => $value) :
                    if ($value['month'] == $month2 && $value['year'] == $year2) :
                        $data['series'][1]['data'][$i] += $value['total'];
                    endif;
                endforeach;
            endif;
        endfor;

        // ============================================
        $data['series'][0]['data'] = array_reverse($data['series'][0]['data']);
        $data['series'][1]['data'] = array_reverse($data['series'][1]['data']);
        $data['labels'] = array_reverse($data['labels']);

        return $data;
    }

    public function msgEnviadasEstado(Request $request)
    {
        $data = (new MsgEnvidasEstado)->dataEstadosArr($request);
        return $data;
    }

    public function satisfacaoClientes(Request $request)
    {
        $msg = Message::where('user_id', user_princ()->id)
            ->whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])
            ->first();

        $dtIni = '1970-01-01';
        $dtFin = date('Y-m-d 23:59');

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;


        if (is_null($msg)) :
            $data = [
                'series' =>  [
                    [
                        'name' => '',
                        'data' => []
                    ],
                ]
            ];
        else :

            $perguntaEtapa = $request->p ?? 'pergunta1';
            $data = [
                'pergunta' => $msg->satisfaction_survey[$perguntaEtapa]['pergunta'],
                'series' =>  [],
                'colors' =>   [
                    'colors' => ["#e64107", "#ff6b01", "#f1f1f1", "var(--bs-primary)", "#203b59"],
                ]
            ];


            // set colors
            if ($perguntaEtapa == 'pergunta3' || $perguntaEtapa == 'pergunta_inicial' || $perguntaEtapa == 'pergunta4')
                $data['colors']['colors'] = ['var(--bs-primary)', "#e64107"];

            $etapas = [
                'pergunta_inicial',
                'pergunta1',
                'pergunta2',
                'pergunta3',
                'pergunta4',
            ];


            // se não for resposta da pergunta 4
            if ($perguntaEtapa != 'pergunta4') :

                foreach ($msg->satisfaction_survey[$perguntaEtapa]['opcoes'] as $indice  => $option) :

                    if (is_numeric($indice)) :
                        $total = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
                            ->whereDate('data_envio', '>=', $dtIni)
                            ->whereDate('data_envio', '<=', $dtFin)
                            ->where('etapa', $perguntaEtapa)
                            ->where('resposta', $indice)
                            ->count();
                        $data['series'][] = [
                            'name' => $option,
                            'data' => [$total]
                        ];
                    endif;
                endforeach;
            else : // se for resposta para pegunta 4


                $totalResp = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
                    ->whereDate('data_envio', '>=', $dtIni)
                    ->whereDate('data_envio', '<=', $dtFin)
                    ->where('etapa', $perguntaEtapa)
                    ->where('resposta', '!=', null)
                    ->get()
                    ->groupBy('whatsapp');


                $totalSemResp = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
                    // ->where('etapa', 'pergunta3')
                    ->whereDate('data_envio', '>=', $dtIni)
                    ->whereDate('data_envio', '<=', $dtFin)
                    ->where('resposta', '!=', '')
                    // ->where('etapa', "!=", $perguntaEtapa)
                    ->get()
                    ->groupBy('whatsapp');


                $data['series'] = [
                    [
                        'name' => 'Responderam',
                        'data' => [$totalResp->count()]
                    ],
                    [
                        'name' => 'Não Responderam',
                        'data' => [$totalSemResp->count()]
                    ]
                ];
            endif;

        endif;

        return $data;
    }

    public function satisfacaoMedia(Request $request)
    {
        $etapas = [
            'pergunta_inicial',
            'pergunta1',
            'pergunta2',
            'pergunta3',
            'pergunta4',
        ];

        $dtIni = '1970-01-01';
        $dtFin = date('Y-m-d 23:59');

        if ($request->has('dt_ini') && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if ($request->has('dt_fin') && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;

        $perguntaEtapa = $request->p ?? 'pergunta1';

        $resp = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('etapa', $perguntaEtapa)->pluck('resposta')->toArray();

        if (empty($resp)) :
            $resp = [0];
        endif;


        $mediaEstrelas = array_sum($resp) / count($resp);

        $porcentagemMedia = ($mediaEstrelas / 5) * 100;

        return [
            'series' => number_format($mediaEstrelas, 1, ','),
            'percent' => $porcentagemMedia
        ];
    }


    public function removerValoresRepetidos($array)
    {


        $data = [];
        foreach ($array as $key => $value) {
            if (isset($value['whatsapp_enviado'])) {
                $data[] = $value['whatsapp_enviado'];
            }
            if (isset($value['whatsapp'])) {
                $data[] = $value['whatsapp'];
            }
        }


        $arrayUnico = [];
        foreach ($data as $valor) {
            if (!in_array($valor, $arrayUnico)) {
                $arrayUnico[] = $valor;
            }
        }

        return $arrayUnico;
    }
}
