<?php

use Illuminate\Support\Facades\Route;
use Modules\Example\App\Http\Controllers\ExampleController;

// Route::middleware(['auth:api'])->prefix('v1')->group(function () {
Route::apiResource('examples', ExampleController::class);
// });
