<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Invoice;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CheckInvoiceProcessing
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $excludedRouteNames = [
            'change-plan.invoice.regenerate',
            'buy-plan.invoice.regenerate',
            'buy-users.invoice.regenerate',
        ];
        
        if (in_array($request->route()->getName(), $excludedRouteNames)) {
            return $next($request);
        }

        if (Auth::check()) :
            $currentTime = Carbon::now();

            if (!Session::has('last_invoices_check') || $currentTime->diffInMinutes(Session::get('last_invoice_check')) >= 30) :    
                Session::put('last_invoices_check', $currentTime);

                $invoices = Invoice::where('user_id', user_princ()->id)
                    ->where('status', 'processing')
                    ->get();

                if ($invoices) :
                    foreach ($invoices as $invoice) :
                        $processingResult = $this->executeFunctionBasedOnType($invoice);
                        if ($processingResult instanceof \Illuminate\Http\RedirectResponse) :
                            return $processingResult;
                        endif;
                        if ($processingResult === true) :
                            return $next($request);
                        endif;
                    endforeach;
                endif;
            endif;
        endif;

        return $next($request);
    }

    protected function executeFunctionBasedOnType($invoice)
    {
        switch ($invoice->type) {
            case 'change_plan':
                return $this->paymentService->processingChangePlanPayment($invoice->invoice_id);
            case 'buy_plan':
                return $this->paymentService->processingPlanPayment($invoice->invoice_id);
            case 'buy_users':
                return $this->paymentService->processingUsersPayment($invoice->invoice_id);
            default:
                return false;
        }
    }
}
