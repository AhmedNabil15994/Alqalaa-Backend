<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('casees/datatable'	,'CaseeController@datatable')
        ->name('casees.datatable');

    Route::get('casees/deletes'	,'CaseeController@deletes')
        ->name('casees.deletes');

    Route::resource('casees','CaseeController')->names('casees');
});