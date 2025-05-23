<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', function (\Modules\Transaction\Services\CbkPaymentService $payment) {
    $transaction = (object) [
        'amount' => 15.49,
        'id' => 1,
    ];
    $pay_id = \Str::random(mt_rand(20, 30));

    return $transaction;
    return $payment->send($transaction, $pay_id);
});
