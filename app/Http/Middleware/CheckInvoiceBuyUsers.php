<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Invoice;

class CheckInvoiceBuyUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $invoice = Invoice::where('user_id', user_princ()->id)
        ->where('type', 'buy_user')
        ->where('status', 'waitingPayment')
        ->where('situation', null)
        ->first();

        if (!is_null($invoice)) :
            return redirect()->route('usuarios.invoice');
        endif;

        return $next($request);
    }
}
