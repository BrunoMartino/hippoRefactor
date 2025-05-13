<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;
use App\Http\Requests\IntegrationStoreRequest;
use App\Http\Requests\IntegrationUpdateRequest;

class IntegrationController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_disabled_account']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $integrations= Integration::latest()->paginate(12);
        return view('pages.integrations.index', compact('integrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.integrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntegrationStoreRequest $request)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $integration = (new Integration)->fill($request->all());
        $integration->user_id = user_princ()->id;
        $integration->save();
        return redirect()->back()->withSuccess('Dados da integração salvos com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Integration $integration)
    {
        return view('pages.integrations.show', compact('integration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Integration $integration)
    {
        return view('pages.integrations.edit', compact('integration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IntegrationUpdateRequest $request, Integration $integration)
    {
        /* TODO: inserir regra de negócio/autorizações */

        $integration = $integration->fill($request->all());
        $integration->user_id = user_princ()->id;
        $integration->save();
        return redirect()->back()->withSuccess('Dados da integração salvos com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Integration $integration)
    {
        /* TODO: inserir regra de negócio/autorizações */
        $integration->delete();
        return redirect()->back()->withSuccess('Registro deletado com sucesso!');
    }
}
