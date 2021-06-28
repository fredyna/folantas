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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/berita', 'front\BeritaController@index')->name('themes.berita');
Route::get('/detail-berita/{slug}', 'front\BeritaController@show')->name('themes.berita.show');
Route::get('/data-kecelakaan', 'front\DataKecelakaanController@index')->name('themes.kecelakaan');
Route::get('/data-kemacetan', 'front\DataKemacetanController@index')->name('themes.kemacetan');

/** modul master */
Route::group(['prefix' => 'dashboard'], function () {
    /** module user */
    Route::get('/user-json', 'UserController@userJson')->name('user.json');
    Route::resource('/user', 'UserController')->except(['create', 'edit']);
    Route::get('/setting-account', 'SettingAccountController@index')->name('setting.account');
    Route::post('/setting-account', 'SettingAccountController@update');

    //data kecelakaan
    Route::get('/data-kecelakaan/buat-berita', 'LaporKecelakaanController@create_berita')->name('data-kecelakaan.create-berita');
    Route::resource('/data-kecelakaan', 'DataKecelakaanController');

    //data kemacetan
    Route::get('/data-kemacetan/buat-berita', 'LaporKemacetanController@create_berita')->name('data-kemacetan.create-berita');
    Route::resource('/data-kemacetan', 'DataKemacetanController');

    //manajemen berita
    Route::resource('/berita', 'BeritaController');

    Route::resource('/lapor-kecelakaan', 'LaporKecelakaanController');
    Route::resource('/lapor-kemacetan', 'LaporKemacetanController');

    /** modul log */
    Route::get('log-json', 'LogController@index_json')->name('log.json');
    Route::resource('log', 'LogController')->only(['index']);
});

/** notification */
Route::get('/notifikasi-redirect', 'NotificationController@redirect')->name('notifikasi.redirect');
Route::get('/notifikasi-json', 'NotificationController@index_json')->name('notifikasi.json');
Route::get('/notifikasi', 'NotificationController@index')->name('notifikasi.index');

/** modul master */
Route::group(['prefix' => 'master'], function () {
    Route::resource('role', 'RoleController')->only([
        'index', 'update'
    ]);
});

Route::get('/home', 'DashboardController@index')->name('dashboard');

Route::get('auth/forgot-password', 'Auth\ForgotPasswordController@forget')->name('auth.forget');
Route::post('auth/change-password', 'Auth\ForgotPasswordController@change')->name('auth.change-password');
Route::get('auth/success', 'Auth\ForgotPasswordController@success')->name('auth.success');
Auth::routes(['verify' => true]);
