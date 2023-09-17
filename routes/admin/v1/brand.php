<?php

use App\Admin\v1\Http\Brand\Controllers\BrandController;

Route::apiResource('brand', BrandController::class, [
   'names' => [
       'index' => 'admin.brand.index',
       'show' => 'admin.brand.show',
       'store' => 'admin.brand.store',
       'update' => 'admin.brand.update',
       'destroy' => 'admin.brand.destroy',
   ]
]);
