<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Usuários
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('usuarios') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">

                        <!-- Nome -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Nome:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="nome" class=" select-nome  form-control custom-select2"
                                        name="nome" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::orderBy('nome_usuario')->get() as $item)
                                            @php
                                                if ($item->hasRole('super_admin') || $item->id == user_princ()->id) {
                                                    continue;
                                                }
                                                if (
                                                    user_princ()->hasRole('usuario_princ') &&
                                                    $item->cadastrado_por != user_princ()->id
                                                ) {
                                                    continue;
                                                }
                                            @endphp
                                            <option value="{{ $item->nome_usuario }}"
                                                @if (request()->get('nome') == $item->nome_usuario) selected @endif>
                                                {{ $item->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        @hasanyrole('super_admin|admin')
                            <li class="">
                                <div class="fs-5 fw-semibold">Tipo</div>
                                <div class="mt-2 mb-2">


                                    <div class="">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="tipo1" type="checkbox" value="PJ"
                                                id="tipo-pj" style="width: 30px; height: 16px;"
                                                @if ('PJ' == request()->get('tipo1')) checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-pj">
                                                Pessoa Jurídica
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="tipo2" type="checkbox" value="PF"
                                                id="tipo-pf" style="width: 30px; height: 16px;"
                                                @if ('PF' == request()->get('tipo2')) checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-pf">
                                                Pessoa Física
                                            </label>
                                        </div>

                                        <div class=""></div>

                                        {{-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tipo" id="tipo-pj"
                                                value="PJ" @if (request()->get('tipo') == 'PJ') checked @endif />
                                            <label class="form-check-label" for="">PJ</label>
                                        </div> --}}
                                        {{-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tipo" id="tipo-pf"
                                                value="PF" @if (request()->get('tipo') == 'PF') checked @endif />
                                            <label class="form-check-label" for="">PF</label>
                                        </div> --}}
                                        <div class="mt-2 pt-1" style="" id="tipo-texto">
                                            @if (request()->get('tipo1') == 'PJ')
                                                <label for="razao" class="form-label pb-0 mb-1">Razão Social:</label>
                                                <input type="text" class="form-control" name="rs" id="razao"
                                                    placeholder="" value="{{ request()->get('rs') }}" />
                                            @endif
                                            @if (request()->get('tipo2') == 'PF')
                                                <label for="nome" class="form-label pb-0 mb-1">Nome:</label>
                                                <input type="text" class="form-control" name="nome" id="nome"
                                                    placeholder="" value="{{ request()->get('nome') }}" />
                                            @endif
                                        </div>
                                    </div>
                            </li>
                            <!-- CPF ou CNPJ -->
                            <li class="">
                                <label class="fs-5 fw-semibold">CPF ou CNPJ:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="cpf_cnpj" class=" select-cpf-cnpj  form-control custom-select2"
                                            name="cpf_cnpj" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                            @foreach (\App\Models\User::get(['cpf', 'cnpj', 'tipo_usuario']) as $item)
                                                @if ($item->cpf != null)
                                                    <option value="{{ $item->cpf }}"
                                                        @if (request()->get('cpf_cnpj') == $item->cpf) selected @endif>
                                                        {{ formatarCPF($item->cpf) }} / CPF
                                                    </option>
                                                @endif
                                                @if ($item->cnpj != null)
                                                    <option value="{{ $item->cnpj }}"
                                                        @if (request()->get('cpf_cnpj') == $item->cnpj) selected @endif>
                                                        {{ formatarCNPJ($item->cnpj) }} / CNPJ
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                        @endhasanyrole

                        <div class=" d-lg-flex">
                            <!-- E-mail -->
                            <li class="w-100 pe-lg-3">
                                <label class="fs-5 fw-semibold">E-mail:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="email" class=" select-email  form-control custom-select2"
                                            name="email" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                            @foreach (\App\Models\User::orderBy('email')->get() as $item)
                                                @php
                                                    if (
                                                        $item->hasRole('super_admin') ||
                                                        $item->id == user_princ()->id
                                                    ) {
                                                        continue;
                                                    }
                                                    if (
                                                        user_princ()->hasRole('usuario_princ') &&
                                                        $item->cadastrado_por != user_princ()->id
                                                    ) {
                                                        continue;
                                                    }
                                                @endphp
                                                <option value="{{ $item->email }}"
                                                    @if (request()->get('email') == $item->email) selected @endif>
                                                    {{ $item->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <!-- Whatsapp -->
                            <li class="w-100 ">
                                <label class="fs-5 fw-semibold">Whatsapp:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="whatsapp" class=" select-whatsapp  form-control custom-select2"
                                            name="whatsapp" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                            @foreach (\App\Models\User::orderBy('whatsapp')->get() as $item)
                                                @php
                                                    if (
                                                        $item->hasRole('super_admin') ||
                                                        $item->id == user_princ()->id
                                                    ) {
                                                        continue;
                                                    }
                                                    if (
                                                        user_princ()->hasRole('usuario_princ') &&
                                                        $item->cadastrado_por != user_princ()->id
                                                    ) {
                                                        continue;
                                                    }
                                                @endphp
                                                <option value="{{ $item->whatsapp }}"
                                                    @if (request()->get('whatsapp') == $item->whatsapp) selected @endif>
                                                    {{ $item->whatsapp }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <div class=" d-lg-flex">
                            <!-- UF -->
                            <li class="w-100 pe-lg-3 position-relative">
                                <label class="fs-5 fw-semibold">UF:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="uf" class=" select-uf  form-control custom-select2"
                                            name="uf" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                            <option value="AL" @if (old('uf', request()->get('uf')) == 'AL') selected @endif>
                                                Alagoas
                                                - AL</option>
                                            <option value="AC" @if (old('uf', request()->get('uf')) == 'AC') selected @endif>
                                                Acre
                                                -
                                                AC</option>
                                            <option value="AP" @if (old('uf', request()->get('uf')) == 'AP') selected @endif>
                                                Amapá
                                                -
                                                AP</option>
                                            <option value="AM" @if (old('uf', request()->get('uf')) == 'AM') selected @endif>
                                                Amazonas - AM</option>
                                            <option value="BA" @if (old('uf', request()->get('uf')) == 'BA') selected @endif>
                                                Bahia
                                                -
                                                BA</option>
                                            <option value="CE" @if (old('uf', request()->get('uf')) == 'CE') selected @endif>
                                                Ceará
                                                -
                                                CE</option>
                                            <option value="DF" @if (old('uf', request()->get('uf')) == 'DF') selected @endif>
                                                Distrito Federal - DF</option>
                                            <option value="ES" @if (old('uf', request()->get('uf')) == 'ES') selected @endif>
                                                Espírito Santo - ES</option>
                                            <option value="GO" @if (old('uf', request()->get('uf')) == 'GO') selected @endif>
                                                Goiás
                                                - GO</option>
                                            <option value="MA" @if (old('uf', request()->get('uf')) == 'MA') selected @endif>
                                                Maranhão - MA</option>
                                            <option value="MT" @if (old('uf', request()->get('uf')) == 'MT') selected @endif>
                                                Mato
                                                Grosso - MT</option>
                                            <option value="MS" @if (old('uf', request()->get('uf')) == 'MS') selected @endif>
                                                Mato
                                                Grosso do Sul - MS</option>
                                            <option value="MG" @if (old('uf', request()->get('uf')) == 'MG') selected @endif>
                                                Minas
                                                Gerais - MG</option>
                                            <option value="PA" @if (old('uf', request()->get('uf')) == 'PA') selected @endif>
                                                Pará
                                                - PA</option>
                                            <option value="PB" @if (old('uf', request()->get('uf')) == 'PB') selected @endif>
                                                Paraíba - PB</option>
                                            <option value="PR" @if (old('uf', request()->get('uf')) == 'PR') selected @endif>
                                                Paraná - PR</option>
                                            <option value="PE" @if (old('uf', request()->get('uf')) == 'PE') selected @endif>
                                                Pernambuco - PE</option>
                                            <option value="PI" @if (old('uf', request()->get('uf')) == 'PI') selected @endif>
                                                Piauí
                                                - PI</option>
                                            <option value="RJ" @if (old('uf', request()->get('uf')) == 'RJ') selected @endif>
                                                Rio
                                                de Janeiro - RJ</option>
                                            <option value="RN" @if (old('uf', request()->get('uf')) == 'RN') selected @endif>
                                                Rio
                                                Grande do Norte - RN</option>
                                            <option value="RS" @if (old('uf', request()->get('uf')) == 'RS') selected @endif>
                                                Rio
                                                Grande do Sul - RS</option>
                                            <option value="RO" @if (old('uf', request()->get('uf')) == 'RO') selected @endif>
                                                Rondônia - RO</option>
                                            <option value="RR" @if (old('uf', request()->get('uf')) == 'RR') selected @endif>
                                                Roraima - RR</option>
                                            <option value="SC" @if (old('uf', request()->get('uf')) == 'SC') selected @endif>
                                                Santa
                                                Catarina - SC</option>
                                            <option value="SP" @if (old('uf', request()->get('uf')) == 'SP') selected @endif>
                                                São
                                                Paulo - SP</option>
                                            <option value="SE" @if (old('uf', request()->get('uf')) == 'SE') selected @endif>
                                                Sergipe - SE</option>
                                            <option value="TO" @if (old('uf', request()->get('uf')) == 'TO') selected @endif>
                                                Tocantins - TO</option>
                                            <option value="EX" @if (old('uf', request()->get('uf')) == 'EX') selected @endif>
                                                Estrangeiro</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="w-100 ">
                                <label class="fs-5 fw-semibold">Cidade:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="cidade" class=" select-cidade  form-control custom-select2"
                                            name="cidade" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </div>

                        @hasanyrole('super_admin|admin')

                            <!-- Cadastrodo por -->
                            <li class="">
                                <label class="fs-5 fw-semibold">Cadastrodo por:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <select id="cadp" class=" select-cadp  form-control custom-select2"
                                            name="cadp" style="width: 100%; height: 36px">
                                            <option value=""></option>
                                            @foreach (\App\Models\User::whereHas('cadastradoPor')->orderBy('nome_usuario')->get() as $item)
                                                <option value="{{ $item->cadastradoPor()->first()->nome_usuario }}"
                                                    @if (request()->get('cadp') == $item->cadastradoPor()->first()->nome_usuario) selected @endif>
                                                    {{ $item->cadastradoPor()->first()->nome_usuario }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>

                            {{-- <li class="">
                                <label class="fs-5 fw-semibold">Cadastrodo por:</label>
                                <div class="mt-2 mb-2">
                                    <div class="mb-2">
                                        <input type="text" class="form-control" name="cadp" id=""
                                            value="{{ request()->get('cadp') }}" placeholder="" />
                                    </div>
                                </div>
                            </li> --}}
                            <!-- Módulo -->
                            <div class="d-md-flex gap-3">
                                <li class="w-100  ">
                                    <label class="fs-5 fw-semibold">Módulo:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">

                                            <select id="modulo" class=" select-modulo  form-control custom-select2"
                                                name="modulo" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach (\App\Models\Modulo::all() as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (request()->get('modulo') == $item->id) selected @endif>
                                                        {{ $item->titulo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>


                                <!-- Plano -->
                                <li class="w-100  ">
                                    <label class="fs-5 fw-semibold">Plano:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="plano" class=" select-plano   form-control custom-select2"
                                                name="plano" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach (\App\Models\Plano::get()->groupBy('nome')->toArray() as $key => $item)
                                                    <option value="{{ $key }}"
                                                        @if (request()->get('plano') == $key) selected @endif>
                                                        {{ ucfirst($key) }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        @endhasanyrole
                    </ul>

                    <div class="text-center d-flex mt-4 pt-2 flex-column flex-md-row gap-2 justify-content-center">
                        <button type="submit" class="btn btn-primary px-5 ">
                            <div class="px-lg-4 fw-semibold">
                                Filtrar
                            </div>
                        </button>
                        <button type="button" class="btn btn-light text-primary px-5 "
                            onclick="resetarFiltro('form-filtro');resetarChecks()">
                            <div class="px-lg-2 fw-semibold">
                                Limpar Filtro
                            </div>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Axios CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
    integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // nome
    $('#modal-filtro .select-nome').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // email
    $('#modal-filtro .select-email').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // cpf cnpj
    $('#modal-filtro .select-cpf-cnpj').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // whatsapp
    $('#modal-filtro .select-whatsapp').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // cadastrdo por
    $('#modal-filtro .select-cadp').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });

    // uf
    $('#modal-filtro .select-uf').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    }).on('select2:opening', function(e) {
        // if (document.getElementById('divisor-h'))
        //     document.getElementById('divisor-h').style.height = '100px'
    })

    // setInterval(() => {
    //     if (document.getElementById('select2-uf-results') || document.getElementById('select2-cidade-results'))
    //         document.getElementById('divisor-h').style.height = '100px'
    //     else
    //         document.getElementById('divisor-h').style.height = '0px'
    // }, 300);

    let uf1 = ''
    setInterval(() => {
        let uf2 = document.getElementById('uf').value
        if (uf1 != uf2) {
            uf1 = uf2
            setCidades()
            console.log('x');
        }
    }, 1000);

    function setCidades() {
        document.getElementById('cidade').disabled = true
        let uf = document.getElementById('uf').value
        if (uf != '') {

            let html = `<option value=""></option>`
            let cidadeSelecionada = `{{ request()->get('cidade') }}`;
            axios.get(`{{ route('cidades.json') }}?uf=${uf}`)
                .then(res => {
                    for (let i in res.data) {
                        html +=
                            `<option value="${res.data[i].nome}" ${cidadeSelecionada == res.data[i].nome ? 'selected' : ''} >${res.data[i].nome}</option>`
                    }
                    document.getElementById('cidade').innerHTML = html
                    document.getElementById('cidade').disabled = false
                })
        }
    }
    setCidades()

    // cidade
    $('#modal-filtro .select-cidade').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
        // ajax: {
        //     url: '{{ route('cidades.json') }}',
        //     dataType: 'json',
        //     delay: 250,
        //     processResults: function(data) {
        //         return {
        //             results: $.map(data, function(item) {
        //                 console.log(item);
        //                 return {
        //                     text: item.nome,
        //                     id: item.id
        //                 }
        //             })
        //         };
        //     },
        //     cache: true
        // }
    })

    // modulo
    $('#modal-filtro .select-modulo').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // plano
    $('#modal-filtro .select-plano').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });

    if (document.getElementById('tipo-pj'))
        document.getElementById('tipo-pj').onchange = function() {
            if (document.getElementById('tipo-pj').checked) {
                document.getElementById('tipo-pf').checked = false

                document.getElementById('tipo-texto').innerHTML = `
                <label for="razao" class="form-label pb-0 mb-1">Razão Social:</label>
                <input type="text" class="form-control" name="rs" id="razao" placeholder=""  />
            `
            } else {
                document.getElementById('tipo-texto').innerHTML = ''
            }

        }
    if (document.getElementById('tipo-pf'))
        document.getElementById('tipo-pf').onchange = function() {
            if (document.getElementById('tipo-pf').checked) {
                document.getElementById('tipo-pj').checked = false

                document.getElementById('tipo-texto').innerHTML = `
                <label for="nome" class="form-label pb-0 mb-1">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder=""  />
            `
            } else {
                document.getElementById('tipo-texto').innerHTML = ''
            }

        }


    function resetarChecks() {
        if (document.getElementById('tipo-pj'))
            document.getElementById('tipo-pj').checked = false
        if (document.getElementById('tipo-pf'))
            document.getElementById('tipo-pf').checked = false
    }
</script>
