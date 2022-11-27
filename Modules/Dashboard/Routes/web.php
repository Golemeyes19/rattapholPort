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

Route::group( [ 'middleware' => 'auth:admin','setAdminAccessControl' ], function(){
    Route::prefix('admin/dashboard')->group(function() {
        Route::get('/', 'DashboardAdminController@index')->name('admin.dashboard.dashboard.index');
        Route::get('/home', 'DashboardAdminController@index')->name('admin.homepage');
        Route::get('/default', 'DashboardAdminController@index')->name('admin.default');
    });
});
