<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('case-actions/datatable'	,'CaseActionController@datatable')
        ->name('case-actions.datatable');

    Route::get('case-actions/exports/{pdf}' , 'CaseActionController@export')->name('case-actions.export');

    Route::get('case-actions/deletes'	,'CaseActionController@deletes')
        ->name('case-actions.deletes');

    Route::resource('case-actions','CaseActionController')->names('case-actions');
});