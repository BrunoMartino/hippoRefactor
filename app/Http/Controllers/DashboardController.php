<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {
        $usuariosRemarketing = [];
        $usuariosCobrancas = [];
        $usuariosFaturamento = [];
        $usuariosRastreamento = [];

        $showDataAdmin = User::find(user_princ()->id)->hasAnyRole('super_admin', 'admin');
        if ($showDataAdmin) {
            $cont = new ChartAdmController;
            $usuariosRemarketing = $cont->usuariosRemarketing();
            $usuariosCobrancas = $cont->usuariosCobrancas();
            $usuariosFaturamento = $cont->usuariosFaturamento();
            $usuariosRastreamento = $cont->usuariosRastreamento();
        }
        $titulo = 'Dashboard';

        return view('pages.home.dashboard', compact(
            'titulo',
            'usuariosRemarketing',
            'usuariosCobrancas',
            'usuariosFaturamento',
            'usuariosRastreamento'
        ));
    }
}
