<?php

use App\Admin\v1\Http\Product\Controllers\ProductController;

Route::apiResource('product', ProductController::class, [
    'names' => [
        'index' => 'admin.product.index',
        'show' => 'admin.product.show',
        'store' => 'admin.product.store',
        'update' => 'admin.product.update',
        'destroy' => 'admin.product.destroy',
    ]
]);
