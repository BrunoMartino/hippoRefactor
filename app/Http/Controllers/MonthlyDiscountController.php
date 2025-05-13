<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plano;
use App\Models\Modulo;
use Illuminate\Http\Request;
use App\Models\MonthlyDiscount;
use App\Http\Requests\MonthlyDiscountStoreRequest;
use App\Http\Requests\MonthlyDiscountUpdateRequest;

class MonthlyDiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('role:super_admin|admin');
    }

    public function index(Request $request)
    {
        authorizePermissions(['ver-desc-mensais']);
        $discounts = $this->filter($request)->latest()->paginate(10);
        return view('pages.monthly_discounts.index', compact('discounts'));
    }

    public function filter($request)
    {
        $discounts = MonthlyDiscount::where('id', '>', 0);

        if ($request->has('cliente') && $request->cliente != '') :
            $discounts->where('user_id', $request->cliente);
        endif;
        if ($request->has('modulo') && $request->modulo != '') :
            $discounts->where('modulo_id', $request->modulo);
        endif;

        if ($request->has('plano') && $request->plano != '') :
            $discounts->where('plano_id', $request->plano);
        endif;
        if ($request->has('cpf_cnpj') && $request->cpf_cnpj != '') :
            $discounts->whereHas('user', function ($query) use ($request) {
                return $query->where('cpf', 'like', "%{$request->cpf_cnpj}%")->orWhere('cnpj',  'like', "%{$request->cpf_cnpj}%");
            });
        endif;

        // valor
        if ($request->has('t1') && $request->t1 != '') :
            if ($request->has('valor_min') && $request->valor_min != '') :
                $discounts->where('valor', '>=', $request->valor_min);
            endif;
            if ($request->has('valor_max') && $request->valor_max != '') :
                $discounts->where('valor', '<=', $request->valor_max);
            endif;
        endif;
        // percentual
        if ($request->has('t2') && $request->t2 != '') :
            if ($request->has('valor_min') && $request->valor_min != '') :
                $discounts->where('porcentagem', '>=', $request->valor_min);
            endif;
            if ($request->has('valor_max') && $request->valor_max != '') :
                $discounts->where('porcentagem', '<=', $request->valor_max);
            endif;
        endif;


        if ($request->has('dt_inicio_min') && $request->dt_inicio_min != '') :
            $discounts->whereBetween('dt_inicio', [$request->dt_inicio_min . '-05', '2099-01-01']);
        endif;
        if ($request->has('dt_inicio_max') && $request->dt_inicio_max != '') :
            $discounts->whereBetween('dt_inicio', ['1970-01-01', $request->dt_inicio_max . '-05']);
        endif;

        if ($request->has('dt_termino_min') && $request->dt_termino_min != '') :
            $discounts->whereBetween('dt_termino', [$request->dt_termino_min . '-05', '2099-01-01']);
        endif;
        if ($request->has('dt_termino_max') && $request->dt_termino_max != '') :
            $discounts->whereBetween('dt_termino', ['1970-01-01', $request->dt_termino_max . '-05']);
        endif;

        return $discounts;
    }

    public function create()
    {
        authorizePermissions(['criar-desc-mensais']);
        return view('pages.monthly_discounts.create');
    }

    public function store(MonthlyDiscountStoreRequest $request)
    {
        authorizePermissions(['criar-desc-mensais']);
        $discount = (new MonthlyDiscount)->fill($request->all());
        $discount->dt_inicio = $request->dt_inicio . '-05'; // 05 para evitar bugs
        $discount->dt_termino = $request->dt_termino . '-05'; // 05 para evitar bugs

        if ($request->valor == '')
            $discount->valor = null;
        if ($request->porcentagem == '')
            $discount->porcentagem = null;

        $discount->save();

        return redirect()->route('descontos-mensais.index')->withSuccess('Desconto cadastrado com sucesso!');
    }

    public function edit(MonthlyDiscount $md)
    {
        authorizePermissions(['edit-desc-mensais']);
        return view('pages.monthly_discounts.edit', compact('md'));
    }

    public function update(MonthlyDiscountUpdateRequest $request,  MonthlyDiscount $md)
    {
        authorizePermissions(['edit-desc-mensais']);
        $md->fill($request->all());
        if ($request->valor != '') :
            $md->valor = $request->valor;
            $md->porcentagem = null;
        else :
            $md->valor = null;
            $md->porcentagem = $request->porcentagem;
        endif;
        $md->dt_inicio = $request->dt_inicio . '-05'; // 05 para evitar bugs
        $md->dt_termino = $request->dt_termino . '-05'; // 05 para evitar bugs
        $md->save();

        return redirect()->route('descontos-mensais.index')->withSuccess('Desconto editado com sucesso!');
    }

    public function show(MonthlyDiscount $md)
    {
        authorizePermissions(['ver-desc-mensais']);
        return view('pages.monthly_discounts.show', compact('md'));
    }

    public function clientesJson(Request $request): ?object
    {
        $data = User::where('nivel_id', 2)
            ->where('nome_usuario', 'like', "%{$request->q}%")
            ->orderBy('nome_usuario')
            ->get(['nome_usuario', 'id']);

        return response()->json($data);
    }

    public function modulosJson(Request $request): ?object
    {
        $data = Modulo::where('titulo', 'like', "%{$request->q}%")->orderBy('nome')->get(['titulo', 'id']);
        return response()->json($data);
    }

    public function planosJson(Request $request): ?object
    {

        $data = Plano::where('nome', 'like', "%{$request->q}%")->get(['nome', 'id']);
        return response()->json($data);
    }

    public function destroy(MonthlyDiscount $md)
    {
        authorizePermissions(['deletar-desc-mensais']);
        $md->delete();
        return redirect()->route('descontos-mensais.index')->withSuccess('Desconto removido com sucesso!');
    }
}
