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

Route::group( [ 'middleware' => 'auth:admin' ,'setAdminAccessControl'], function(){
    Route::prefix('admin/banner')->group(function() {
        Route::get('/index', 'BannerAdminController@index')->name('admin.banner.banner.index') ;
        Route::get('/datatable_ajax', 'BannerAdminController@datatable_ajax')->name('admin.banner.banner.datatable_ajax') ;

        Route::get('/add', 'BannerAdminController@form_banner')->name('admin.banner.banner.add') ;
        Route::get('/edit/{category_id}', 'BannerAdminController@form_banner')->name('admin.banner.banner.edit') ;
        Route::post('/save', 'BannerAdminController@save_banner')->name('admin.banner.banner.save') ;

        Route::post('/set_status', 'BannerAdminController@set_status')->name('admin.banner.banner.set_status') ;
        Route::post('/set_delete', 'BannerAdminController@set_delete')->name('admin.banner.banner.set_delete') ;

        Route::get('/category', 'BannerAdminController@category')->name('admin.banner.category.index') ;
        Route::get('/category_datatable_ajax', 'BannerAdminController@category_datatable_ajax')->name('admin.banner.category.datatable_ajax') ;

        Route::get('/category/add', 'BannerAdminController@category_form')->name('admin.banner.category.add') ;
        Route::get('/category/edit/{category_id}', 'BannerAdminController@category_form')->name('admin.banner.category.edit') ;
        Route::post('/category/save', 'BannerAdminController@category_save')->name('admin.banner.category.save') ;

        Route::post('/set_category_status', 'BannerAdminController@set_category_status')->name('admin.banner.category.set_category_status') ;
        Route::post('/set_category_delete', 'BannerAdminController@set_category_delete')->name('admin.banner.category.set_category_delete') ;

    });
});
