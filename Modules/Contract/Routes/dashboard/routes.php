<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('contracts/datatable'	,'ContractController@datatable')
        ->name('contracts.datatable');

    Route::get('contracts/exports/{pdf}/{status?}' , 'ContractController@export')->name('contracts.export');

    Route::get('contracts/get/{client}'	,'ContractController@getWithClient')
        ->name('contracts.get-with-client-id');

    Route::get('contracts/deletes'	,'ContractController@deletes')
        ->name('contracts.deletes');

    Route::get('contracts/refresh/table/{id}'	,'ContractController@refreshTable')
        ->name('contracts.refresh.table');

    Route::get('contracts/print/{id}','ContractController@printContract')
        ->name('contracts.print');

    Route::get('contracts/printIndebtednessCertificate/{id}','ContractController@printIndebtednessCertificate')
        ->name('contracts.printIndebtednessCertificate');

    Route::resource('contracts','ContractController')->names('contracts');


    //completed contracts
    Route::get('completed-contracts'	,'ContractController@completedContractsIndex')
        ->name('completed-contracts.index');
    Route::get('completed-contracts/datatable'	,'ContractController@completedContractsDatatable')
        ->name('completed-contracts.datatable');

    //current contracts
    Route::get('current-contracts'	,'ContractController@currentContractsIndex')
        ->name('current-contracts.index');
    Route::get('current-contracts/datatable'	,'ContractController@currentContractsDatatable')
        ->name('current-contracts.datatable');

    //current contracts
    Route::get('pending-contracts'	,'ContractController@pendingContractsIndex')
        ->name('pending-contracts.index');
    Route::get('pending-contracts/datatable'	,'ContractController@pendingContractsDatatable')
        ->name('pending-contracts.datatable');
});
