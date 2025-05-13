<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Requests\SystemSettingStoreRequest;
use App\Http\Requests\SystemSettingUpdateRequest;

class SystemSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_disabled_account']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systemSettings = SystemSetting::latest()->paginate(12);
        return view('pages.integrations.system_settings.index', compact('systemSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.integrations.system_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SystemSettingStoreRequest $request)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $systemSetting = (new SystemSetting)->fill($request->all());
        $systemSetting->save();

        return redirect()->back()->withSuccess('Dados salvos com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemSetting $systemSetting)
    {
        return view('pages.integrations.system_settings.show', compact('systemSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemSetting $systemSetting)
    {
        return view('pages.integrations.system_settings.edit', compact('systemSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SystemSettingUpdateRequest $request, SystemSetting $systemSetting)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $systemSetting = $systemSetting->fill($request->all());
        $systemSetting->save();

        return redirect()->back()->withSuccess('Configuração atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemSetting $systemSetting)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $systemSetting->delete();
        return redirect()->back()->withSuccess('Configuração deletada com sucesso!');
    }
}
