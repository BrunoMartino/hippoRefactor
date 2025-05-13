<div>
    <div class="table-responsive pb-3">
        <table class="table table-sm table-hover table-bordered table-striped text-nowrap">
            <thead>
                <!-- start row -->
                <tr>
                    <th class="p-2">Módulo</th>
                    <th class="p-2">Plano</th>
                    <th class="p-2">Qtd. Msgs Excedentes</th>
                    <th class="p-2">Valor Excedente</th>
                </tr>
                <!-- end row -->
            </thead>
            <tbody>
                <!-- start row -->
                @foreach ($plans as $item)
                    <tr class=" ">
                        <td class="p-2 ">
                            {{ $item->modulo->titulo }}
                        </td>
                        <td class="p-2 ">
                            {{ ucfirst($item->nome) }}
                        </td>
                        <td class="p-2 ">
                            @php

                                $users = $item->users()->whereHas('controlQuantMessage')->get();

                                $total = 0;
                                $enviados = 0;
                                $excedentes = 0;
                                foreach ($users as $key => $user) {
                                    $total += $user->controlQuantMessage->quant_mensagens;
                                    $enviados += $user->controlQuantMessage->mensagens_enviadas;
                                    if ($total < $enviados) {
                                        $excedentes = $enviados - $total;
                                    }
                                }

                                $valor = $excedentes * $item->custo_excedente;
                                if ($valor < 0) {
                                    $valor = 0;
                                }
                            @endphp
                            {{ $excedentes }}
                        </td>

                        <td class=" p-2">
                            {{ number_format($valor, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
