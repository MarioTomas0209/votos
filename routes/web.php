<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\ComparisonController;

Route::get('/', [ComparisonController::class, 'index'])->name('home');
Route::post('/vote', [VoteController::class, 'store'])->middleware('auth')->name('vote.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [HomeController::class, 'index'])->name('admin.index');
});
Route::resource('items', ItemController::class)->names('admin.items');
