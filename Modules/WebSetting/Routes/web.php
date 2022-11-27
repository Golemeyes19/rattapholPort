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
    Route::prefix('admin/websetting')->group(function () {

        Route::get('/edit', 'WebSettingAdminController@form')->name('admin.websetting.websetting.edit');
        Route::post('/save', 'WebSettingAdminController@save')->name('admin.websetting.websetting.save');

        Route::get('/form_privacy/1', 'WebSettingAdminController@form_privacy')->name('admin.websetting.form_privacy.edit');
        Route::post('/save_privacy', 'WebSettingAdminController@save_privacy')->name('admin.websetting.form_privacy.save');
        Route::post('/delete_image', 'WebSettingAdminController@delete_image')->name('admin.websetting.delete_image');
    });
});
