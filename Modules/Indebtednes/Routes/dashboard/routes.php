<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('indebtednes/datatable'	,'IndebtednesController@datatable')
        ->name('indebtednes.datatable');

    Route::get('indebtednes/deletes'	,'IndebtednesController@deletes')
        ->name('indebtednes.deletes');

    Route::get('indebtednes/exports/{pdf}' , 'IndebtednesController@export')->name('indebtednes.export');

    Route::get('indebtednes/print/{id}','IndebtednesController@printIndebtednes')
        ->name('indebtednes.print');

    Route::get('indebtednes/get/{client}'	,'IndebtednesController@getWithClient')
        ->name('indebtednes.get-with-client-id');

    Route::get('indebtednes/refresh/table/{id}'	,'IndebtednesController@refreshTable')
        ->name('indebtednes.refresh.table');

    Route::put('indebtednes/pay/{id}'	,'IndebtednesController@pay')
        ->name('indebtednes.pay');

    Route::put('indebtednes/{indebtednes}/cancel/{id}'	,'IndebtednesController@cancel')
        ->name('indebtednes.cancel');

    Route::resource('indebtednes','IndebtednesController')->names('indebtednes');
});