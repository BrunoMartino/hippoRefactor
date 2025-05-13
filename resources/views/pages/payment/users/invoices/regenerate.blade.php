@extends('layouts.basic')
@section('title', 'Fatura em aberto')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Fatura em aberto</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Fatura em aberto</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <x-alerts.error />
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('usuarios.comprar.pagar') }}" method="get"
                        id="form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12 px-0 px-md-3">
                                <div class="fs-5 mb-4">
                                    <div class="alert alert-warning text-center" role="alert">
                                        O pagamento da fatura abaixo não foi aprovado pela instituição financeira, favor realizar o pagamento.
                                    </div>
                                </div>
                                <div class="fw-semibold fs-4 mb-1">
                                    Itens da compra:
                                </div>
                                <div class="mb-4 mb-md-0 d-flex gap-3 fs-7 justify-content-between px-3 py-2 rounded  align-items-center text-truncate " style="background: #f5f6f6">
                                    <div class="">
                                        {{ $total == 1 ? 'Usuário' : 'Usuários' }}
                                    </div>
                                    <div class=" text-center">
                                        {{ $total }}un
                                    </div>
                                    <div class=" text-end ">
                                        <strong>R$
                                            {{ number_format($valor, 2, ',', '.') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1">
                            <div class="text-center mt-5 mb-5 pt-5">
                                <div class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                    <button type="submit" class="btn btn-primary  px-5 fs-4">
                                        <div class="">Realizar pagamento</div>
                                    </button>
                                    <button type="button"
                                    onclick="cancel(`{{ route('usuarios.invoice.cancel', $invoice->invoice_id) }}`)"
                                    class="btn btn-light px-5 fs-4 text-primary" id="btn-cancelar">
                                    <div class="px-lg-4">Cancelar fatura</div>
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="#" method="post" id="form-cancel">
        @csrf
        @method('PUT')
    </form>
@endsection
@section('scripts')
    <script>
        function cancel(url) {
            Swal.fire({
                title: "Cancelar Fatura",
                text: "Você tem certeza de que deseja cancelar a fatura?",
                icon: "warning",
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Sim`,
                cancelButtonText: `Não`,
                focusConfirm: false,
                preDeny: () => {
                    document.getElementById('form-cancel').action = url
                    document.getElementById('form-cancel').submit()
                }
            });
        }
    </script>
@endsection