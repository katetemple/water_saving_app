<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HouseholdController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('households', HouseholdController::class);

    // route for the View Usage page with authentication middleware
    Route::get('/view-usage', [HouseholdController::class, 'viewUsage'])->name('view.usage')->middleware('auth');
});

require __DIR__.'/auth.php';
