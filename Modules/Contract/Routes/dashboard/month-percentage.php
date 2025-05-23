<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('month-percentages/datatable'	,'MonthPercentageController@datatable')
        ->name('month-percentages.datatable');

    Route::get('month-percentages/exports/{pdf}' , 'MonthPercentageController@export')->name('month-percentages.export');

    Route::get('month-percentages/deletes'	,'MonthPercentageController@deletes')
        ->name('month-percentages.deletes');

    Route::get('month-percentages/switch/{id}/{action}', 'MonthPercentageController@switcher')->name('month-percentages.switch');
    Route::get('month-percentages/get-by-id/{id}', 'MonthPercentageController@getById')->name('month-percentages.get-by-id');

    Route::resource('month-percentages','MonthPercentageController')->names('month-percentages');
});