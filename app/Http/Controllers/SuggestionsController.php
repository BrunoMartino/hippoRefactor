<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suggestion;
use App\Models\Improvement;
use Illuminate\Http\Request;
use App\Http\Requests\SuggestionStoreRequest;
use App\Http\Requests\ImprovementStoreRequest;

class SuggestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {


        // $x= User::find(auth()->user()->id)->roles->where('name', 'super_admin');
        // dd($x->toArray());

        // if (User::find(auth()->user()->id)->hasRole('usuario_sec'))
        //     abort(403);

        $userAuth = User::find(auth()->user()->id);

        $roleName = 'admin';
        if ($userAuth->hasRole('super_admin') || $userAuth->hasRole('admin'))
            $roleName = ['admin', 'super_admin', 'usuario_princ', 'usuario_sec', 'afiliado'];
        if ($userAuth->hasRole('usuario_princ'))
            $roleName = ['usuario_princ'];
        if ($userAuth->hasRole('usuario_sec'))
            $roleName = ['usuario_sec'];
        if ($userAuth->hasRole('afiliado'))
            $roleName = ['afiliado'];

        $improvements = Suggestion::whereHas('user', function ($query) use ($roleName) {
            $query->whereHas('roles', function ($roleQuery) use ($roleName) {
                $roleQuery->whereIn('name', $roleName);
            });
        })
            ->withCount('votes_suggestion')
            ->orderBy('votes_suggestion_count', 'desc')
            ->latest()
            ->paginate(10);
        return view('pages.suggestions.index', compact('improvements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.suggestions.create');
    }

    public function store(SuggestionStoreRequest $request)
    {
        // if (User::find(auth()->user()->id)->hasRole('usuario_sec'))
        //     abort(403);

        $improvement = (new Suggestion)->fill($request->all());
        $improvement->user_id = auth()->user()->id;
        $improvement->save();

        return redirect()->route('sugestoes.index')->withSuccess('O texto foi publicado com sucesso!');
    }

    public function show(Suggestion $sugestao)
    {
        $improvement = $sugestao;
        return view('pages.suggestions.show', compact('improvement'));
    }

    public function edit(Suggestion $sugestao)
    {
        $improvement = $sugestao;
        return view('pages.suggestions.edit', compact('improvement'));
    }

    public function update(SuggestionStoreRequest $request, Suggestion $sugestao)
    {
        if (auth()->user()->id != $sugestao->user_id)
            abort(403);

        $sugestao->text = $request->text;
        $sugestao->save();

        return redirect()->route('sugestoes.index')->withSuccess('Texto editado com sucesso!');
    }

    public function destroy(Suggestion $sugestao)
    {
        /** @disregard */
        if (auth()->user()->id != $sugestao->user_id && !auth()->user()->hasRole('super_admin'))
            abort(403);

        $sugestao->delete();
        return redirect()->route('sugestoes.index')->withSuccess('Melhoria deletada com sucesso!');
    }
}
