<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',  ['except' => ['logout', 'changePasswordFromProfilePage']]);
    }

    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            session()->regenerate();
            $authUser = auth()->user();
            Log::info("Login de {$authUser->nome_usuario}({$authUser->id})");
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records',
            ])->onlyInput('email');
        }
    }

    public function logout()
    {
        $this->logoutExec();
        return redirect()->route('login');
    }

    public function changePasswordFromProfilePage()
    {
        $this->logoutExec();
        return redirect()->route('recuperar.form');
    }

    public function logoutExec()
    {
        if (Auth::check()) :
            $authUser = auth()->user();
            Log::info("Logout de {$authUser->nome_usuario}({$authUser->id})");
            Auth::logout();
        endif;

        session()->flush();
        session()->regenerate();

        return true;
    }
}
