<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 11px
        }

        td,
        th {
            border: 1px solid #eaeff4;
            text-align: left;
            padding: 8px;
        }

        th {
            color: #0853fc
        }

        tr:nth-child(even) {
            background-color: #eaeff4;
        }

        h2 {
            font-family: Arial, Helvetica, sans-serif
        }
    </style>
</head>

<body>

    <h2>Relatório Rastreamento</h2>

    <table class="table table-hover table-striped table-hover  ">
        <thead>
            <tr class="border-0 text-center">
                <th scope="" class="p-0 border-0 pb-2 pe-3">
                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                        Nome
                    </div>
                </th>
                <th scope="" class="py-0 border-0 pb-2 ps-0" style="text-align: center">
                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  text-truncate">
                        Envio
                    </div>
                </th>
                <th scope="" class="py-0 border-0 pb-2 ps-0" style="text-align: center">
                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                        Situação
                    </div>
                </th>
                <th scope="" class="py-0 border-0 pb-2 ps-0" style="text-align: center">
                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate ">
                        Visualizado
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($reports as $report)
                <tr class="align-items-center ">
                    <td class="border-0 py-2 col-md-2 ">
                        <div class=" fw-semibold px-1 pt-2  text-truncate">
                            {{ Str::limit($report->nome_cliente, 30) }}
                        </div>
                    </td>
                    <td class=" border-0 py-2">
                        <div class=" fw-semibold px-1 pt-2 text-center pe-3 " style="text-align: center">
                            {{ date('d/m/Y H:i', strtotime($report->data_envio)) }}
                        </div>
                    </td>
                    <td class=" border-0 py-2">
                        <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                            <div class="pe-1">
                                @switch($report->situacao)
                                    @case('entregue')
                                        <span class="bg-primary badge w-100 rounded-pill"
                                            style="max-width: 120px; background: #0853FC !important; border-color: #0853FC !important; padding: 2px 5px; border-radius: 10px; color:white; font-size:10px; display:block; text-align: center; width: 80px; margin: 0 auto">
                                            Entregue
                                        </span>
                                    @break

                                    @case('nao_entregue')
                                        <span class="bg-orange badge w-100 rounded-pill"
                                            style="max-width: 120px; background: #ff621d !important; border-color: #ff621d !important; padding: 2px 5px; border-radius: 10px; color:white; font-size:10px; display:block; text-align: center; width: 80px; margin: 0 auto">
                                            Não entregue
                                        </span>
                                    @break

                                    @case('visualizado')
                                        <span ty class="bg-success badge w-100 rounded-pill"
                                            style="max-width: 120px;background: #37bb37; border-color: #37bb37; padding: 2px 5px; border-radius: 10px; color:white; font-size:10px; display:block; text-align: center; width: 80px; margin: 0 auto">
                                            Visualizado
                                        </span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </td>
                    <td class=" border-0 py-2">
                        <div class=" fw-semibold px-1 pt-2 text-center pe-3 " style="text-align: center">
                            @if (is_null($report->data_visualizado))
                                -
                            @else
                                {{ date('d/m/Y H:i', strtotime($report->data_visualizado)) }}
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
