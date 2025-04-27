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
    Route::view('rewards', 'rewards')->name('rewards');
    Route::view('progress', 'progress')->name('progress');
});

Route::middleware(['auth', 'can:isAdmin,App\Models\User'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::put('users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/delete/{user}', [UserController::class, 'update'])->name('users.delete');
    Route::view('rewadmin', 'rewadmin')->name('rewadmin');
    Route::get('/rewards/{id}/edit', [RewardController::class, 'edit'])->name('rewards.edit');
    Route::put('/rewards/{id}', [RewardController::class, 'update'])->name('rewards.update');
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
