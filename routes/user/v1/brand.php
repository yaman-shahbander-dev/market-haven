<?php

use App\User\v1\Http\Brand\Controllers\BrandController;

Route::controller(BrandController::class)
    ->name('user.')
    ->group(function () {
        Route::get('/brand', 'index')->name('brand.index');
        Route::get('/brand/{brand}', 'show')->name('brand.show');
    });
