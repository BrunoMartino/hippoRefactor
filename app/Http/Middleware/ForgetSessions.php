<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForgetSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('trocar-plano/pagar/cartao') && !$request->is('trocar-plano/pagar/pix')) {
            $request->session()->forget('change_plan_id');
        }

        if (!$request->is('payment/confirm-new-card')) {
            $request->session()->forget('change_card');
        }
        return $next($request);
    }
}
