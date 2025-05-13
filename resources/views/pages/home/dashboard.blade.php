@extends('layouts.basic')
@section('head')
    <!-- scripts necessários para a lib select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>
    <!-- / scripts necessários para a lib select2 -->
@endsection
@section('content')
    <div id="cancelar-conta"></div>

    @hasanyrole('super_admin|admin')
        @include('pages.home._adm')
    @endhasanyrole
    @hasanyrole('usuario_princ|usuario_sec')
        @include('pages.home._user')
    @endhasanyrole
@endsection
@section('scripts')
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
        integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- charts -->
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <!-- dataTables -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    @hasanyrole('usuario_princ|usuario_sec')
        <!-- Charts -->
        <script src="{{ asset('assets/js/chart-user-main.js') }}"></script>
    @endhasanyrole

    @hasanyrole('super_admin|admin')
        <!-- Charts -->
        <script src="{{ asset('assets/js/chart-adm.js') }}"></script>
        <!-- Datatable -->
        <script src="{{ asset('assets/js/datatable-adm.js') }}"></script>
    @endhasanyrole
@endsection
