<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ItemsComparisonsController extends Controller
{
    public function index()
    {
        return view('admin.comparisons.index');
    }
}
