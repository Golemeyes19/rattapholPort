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
Route::prefix('admin/menu')->group(function () {
    Route::get('/', 'MenuAdminController@index')->name('admin.menu.menu.index');
    Route::get('/type/{type}', 'MenuAdminController@type_menu')->name('admin.menu.menu.type_menu');
    Route::get('/datatable_ajax', 'MenuAdminController@datatable_ajax')->name('admin.menu.menu.datatable_ajax');

    Route::get('/add', 'MenuAdminController@form')->name('admin.menu.menu.add');
    Route::get('/edit/{category_id}', 'MenuAdminController@form')->name('admin.menu.menu.edit');
    Route::post('/save', 'MenuAdminController@save')->name('admin.menu.menu.save');


    Route::post('/set_status', 'MenuAdminController@set_status')->name('admin.menu.menu.set_status');
    Route::post('/set_delete', 'MenuAdminController@set_delete')->name('admin.menu.menu.set_delete');
    
    Route::post('/menu_up', 'MenuAdminController@menu_up')->name('menu.menu.menu_up');
    Route::post('/menu_down', 'MenuAdminController@menu_down')->name('menu.menu.menu_down');

    });
});

// Route::prefix('menu')->group(function () {
    Route::get('/getmenu', 'MenuController@getmenu')->name('menu.menu.getmenu');

    // });