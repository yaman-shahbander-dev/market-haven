<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aa', function () {
    Bugsnag::registerCallback(function ($report) {
        $report->setUser([
            'id' => '123456',
            'name' => 'Leeroy Jenkins',
            'email' => 'leeeeroy@jenkins.com',
        ]);
    });
    return 'here';
});
