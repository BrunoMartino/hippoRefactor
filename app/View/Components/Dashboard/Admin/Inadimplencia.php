<?php

namespace App\View\Components\Dashboard\Admin;

use App\Models\Invoice;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Inadimplencia extends Component
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
        $total= Invoice::where('status', 'overdue')->sum('total_value');
        return view('components.dashboard.admin.inadimplencia', compact('total'));
    }
}
