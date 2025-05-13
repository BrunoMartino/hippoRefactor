<?php

namespace App\Http\Controllers\Config;

use App\Models\User;
use App\Models\Plano;
use App\Models\Modulo;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_disabled_account'], ['except' => ['cancelAccount']]);
        $this->middleware(['check_payment'], ['except' => ['confirmPaymentPlan']]);
        $this->middleware(['check_beta_user'], ['except' => ['cancelAccount']]);
    }

    public function currentPlan()
    {
        // $user = User::find(user_princ()->id);
        // $currentPlans = $user->subscription()->plan;
        // $subs = Subscription::where('user_id', user_princ()->id)
        //     ->where('status', 'ativo')
        //     ->get();
        // $subs = Subscription::where('user_id', user_princ()->id)
        //     ->where('status', 'ativo')
        //     ->orderBy('plans.nome', 'asc')
        //     ->get();
        $subs = Subscription::select('subscriptions.*')
            ->join('planos', 'subscriptions.plan_id', '=', 'planos.id')
            ->where('user_id', user_princ()->id)
            ->where('status', 'ativo')
            ->orderBy('planos.id', 'asc')
            ->get();


        return view('pages.config.user_account.current_plan', compact('subs'));
    }

    public function changePlanSetSession(Modulo $modulo)
    {
        authorizePermissions(['edit-config-conta']);
        session()->put('current_module_id', $modulo->id);
        return redirect()->route('config.user-account.change-plan');
    }
    public function changePlanAdquirir(Modulo $modulo)
    {
        authorizePermissions(['edit-config-conta']);
        session()->forget('current_module_id');
        return redirect()->route('config.user-account.change-plan');
    }

    public function changePlan()
    {

        // dd(session('current_module_id'));
        authorizePermissions(['edit-config-conta']);
        $invoice = Invoice::where('user_id', user_princ()->id)
            ->where('type', 'change_plan')
            ->where('status', 'waitingPayment')
            ->where('situation', null)
            ->first();

        // se tiver fatura em aberto, ir para tela
        if ($invoice != null) :
            return redirect()->route('change-plan.invoice');
        endif;

        session()->forget('fatura_gerada');
        $planos = Plano::get();
        return view('pages.config.user_account.change_plan', compact('planos'));
    }

    public function setFreePlan(Plano $plan)
    {

        if (Subscription::where('plan_id', $plan->id)->where('user_id', user_princ()->id)->where('status', 'inativo')->exists())
            abort(403);

        Subscription::where('user_id', user_princ()->id)
            ->whereHas('plan', function ($q) use ($plan) {
                return $q->where('modulo_id', $plan->modulo_id);
            })
            ->update([
                'status' => 'inativo',
                'data_change' => now()
            ]);

        Subscription::create([
            'user_id' => user_princ()->id,
            'plan_id' => $plan->id, // remarketing
            'valor_plano' => $plan->valor,
            'status' => 'ativo'
        ]);

        return redirect()->route('config.user-account.current-plan')->withSuccess('Plano adicionado com sucesso!');
    }

    public function cancelPlan(Plano $plan)
    {
        authorizePermissions(['edit-config-conta']);
        Subscription::where('user_id', user_princ()->id)
            ->where('plan_id', $plan->id)
            ->update([
                'status' => 'inativo',
                'data_change' => now()
            ]);


        $hasActivePlan = Subscription::where('user_id', user_princ()->id)->where('status', 'ativo')->exists();

        if ($hasActivePlan == false) : // alocar usuáio a o plano gratuito caso ele cancele todos os planos pagos
            Subscription::create([
                'user_id' => user_princ()->id,
                'plan_id' => 12, // remarketing
                'valor_plano' => 0,
                'status' => 'ativo'
            ]);
        endif;

        return redirect()->back()->withSuccess('Plano cancelado com sucesso!');
    }

    public function financial()
    {
        $faturas = Invoice::with(['plan.modulo'])
            ->where('user_id', user_princ()->id)
            ->latest()->paginate(10);
        return view('pages.config.user_account.financial.index', compact('faturas'));
    }

    public function showFinancial($invoiceId)
    {
        $fatura = Invoice::where('user_id', user_princ()->id)->where('invoice_id', $invoiceId)->first();
        if (is_null($fatura))
            return redirect()->back()->withWarning('Fatura não encontrada!');

        return view('pages.config.user_account.financial.show', compact('fatura'));
    }

    public function cancelAccount()
    {
        $user = User::find(auth()->user()->id);
        $user->status = 'desativado';
        $user->save();

        Auth::logout();

        /* TODO: cancelar assinatura do cantão se tiver tbm */
        return redirect()->route('home')->withSuccess('Sua conta foi cancelada com sucesso!');
    }
}
