<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProfileRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:edit-perfil', 'check_disabled_account']);
    }

    public function profile()
    {
        $usuario = Auth::user();
        $titulo = 'Perfil do Usuário';
        return view('pages.profile.index', compact('titulo', 'usuario'));
    }

    public function saveProfile(SaveProfileRequest $request)
    {
        $usuario = User::find(Auth::id());

        $fotoAtual = $usuario->foto_perfil;

        if ($request->cpf == '' && $request->cnpj == '') :
            $request['cpf'] = $usuario->cpf;
            $request['cnpj'] = $usuario->cnpj;
        endif;

        $usuario->fill($request->all());

        // empedir q nome e email seja modificado
        $usuario->nome_usuario = auth()->user()->nome_usuario;
        $usuario->email = auth()->user()->email;


        if ($request->tipo_usuario == 'PF') :
            $usuario->cnpj = null;
            $usuario->razao_social = null;

            if ($request->cpf == '') :
                $usuario->cpf = auth()->user()->cpf;
            endif;

        endif;
        if ($request->tipo_usuario == 'PJ') :
            $usuario->cpf = null;

            if ($request->cnpj == '' && $request->razao_social == '') :
                $usuario->cnpj = auth()->user()->cnpj;
                $usuario->razao_social = auth()->user()->razao_social;
            endif;

        endif;


        $pathFotoPerfil = null;
        if ($request->hasFile('foto_perfil')) :
            // atualizar foto de perfil
            $pathFotoPerfil = $request->file('foto_perfil')->store('public/perfil');
            $usuario->foto_perfil = Storage::url($pathFotoPerfil);
            // deletar imagem antiga (atual)
            if ($fotoAtual) :
                Storage::delete('public' . explode('/storage', $fotoAtual)[1]);
            endif;
        else :
            // continuar com foto atual de perfil
            $usuario->foto_perfil = $fotoAtual;
        endif;
        $usuario->save();

        Log::info("{$usuario->nome_usuario}({$usuario->id}) atualizou o perfil");

        // // redirecionar se for usuário principal e não tiver feito o pagamento
        // if ($usuario->hasRole('usuario_princ') && $usuario->subscription()->status == 'inativo') :
        //     return redirect()->route('payment-plan');
        // endif;

        if (session()->get('registro')) :
            session()->forget('registro');
            return redirect()->route('dashboard');
        endif;

        return redirect()->back()->withSuccess('Perfil atualizado com sucesso.');
    }
}
