<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PlanUpdateRequest;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin|admin');
    }

    public function index(Request $request)
    {
        authorizePermissions(['ver-planos']);
        $planos = $this->filter($request);
        $todosPlanos = Plano::latest()->get();
        return view('pages.plans.index', compact('planos', 'todosPlanos'));
    }

    public function filter($request)
    {

        $planos = Plano::where('id', '>', 0);

        // nome
        if ($request->has('plano') && $request->plano != '') :
            $planos->where('nome','like', '%'.$request->plano.'%');
        endif;

        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $planos->where('modulo_id', 'like', "%{$request->modulo}%");
        endif;

        $planos = $planos->paginate(10);
        return $planos;
    }

    public function edit(int $plano_id)
    {
        authorizePermissions(['edit-planos']);
        $plano = Plano::find($plano_id);
        $titulo = 'Editar Plano de Assinatura';
        return view('pages.plans.edit', compact('titulo', 'plano'));
    }

    public function update(PlanUpdateRequest $request, Plano $plan)
    {
        authorizePermissions(['edit-planos']);


        $plan->limite_mensagens = $request->input('limite_mensagens');
        $plan->valor = $request->input('valor');
        $plan->qtd_usuarios = $request->input('qtd_usuarios');
        $plan->qtd_instancias = $request->input('qtd_instancias');
        // $plan->modulo_id = $request->input('modulo_id');
        $plan->custo_excedente = is_null($request->custo_excedente) || $request->custo_excedente == '' ? 0 : $request->custo_excedente;
        $plan->color = $request->input('color');
        if ($request->hasFile('icon')) :
            $pathIcon = $request->file('icon')->store('public/icons');
            $plan->icon = Storage::url($pathIcon);
        endif;
        $plan->save();

        $authUser = auth()->user();
        Log::info("Plano '" . ucfirst($plan->nome) . "' atualizado por {$authUser->nome_usuario}({$authUser->id})");

        return redirect()->route('planos')->with('success', 'Plano atualizado com sucesso.');
    }
}
