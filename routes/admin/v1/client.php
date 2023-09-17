<?php

use App\Admin\v1\Http\Client\Controllers\AuthController;

Route::controller(AuthController::class)
    ->name('admin.')
    ->group(function () {

    Route::post('/login', 'login')
        ->name('login');

    Route::get('/logout', 'logout')
        ->middleware(['auth:api', 'scope:admin'])
        ->name('logout');
});
