<?php
use Illuminate\Support\Facades\Route;

Route::get('instalments/payment/{token}' , 'InstallmentController@index')->name('frontend.instalment.checkout');
Route::post('instalments/payment/{token}/pay/{id}' , 'InstallmentController@pay')->name('frontend.instalment.pay');
Route::any('installments/webhooks', 'InstallmentController@webHooks')->name('frontend.installments.webhooks');


Route::get('installments/print/{id}','InstallmentController@printInstallment')
    ->name('installments.print');