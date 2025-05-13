<?php

namespace App\View\Components\Ajuda;

use Illuminate\View\Component;

class Figure extends Component
{
    public static $contador = null;

    public $src;
    public $descricao;
    public $numero;

    public function __construct($src, $descricao)
    {
        // Inicia contador se for a primeira vez
        if (is_null(self::$contador)) {
            self::$contador = session('figura_base', 1); // valor inicial da sessão ou 1
        }

        $this->src = $src;
        $this->descricao = $descricao;
        $this->numero = self::$contador;

        self::$contador++;
    }

    public function render()
    {
        return view('components.ajuda.figure');
    }
}
