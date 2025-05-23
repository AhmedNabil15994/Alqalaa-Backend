<?php
use Illuminate\Support\Facades\Route;

Route::name('client.')->group( function () {

    Route::post('installments/webhooks', 'InstallmentController@webHooks')->name('installments.webhooks');

    Route::get('success', 'InstallmentController@success')
        ->name('installments.success');

    Route::get('failed', 'InstallmentController@failed')
        ->name('installments.failed');

    Route::get('installments/print/{id}','InstallmentController@printInstallment')
        ->name('installments.print')->middleware('auth:client');

    Route::put('installments/create/{id}','InstallmentController@createInstallment')->name('installments.create')->middleware('auth:client');
});