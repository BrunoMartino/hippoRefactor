<?php

namespace App\View\Components\Dashboard\Admin;

use Closure;
use App\Models\Plano;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ExcessMessages extends Component
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
        $plans = Plano::get();
        return view('components.dashboard.admin.excess-messages', compact('plans'));
    }
}
