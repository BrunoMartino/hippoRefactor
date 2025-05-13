<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\UserTrait;
use App\Traits\EmailTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    use UserTrait, EmailTrait;

    public function formEmail()
    {
        return view('pages.auth.recover_password');
    }

    public function sendResetToken(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (!User::where('email', $request->email)->exists()) {
            return back()
                ->withErrors(['error' => 'E-mail não encontrado, verifique o endereço de e-mail.'])
                ->withInput();
        }

        $token = $this->gerarToken(45, 15, '.');

        $usuario = User::where('email', $request->email)->first();
        if ($usuario) {
            $usuario->makeHidden('password');
            $usuario->reset_token = $token;
            $usuario->save();

            $url = $this->gerarUrl($request->email, $usuario->reset_token);

            $dados = [
                'email' => $request->email,
                // 'email' => 'hipponotify.teste@gmail.com',
                'url' => $url,
                'nome' => $usuario->nome_usuario
            ];

            $statusSend = $this->enviarEmailResetarSenha($dados);

            if (!$statusSend)
                return back()
                    ->withError('Houve um erro ao enviar o e-mail, por favor, tente novamente mais tarde.')
                    ->withInput();

            Log::info("{$usuario->nome_usuario}({$usuario->id}) enviou solicitação para resetar senha");
        } else {
            return back()
                ->withErrors(['error' => 'Houve um erro ao identificar o e-mail, favor confira o e-mail informado.'])
                ->withInput();
        }

        return redirect()->route('login')->withSuccess('Acesso seu email e clique no link para redefinir senha!');
    }

    public function formNewPassword()
    {
        $dados = request('token');
        return view('pages.auth.new_password', compact('dados'));
    }

    public function saveNewPassword(Request $request, $dados)
    {
        if ($request->password == $request->confirm_password) {
            $dados_agrup = base64_decode($dados);
            $dados = explode("===", $dados_agrup);
            $email = $dados[0];
            $token = $dados[1];

            $usuario = User::where('email', $email)->first();
            $usuario->makeHidden('password');

            if ($token === $usuario['reset_token']) {
                $usuario->password = $request->password;
                $usuario->save();

                Log::info("{$usuario->nome_usuario}({$usuario->id}) modificou a senha");

                return redirect()->route('login')->withSuccess('Sua senha foi redefinida com sucesso!"');
            } else {
                return back()
                    ->withErrors(['error' => 'Houve um erro ao salvar a nova senha, favor solicitar novamente.']);
            }
        } else {
            return back()
                ->withErrors(['error' => 'As senhas não conferem, favor digitar novamente.']);
        }
    }
}
