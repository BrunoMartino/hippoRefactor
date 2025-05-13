<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plano;
use App\Models\Affiliate;
use App\Traits\UserTrait;
use App\Traits\EmailTrait;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\UsuariosComprados;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Auth\RegisterController;


class UserController extends Controller
{
    use UserTrait, EmailTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function blockUserFreePlan()
    {
        // Verificar se usuário princ só tem plano gratuito, se sim, não pode visualizar usuáros
        if (
            isset(user_princ()->subscriptionAll) &&
            count(user_princ()->subscriptionAll) > 0 &&
            !user_princ()->subscriptionAll()->where('status', 'ativo')->whereHas('plan', function ($query) {
                $query->where('valor', '>', 0);
            })->exists()
        ) {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        authorizePermissions(['ver-todos-users', 'ver-user-cadast']);
        $this->blockUserFreePlan();

        $showDataAdmin = User::find(auth()->user()->id)->hasAnyRole('super_admin', 'admin');

        // dado para user principal
        $totalUserCadastrei = User::where('cadastrado_por', auth()->user()->id)->count() + 1;
        $totalUserComprado = UsuariosComprados::where('user_id', auth()->user()->id)->sum('qtd_compra');

        $totalUserLimite = $this->totalUsersPlanos() + $totalUserComprado;

        $usuarios = null;
        if ($showDataAdmin) :
            $usuarios = $this->getAllUsers($request);
        else :
            $usuarios = $this->getAllUsersSec($request);
        endif;

        $totalUserComprados = $totalUserComprado;

        return view('pages.users.index', compact('usuarios', 'totalUserCadastrei', 'totalUserLimite', 'totalUserComprados'));
    }

    public function totalUsersPlanos(): int
    {
        $subs = Subscription::select('subscriptions.*')
            ->join('planos', 'subscriptions.plan_id', '=', 'planos.id')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'ativo')
            ->orderBy('planos.id', 'asc')
            ->get();

        $total = 0;
        foreach ($subs as $key => $sub):
            $total += $sub->plan->qtd_usuarios;
        endforeach;

        return $total;
    }

    public function getAllUsers($request): object
    {

        $usuarios = User::with(['cadastradoPor', 'plano', 'nivel'])->where('id', '!=', auth()->user()->id);

        $userLogged = User::find(auth()->user()->id);
        // se usuário logado for 'admin' ele pode ver apenas os admins q ele cadastrou e todos os usuários
        if ($userLogged->hasRole('admin'))
            $usuarios->where('cadastrado_por', $userLogged->id)->orWhere('nivel_id', '!=', 1);

        if (!$userLogged->hasPermissionTo('ver-todos-users'))
            $usuarios->where('cadastrado_por', $userLogged->id);

        // tipo, pf e pj
        if ($request->has('tipo1') && $request->tipo1 != '') :
            $usuarios->where('tipo_usuario', $request->tipo1);
        endif;

        // tipo, pf e pj
        if ($request->has('tipo2') && $request->tipo2 != '') :
            $usuarios->where('tipo_usuario', $request->tipo2);
        endif;
        // cpf_cnpj
        if ($request->has('cpf_cnpj') && $request->cpf_cnpj != '') :
            $usuarios->where('cpf', $request->cpf_cnpj)->orWhere('cnpj', $request->cpf_cnpj);
        endif;

        // razao social
        if ($request->has('rs') && $request->rs != '') :
            $usuarios->where('razao_social', 'like', "%{$request->rs}%");
        endif;

        // nome
        if ($request->has('nome') && $request->nome != '') :
            $usuarios->where('nome_usuario', 'like', "%{$request->nome}%");
        endif;

        // email
        if ($request->has('email') && $request->email != '') :
            $usuarios->where('email', 'like', "%{$request->email}%");
        endif;

        // whatsapp
        if ($request->has('whatsapp') && $request->whatsapp != '') :
            $usuarios->where('whatsapp', 'like', "%" . extrairNumeros($request->whatsapp) . "%");
        endif;

        // uf
        if ($request->has('uf') && $request->uf != '') :
            $usuarios->where('estado', $request->uf);
        endif;

        // cidade
        if ($request->has('cidade') && $request->cidade != '') :
            $usuarios->where('cidade', 'like', "%{$request->cidade}%");
        endif;

        // cadastado por
        if ($request->has('cadp') && $request->cadp != '') :
            $usuarios = $usuarios->whereHas('cadastradoPor', function ($q) use ($request) {
                return $q->where('nome_usuario', 'like', "%{$request->cadp}%");
            });
        endif;


        if ($request->has('plano') && $request->plano != '' && $request->has('modulo') && $request->modulo != ''):
            $usuarios->whereHas('subscriptionAll', function ($q) use ($request) {
                $q->whereHas('plan', function ($query) use ($request) {
                    return $query->where('nome', $request->plano)->where('modulo_id', $request->modulo);
                });
            });
        else:
            // plano
            if ($request->has('plano') && $request->plano != '') :
                $usuarios->whereHas('subscriptionAll', function ($q) use ($request) {
                    $q->whereHas('plan', function ($query) use ($request) {
                        return $query->where('nome', $request->plano);
                    });
                });

            endif;

            // modulo
            if ($request->has('modulo') && $request->modulo != '') :
                $usuarios->whereHas('subscriptionAll', function ($q) use ($request) {
                    $q->whereHas('plan', function ($query) use ($request) {
                        return $query->where('modulo_id', $request->modulo);
                    });
                });
            endif;

        endif;


        $usuarios = $usuarios->latest()->paginate(12);

        return $usuarios;
    }

    /**
     * Todos os usuários secundarios 
     *
     * @return object
     */
    public function getAllUsersSec($request): object
    {
        /* TODO: colocar regra de negociar para obter usuário secundarios com relação ao usuario principal */

        $usuarios = User::with(['cadastradoPor', 'plano', 'nivel'])
            ->where('cadastrado_por', auth()->user()->id)
            ->where('nivel_id', '!=', 1);

        // uf
        if ($request->has('uf') && $request->uf != '') :
            $usuarios->where('estado', $request->uf);
        endif;

        // cidade
        if ($request->has('cidade') && $request->cidade != '') :
            $usuarios->where('cidade', 'like', "%{$request->cidade}%");
        endif;

        // nome
        if ($request->has('nome') && $request->nome != '') :
            $usuarios->where('nome_usuario', 'like', "%{$request->nome}%");
        endif;

        // email
        if ($request->has('email') && $request->email != '') :
            $usuarios->where('email', 'like', "%{$request->email}%");
        endif;

        // whatsapp
        if ($request->has('whatsapp') && $request->whatsapp != '') :
            $usuarios->where('whatsapp', 'like', "%" . extrairNumeros($request->whatsapp) . "%");
        endif;

        $usuarios = $usuarios->latest()->paginate(12);

        return $usuarios;
    }

    public function create()
    {
        authorizePermissions(['cad-user', 'cad-user-secund']);
        $this->blockUserFreePlan();
        $boolUsuariosExcedidos = $this->verifyTotalUsers();

        // $totalUserComprado = UsuariosComprados::where('user_id', auth()->user()->id)->where('situacao', 'pago')->sum('qtd_compra');
        // $totalUserLimite = $this->totalUsersPlanos() + $totalUserComprado;

        $totalUserComprado = UsuariosComprados::where('user_id', auth()->user()->id)->sum('qtd_compra');
        $totalUserLimite = $this->totalUsersPlanos() + $totalUserComprado;

        return view('pages.users.create', compact('boolUsuariosExcedidos', 'totalUserLimite'));
    }

    /**
     * Verificar total de usuários pode cadastro pelo plano
     *
     * @return bool
     */
    public function verifyTotalUsers(): bool
    {
        $authUser = User::find(auth()->user()->id);

        if ($authUser->hasRole('usuario_princ')) :
            $totalUserComprado = UsuariosComprados::where('user_id', auth()->user()->id)->sum('qtd_compra');

            $qtdPermitidos = $this->totalUsersPlanos() - 1 + $totalUserComprado;
            $totalUsers = User::where('cadastrado_por', $authUser->id)->count();
            if ($totalUsers >= $qtdPermitidos) :
                return true;
            endif;
        endif;
        return false;
    }

    public function store(UserStoreRequest $request)
    {

        if (Auth::user()->nivel_id == 1) {
            /* Verificar se o cadastro é com email já deletado */
            $userEmailDeletado = User::onlyTrashed()->where('email', $request->email)->first();
            if ($userEmailDeletado):
                return redirect()->back()->with('usuario_deletado', $userEmailDeletado)->withInput();
            else:
                $request->validate(["email" => ['required', 'string', 'email', 'max:255', 'unique:users'],]);
            endif;

            /* Verificar se o cadastro é com whatsapp já deletado */
            $useWhatsappDeletado = User::onlyTrashed()
                ->where('whatsapp', $request->whatsapp)->first();
            if ($useWhatsappDeletado):
                $useWhatsappDeletado->whatsapp = null;
                $useWhatsappDeletado->save();
            endif;
            $request->validate(["whatsapp" => ['required', 'unique:users,whatsapp', 'max:255'],]);
        }

        if (Auth::user()->nivel_id == 2) {
            /* Verificar se o cadastro é com email já deletado */
            $userEmailDeletado = User::onlyTrashed()
                ->where('email', $request->email)
                ->where('cadastrado_por', auth()->user()->id)->first();
            if ($userEmailDeletado):
                return redirect()->back()->with('usuario_deletado', $userEmailDeletado)->withInput();
            else:
                $request->validate(["email" => ['required', 'string', 'email', 'max:255', 'unique:users'],]);
            endif;

            /* Verificar se o cadastro é com whatsapp já deletado */
            $useWhatsappDeletado = User::onlyTrashed()
                ->where('whatsapp', $request->whatsapp)
                ->where('cadastrado_por', auth()->user()->id)->first();
            if ($useWhatsappDeletado):
                $useWhatsappDeletado->whatsapp = null;
                $useWhatsappDeletado->save();
            endif;
            $request->validate(["whatsapp" => ['required', 'unique:users,whatsapp', 'max:255'],]);
        }




        /*  */
        authorizePermissions(['cad-user', 'cad-user-secund']);
        $this->blockUserFreePlan();

        if ($this->verifyTotalUsers()) :
            return redirect()->back()->withError('Você não pode cadastrar mais usuários, faça um upgrade no seu plano!');
        endif;

        // 
        $authUser = User::find(auth()->user()->id);

        // 
        $senha = Str::random(8);
        $dados_usuario = $request->all();
        $dados_usuario['cadastrado_por'] = Auth::id();
        $dados_usuario['nivel_id'] = Auth::user()->nivel_id;
        $dados_usuario['password'] = bcrypt($senha);

        $pathFotoPerfil = null;
        if ($request->hasFile('foto_perfil')) :
            $pathFotoPerfil = $request->file('foto_perfil')->store('public/perfil');
            $dados_usuario['foto_perfil'] = Storage::url($pathFotoPerfil);
        endif;

        $usuario = User::create($dados_usuario);
        // adiciionar role/permission ao usuário
        if (Auth::user()->nivel_id == 1) {
            $usuario->assignRole('admin');
        }
        if (Auth::user()->nivel_id == 2) {
            $usuario->assignRole('usuario_sec');
        }
        $usuario->givePermissionTo('edit-perfil');


        Log::info("{$authUser->nome_usuario}({$authUser->id})  cadastrou {$usuario->nome_usuario}({$usuario->id}) como {$usuario->nivel->nome}");

        // $this->enviarEmailCadastro($dados_usuario);

        // enviar credenciais de acesso por email
        (new RegisterController)->sendAccessData($usuario, $senha);

        if ($authUser->hasPermissionTo('edit-permissoes')) :
            session()->put('novo_user', true);
            return redirect()
                ->route('permissions.edit', $usuario->id)
                ->withSuccess('Usuário cadastrado com sucesso.');
        else :
            return redirect()
                ->route('usuarios', $usuario->id)
                ->withSuccess('Usuário cadastrado com sucesso.');
        endif;
    }

    public function restoreUserDeleted($id)
    {

        if (Auth::user()->nivel_id == 1) {
            $userEmailDeletado = User::onlyTrashed()
                ->where('id', $id)
                ->first();
        }
        if (Auth::user()->nivel_id == 2) {
            $userEmailDeletado = User::onlyTrashed()
                ->where('cadastrado_por', auth()->user()->id)
                ->where('id', $id)
                ->first();
        }


        $userEmailDeletado->restore();
        $userEmailDeletado->status = 'ativo';
        $userEmailDeletado->cadastrado_por = auth()->user()->id;
        $senha = Str::random(8);
        $userEmailDeletado->password = bcrypt($senha);
        $userEmailDeletado->save();

        (new RegisterController)->sendAccessData($userEmailDeletado, $senha);

        return redirect()
            ->route('usuario.editar', ['id' => $userEmailDeletado->id])
            ->withSuccess('Usuário restaurado com sucesso. Agora você pode editar seus dados e permissões.');
    }

    public function show(User $user)
    {
        authorizePermissions(['ver-todos-users', 'ver-user-cadast']);

        return view('pages.users.show', compact('user'));
    }

    public function edit(int $id)
    {
        authorizePermissions(['edit-user']);
        $this->blockUserFreePlan();
        $titulo = 'Editar Usuário';
        $usuario = User::find($id);

        //? CONFIGURAR PERMISSOES

        /* TODO: rever a regra de negócio desse if() abaixo */

        $this->blockEditUser($usuario);

        return view('pages.users.edit', compact('titulo', 'usuario'));
    }

    public function blockEditUser($userEdit)
    {
        $userLogged = User::find(auth()->user()->id);

        // bloquear editar super admin
        if ($userEdit->hasRole('super_admin'))
            abort(403);

        // impedir que usuario admin edite outros usuários admin q ele não tenha cadastrado
        if ($userLogged->hasRole('admin'))
            if ($userLogged->id != $userEdit->cadastrado_por && $userEdit->hasRole('admin'))
                abort(403);

        // impedir que usuario princ. edite outros usuários q ele não tenha cadastrado
        if ($userLogged->hasRole('usuario_princ'))
            if ($userLogged->id != $userEdit->cadastrado_por)
                abort(403);
    }

    public function update(UserUpdateRequest $request, User $usuario)
    {
        authorizePermissions(['edit-user']);
        $this->blockUserFreePlan();
        $fotoAtual = $usuario->foto_perfil;
        $usuario->fill($request->all());

        $this->blockEditUser($usuario);

        $pathFotoPerfil = null;
        if ($request->hasFile('foto_perfil')) :
            $pathFotoPerfil = $request->file('foto_perfil')->store('public/perfil');
            $usuario->foto_perfil = Storage::url($pathFotoPerfil);
            if ($fotoAtual) :
                Storage::delete('public' . explode('/storage', $fotoAtual)[1]);
            endif;
        else :
            $usuario->foto_perfil = $fotoAtual;
        endif;
        $usuario->save();

        $authUser = auth()->user();
        Log::info("{$authUser->nome_usuario}({$authUser->id}) atualizou os dados de {$usuario->nome_usuario}({$usuario->id})");

        return redirect()->back()->withSuccess('Usuário editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        authorizePermissions(['deletar-user']);
        $this->blockUserFreePlan();

        $this->blockEditUser($usuario);

        /* TODO: adicionar regra de negócio para deleter usuário */
        $usuario->status = 'desativado';
        $usuario->save();
        $dataUsuario = $usuario;
        if ($usuario->delete()) {
            $authUser = auth()->user();
            Log::info("{$authUser->nome_usuario}({$authUser->id}) deletou o usuário {$dataUsuario->nome_usuario}({$dataUsuario->id})");

            //2: usuários normais. remover todos os usuários cadastrado pelo usuário princ
            if ($dataUsuario->nivel_id == 2) :
                User::where('cadastrado_por', $dataUsuario->id)->delete();
            else : //1: admins. retirar relação de todos os usuários cadastado por esse admin q está sendo deletado
                User::where('cadastrado_por', $dataUsuario->id)->update([
                    'cadastrado_por' => null
                ]);
            endif;
            // remover dados de afiliado se tiver
            Affiliate::where('user_id', $dataUsuario->id)->delete();
        }

        return redirect()->route('usuarios')->withSuccess('Usuário removido com sucesso.');
    }
}
