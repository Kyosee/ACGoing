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


Route::domain('{account}.myapp.com')->group(function () {

});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(Router $router){
    $router->get('/', 'IndexController@index');
});
