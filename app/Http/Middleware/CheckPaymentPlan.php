<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !user_princ()->beta_user) :
            $user = User::find(user_princ()->id);
            /* Verificar se o status da inscrição está ativo para usuário princ. e se o plano é gratuito */

            $hasActiveSubs = Subscription::where('user_id', $user->id)
                ->whereHas('plan', function ($q) {
                    return $q->where('valor', '>', 0); // plano não gratuito
                })
                ->where('status', 'ativo')
                ->exists();

            $hasFreePlan = Subscription::where('user_id', $user->id)
                ->whereHas('plan', function ($q) {
                    return $q->where('valor', '<=', 0); // é plano gratuito
                })
                ->where('status', 'ativo')
                ->exists();

            // Usuário princ - se não tem plano pago e nem gratuito
            if ($user->hasRole('usuario_princ') && $hasFreePlan == false && $hasActiveSubs == false) :
                // if ($request->route()->getName() !== 'payment-plan' && $request->route()->getName() !== 'config.user-account.change-plan'):
                if (!Route::is("payment*") && !Route::is("config.user-account*")):

                    // se user for sec
                    if (User::find(auth()->user()->id)->hasRole('usuario_sec')):
                        Auth::logout();
                        return redirect()->route('login')->withError('Não há nenhum plano ativo. Entre em contato com o usuário principal para que ele possa contratar um plano.');
                    else:

                        $listPlansInactive = Subscription::where('user_id', $user->id)->where('status', 'inativo');
                        if ($listPlansInactive->count() == 1): // Se tiver apenas 1 plano inativo, redirecionar para pagar
                            // return redirect()->route('payment.change-plan', $listPlansInactive->first()->plan->id);
                            return redirect()->route('payment-plan');
                        endif;

                        // redirecionar para selecionar plano
                        return redirect()->route('config.user-account.change-plan');
                    endif;
                endif;
            endif;

            // se tem plano pago, verificar se tá expirado
            if ($user->hasRole('usuario_princ') && $hasFreePlan == false && $hasActiveSubs == true) :

                $subPaidPlans = Subscription::where('user_id', $user->id)
                    ->where('status', 'ativo')
                    ->whereHas('plan', function ($q) {
                        return $q->where('valor', '>', 0);
                    })->get();

                $existPlanoPagoAtivoNaoExpirado = false;
                foreach ($subPaidPlans as $sub):
                    // verificar se tem algum plano não expirado, ai não bloqueia o acesso
                    if ($sub->expiration_date_paid_plan != null && $sub->days_expire_paid_plan != 'Expirado'):
                        $existPlanoPagoAtivoNaoExpirado = true;
                        break;
                    endif;
                endforeach;

                // se todos os planos pagos tiver sido expirado
                if ($existPlanoPagoAtivoNaoExpirado == false):
                    if (!Route::is("payment*") && !Route::is("config.user-account*")):

                        if (User::find(auth()->user()->id)->hasRole('usuario_sec')):
                            Auth::logout();
                            return redirect()->route('login')->withError('Não há nenhum plano ativo. Entre em contato com o usuário principal para que ele possa contratar um plano.');
                        else:
                            return redirect()->route('payment-plan');
                        endif;

                    endif;
                endif;
            endif;
        endif;

        return $next($request);
    }
}
