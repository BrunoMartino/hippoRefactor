<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index(Request $request)
    {
        authorizePermissions(['ver-permissoes']);

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('usuario_princ')) :
            $users = $this->getAllUsersSec($request);
        else :
            $users = $this->getAllUsers($request);
        endif;
        return view('pages.permissions.index', compact('users'));
    }
    
    /**
     * Usuário para utilizar no select2
     *
     * @return void
     */
    public function usersSelect2()
    {
        
    }

    public function edit(User $user)
    {
        authorizePermissions(['ver-permissoes']);

        // O admin de nível 1 pode retornar todas as permissões, o usuário de nível 2 vê permissões de nível 2 ou superior
        $permissionsGroup = Permission::where('level_id', 'like', "%{$user->nivel_id}%")
            ->get()->groupBy('area');

        return view('pages.permissions.edit', compact('permissionsGroup', 'user'));
    }

    /**
     * Todos os usuários de nível 1 (super_admin, admin)
     *
     * @return void
     */
    public function getAllUsers($request)
    {
        $users = User::where('id', '!=', auth()->user()->id);

        // filtrar nome
        if ($request->has('nome') && $request->nome != '')
            $users->where('nome_usuario', 'like', "%{$request->nome}%");

        // filtrar email
        if ($request->has('email') && $request->email != '')
            $users->where('email', 'like', "%{$request->email}%");

        $userLogged = User::find(auth()->user()->id);
        if ($userLogged->hasRole('admin'))
            $users->where('cadastrado_por', $userLogged->id);

        $users = $users->latest()->paginate(12);

        return $users;
    }

    /**
     * Obter usuários secundarios cadastrados pelo usuário principal
     *
     * @return void
     */
    public function getAllUsersSec($request)
    {
        $users = User::where('id', '!=', auth()->user()->id)
            ->where('nivel_id', 2)
            ->where('cadastrado_por', auth()->user()->id)
            ->latest()
            ->paginate(10);

        return $users;
    }

    public function update(Request $request, User $user)
    {
        authorizePermissions(['edit-permissoes']);

        // Para usuário admin, ele pode editar apenas se usuários foi cadastrado por ele
        $userLogged = User::find(auth()->user()->id);
        if ($userLogged->hasRole('admin') && $user->cadastrado_por != $userLogged->id)
            abort(403);

            

        // usuário principal pode editar apenas a permissões dos usuários q ele cadastrou
        if ($userLogged->hasRole('usuario_princ') && $user->cadastrado_por != $userLogged->id)
            abort(403);

        if ($user->id == auth()->user()->id)
            abort(403);

        // remover todas as permissões
        foreach ($user->getPermissionNames()->toArray() as $value) {
            $user->revokePermissionTo($value);
        }

        // adicionar permissoes selecionadas
        $user->givePermissionTo($request->permissions);
        

        // redir para relat. usuários
        if (session('novo_user')) :
            session()->forget('novo_user');
            return redirect()->route('usuarios')->withSuccess('Permissões atualizadas com sucesso!');
        endif;
        return redirect()->route('usuarios')->withSuccess('Permissões atualizadas com sucesso!');

        // return redirect()->route('permissions.index')->withSuccess('Permissões atualizadas com sucesso!');
    }
}
