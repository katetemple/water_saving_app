<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\WaterUsageController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LeaderboardInvitationController;
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
    Route::get('/view-usage', [WaterUsageController::class, 'viewUsage'])->name('view.usage');

    Route::get('/leaderboards', [LeaderboardController::class, 'index'])->name('leaderboards.index');
    Route::get('/leaderboards/create', [LeaderboardController::class, 'create'])->name('leaderboards.create');
    Route::post('/leaderboards', [LeaderboardController::class, 'store'])->name('leaderboards.store');

    Route::get('/notifications', [LeaderboardInvitationController::class, 'index'])->name('leaderboard-invitations.index');
    Route::get('/leaderboards/{leaderboard}/invite', [LeaderboardInvitationController::class, 'create'])->middleware('auth')->name('invites.create');
    Route::post('/leaderboards/{leaderboard}/invite', [LeaderboardInvitationController::class, 'inviteUser'])->middleware('auth')->name('leaderboards.invite');
    Route::post('/notifications/respond/{id}', [LeaderboardInvitationController::class, 'respond'])->name('leaderboard-invitations.respond');
});

require __DIR__.'/auth.php';
