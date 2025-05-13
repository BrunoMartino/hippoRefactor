<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class VerifyBuyPlanInvoice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) :
            $invoiceProcessing = Invoice::where('user_id', user_princ()->id)
                ->where('type', 'buy_plan')
                ->where('status', 'processing')
                ->where('situation', 'processing')
                ->first();

            if ($invoiceProcessing) :
                return redirect()->route('invoices-processing');
            else :
                $invoiceWaiting = Invoice::where('user_id', user_princ()->id)
                    ->where('type', 'buy_plan')
                    ->where('status', 'waitingPayment')
                    ->where('situation', 'unpaid')
                    ->first();
                if ($invoiceWaiting) :
                    return redirect()->route('buy-plan.invoice.regenerate');
                endif;
            endif;
        endif;

        return $next($request);
    }
}
