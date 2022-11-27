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

Route::group(['middleware' => 'auth:admin','setAdminAccessControl'], function () {
    Route::prefix('admin/page')->group(function () {
        Route::get('/index', 'PageAdminController@index')->name('admin.page.page.index');
        Route::get('/datatable_ajax', 'PageAdminController@datatable_ajax')->name('admin.page.page.datatable_ajax');

        Route::get('/add', 'PageAdminController@page_form')->name('admin.page.page.add');
        Route::post('/save', 'PageAdminController@save')->name('admin.page.page.save');
        Route::get('/edit/{category_id}', 'PageAdminController@page_form')->name('admin.page.page.edit');

        Route::post('/set_status', 'PageAdminController@set_status')->name('admin.page.page.set_status');
        Route::post('/set_delete', 'PageAdminController@set_delete')->name('admin.page.page.set_delete');
    });
});
