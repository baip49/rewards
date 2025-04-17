<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('rewards', 'rewards')->name('rewards');
    Route::view('progress', 'progress')->name('progress');
    // Route::view('users','users')->name('users');
    //users by rich
    Route::get('users', [userController::class, 'index'])->name('users');
    Route::post('users/{user}/update-points', [UserController::class, 'updatePoints'])->name('users.update-points');
    //users by rich
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
