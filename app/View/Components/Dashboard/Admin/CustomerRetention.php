<?php

namespace App\View\Components\Dashboard\Admin;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CustomerRetention extends Component
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
        $percent = 20;

        // $initialCustomers -> todos antes do dia 1
        // $endCustomers -> todos antes do dia 1 que continuaram ativos até hj
        // $newCustomers -> todos apartir do dia 1 e ativos

        $initialCustomers = User::role('usuario_princ')
            ->whereDate('created_at', '<', date('Y-m-01'))
            ->whereHas('subscriptionAll')
            ->count();

        $endCustomers = User::role('usuario_princ')
        // ->whereDate('created_at', '<', date('Y-m-01'))
            ->whereHas('subscriptionAll', function ($q) {
                return $q->where('status', 'ativo');
            })->count();

        $newCustomers = User::role('usuario_princ')->whereDate('created_at', '>=', date('Y-m-01'))
            ->whereHas('subscriptionAll', function ($q) {
                return $q->where('status', 'ativo');
            })->count();

        // dd($initialCustomers, $endCustomers, $newCustomers,);

        if ($initialCustomers <= 0) :
            $percent = 0;
        else :
            $percent = (($endCustomers  - $newCustomers) / $initialCustomers) * 100;
        endif;


        return view('components.dashboard.admin.customer-retention', compact('percent'));
    }
}
