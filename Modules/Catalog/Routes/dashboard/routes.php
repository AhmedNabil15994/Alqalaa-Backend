<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('labels/datatable'	,'LabelController@datatable')
        ->name('labels.datatable');

    Route::get('labels/deletes'	,'LabelController@deletes')
        ->name('labels.deletes');

    Route::resource('labels','LabelController')->names('labels');
});