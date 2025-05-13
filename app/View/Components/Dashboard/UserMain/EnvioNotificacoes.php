<?php

namespace App\View\Components\Dashboard\UserMain;

use Closure;
use App\Models\MessageReport;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\RespostasPesquisaSatisfacao;

class EnvioNotificacoes extends Component
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
        return view('components.dashboard.user-main.envio-notificacoes');
    }
}
