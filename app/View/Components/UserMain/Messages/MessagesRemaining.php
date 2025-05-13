<?php

namespace App\View\Components\UserMain\Messages;

use Closure;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MessagesRemaining extends Component
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
        $totalMessagesRemaining = $this->totalMessagesRemaining();
        $total = $totalMessagesRemaining;
        return view('components.user-main.messages.messages-remaining', compact('total'));
    }

    public function totalMessagesRemaining(): int
    {
        $userPrinc = User::find(user_princ()->id);
        if ($userPrinc) :

            /* total limit remarketing */
            $limiteRemarketing = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 3);
                })
                ->first();
            if ($limiteRemarketing) :
                $limiteRemarketing = $limiteRemarketing->plan->limite_mensagens;
            else :
                $limiteRemarketing = 0;
            endif;

            /* total limit cobranças */
            $limiteCobranca = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 1);
                })
                ->first();
            if ($limiteCobranca) :
                $limiteCobranca = $limiteCobranca->plan->limite_mensagens;
            else :
                $limiteCobranca = 0;
            endif;

            /* total limit faturamento */
            $limiteFaturamento = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 2);
                })
                ->first();
            if ($limiteFaturamento) :
                $limiteFaturamento = $limiteFaturamento->plan->limite_mensagens;
            else :
                $limiteFaturamento = 0;
            endif;

            /* total limit rastreamento */
            $limiteRastreamento = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 4);
                })
                ->first();
            if ($limiteRastreamento) :
                $limiteRastreamento = $limiteRastreamento->plan->limite_mensagens;
            else :
                $limiteRastreamento = 0;
            endif;

            // soma total limites
            $totalLimite = $limiteRemarketing + $limiteCobranca + $limiteFaturamento + $limiteRastreamento;

            $totalRemaining = ($totalLimite - (new MessagesSent)->totalMessagesSent());
        else :
            $totalRemaining = 0;
        endif;

        return $totalRemaining;
    }
}
