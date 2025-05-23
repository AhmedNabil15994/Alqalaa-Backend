<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@index')->name('frontend.home');
