<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuggestionAnswer;
use App\Http\Requests\SuggestionsAnswerStoreRequest;

class SuggestionsAnswerController extends Controller
{
    public function store(SuggestionsAnswerStoreRequest $request)
    {
        if (User::find(auth()->user()->id)->hasRole('usuario_sec'))
            abort(403);

        $improvementAnswer = (new SuggestionAnswer)->fill($request->all());
        $improvementAnswer->user_id = auth()->user()->id;
        $improvementAnswer->save();

        return redirect()->back()->withSuccess('Comentário adicionado com sucesso!');
    }

    public function destroy(SuggestionAnswer $suggestionAnswer)
    {

        if (auth()->user()->id != $suggestionAnswer->user_id)
            abort(403);

        $suggestionAnswer->delete();
        return redirect()->back()->withSuccess('Comentário removido com sucesso!');
    }
}
