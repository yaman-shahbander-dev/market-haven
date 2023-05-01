<?php

use App\Admin\v1\Http\Client\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')
        ->name('admin.login');

    Route::get('/logout', 'logout')
        ->middleware(['auth:api', 'scope:admin'])
        ->name('admin.logout');
});
