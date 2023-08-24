<?php

use App\Admin\v1\Http\Location\Controllers\ContinentController;
use App\Admin\v1\Http\Location\Controllers\CountryController;

Route::controller(ContinentController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/continents', 'index')->name('location.continents.index');
        Route::get('/continents/{continent}', 'show')->name('location.continents.show');
    });

Route::controller(CountryController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/countries', 'index')->name('location.countries.index');
        Route::get('/countries/{country}', 'show')->name('location.countries.show');
    });
