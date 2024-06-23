<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function index()
    {
        $comparisons = Comparison::all();

        return view('comparisons.index', compact('comparisons'));
    }
}
