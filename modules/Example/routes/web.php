<?php

use Illuminate\Support\Facades\Route;
use Modules\Example\App\Http\Controllers\ExampleController;

// Route::middleware(['auth', 'verified'])->group(function () {
Route::resource('examples', ExampleController::class);
// });
