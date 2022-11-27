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

// Route::prefix('news')->group(function() {
//     Route::get('/', 'NewsController@index');
// });

Route::group( [ 'middleware' => 'auth:admin' ,'setAdminAccessControl'], function(){
    Route::prefix('admin/news')->group(function() {
        Route::get('/index', 'NewsAdminController@index')->name('admin.news.news.index') ;
        Route::get('/datatable_ajax', 'NewsAdminController@datatable_ajax')->name('admin.news.news.datatable_ajax') ;

        Route::get('/add', 'NewsAdminController@news_form')->name('admin.news.news.add') ;
        Route::post('/save', 'NewsAdminController@save')->name('admin.news.news.save') ;
        Route::get('/edit/{category_id}', 'NewsAdminController@news_form')->name('admin.news.news.edit') ;

        Route::post('/set_status', 'NewsAdminController@set_status')->name('admin.news.news.set_status') ;
        Route::post('/set_delete', 'NewsAdminController@set_delete')->name('admin.news.news.set_delete') ;

        Route::get('/index_news_category', 'NewsAdminController@index_news_category')->name('admin.news.news.index_news_category') ;
        Route::get('/datatable_ajax_news_category', 'NewsAdminController@datatable_ajax_news_category')->name('admin.news.news.datatable_ajax_news_category') ;

        Route::get('/add_news_category', 'NewsAdminController@news_form_category')->name('admin.news.news.add_news_category') ;
        Route::post('/save_news_category', 'NewsAdminController@save_news_category')->name('admin.news.news.save_news_category') ;
        Route::get('/edit_news_category/{category_id}', 'NewsAdminController@news_form_category')->name('admin.news.news.edit_news_category') ;
    
        Route::post('/set_status_news_category', 'NewsAdminController@set_status_news_category')->name('admin.news.news.set_status_news_category') ;
        Route::post('/set_delete_news_category', 'NewsAdminController@set_delete_news_category')->name('admin.news.news.set_delete_news_category') ;

        Route::post('/menu_up', 'NewsAdminController@menu_up')->name('admin.news.news.menu_up');
        Route::post('/menu_down', 'NewsAdminController@menu_down')->name('admin.news.news.menu_down');

    });
});

Route::prefix('news')->group(function() {
    Route::get('/get_news_category', 'NewsController@getNewsCategory')->name('news.news.get_nwes') ;
    Route::get('/get_news', 'NewsController@getNewsAll')->name('news.news.get_nwes') ;
    Route::get('/get_news/{category_id}/{cur_page}', 'NewsController@getNewsAll')->name('news.news.get_nwes') ;
    Route::get('/get_detail_news', 'NewsController@getDetailNews')->name('news.news.get_detail_news') ;
    Route::get('/get_detail_news/{slug_name}', 'NewsController@getDetailNews')->name('news.news.get_detail_news') ;
    
});
