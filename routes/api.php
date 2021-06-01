<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'api\AuthController@register');
Route::post('login', 'api\AuthController@login');
Route::get('check-phone/{phone}', 'api\AuthController@checkPhone');
Route::get('check-token/{token}', 'api\AuthController@checkToken');
Route::get('check-nik-user/{nik}', 'api\AuthController@checkNIK');
Route::get('check-nik/{nik}', 'api\AuthController@getByNIK');

//warga
Route::get('/warga/cek-nik', 'api\CekNikController@index')->name('api.cek-nik');
Route::get('/warga/show', 'api\WargaController@show');
Route::get('/warga', 'api\WargaController@index');
Route::post('/warga', 'api\WargaController@store');

Route::get('/status-laporan/change/{id}', 'api\ApiLaporanController@changeStatus');
Route::get('/status-laporan/{id}', 'api\ApiLaporanController@status');
Route::resource('/laporan', 'api\ApiLaporanController');
Route::get('/near-hospital', 'api\NearHospitalController@index')->name('api.near-hospital');
Route::get('rumahsakit/{id}', 'api\RumahSakitController@show')->name('api.rumahsakit.show');

Route::get('berita', 'api\BeritaController@index')->name('api.berita');
