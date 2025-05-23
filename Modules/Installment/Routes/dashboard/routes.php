<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {


    Route::get('installments/print/{id}','InstallmentController@printInstallment')
        ->name('installments.print');

    Route::get('installments/exports/excel/{excel}' , 'V2\InstallmentController@export')->name('installments.export.excel');

    Route::get('installments/export/excel/{excel}' , 'V2\InstallmentController@export')->name('installments.export.excel.judging');

    Route::get('installments/exports/{pdf}' , 'V2\InstallmentController@export')->name('installments.export');

    Route::get('installments/export/{pdf}' , 'V2\InstallmentController@export')->name('installments.export.judging');

    Route::get('installments/datatable'	,'InstallmentController@datatable')
        ->name('installments.datatable');

    Route::get('installments/judging/datatable'	,'InstallmentController@datatable')
        ->name('installments.judging.datatable');

    Route::get('installments/judging'	,'InstallmentController@index')
        ->name('installments.judging.index');

    Route::get('installments/cancel/{id}'	,'InstallmentController@cancel')
        ->name('installments.cancel');

    Route::get('installments/multi-pay'	,'InstallmentController@multiPay')
        ->name('installments.multi.pay');

    Route::get('installments/send_WAMsg/{id}'	,'InstallmentController@send_WAMsg')
        ->name('installments.send_WAMsg');

    Route::get('installments/multi-employee-pay'	,'InstallmentController@multiEmployeePay')
        ->name('installments.multi.employee.pay');

    Route::get('installments/add-offer'	,'InstallmentController@multiAddOffer')
        ->name('installments.multi.add-offer');

    Route::get('installments/cancel-offer'	,'InstallmentController@multiCancelOffer')
        ->name('installments.multi.cancel-offer');

    Route::get('installments/send-whatsapp'	,'InstallmentController@multiSendWhatsapp')
        ->name('installments.multi.send-whatsapp');

    Route::get('installments/update-due-date/{id}'	,'InstallmentController@updateDueDate')
        ->name('installments.update.due.date');

    Route::resource('installments','InstallmentController')->only('update','index')->names('installments');
});
