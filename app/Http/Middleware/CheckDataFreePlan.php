<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Checar se usuário tem o plano gratuito e se preencheu os dados
 */
class CheckDataFreePlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = User::find(user_princ()->id);
        if ($user->hasRole('usuario_princ')) :


            // Obter planos grátuitos ativos
            $allPlans = $user->subscriptionAll()
                ->where('status', 'ativo')
                ->whereHas('plan', function ($query) {
                    return $query->where('valor', '<=', 0);
                });


            // desativar plano gratuito se tiver expirado
            foreach ($allPlans->get() as $key => $value) {
                if ($value->days_expire == 'Expirado') {
                    $value->status = 'inativo';
                    $value->save();
                }
            }

        endif;

        return $next($request);
    }
}
