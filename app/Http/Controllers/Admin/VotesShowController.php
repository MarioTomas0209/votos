<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Vote;
use App\Models\Comparison;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Http\Controllers\Controller;

class VotesShowController extends Controller
{

    public function index()
    {
        $votes = Vote::with('user', 'item')->orderBy('id', 'desc')->paginate(10);

        $usersWhoVoted = User::whereIn('id', $votes->pluck('user_id'))->paginate(10, ['*'], 'voted_page');
        $usersWhoDidNotVote = User::whereNotIn('id', $votes->pluck('user_id'))->paginate(10, ['*'], 'not_voted_page');

        // Obtener comparaciones
        $comparisons = Comparison::with(['item1', 'item2'])->get();

        return view('admin.votes.index', compact('votes', 'usersWhoVoted', 'usersWhoDidNotVote', 'comparisons'));
    }
}
