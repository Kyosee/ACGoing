<?php
use Illuminate\Routing\Router;

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
Route::get('/kit', 'KitController@testSP')->name('kit');

// passport
Route::group([], function(){
    Route::get('passport/signup', 'PassportController@signup')->name('signup');
    Route::post('passport/signup', 'PassportController@subReg');

    Route::get('passport/login', 'PassportController@login')->name('login');
    Route::post('passport/login', 'PassportController@subLogin');

    Route::get('passport/forget', 'PassportController@forget')->name('forget');
    Route::post('passport/forget', 'PassportController@subForget');

    Route::get('passport/logout', 'PassportController@logout')->name('logout');

    Route::get('passport/captcha', 'PassportController@captcha')->name('passport.captcha');
});

Route::group(['prefix' => 'member', 'namespace' => 'Member'], function(Router $router){
    Route::get('/', 'HomeController@index')->name('member');
    Route::get('/{user?}', 'HomeController@show')->name('member');
});

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function(Router $router){
    $router->get('/', ['as' => 'dbhome', 'uses' => 'HomeController@home']);

    // Spider
    Route::group(['prefix' => 'spider'], function(Router $router){
        $router->get('/spider_site_type', 'SpiderController@site_type')->name('spider_site_type');
        $router->post('/spider_site_type', 'SpiderController@siteTypeStore');
        $router->delete('/spider_site_type', 'SpiderController@siteTypeDelete');

        $router->get('/', 'SpiderController@home')->name('site');
        $router->post('/site_details/{id?}', 'SpiderController@siteStore');
        $router->get('/site_details/{id?}', 'SpiderController@site_details')->name('site_details');
    });
});
