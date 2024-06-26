<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Vote;
use App\Models\Comparison;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $itemsTotal = Item::count();
        $comparisonTotal = Comparison::count();
        $votersTotal = Vote::distinct('user_id')->count('user_id'); 
        
        return view('admin.index', compact('itemsTotal', 'comparisonTotal', 'votersTotal'));
    }
}
