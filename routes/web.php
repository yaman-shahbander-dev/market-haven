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

//Route::get('/aa', function () {
//    Bugsnag::registerCallback(function ($report) {
//        $report->setUser([
//            'id' => '123456',
//            'name' => 'Leeroy Jenkins',
//            'email' => 'leeeeroy@jenkins.com',
//        ]);
//    });
//    return 'here';
//});

// for testing stripe confirm payment
$clientSecret = 'pi_3NX5fPH3qVRn63M21hS8GyIQ_secret_7xY8BoSQwWHLOXUMgxGnafroN';
Route::get('/stripe-key', function () use ($clientSecret) {
    return response()->json([
        'publishableKey' => config('payment.stripe.public_key', 'pk_test_51L1rOdH3qVRn63M2Mk0rJKMmfbCPIKiTPCEKW6Q0DTPIj8hKVyRKHEuWbZiN1xacF6NxwCgzVNox1iDXgTdC2TXT000nGV1wXu'),
        'clientSecret' => $clientSecret
    ]);
})->middleware('cors');
Route::get('pay', function () use ($clientSecret) {
    return response()->json([
        'error' => false,
        'requiresAction' => false,
        'clientSecret' => $clientSecret
    ], 200);
})->middleware('cors');
