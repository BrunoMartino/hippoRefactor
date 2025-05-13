<?php

namespace App\View\Components\Dashboard\UserMain;

use Closure;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Models\TrackingReport;
use Illuminate\View\Component;
use App\Models\ImportedBilling;
use App\Models\InvoicingReport;
use App\Models\ImportedTracking;
use App\Models\ImportedInvoicing;
use App\Models\ImportedRemarketing;
use Illuminate\Contracts\View\View;
use App\Models\RespostasPesquisaSatisfacao;

class MsgEnvidasEstado extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {


        $dataEstados = $this->dataEstadosArr();

        return view('components.dashboard.user-main.msg-envidas-estado', compact('dataEstados'));
    }

    public function dataEstadosArr($request = null)
    {

        $dtIni = '1970-01-01';
        $dtFin = date('Y-m-d 23:59');

        if (isset($request->dt_ini) && $request->dt_ini != '') :
            $dtIni = $request->dt_ini;
        endif;
        if (isset($request->dt_fin) && $request->dt_fin != '') :
            $dtFin = $request->dt_fin;
        endif;


        $estados = [
            'AC' => [
                'total' => 0,
                'nome' => 'Acre',
            ],
            'AL' => [
                'total' => 0,
                'nome' => 'Alagoas',
            ],
            'AP' => [
                'total' => 0,
                'nome' => 'Amapá',
            ],
            'AM' => [
                'total' => 0,
                'nome' => 'Amazonas',
            ],
            'BA' => [
                'total' => 0,
                'nome' => 'Bahia',
            ],
            'CE' => [
                'total' => 0,
                'nome' => 'Ceará',
            ],
            'DF' => [
                'total' => 0,
                'nome' => 'Distrito Federal',
            ],
            'ES' => [
                'total' => 0,
                'nome' => 'Espírito Santo',
            ],
            'GO' => [
                'total' => 0,
                'nome' => 'Goiás',
            ],
            'MA' => [
                'total' => 0,
                'nome' => 'Maranhão',
            ],
            'MT' => [
                'total' => 0,
                'nome' => 'Mato Grosso',
            ],
            'MS' => [
                'total' => 0,
                'nome' => 'Mato Grosso do Sul',
            ],
            'MG' => [
                'total' => 0,
                'nome' => 'Minas Gerais',
            ],
            'PA' => [
                'total' => 0,
                'nome' => 'Pará',
            ],
            'PB' => [
                'total' => 0,
                'nome' => 'Paraíba',
            ],
            'PR' => [
                'total' => 0,
                'nome' => 'Paraná',
            ],
            'PE' => [
                'total' => 0,
                'nome' => 'Pernambuco',
            ],
            'PI' => [
                'total' => 0,
                'nome' => 'Piauí',
            ],
            'RJ' => [
                'total' => 0,
                'nome' => 'Rio de Janeiro',
            ],
            'RN' => [
                'total' => 0,
                'nome' => 'Rio Grande do Norte',
            ],
            'RS' => [
                'total' => 0,
                'nome' => 'Rio Grande do Sul',
            ],
            'RO' => [
                'total' => 0,
                'nome' => 'Rondônia',
            ],
            'RR' => [
                'total' => 0,
                'nome' => 'Roraima',
            ],
            'SC' => [
                'total' => 0,
                'nome' => 'Santa Catarina',
            ],
            'SP' => [
                'total' => 0,
                'nome' => 'São Paulo',
            ],
            'SE' => [
                'total' => 0,
                'nome' => 'Sergipe',
            ],
            'TO' => [
                'total' => 0,
                'nome' => 'Tocantins',
            ],
        ];

        $rep1 = MessageReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('whatsapp', "!=", null)
            ->get('whatsapp')->toArray();
        $rep3 = BillingsReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep4 = InvoicingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();
        $rep5 = TrackingReport::where('user_id', user_princ()->id)
            ->whereDate('data_envio', '>=', $dtIni)
            ->whereDate('data_envio', '<=', $dtFin)
            ->where('whatsapp_enviado', "!=", null)
            ->get('whatsapp_enviado')->toArray();



        $todosWhats = array_merge($rep1, $rep2, $rep3, $rep4, $rep5);
        $todosWhats = $this->removerValoresRepetidos($todosWhats);
        // dd($todosWhats);

        $data = [];
        $userCurrenteId = user_princ()->id;

        // Carrega todos os dados das tabelas relevantes em memória, filtrando apenas pelo user_id
        $importedBillings = ImportedBilling::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp');
        $importedInvoicings = ImportedInvoicing::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp');
        $importedRemarketings = ImportedRemarketing::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp');
        $importedTrackings = ImportedTracking::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp');

        // 
        $messageReport = MessageReport::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp_enviado');
        $respostasPesquisaSatisfacao = RespostasPesquisaSatisfacao::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp');
        $billingsReport = BillingsReport::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp_enviado');
        $invoicingReport = InvoicingReport::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp_enviado');
        $trackingReport = TrackingReport::where('user_id', $userCurrenteId)->get()->keyBy('whatsapp_enviado');


        foreach ($todosWhats as $key => $whats) :

            
            // if($whats['whatsapp_enviado'] == '5511918559690')
            // dd('ok', $whats['whatsapp_enviado']);

            // Busca os dados pré-carregados para o número atual
            $impBiling = $importedBillings->get($whats);
            $impInvoicing = $importedInvoicings->get($whats);
            $impRemarketing = $importedRemarketings->get($whats);
            $impTracking = $importedTrackings->get($whats);

            // Busca os dados pré-carregados para o número atual
            $repMessageReport = $messageReport->get($whats);
            $repRespostasPesquisaSatisfacao = $respostasPesquisaSatisfacao->get($whats);
            $repBillingsReport = $billingsReport->get($whats);
            $repInvoicingReport = $invoicingReport->get($whats);
            $repTrackingReport = $trackingReport->get($whats);

            if ($impBiling != null) :
                if (isset($estados[$impBiling->uf]['total'])):
                    $estados[$impBiling->uf]['total'] += 1;
                endif;
            elseif ($impInvoicing != null) :
                if (isset($estados[$impInvoicing->uf]['total'])):
                    $estados[$impInvoicing->uf]['total'] += 1;
                endif;
            elseif ($impRemarketing != null) :
                if (isset($estados[$impRemarketing->uf]['total'])):
                    $estados[$impRemarketing->uf]['total'] += 1;
                endif;
            elseif ($impTracking != null) :
                if (isset($estados[$impTracking->uf]['total'])):
                    $estados[$impTracking->uf]['total'] += 1;
                endif;
            elseif ($repMessageReport != null) :
                if (isset($estados[$repMessageReport->uf]['total'])):
                    $estados[$repMessageReport->uf]['total'] += 1;
                endif;
            elseif ($repRespostasPesquisaSatisfacao != null) :
                if (isset($estados[$repRespostasPesquisaSatisfacao->uf]['total'])):
                    $estados[$repRespostasPesquisaSatisfacao->uf]['total'] += 1;
                endif;
            elseif ($repBillingsReport != null) :
                if (isset($estados[$repBillingsReport->uf]['total'])):
                    $estados[$repBillingsReport->uf]['total'] += 1;
                endif;
            elseif ($repInvoicingReport != null) :
                if (isset($estados[$repInvoicingReport->uf]['total'])):
                    $estados[$repInvoicingReport->uf]['total'] += 1;
                endif;
            elseif ($repTrackingReport != null) :
                if (isset($estados[$repTrackingReport->uf]['total'])):
                    $estados[$repTrackingReport->uf]['total'] += 1;
                endif;
            endif;

        endforeach;



        /* ============== */
        $dataEstados =  [
            'meses' => [
                [
                    "mes" => "Janeiro",
                    'dados' => [
                        [
                            "estado" => "Acre",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Alagoas",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Amazonas",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Amapá",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Bahia",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Ceará",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Espírito Santo",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Goiás",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Maranhão",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Minas Gerais",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Mato Grosso do Sul",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Mato Grosso",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Pará",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Paraíba",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Pernambuco",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Piauí",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Paraná",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Rio de Janeiro",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Rio Grande do Norte",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Rondônia",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Roraima",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Rio Grande do Sul",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Santa Catarina",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Sergipe",
                            "valor" => 0
                        ],
                        [
                            "estado" => "São Paulo",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Tocantins",
                            "valor" => 0
                        ],
                        [
                            "estado" => "Distrito Federal",
                            "valor" => 0
                        ]

                    ]
                ]
            ]
        ];

        foreach ($estados as $keyUf => $estado1) :
            foreach ($dataEstados['meses'][0]['dados'] as $key => $estado2) :
                if ($estado1['nome'] == $estado2['estado']) :
                    $dataEstados['meses'][0]['dados'][$key]['valor'] = $estado1['total'];
                endif;
            endforeach;
        endforeach;

        return $dataEstados;
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
