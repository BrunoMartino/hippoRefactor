@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show text-center px-3 " role="alert">
        {{ session('warning') }}
        <div class="mt-2">
            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="alert" aria-label="Close">
                OK
            </button>
        </div>
    </div>
@endif
