<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')->group(function() {
    Route::get('/', 'FrontendController@index');
    Route::get('/about', 'FrontendController@about');
    Route::get('/services', 'FrontendController@services');
    Route::get('/portfolio', 'FrontendController@portfolio');
    Route::get('/news', 'FrontendController@news');
    Route::get('/contact', 'FrontendController@contact');
});




