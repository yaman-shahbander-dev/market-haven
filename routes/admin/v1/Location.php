<?php

use App\Admin\v1\Http\Location\Controllers\ContinentController;
use App\Admin\v1\Http\Location\Controllers\CountryController;
use App\Admin\v1\Http\Location\Controllers\CityController;
use App\Admin\v1\Http\Location\Controllers\AddressController;

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

Route::controller(CityController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/cities', 'index')->name('location.cities.index');
        Route::get('/cities/{city}', 'show')->name('location.cities.show');
    });

Route::controller(AddressController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/addresses', 'index')->name('location.addresses.index');
        Route::get('/addresses/{address}', 'show')->name('location.addresses.show');
    });
