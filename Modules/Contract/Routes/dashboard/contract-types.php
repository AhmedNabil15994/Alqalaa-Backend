<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('contract-types/datatable'	,'ContractTypesController@datatable')
        ->name('contract-types.datatable');

    Route::get('contract-types/deletes'	,'ContractTypesController@deletes')
        ->name('contract-types.deletes');

    Route::resource('contract-types','ContractTypesController')->names('contract-types');
});