<?php

use App\User\v1\Http\Category\Controllers\CategoryController;

Route::apiResource('category', CategoryController::class)->only(['index', 'show']);
