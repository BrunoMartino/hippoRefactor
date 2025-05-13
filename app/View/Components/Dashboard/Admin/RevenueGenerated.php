<?php

namespace App\View\Components\Dashboard\Admin;

use Closure;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class RevenueGenerated extends Component
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
        $users= User::role('usuario_princ')->get();
        return view('components.dashboard.admin.revenue-generated', compact('users'));
    }
}
