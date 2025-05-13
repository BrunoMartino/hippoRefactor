<div class="">
    <form action="#" method="post" class="" id="form-deletar" style="display: none">
        @csrf
        @method('DELETE')

        <div class="alert alert-warning text-center" role="alert">
            <strong class="fs-5">{{$title}}</strong>
            <div class="fs-4">
                {!! $desc !!}
            </div>
            <div class="mt-2 d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-deletar-regitro">
                    Sim
                </button>
                <button type="button" class="btn btn-light text-orange btn-sm px-3" onclick="document.getElementById('form-deletar').style.display='none';">
                    Cancelar
                </button>
            </div>
        </div>
    </form>
</div>
