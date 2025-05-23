<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'login', 'middleware' => 'guest:client'], function () {

    Route::get('/', 'LoginController@showLogin')
        ->name('client.login');

    // Submit Login
    Route::post('/', 'LoginController@postLogin')
        ->name('client.login');
});


Route::group(['prefix' => 'logout', 'middleware' => 'auth:client'], function () {

    // Logout
    Route::any('/', 'LoginController@logout')
        ->name('client.logout');
});
