<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Comparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comparison_id' => 'required:exists:comparisons,id',
            'item_id' => 'required:exists:items,id',
        ]);

        $comparison = Comparison::find($request->comparison_id);

        if ($comparison) {

            // Verificar si el usuario ya ha votado en esta comparación
            $existingVote = Vote::where('comparison_id', $request->comparison_id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingVote) {
                return back()->with('info', 'Ya has votado en esta comparación.');
            }

            Vote::create([
                'comparison_id' => $request->comparison_id,
                'user_id' => Auth::id(),
                'item_id' => $request->item_id,
            ]);

            $comparison->updateVotes();

            return back()->with('success', 'Tu voto ha sido registrado');
        }

        return back()->with('error', 'Error al registrar al voto');
    }
}
