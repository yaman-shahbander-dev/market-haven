<?php

use App\User\v1\Http\Cart\Controllers\CartController;

Route::name('user.')
    ->controller(CartController::class)
    ->group(function () {
        Route::get('cart', 'index')->name('cart.index');
        Route::post('cart', 'store')->name('cart.store');
        Route::delete('cart/{cart}', 'destroy')->name('cart.destroy');
        Route::put('cart/{cart}/add/{product}', 'add')->name('cart.add');
        Route::put('cart/{cart}/remove/{product}', 'remove')->name('cart.remove');
    });
