<?php

use App\Admin\v1\Http\Review\Controllers\ReviewController;

Route::name('admin.')
    ->controller(ReviewController::class)
    ->group(function () {
        Route::get('review', 'index')->name('review.index');
        Route::get('review/{review}', 'show')->name('review.show');
        Route::delete('review/{review}', 'destroy')->name('review.destroy');
        Route::put('review/{review}', 'approve')->name('review.approve');
    });
