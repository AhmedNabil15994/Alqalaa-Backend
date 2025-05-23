<?php
use Illuminate\Support\Facades\Route;

Route::name('client.')->group( function () {

    Route::get('contracts/datatable'	,'ContractController@datatable')
        ->name('contracts.datatable');

    Route::get('contracts/deletes'	,'ContractController@deletes')
        ->name('contracts.deletes');

    Route::get('contracts/refresh/table/{id}'	,'ContractController@refreshTable')
        ->name('contracts.refresh.table');

    Route::resource('contracts','ContractController')->only('index','show')->names('contracts');
});