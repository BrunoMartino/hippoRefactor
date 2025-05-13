<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionStoreRequest $request)
    {
        /* TODO: inserir regra de negócio/autorizações */

        Subscription::updateOrCreate([
            'user_id' => $request->user_id,
            'plan_id' => $request->plan_id,
            // 'status' => 'ativo'
        ]);

        return redirect()->back()->withSuccess('Dados salvos com sucesso!');
    }
   
    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $subscription = $subscription->fill($request->all());
        $subscription->save();

        return redirect()->back()->withSuccess('Inscrição atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $subscription->delete();
        return redirect()->back()->withSuccess('Inscrição deletada com sucesso!');
    }
}
