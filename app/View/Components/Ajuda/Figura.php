<?php

namespace App\View\Components\Ajuda;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Figura extends Component
{
    public $id;
    public $src;
    public $alt;
    public $caption;

    public function __construct($id, $src, $alt = '', $caption = '')
    {
        $this->id = $id;
        $this->src = $src;
        $this->alt = $alt;
        $this->caption = $caption;
    }

    public function render()
    {
        return view('components.ajuda.figura');
    }
}
