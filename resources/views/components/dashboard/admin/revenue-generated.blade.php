<div>
    <div class="table-responsive pb-3">
        <table class="table table-sm table-hover table-bordered table-striped datatable-receita-clientes text-nowrap">
            <thead>
                <!-- start row -->
                <tr>
                    <th class="p-2">Nome</th>
                    <th class="p-2">Valor</th>
                </tr>
                <!-- end row -->
            </thead>
            <tbody>
                <!-- start row -->
                @foreach ($users as $user)
                    <tr>
                        <td class="p-2">
                            {{ $user->nome_usuario }}
                        </td>
                        <td class="p-2">
                            {{ convertStringNumber($user->invoices()->where('status', 'paid')->sum('total_value'), 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
