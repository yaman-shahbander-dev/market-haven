<?php

use App\User\v1\Http\Product\Controllers\ProductController;

Route::controller(ProductController::class)
    ->name('user.')
    ->group(function () {
        Route::get('/product', 'index')->name('product.index');
        Route::get('/product/{product}', 'show')->name('product.show');
        Route::get('/product/{search}/search', 'search')->name('product.search');
    });
