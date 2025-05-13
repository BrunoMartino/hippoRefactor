@extends('layouts.basic')
@section('title', 'Rendimentos afiliados')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="d-flex gap-2 align-items-center">
                <div class="">
                    <h4 class="fw-semibold mb-8">Rendimentos Afiliados</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Rendimentos Afiliados</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    
                    <div class="d-flex flex-column flex-md-row justify-content-end gap-3 mb-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('rend.afiliados.xlsx') }}"
                                class="btn btn-light btn-lg px-4 @if ($incomes->count() == 0) disabled @endif">
                                <i class="ti ti-download me-2"></i>
                                XLSX
                            </a>
                            <a href="{{ route('rend.afiliados.csv') }}"
                                class="btn btn-light btn-lg px-4 @if ($incomes->count() == 0) disabled @endif">
                                <i class="ti ti-download me-2"></i>
                                CSV
                            </a>
                        </div>
                        <div class="">
                            <a href="#"
                                class="btn btn-primary btn-lg px-4 w-100 @if ($incomes->count() == 0) disabled @endif"
                                data-bs-toggle="tooltip" data-bs-placement="top" onclick="showValuesDetails()">
                                Detalhes valores
                            </a>
                        </div>
                    </div>
                    <div class="">
                        @if ($incomes->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem usuário(s) cadastrado(s).
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Data Cadastro
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Data Contrato
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Comissão
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">

                                        @foreach ($incomes as $item)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        {{ $item->created_at->format('d/m/Y') }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        @if ($item->contract_date)
                                                            {{ date('d/m/Y', strtotime($item->contract_date)) }}
                                                        @else
                                                            ----
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  ">
                                                        R$ {{ number_format($item->commission, 2, ',', '.') }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Visualizar" class="btn fs-7 text-dark p-0">
                                                            <i class="ti ti-eye fs-7"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <div class="mt-4">
                            {{ $incomes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="al-details-values" tabindex="-1" aria-labelledby="vertical-center-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-primary">
                <div class="modal-body p-4">
                    <div class="text-center text-primary">
                        <form id="modal-financial">
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total comissões</h5>
                                <input class="form-control" type="text" value="500" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total recebido</h5>
                                <input class="form-control" type="text" value="50" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total a receber</h5>
                                <input class="form-control" type="text" value="450" disabled>
                            </div>
                            <button type="button" class="btn btn-primary my-2" data-bs-dismiss="modal" aria-label="Close">
                                Fechar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function showValuesDetails() {
            let modal = new bootstrap.Modal(
                document.getElementById("al-details-values")
            );
            modal.show()
        }
    </script>
@endsection
