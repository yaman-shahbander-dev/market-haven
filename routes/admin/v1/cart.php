<?php

use App\Admin\v1\Http\Cart\Controllers\CartController;

Route::name('admin.')
    ->controller(CartController::class)
    ->group(function () {
        Route::get('cart', 'index')->name('cart.index');
        Route::get('cart/{cart}', 'show')->name('cart.show');
    });
