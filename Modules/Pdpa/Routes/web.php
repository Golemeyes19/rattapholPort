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

Route::get('/getpdpa', 'PdpaController@get_pdpaAll')->name('pdpa.pdpa.getpdpa') ;

Route::prefix('pdpa')->group(function() {
    Route::get('/', 'PdpaController@index');
    Route::get('/check_accept', 'PdpaController@check_accept')->name('frontend.pdpa.pdpa.check_accept') ;

});

Route::group( [ 'middleware' => 'auth:admin' ,'setAdminAccessControl'], function(){
  Route::prefix('admin/pdpa')->group(function() {
      Route::get('/', 'PdpaAdminController@index')->name('admin.pdpa.pdpa.index') ;
      Route::get('/datatable_ajax', 'PdpaAdminController@datatable_ajax')->name('admin.pdpa.pdpa.datatable_ajax') ;

      Route::get('/pdpa_detail', 'PdpaAdminController@pdpa_detail')->name('admin.pdpa.pdpa.pdpa_detail') ;
      Route::get('/datatable_ajax_pdpa_detail', 'PdpaAdminController@datatable_ajax_pdpa_detail')->name('admin.pdpa.pdpa.datatable_ajax_pdpa_detail') ;

      Route::get('/add', 'PdpaAdminController@form')->name('admin.pdpa.pdpa.add') ;
      Route::post('/save_pdpa', 'PdpaAdminController@save')->name('admin.pdpa.pdpa.save_pdpa') ;
      Route::get('/edit/{pdpa_id}', 'PdpaAdminController@form')->name('admin.pdpa.pdpa.edit') ;

      Route::post('/set_status', 'PdpaAdminController@set_status')->name('admin.pdpa.pdpa.set_status') ;
      Route::post('/set_delete', 'PdpaAdminController@set_delete')->name('admin.pdpa.pdpa.set_delete') ;

  });
});
