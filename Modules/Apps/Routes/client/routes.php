<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/' , 'middleware' => []], function() {

  Route::get('/' , 'ClientController@index')->name('client.home');

});
