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

Route::get('/', function () {
    return view('welcome');
});

/** module user */
Route::get('/user-json', 'UserController@userJson')->name('user.json');
Route::resource('/user', 'UserController')->except(['create', 'edit']);

Route::get('/setting-account', 'SettingAccountController@index')->name('setting.account');

/** modul log */
Route::get('log-json', 'LogController@index_json')->name('log.json');
Route::resource('log', 'LogController')->only(['index']);

/** notification */
Route::get('/notifikasi-redirect', 'NotificationController@redirect')->name('notifikasi.redirect');
Route::get('/notifikasi-json', 'NotificationController@index_json')->name('notifikasi.json');
Route::get('/notifikasi', 'NotificationController@index')->name('notifikasi.index');

//data kecelakaan
Route::resource('/data-kecelakaan', 'DataKecelakaanController');

/** modul master */
Route::group(['prefix' => 'master'], function () {
    Route::resource('role', 'RoleController')->only([
        'index', 'update'
    ]);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/forgot-password', 'Auth\ForgotPasswordController@forget')->name('auth.forget');
Route::post('auth/change-password', 'Auth\ForgotPasswordController@change')->name('auth.change-password');
Route::get('auth/success', 'Auth\ForgotPasswordController@success')->name('auth.success');
Auth::routes(['verify' => true]);
