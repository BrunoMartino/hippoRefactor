<?php

namespace App\Http\Controllers\Config\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemRemarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index(Request $request)
    {
        abortAccessForModule(3);
        authorizePermissions(['ver-modulo-remarketing']);
        session()->forget('modulo_id_para_redirect');
        $getConfigModuleExist = SystemController::getConfigModuleExist2();
        return view('pages.config.system.remarketing.index', compact('getConfigModuleExist'));
    }
}
