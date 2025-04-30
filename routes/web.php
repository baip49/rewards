<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('progress', 'progress')->name('progress');
    Route::get('rewards', [RewardsController::class, 'index'])->name('rewards.user');
    Route::post('rewards/redeem/{reward}', [RewardsController::class, 'redeem'])->name('rewards.redeem');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('orders/{order}/message', [OrderController::class, 'sendMessage'])->name('order.sendMessage');
});

Route::middleware(['auth', @'can:isAdmin,App\Models\User'])->group(function () {
    Route::get('admin/rewards/orders', [OrderController::class, 'index'])->name('admin.rewards.orders');
    Route::get('admin/rewards/', [RewardsController::class, 'admin'])->name('admin.rewards');
    Route::post('admin/rewards/create', [RewardsController::class, 'create'])->name('admin.rewards.create');
    Route::put('admin/rewards/update/{reward}', [RewardsController::class, 'update'])->name('admin.rewards.update');
    Route::delete('admin/rewards/delete/{reward}', [RewardsController::class, 'delete'])->name('admin.rewards.delete');

    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::put('admin/users/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
    // Route::post('admin/users/delete/{user}', [UserController::class, 'update'])->name('users.delete');

    // Orders
    Route::put('orders/{order}/close', [OrderController::class, 'close'])->name('order.close');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::fallback(function () {
    return redirect()->route('home');
});

require __DIR__ . '/auth.php';
