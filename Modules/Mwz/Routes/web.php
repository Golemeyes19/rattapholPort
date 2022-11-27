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

Route::prefix('mwz')->group(function() {
    Route::get('/', 'MwzController@index');
});


Route::prefix('admin/mwz')->group(function() {
    Route::get('/get_province/{type}', 'MwzAdminController@getProvince')->name('admin.mwz.address.province') ;

    Route::get('/get_city/{type}/{province_id}', 'MwzAdminController@getCity')->name('admin.mwz.address.city') ;

    Route::get('/get_city_full/{type}/{province_id}', 'MwzAdminController@getCityFull')->name('admin.mwz.address.cityfull') ;

    Route::get('/get_districe/{type}/{city_id}', 'MwzAdminController@getDistrict')->name('admin.mwz.address.district') ;

    Route::get('/get_districe_full/{type}/{city_id}', 'MwzAdminController@getDistrictFull')->name('admin.mwz.address.districtfull') ;

    Route::get('/get_address_by_zipcode/{type}/{zipcode}', 'MwzAdminController@getAddressByZipcode')->name('admin.mwz.address.districtzipcode') ;

    Route::get('/get_tin/{tax_id}', 'MwzAdminController@getTIN')->name('admin.mwz.rd.tin') ;

    Route::post('/multifiles/upload', 'MwzAdminController@multifiles_upload')->name('admin.master.multifiles.upload') ;
});

Route::group(['middleware' => 'setlocale'], function() {

    Route::prefix('mwz')->group(function() {
        Route::get('/get_province/{type}', 'MwzController@getProvince')->name('mwz.address.province') ;

        Route::get('/get_city/{type}/{province_id}', 'MwzController@getCity')->name('mwz.address.city') ;

        Route::get('/get_city_full/{type}/{province_id}', 'MwzController@getCityFull')->name('mwz.address.cityfull') ;

        Route::get('/get_districe/{type}/{city_id}', 'MwzController@getDistrict')->name('mwz.address.district') ;

        Route::get('/get_districe_full/{type}/{city_id}', 'MwzController@getDistrictFull')->name('mwz.address.districtfull') ;

        Route::get('/get_address_by_zipcode/{type}/{zipcode}', 'MwzController@getAddressByZipcode')->name('mwz.address.districtzipcode') ;

        Route::get('/get_tin/{tax_id}', 'MwzController@getTIN')->name('admin.mwz.rd.tin') ;

        Route::post('/multifiles/upload', 'MwzController@multifiles_upload')->name('master.multifiles.upload') ;
    });

});

Route::group(['prefix' => '{locale?}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {
    Route::prefix('mwz')->group(function() {
        Route::get('/get_province/{type}', 'MwzController@getProvince')->name('lang.mwz.address.province') ;

        Route::get('/get_city/{type}/{province_id}', 'MwzController@getCity')->name('lang.mwz.address.city') ;

        Route::get('/get_city_full/{type}/{province_id}', 'MwzController@getCityFull')->name('lang.mwz.address.cityfull') ;

        Route::get('/get_districe/{type}/{city_id}', 'MwzController@getDistrict')->name('lang.mwz.address.district') ;

        Route::get('/get_districe_full/{type}/{city_id}', 'MwzController@getDistrictFull')->name('lang.mwz.address.districtfull') ;

        Route::get('/get_address_by_zipcode/{type}/{zipcode}', 'MwzController@getAddressByZipcode')->name('lang.mwz.address.districtzipcode') ;

        Route::get('/get_tin/{tax_id}', 'MwzController@getTIN')->name('lang.mwz.rd.tin') ;

        Route::post('/multifiles/upload', 'MwzController@multifiles_upload')->name('lang.master.multifiles.upload') ;
    });
});
