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
Route::group(['prefix' => 'passport'], function(){
    Route::get('register', 'PassportController@register')->name('register');
    Route::post('register', 'PassportController@subReg');

    Route::get('login', 'PassportController@login')->name('login');
    Route::post('login', 'PassportController@subLogin');

    Route::get('forget', 'PassportController@forget')->name('forget');
    Route::post('forget', 'PassportController@subForget');

    Route::get('logout', 'PassportController@logout')->name('logout');

    Route::get('captcha', 'PassportController@captcha')->name('passport.captcha');
});

// user center
Route::group(['namespace' => 'User'], function(Router $router){
    $router->resource('users', 'HomeController');
});

// News
Route::group(['namespace' => 'News', 'prefix' => 'news'], function(Router $router){
    $router->get('/', 'HomeController@index')->name('news');
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
