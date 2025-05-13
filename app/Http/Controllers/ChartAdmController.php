<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Plano;
use App\Models\Modulo;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Models\TrackingReport;
use App\Models\InvoicingReport;
use Illuminate\Support\Facades\DB;
use App\Models\RespostasPesquisaSatisfacao;

class ChartAdmController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('role:super_admin|admin');
    }

    public function msgEnviadas(Request $request)
    {

        // return $data;
        $dataResultado = [];

        $allClassReport = [
            MessageReport::class,
            RespostasPesquisaSatisfacao::class,
            BillingsReport::class,
            InvoicingReport::class,
            TrackingReport::class,
        ];

        foreach ($allClassReport as $key => $classReport):


            if ($request->has('dt_ini') && $request->dt_ini != '' || $request->has('dt_fin') && $request->dt_fin != '') :

                // dados dos ultimos 20 dias
                $data = $classReport::where('id', '>', 0);
                if ($request->has('dt_ini') && $request->dt_ini != '') :
                    $data->whereDate('data_envio', '>=', $request->dt_ini);

                endif;
                if ($request->has('dt_fin') && $request->dt_fin != '') :
                    $data->whereDate('data_envio', '<=', $request->dt_fin);

                    if ($request->dt_ini == '') :
                        $data->whereDate('data_envio', '>=', date('Y-m-d', strtotime($request->dt_fin . ' -10 days')));
                    endif;

                endif;

                $data = $data->select(DB::raw('DATE(data_envio) as x'), DB::raw('count(*) as y'))
                    ->groupBy(DB::raw('DATE(data_envio)'))
                    ->orderBy(DB::raw('DATE(data_envio)'))
                    ->get();

            else :
                // // dados dos ultimos 20 dias
                $data = $classReport::whereDate('data_envio', '>=', Carbon::now()->subDays(10)->format('Y-m-d'))
                    ->select(DB::raw('DATE(data_envio) as x'), DB::raw('count(*) as y'))
                    ->groupBy(DB::raw('DATE(data_envio)'))
                    ->orderBy(DB::raw('DATE(data_envio)'))
                    ->get();
            endif;

            if (count($data) > 0) :
                /* Obter dados sem filtro */
                if ($request->dt_fin == '' && $request->dt_ini == '') :
                    $dtUltimasDiasFim = date('Y-m-d');
                    for ($i = 0; $i < 10; $i++) :
                        $dtDados = date('Y-m-d', strtotime($dtUltimasDiasFim . " - $i days"));
                        $valorDados = 0;

                        foreach ($data as $value) :
                            // dd($value['x'], $dtDados);
                            if ($value['x'] == $dtDados) :
                                $valorDados = $value['y'];
                            endif;
                        endforeach;

                        $c = 0;
                        foreach ($dataResultado as $k => $v) {
                            if ($v['x'] == $dtDados) {
                                $c = 1;
                                $dataResultado[$k]['y'] += $valorDados;
                                break;
                            }
                        }

                        if ($c == 0) {
                            $dataResultado[] = [
                                'x' => $dtDados,
                                'y' => $valorDados
                            ];
                        }


                    endfor;

                /* Obter dados com filtro incio e fim */
                elseif ($request->dt_fin != '' && $request->dt_ini != '') :

                    $dtUltimasDiasFim = $request->dt_fin;
                    $dtUltimasDiasIni = $request->dt_ini;

                    if (strtotime($dtUltimasDiasFim) > strtotime(date('Y-m-d')))
                        $dtUltimasDiasFim = date('Y-m-d');

                    // Calcular a diferença em dias
                    $dateDiffStart = Carbon::parse($dtUltimasDiasIni);
                    $dateDiffEnd = Carbon::parse($dtUltimasDiasFim);
                    $daysDifference = $dateDiffStart->diffInDays($dateDiffEnd);

                    for ($i = 0; $i <= $daysDifference; $i++) :
                        $dtDados = date('Y-m-d', strtotime($dtUltimasDiasFim . " - $i days"));
                        $valorDados = 0;

                        foreach ($data as $value) :
                            if ($value['x'] == $dtDados) :
                                $valorDados = $value['y'];
                            endif;
                        endforeach;


                        $c = 0;
                        foreach ($dataResultado as $k => $v) {
                            if ($v['x'] == $dtDados) {
                                $c = 1;
                                $dataResultado[$k]['y'] += $valorDados;
                                break;
                            }
                        }

                        if ($c == 0) {
                            $dataResultado[] = [
                                'x' => $dtDados,
                                'y' => $valorDados
                            ];
                        }
                    endfor;

                /* Obter dados com filtro incio apenas */
                elseif ($request->dt_fin == '' && $request->dt_ini != '') :

                    $dtUltimasDiasFim = date('Y-m-d', strtotime($request->dt_ini . "+10 days"));
                    $dtUltimasDiasIni = $request->dt_ini;

                    if (strtotime($dtUltimasDiasFim) > strtotime(date('Y-m-d')))
                        $dtUltimasDiasFim = date('Y-m-d');

                    // Calcular a diferença em dias
                    $dateDiffStart = Carbon::parse($dtUltimasDiasIni);
                    $dateDiffEnd = Carbon::parse($dtUltimasDiasFim);
                    $daysDifference = $dateDiffStart->diffInDays($dateDiffEnd);

                    for ($i = 0; $i <= $daysDifference; $i++) :

                        $dtDados = date('Y-m-d', strtotime($dtUltimasDiasFim . " - $i days"));
                        $valorDados = 0;

                        foreach ($data as $value) :
                            if ($value['x'] == $dtDados) :
                                $valorDados = $value['y'];
                            endif;
                        endforeach;

                        $c = 0;
                        foreach ($dataResultado as $k => $v) {
                            if ($v['x'] == $dtDados) {
                                $c = 1;
                                $dataResultado[$k]['y'] += $valorDados;
                                break;
                            }
                        }

                        if ($c == 0) {
                            $dataResultado[] = [
                                'x' => $dtDados,
                                'y' => $valorDados
                            ];
                        }
                    endfor;

                /* Obter dados com filtro fim apenas */
                elseif ($request->dt_fin != '' && $request->dt_ini == '') :

                    $dtUltimasDiasFim = $request->dt_fin;
                    $dtUltimasDiasIni = date('Y-m-d', strtotime($request->dt_fin . "-10 days"));

                    if (strtotime($dtUltimasDiasFim) > strtotime(date('Y-m-d')))
                        $dtUltimasDiasFim = date('Y-m-d');

                    // Calcular a diferença em dias
                    $dateDiffStart = Carbon::parse($dtUltimasDiasIni);
                    $dateDiffEnd = Carbon::parse($dtUltimasDiasFim);
                    $daysDifference = $dateDiffStart->diffInDays($dateDiffEnd);

                    for ($i = 0; $i <= $daysDifference; $i++) :

                        $dtDados = date('Y-m-d', strtotime($dtUltimasDiasFim . " - $i days"));
                        $valorDados = 0;

                        foreach ($data as $value) :
                            if ($value['x'] == $dtDados) :
                                $valorDados = $value['y'];
                            endif;
                        endforeach;

                        $c = 0;
                        foreach ($dataResultado as $k => $v) {
                            if ($v['x'] == $dtDados) {
                                $c = 1;
                                $dataResultado[$k]['y'] += $valorDados;
                                break;
                            }
                        }

                        if ($c == 0) {
                            $dataResultado[] = [
                                'x' => $dtDados,
                                'y' => $valorDados
                            ];
                        }
                    endfor;

                endif;
            endif;

        endforeach;

        // formata data padrão americano
        foreach ($dataResultado as $key => $value):
            $dataResultado[$key]['x'] = date("m-d-Y \\G\\M\\T", strtotime($value['x']));
        endforeach;

        return $dataResultado;
    }

    /**
     * Usuários por módulos e planos
     *
     * @return void
     */
    public function usuariosRemarketing()
    {
        $modulo = Modulo::where('nome', 'remarketing')->first();

        if (is_null($modulo))
            return [];

        $data = [
            'labels' => [],
            'data' => []
        ];
        foreach ($modulo->planos as $key => $plan) {
            $data['labels'][] = ucfirst($plan->nome);

            $data['data'][] = Subscription::where('plan_id', $plan->id)->whereHas('user', function ($q) {
                return $q->role('usuario_princ');
            })->where('status', 'ativo')->count();
        }

        return $data;
    }

    public function usuariosCobrancas()
    {
        $modulo = Modulo::where('nome', 'cobrancas')->first();

        if (is_null($modulo))
            return [];

        $data = [
            'labels' => [],
            'data' => []
        ];
        foreach ($modulo->planos as $key => $plan) {
            $data['labels'][] = ucfirst($plan->nome);

            $data['data'][] = Subscription::where('plan_id', $plan->id)->whereHas('user', function ($q) {
                return $q->role('usuario_princ');
            })->where('status', 'ativo')->count();
        }

        return $data;
    }

    public function usuariosFaturamento()
    {
        $modulo = Modulo::where('nome', 'faturamento')->first();

        if (is_null($modulo))
            return [];

        $data = [
            'labels' => [],
            'data' => []
        ];
        foreach ($modulo->planos as $key => $plan) {
            $data['labels'][] = ucfirst($plan->nome);

            $data['data'][] = Subscription::where('plan_id', $plan->id)->whereHas('user', function ($q) {
                return $q->role('usuario_princ');
            })->where('status', 'ativo')->count();
        }

        return $data;
    }

    public function usuariosRastreamento()
    {
        $modulo = Modulo::where('nome', 'rastreamento')->first();

        if (is_null($modulo))
            return [];

        $data = [
            'labels' => [],
            'data' => []
        ];
        foreach ($modulo->planos as $key => $plan) {
            $data['labels'][] = ucfirst($plan->nome);

            $data['data'][] = Subscription::where('plan_id', $plan->id)->whereHas('user', function ($q) {
                return $q->role('usuario_princ');
            })->where('status', 'ativo')->count();
        }

        return $data;
    }

    public function upgradeEndDowngradPlans(Request $request)
    {
        /* Organizar dados */
        $plans = Plano::get();
        $namePlans = [];
        foreach ($plans as $key => $plan) :

            if ($plan->nome == 'Test')
                continue;

            $namePlans[$plan->id] = [
                'name' => $plan->modulo->titulo . ' - '.  ucfirst($plan->nome),
                'upgrade' => 0,
                'downgrade' => 0
            ];

            if($plan->id == 3 || $plan->id == 7 || $plan->id == 11 || $plan->id == 15 || $plan->id == 19){
                $namePlans[rand(10000, 100000)] = [
                    'name' => '',
                    'upgrade' => 0,
                    'downgrade' => 0
                ];
            }
            
        endforeach;

        /*  */
        $subsGroup = Subscription::where('id', '>', 0);

        $subsGroup = $subsGroup->get()->groupBy('user_id');

        foreach ($subsGroup as $group) :
            foreach ($group as $key => $subs) :

                // pula o primeiro registro, q é a primeira assinatura q não é upgrade nem downgrade
                if ($key == 0)
                    continue;

                // fazer filtro por datas
                if ($request->has('dt_ini') && $request->dt_ini)
                    if (strtotime(date('Y-m-d', strtotime($subs->created_at . '+1 days'))) <= strtotime($request->dt_ini))
                        continue;
                if ($request->has('dt_fin') && $request->dt_fin)
                    if (strtotime(date('Y-m-d', strtotime($subs->created_at . '-1 days'))) >= strtotime($request->dt_fin))
                        continue;

                //
                $subsUp = $subs;
                $subsDow = $group[$key - 1];

                // se o plano que esta sendo o upgrade for de um valor mairo que o plano do downgrade
                if ($subsUp->plan->valor > $subsDow->plan->valor) :
                    $namePlans[$subs->plan_id]['upgrade'] += 1;
                endif;
                if ($subsUp->plan->valor < $subsDow->plan->valor) :
                    $namePlans[$subsDow->plan_id]['downgrade'] += 1;
                endif;

            endforeach;
        endforeach;

        // preparar dados para gráfico
        $data =  [
            'categories' => [],
            'series' => [
                ['name' => "Upgrade", 'data' => [],],
                ['name' => "Downgrade", 'data' => [],]
            ],
        ];

        foreach ($namePlans as $key => $value) :
            $data['categories'][] = $value['name'];
            // Upgrade
            $data['series'][0]['data'][] = $value['upgrade'];
            // Downgrade
            $data['series'][1]['data'][] = $value['downgrade'];
        endforeach;

        return $data;
    }

    public function newCustomers(Request $request)
    {
        $data = [
            'series' => [
                [
                    'name' => 'Clientes',
                    'data' => []
                ],
            ],
            'categories' => []
        ];

        $customers = User::role('usuario_princ')
            ->select(DB::raw('DATE(created_at) as data'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();

        $customers = User::role('usuario_princ')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($data) {
                return $data->created_at->format('Y-m-d');
            });

        // data inicial e final
        $dateStart = $request->dt_ini ?? date('Y-m-d', strtotime('-10 days'));
        $dateEnd = $request->dt_fin ?? date('Y-m-d');

        if ($request->dt_ini && $request->dt_fin == '') :
            $dateEnd = date('Y-m-d', strtotime($request->dt_ini . "+ 10 days"));
            $dateEnd = (strtotime($dateEnd) > strtotime(date('Y-m-d'))) ? date('Y-m-d') : $dateEnd;
        endif;
        if ($request->dt_fin && $request->dt_ini == '') :
            $dateStart = date('Y-m-d', strtotime($request->dt_fin . "- 10 days"));
        endif;

        // Calcular a diferença em dias
        $dateDiffStart = Carbon::parse($dateStart);
        $dateDiffEnd = Carbon::parse($dateEnd);
        $daysDifference = $dateDiffStart->diffInDays($dateDiffEnd);

        // return $customers;
        for ($i = 0; $i <= $daysDifference; $i++) :
            $day = date('Y-m-d', strtotime($dateStart . " + $i days"));
            // $day= date('d/m/Y', strtotime($dateStart . " + $i days"));

            if (isset($customers[$day])) :
                $data['series'][0]['data'][] = count($customers[$day]);
            else :
                $data['series'][0]['data'][] = 0;
            endif;
            $data['categories'][] = date('m-d-Y', strtotime($day));
        endfor;

        return $data;
    }
}
