<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('contract-status/datatable'	,'ContractStatusController@datatable')
        ->name('contract-status.datatable');

    Route::get('contract-status/exports/{pdf}' , 'ContractStatusController@export')->name('contract-status.export');

    Route::get('contract-status/deletes'	,'ContractStatusController@deletes')
        ->name('contract-status.deletes');

    Route::get('contract-status/switch/{id}/{action}', 'ContractStatusController@switcher')->name('contract-status.switch');
    Route::get('contract-status/get-by-id/{id}', 'ContractStatusController@getById')->name('contract-status.get-by-id');

    Route::resource('contract-status','ContractStatusController')->names('contract-status');
});