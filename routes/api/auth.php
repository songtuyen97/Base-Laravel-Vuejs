<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('me', [AuthController::class, 'me'])
        ->name('me');
});
