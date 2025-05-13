<div class="">
    <form action="#" method="post" class="" id="form-ativar" style="display: none">
        @csrf
        @method('PUT')

        <div class="alert alert-primary text-center" role="alert">
            <strong class="fs-5">{{$title}}</strong>
            <div class="fs-4">
                {{$desc}}
            </div>
            <div class="mt-2 d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-ativar-regitro">
                    Cancelar
                </button>
                <button type="button" class="btn btn-light text-orange btn-sm px-3" onclick="closeAlertActive()">
                    Sim
                </button>
            </div>
        </div>
    </form>
</div>
