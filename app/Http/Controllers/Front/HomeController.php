<?php

namespace App\Http\Controllers\Front;

use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $this->saveReferralId($request);
    }

    public function index(Request $request)
    {

        //! manutenção
        // return view('pages.auth.maintenance');

        // redirecionar se for link de referência
        if ($request->has('ref'))
            return redirect('http://hipponotify.com.br/');

        if (Auth::check())
            return redirect()->route('dashboard');

        return redirect()->route('login');

        // $planos = Plano::where('id', '!=', 444444)->get(); // id 4 é o id do registro 'Test'
        // $planTest = Plano::where('id', 4)->first();

        // return view('pages.front.index', compact('planos', 'planTest'));
    }

    public function saveReferralId($request)
    {
        if ($request->has('ref') && $request->ref != '') :

            $cookieValue = $request->ref;

            // Calcula o tempo de expiração em Unix timestamp (7 dias a partir de agora)
            $expirationTime = time() + (7 * 24 * 60 * 60); // 7 dias em segundos

            // Define o cookie com o tempo de expiração
            setcookie('ref_id', $cookieValue, $expirationTime);

        endif;
    }
}
