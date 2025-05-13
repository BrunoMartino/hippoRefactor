<?php

namespace App\View\Components\Ajuda;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RefFigura extends Component
{
    public $id;
    public $parens;

    public function __construct($id, $parens = false)
    {
        $this->id = $id;
        $this->parens = $parens;
    }

    public function render()
    {
        return view('components.ajuda.ref-figura', [
            'id' => $this->id,
            'parens' => $this->parens,
        ]);
    }
}
