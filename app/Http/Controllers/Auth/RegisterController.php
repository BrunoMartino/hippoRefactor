<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Plano;
use App\Models\Affiliate;
use App\Traits\UserTrait;
use App\Traits\EmailTrait;
use App\Models\FreePlanUser;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\AccessDataLogin;
use App\Models\AffiliateReferral;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RegisterStoreRequest;
use App\Http\Requests\RegisterSavePlanRequest;

class RegisterController extends Controller
{
    use UserTrait, EmailTrait;

    public function choosePlan()
    {
        $planos = Plano::where('id', '!=', 4)->get(); // id 4 é o id do registro 'Test'
        $planTest = Plano::where('id', 4)->first();

        return view('pages.auth.choose_plan', compact('planos', 'planTest'));
    }

    public function savePlan($plano_id)
    {

        if (is_null(Plano::find($plano_id))):
            return redirect()->route('home')->withError('Plano não encontrado.');
        endif;

        // session(['plano_id' => $request->plano_id]);
        session(['plano_id' => $plano_id]);
        return redirect()->route('usuario.registro');
    }

    public function register()
    {
        if (empty(session('plano_id'))) {
            $url = URL::route('home') . '#planos';
            return redirect($url)->withErrors(['error' => 'Não existe plano selecionado, escolha um por favor.']);
        }

        return view('pages.auth.register');
    }

    public function saveRegister(RegisterStoreRequest $request)
    {
        if (session('plano_id') and !empty(session('plano_id'))) {
            $dados_usuario = $request->all();

            if ($dados_usuario['password'] == $dados_usuario['conf_password']) {
                $digitos = $this->gerarDigitos();
                $digitos_confirmacao = Hash::make($digitos);

                $dados_usuario['nivel_id'] = 2;
                $dados_usuario['plano_id'] = session('plano_id');
                $dados_usuario['tipo_usuario'] = null;

                $usuario = User::create($dados_usuario);
                if ($usuario) {

                    Log::info("{$usuario->nome_usuario}({$usuario->id}) registrou-se no sistema");

                    $plano = Plano::find(session('plano_id'));
                    // adicionar role e permissões
                    $usuario->assignRole(['usuario_princ']);
                    $usuario->givePermissionTo(Permission::where('level_id', 'like', "%2%")->get());

                    // adicionar inscrição do usuário no plano
                    Subscription::create([
                        'user_id' => $usuario->id,
                        'plan_id' => $plano->id,
                        'status' => in_array($plano->id, [4, 8, 12, 16]) ? 'ativo' : 'inativo', // planos gratuitos ou especiais
                    ]);

                    // associar afiliado se tiver
                    $this->associateAffiliate($usuario, $plano, $request);

                    // criar session com informações usuário
                    session([
                        'usuario' => [
                            'id' => $usuario->id,
                            'nome_usuario' => $usuario->nome_usuario,
                            'email' => $usuario->email,
                            'digitos_confirmacao' => $digitos_confirmacao,
                            'digitos' => $digitos,
                            'senha' => $request->password
                        ]
                    ]);
                    session()->forget('plano_id');

                    /* TODO: */
                    $this->enviarEmailConfirmacao($usuario->email, $digitos);
                    // $this->enviarEmailConfirmacao('hipponotify.teste@gmail.com', $digitos);

                    return redirect()->route('confirmacao');
                } else {
                    return back()
                        ->withErrors(['error' => 'Confira os dados, algum erro ocorreu ao cadastrar.'])
                        ->withInput();
                }
            } else {
                return back()
                    ->withErrors(['error' => 'As senhas não conferem, digite novamente.'])
                    ->withInput();
            }
        } else {

            $url = URL::route('home') . '#planos';
            return redirect($url)->withErrors(['error' => 'Não existe plano selecionado, escolha um por favor.']);
        }
    }

    public function resendConfirmEmail()
    {
        if (!isset(session('usuario')['email']) || !isset(session('usuario')['digitos']))
            return redirect()->route('usuario.registro');

        $email = session('usuario')['email'];
        $digits = session('usuario')['digitos'];
        $this->enviarEmailConfirmacao($email, $digits);
        // $this->enviarEmailConfirmacao('hipponotify.teste@gmail.com', $digits);

        return redirect()->back();
    }

    public function associateAffiliate($user, $plano, $request)
    {
        if (isset($_COOKIE['ref_id'])) :

            $cookieValue = $_COOKIE['ref_id'];

            $affiliate = Affiliate::where('ref_id', $cookieValue)->first();
            if ($affiliate) :
                $this->createAffilateRef($user, $affiliate, $plano);
                Log::info("Usuário {$user->nome_usuario} #{$user->id} cadastrado com código de afiliado #" . $cookieValue);
                $this->deleteCookieAffiliate();
            endif;
        endif;
    }

    public function createAffilateRef($user, $affiliate, $plano)
    {
        AffiliateReferral::create([
            'user_id' => $user->id,
            'affiliate_id' => $affiliate->id,
            'contract_date' => date('Y-m-d'), // adcionar data de contrato quando é feito o pagamento
            'commission' => ($affiliate->comission * $plano->valor) / 100, // obter a porcentagem do afiliado do valor do plano
        ]);
    }

    public function deleteCookieAffiliate()
    {
        if (isset($_COOKIE['ref_id'])) {
            // Define o cookie com tempo de expiração no passado (para excluí-lo)
            setcookie('ref_id', '', time() - 3600);
            // Remove o cookie da variável $_COOKIE
            unset($_COOKIE['ref_id']);
            return true;
        } else {
            return false;
        }
    }

    public function formConfirmationDigits()
    {
        return view('pages.auth.confirm');
    }

    public function checkDigits(Request $request)
    {
        $digitos_recebidos = implode('', $request->digitos);
        $digitos_confirmacao = session('usuario')['digitos_confirmacao'];

        if (Hash::check($digitos_recebidos, $digitos_confirmacao)) {

            Auth::loginUsingId(session('usuario')['id']);

            // enviar usuario e senha por email
            $user = Auth::user();
            $pass = session('usuario')['senha'];
            $this->sendAccessData($user, $pass);

            session()->forget('usuario');
            session()->put('registro', true);

            return redirect()->route('profile.index');
        } else {
            return back()->withErrors(['error' => 'Os dígitos não conferem, favor digitar novamente.']);
        }
    }

    public function sendAccessData($user, $pass)
    {

        try {
            Mail::to($user)->send(new AccessDataLogin($user, $pass));
        } catch (\Throwable $th) {
            Log::error('Erro ao enviar email com dados de acesso: ' . $th->getMessage(), [
                'exception' => $th
            ]);
        }
        // Mail::to('hipponotify.teste@gmail.com')->send(new AccessDataLogin($user, $pass));
    }
}
