<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\Admin\ItemsComparisonsController;
use App\Http\Controllers\Admin\VotesShowController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ComparisonController::class, 'index'])->name('home');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
});

Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('admin', [HomeController::class, 'index'])->name('admin.index');
    Route::resource('items', ItemController::class)->names('admin.items');
    Route::resource('comparison', ItemsComparisonsController::class)->names('admin.comparisons');
    Route::resource('votes', VotesShowController::class)->names('admin.votes');
});
