<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plano;
use App\Models\Affiliate;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\AffiliateReferral;
use App\Http\Requests\AffiliateStoreRequest;
use App\Http\Requests\AffiliateUpdateRequest;
use App\Http\Controllers\Auth\RegisterController;

class AfiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        authorizePermissions(['ver-afiliados']);
        $affiliates = $this->filter($request);
        return view('pages.affiliates.index', compact('affiliates'));
    }

    public function filter($request)
    {
        $affiliates = Affiliate::where('id', '>', 0);

        // nome
        if ($request->has('nome') && $request->nome != '') :
            $affiliates->whereHas('user', function ($q) use ($request) {
                return $q->where('id', $request->nome);
            });
        endif;
        // código
        if ($request->has('cod') && $request->cod != '') :
            $affiliates->where('ref_id', 'like', "%{$request->cod}%");
        endif;

        // email
        if ($request->has('email') && $request->email != '') :
            $affiliates->whereHas('user', function ($q) use ($request) {
                return $q->where('email', 'like', "%{$request->email}%");
            });
        endif;
        // whatsapp
        if ($request->has('whatsapp') && $request->whatsapp != '') :
            $affiliates->whereHas('user', function ($q) use ($request) {
                return $q->where('whatsapp', 'like', "%" . extrairNumeros($request->whatsapp) . "%");
            });
        endif;

        $affiliates = $affiliates->latest()->paginate(12);
        return $affiliates;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        authorizePermissions(['criar-afiliados']);
        return view('pages.affiliates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AffiliateStoreRequest $request)
    {
        authorizePermissions(['criar-afiliados']);
        // criar usuário
        $pass = Str::random(8);
        $user = User::create([
            'nome_usuario' => $request->name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'estado' => $request->state,
            'cidade' => $request->city,
            'endereco' => $request->address,
            'password' => bcrypt($pass),
            'cadastrado_por' => auth()->user()->id,
            'nivel_id' => 3
        ]);
        $user->assignRole('afiliado');
        $user->givePermissionTo('edit-perfil', 'ver-rend-afiliados');

        // salvar dados afiliado
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['ref_id'] = $this->generateRefId();
        $affiliate = Affiliate::create($data);

        // enviar login por email
        $send = (new RegisterController)->sendAccessData($user, $pass);

        return redirect()->route('affiliates.crud.index')->with('success', 'Afiliado cadastrado com sucesso.');
    }

    public function generateRefId()
    {
        for ($i = 0; $i < 1000; $i++) {
            $ref = Str::random(10);
            if (Affiliate::where('ref_id', $ref)->exists()) {
                $ref = Str::random(10) . Affiliate::count() + 1;
                break;
            }
        }

        return $ref;
    }

    /**
     * Display the specified resource.
     */
    public function show(Affiliate $affiliate)
    {
        authorizePermissions(['ver-afiliados']);
        return view('pages.affiliates.show', compact('affiliate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        authorizePermissions(['edit-afiliados']);
        $affiliate = Affiliate::where('id', $request->id)->get()->first();
        if ($affiliate) {
            return view('pages.affiliates.update', compact('affiliate'));
        }
        return redirect()->back()->with('error', 'Afiliado não encontrado.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AffiliateUpdateRequest $request, Affiliate $affiliate)
    {
        authorizePermissions(['edit-afiliados']);
        $affiliate->fill($request->all());
        $affiliate->save();

        $user = User::find($affiliate->user_id);
        $user->nome_usuario = $request->name;
        $user->email = $request->email;
        $user->whatsapp = $request->whatsapp;
        $user->estado = $request->state;
        $user->cidade = $request->city;
        $user->endereco = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Afiliado atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        /* TODO: talves em remover afiliados está removendo os usuários q cadastraram pelo seu link (porq está associado), 
        revisar */

        authorizePermissions(['deletar-afiliados']);

        if ($request->has('id')) {
            $affiliate = Affiliate::find($request->id);
            if ($affiliate) {
                $affiliate->delete();
                User::where('id', $affiliate->user_id)->delete();
                return redirect()->back()->with('success', 'Afiliado excluído com sucesso.');
            }
        }
        return redirect()->back()->with('error', 'Não foi possível excluir o afiliado, tente novamente.');
    }

    /**
     * Tela Rendimentos Afiliados
     *
     * @param  mixed $request
     * @return void
     */
    public function income(Request $request)
    {
        authorizePermissions(['ver-rend-afiliados-adm']);

        // return  AffiliateReferral::all();
        $incomes = $this->filterIncome($request);
        return view('pages.affiliates.income.index', compact('incomes'));
    }

    public function showIncome(AffiliateReferral $affiliate)
    {
        return view('pages.affiliates.income.show', compact('affiliate'));
    }

    public function filterIncome($request)
    {

        // $incomes= Subscription::where('status', 'ativo')->user()->affiliate_ref();

        // $incomes = AffiliateReferral::whereHas('user', function ($query) {
        //     // ser usuário fez o pagamento e a conta está ativa na tabela 'subscription'
        //     return $query->whereHas('subscription', function ($q) {
        //         return $q->where('status', 'ativo');
        //     });
        // });
        $incomes = AffiliateReferral::where('id', '>', 0);

        // afiliado
        if ($request->has('afiliado') && $request->afiliado != '') :
            $incomes->whereHas('affiliate', function ($query) use ($request) {
                $query->whereHas('user', function ($q) use ($request) {
                    return $q->where('id', $request->afiliado);
                });
            });
        endif;
        // plano
        if ($request->has('plano') && $request->plano != '') :
            $incomes->whereHas('user', function ($query) use ($request) {
                $query->whereHas('subscriptionAll', function ($q) use ($request) {
                    $q->whereHas('plan', function ($p) use ($request) {
                        $p->where('nome', 'LIKE', '%' . $request->plano . '%');
                    });
                });
            });
        endif;
        // modulo
        if ($request->has('modulo') && $request->modulo != '') :
            $incomes->whereHas('user', function ($query) use ($request) {
                $query->whereHas('subscriptionAll', function ($q) use ($request) {
                    $q->whereHas('plan', function ($p) use ($request) {
                        return $p->where('modulo_id', $request->modulo);
                    });
                });
            });
        endif;

        // data venda
        if ($request->has('data') && $request->data != '') :
            $incomes->whereHas('user', function ($query) use ($request) {
                $query->whereHas('subscription', function ($q) use ($request) {
                    return $q->whereDate('updated_at', $request->data);
                });
            });
        endif;

        if ($request->has('dt_venda_ini') && $request->dt_venda_ini != '') :
            $incomes->whereHas('user', function ($query) use ($request) {
                $query->whereHas('subscriptionAll', function ($q) use ($request) {
                    return $q->whereBetween('updated_at', [$request->dt_venda_ini .' 00:00', '2099-01-01']);
                });
            });
        endif;
        if ($request->has('dt_venda_fim') && $request->dt_venda_fim != '') :
            $incomes->whereHas('user', function ($query) use ($request) {
                $query->whereHas('subscriptionAll', function ($q) use ($request) {
                    return $q->whereBetween('updated_at', ['1970-01-01', $request->dt_venda_fim . ' 23:59:59']);
                });
            });
        endif;
        

        // dd($incomes->get()->toArray());
        $incomes = $incomes->latest()->paginate(12);
        return $incomes;
    }
}
