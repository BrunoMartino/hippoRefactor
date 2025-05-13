<?php

namespace App\View\Components\Dashboard\UserMain;

use Closure;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Models\TrackingReport;
use Illuminate\View\Component;
use App\Models\InvoicingReport;
use Illuminate\Contracts\View\View;
use App\Models\RespostasPesquisaSatisfacao;

class MessagesDelivered extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $t1 = MessageReport::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();
        $t2 = BillingsReport::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();
        $t3 = InvoicingReport::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();
        $t4 = TrackingReport::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();
        $t6 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();

        $total = $t1 + $t2 + $t3 + $t4 + $t6;

        // $total =  + RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)->where('situacao', 'entregue')->count();
        return view('components.dashboard.user-main.messages-delivered', compact('total'));
    }
}
