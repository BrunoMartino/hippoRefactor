<?php

namespace App\View\Components\Ajuda;

use Illuminate\View\Component;

class LinkFigura extends Component
{
    public static $contador = null;

    public $numero;
    public $format;

    public function __construct($format = false)
    {
        // Pega o valor inicial da sessão ou começa do 1
        if (is_null(self::$contador)) {
            self::$contador = session('figura_base', 1);
        }

        $this->numero = self::$contador;
        $this->format = $format;

        self::$contador++; // incrementa para próxima figura
    }

    public function render()
    {
        return view('components.ajuda.link-figura');
    }
}
