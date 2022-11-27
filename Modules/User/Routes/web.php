<?php
// use Modules\User\Http\Controllers\PassportAuthController;
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

// echo 'route module user';

Route::prefix('user')->group(function() {
    Route::get('/', 'UserController@index');
});


Route::prefix('api')->group(function() {
    Route::post('/register', 'PassportAuthController@register')->name('api.register');
    Route::post('/login', 'PassportAuthController@login')->name('api.login');   
});


Route::prefix('admin')->group(function() {
    // Login Logout
    Route::get('/',  'UserAdminController@login')->name('admin.login');
    Route::post('/', 'UserAdminController@login');

    // logout
    Route::get('/logout', 'UserAdminController@logout')->name('admin.logout');

    Route::get('/forget-password',  'UserPasswordController@forget_password')->middleware('guest')->name('admin.forget_password');
    Route::post('/forget-password', 'UserPasswordController@forget_password')->middleware('guest');

    Route::get('/reset-password/{token}','UserPasswordController@reset_password')->middleware('guest')->name('admin.reset_password');
    Route::post('/reset-password/','UserPasswordController@set_reset_password')->middleware('guest')->name('admin.set_reset_password');


    Route::get('/notify','UserPasswordController@notify')->middleware('guest')->name('admin.notify');

}); 

Route::group( [ 'middleware' => 'auth:admin','setAdminAccessControl' ], function(){
    Route::prefix('admin/user')->group(function() {

        // user
        Route::get('/', 'UserAdminController@index')->name('admin.user.user.index');
        Route::get('/datatable_ajax', 'UserAdminController@datatable_ajax')->name('admin.user.user.datatable_ajax') ;

        Route::get('/add', 'UserAdminController@form')->name('admin.user.user.add') ;
        Route::get('/edit/{user_id}', 'UserAdminController@form')->name('admin.user.user.edit') ;
        Route::post('/save', 'UserAdminController@save')->name('admin.user.user.save') ;

        Route::post('/set_status', 'UserAdminController@set_status')->name('admin.user.user.set_status') ;
        Route::post('/set_delete', 'UserAdminController@set_delete')->name('admin.user.user.set_delete') ;

        // user group
        Route::get('/group', 'UserAdminController@group')->name('admin.user.group.index') ;
        Route::get('/group_datatable_ajax', 'UserAdminController@group_datatable_ajax')->name('admin.user.group.datatable_ajax') ;

        Route::get('/group/add', 'UserAdminController@group_form')->name('admin.user.group.add') ;
        Route::get('/group/edit/{group_id}', 'UserAdminController@group_form')->name('admin.user.group.edit') ;
        Route::post('/group/save', 'UserAdminController@group_save')->name('admin.user.group.save') ;
        
        Route::post('/set_group_status', 'UserAdminController@set_group_status')->name('admin.user.group.set_status') ;
        Route::post('/set_group_delete', 'UserAdminController@set_group_delete')->name('admin.user.group.set_delete') ;
        
    });
});    



