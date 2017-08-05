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

Route::get('/', 'HomeController@home')->name('home');

// passport
Route::get('passport/signup', 'PassportController@signup')->name('signup');
Route::get('passport/captcha', 'PassportController@captcha')->name('passport.captcha');

Route::get('passport/login', 'PassportController@login')->name('login');
Route::get('passport/test', 'PassportController@test');
