<?php

use App\User\v1\Http\Product\Controllers\ProductController;

Route::controller(ProductController::class)
    ->group(function () {
        Route::get('/product', 'index')->name('user.product.index');
        Route::get('/product/{product}', 'show')->name('user.product.show');
    });
