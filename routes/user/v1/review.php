<?php

use App\User\v1\Http\Review\Controllers\ReviewController;

Route::post('/review', [ReviewController::class, 'store'])->name('user.review.store');
