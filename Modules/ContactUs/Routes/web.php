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
// Route::get('/getContactSubject', 'ContactUsController@getContactSubject')->name('contactus.contactus.getContactSubject') ;

Route::group( [ 'middleware' => 'auth:admin' ,'setAdminAccessControl'], function(){
    Route::prefix('admin/contactus')->group(function() {
        Route::get('/', 'ContactUsAdminController@index')->name('admin.contactus.contactus.index') ;
        Route::get('/datatable_ajax', 'ContactUsAdminController@datatable_ajax')->name('admin.contactus.contactus.datatable_ajax') ;
        Route::get('/datatable_ajax_subject', 'ContactUsAdminController@datatable_ajax_subject')->name('admin.contactus.contactus.datatable_ajax_subject') ;
        Route::get('/edit/{category_id}', 'ContactUsAdminController@form')->name('admin.contactus.contactus.edit') ;

        Route::post('/set_status', 'ContactUsAdminController@set_status')->name('admin.contactus.contactus.set_status') ;
        Route::post('/set_delete', 'ContactUsAdminController@set_delete')->name('admin.contactus.contactus.set_delete') ;
        Route::post('/save', 'ContactUsAdminController@save')->name('admin.contactus.contactus.save') ;

        Route::get('/subject_index', 'ContactUsAdminController@subject')->name('admin.contactus.contactus.subject_index') ;
        Route::get('/subject', 'ContactUsAdminController@form_contact_subject')->name('admin.contactus.contactus.edit_contact_subject') ;
        Route::get('/add_subject', 'ContactUsAdminController@add_contact_subject')->name('admin.contactus.contactus.add_contact_subject') ;
        Route::post('/save_subject', 'ContactUsAdminController@save_contact_subject')->name('admin.contactus.contactus.save_contact_subject') ;
        Route::post('/set_delete_subject', 'ContactUsAdminController@set_delete_subject')->name('admin.contactus.contactus.set_delete_subject') ;
        Route::post('/set_status_subject', 'ContactUsAdminController@set_status_subject')->name('admin.contactus.contactus.set_status_subject') ;
        Route::get('/edit_subject/{id}', 'ContactUsAdminController@form_contact_subject')->name('admin.contactus.contactus.edit_subject') ;

        Route::post('/save_contact_page', 'ContactUsAdminController@save_contact_page')->name('admin.contactus.contactus.save_contact_page') ;
        Route::get('/edit', 'ContactUsAdminController@form_contact_page')->name('admin.contactus.contactus.edit_contact_page') ;


    });
});
Route::prefix('contactus')->group(function() {
    Route::get('/getContactSubject', 'ContactUsController@getContactSubject')->name('contactus.contactus.getContactSubject') ;
});

Route::get('/dev/contactus/form', 'ContactUsController@form_contactus')->name('dav.contact.form') ;
Route::post('/dev/contactus/send', 'ContactUsController@send_contactus')->name('dav.contact.send') ;
