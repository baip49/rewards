<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RewardController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('progress', 'progress')->name('progress');
    Route::get('/rewards', [RewardController::class, 'showRewards'])->name('rewards.user');
    Route::post('/rewards/redeem/{reward}', [RewardController::class, 'redeem'])->name('rewards.redeem');
});

Route::middleware(['auth', @'can:isAdmin,App\Models\User'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::put('users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/delete/{user}', [UserController::class, 'update'])->name('users.delete');
    //Usuario//

    //Admin//
    Route::get('/rewards/admin', [RewardController::class, 'index'])->name('rewards.admin');
    Route::post('/rewards', [RewardController::class, 'store'])->name('rewards.store');
    Route::put('/rewards/{reward}', [RewardController::class, 'update'])->name('rewards.update');
    Route::delete('/rewards/{reward}', [RewardController::class, 'destroy'])->name('rewards.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::fallback(function () {
    return redirect()->route('index');
});

require __DIR__ . '/auth.php';
