@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show text-center  px-3" role="alert">
        Preencha o formulário corretamento.
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show text-center " role="alert">
        {{ session('error') }}
    </div>
@endif
