<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Http\Controllers\UserController;
use Modules\User\app\Livewire\Settings\Appearance;
use Modules\User\app\Livewire\Settings\Password;
use Modules\User\app\Livewire\Settings\Profile;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
