<?php

namespace App\View\Components\Dashboard\Admin;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Canceled extends Component
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
        $total= User::role('usuario_princ')->where('status', 'desativado')->count();
        return view('components.dashboard.admin.canceled', compact('total'));
    }
}
