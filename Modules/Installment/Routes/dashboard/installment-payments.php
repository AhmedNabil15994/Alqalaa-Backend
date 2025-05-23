<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.installments.payments.')->group( function () {

    Route::get('installment-payments'	,'InstallmentPaymentController@index')
        ->name('index');
        
    Route::get('installment-payments/datatable'	,'InstallmentPaymentController@datatable')
        ->name('datatable');
        
    Route::get('installment-payments/cancel/{id}'	,'InstallmentPaymentController@cancel')
        ->name('cancel');

    Route::get('installment-payments/exports/excel/{excel}' , 'InstallmentPaymentController@export')->name('export.excel');
    Route::get('installment-payments/exports/{pdf}' , 'InstallmentPaymentController@export')->name('export');

});