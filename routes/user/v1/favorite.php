<?php

use App\User\v1\Http\Favorite\Controllers\FavoriteController;

Route::get('favorite', [FavoriteController::class, 'index'])->name('user.favorite.index');
