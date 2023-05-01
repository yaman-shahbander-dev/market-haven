<?php

use App\User\v1\Http\Client\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')
        ->name('user.register');

    Route::post('/login', 'login')
        ->name('user.login');

    Route::get('/logout', 'logout')
        ->middleware(['auth:api', 'scope:user'])
        ->name('user.logout');
});
