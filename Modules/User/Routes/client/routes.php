<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'profile'], function () {

    Route::get('/', 'ClientController@profileView')->name('client.profile');
    Route::post('{client}', 'ClientController@updateProfile')->name('client.update.profile');
});
