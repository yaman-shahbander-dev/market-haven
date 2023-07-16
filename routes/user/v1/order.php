<?php

use App\User\v1\Http\Order\Controllers\OrderController;

Route::name('user.')
    ->controller(OrderController::class)
    ->group(function () {
        Route::post('/order', 'store')->name('order.store');
    });
