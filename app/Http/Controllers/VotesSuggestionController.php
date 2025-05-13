<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Models\VotesSuggestion;

class VotesSuggestionController extends Controller
{
    public function setVote(Suggestion $suggestion)
    {
        if (VotesSuggestion::where('user_id', user_princ()->id)->where('suggestion_id', $suggestion->id)->exists()):
            return redirect()->back()->withWarning('Você já votou nessa sugestão.');
        endif;

        if ($suggestion->user_id == user_princ()->id)
            abort(403);

        VotesSuggestion::create([
            'user_id' => user_princ()->id,
            'suggestion_id' => $suggestion->id
        ]);

        return redirect()->back()->withSuccess('Voto enviado com sucesso.');
    }

    public function removeVote(Suggestion $suggestion)
    {
        VotesSuggestion::where('user_id', user_princ()->id)
            ->where('suggestion_id', $suggestion->id)
            ->delete();

        return redirect()->back()->withSuccess('Voto removido com sucesso.');
    }
}
