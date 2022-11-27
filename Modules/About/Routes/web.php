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

Route::prefix('about')->group(function() {
    Route::get('/', 'AboutController@index');
});

Route::group( [ 'middleware' => 'auth:admin','setAdminAccessControl' ], function(){
    Route::prefix('admin/about')->group(function() {

        Route::get('/', 'AboutAdminController@form_about')->name('admin.about.about.index');

        Route::post('/save', 'AboutAdminController@save_about')->name('admin.about.about.save');

    });
});
