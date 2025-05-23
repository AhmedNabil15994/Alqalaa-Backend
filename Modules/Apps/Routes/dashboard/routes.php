<?php

//use Vsch\TranslationManager\Translator;


Route::group(['prefix' => '/' , 'middleware' => [ 'dashboard.auth','check.permission']], function() {

  Route::get('/' , 'DashboardController@index')->name('dashboard.home');
  Route::get('/chart' , 'DashboardController@chart')->name('dashboard.chart');

//  Route::group(['prefix' => 'translations'], function () {
//      Translator::routes();
//  });

  Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});

Route::name('dashboard.')->group( function () {

  Route::get('print/reports/request/datatable'	,'PrintReportsRequestController@datatable')
      ->name('print.reports.request.datatable');

  Route::get('print/reports/request/deletes'	,'PrintReportsRequestController@deletes')
      ->name('print.reports.request.deletes');

  Route::resource('print/reports/request','PrintReportsRequestController')->names('print.reports.request');

});