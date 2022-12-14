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

if (getenv('APP_PROTOCOL') && getenv('APP_PROTOCOL') !== 'http') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/cookie/get', 'UserController@getCookie')->name('user.cookie');
Route::get('/cookie/set', 'UserController@setCookie')->name('user.setCookie');

/* User Management */
Route::group([], function () {
    Route::get('login', 'UserController@login')->name('login');
    Route::get('logout', 'UserController@logout')->name('logout');
    Route::post('user-auth', 'UserController@auth')->name('user.auth');
    Route::post('user-authafterotp', 'UserController@authafterotp')->name('user.authafterotp');
    Route::post('user-auth2fa', 'UserController@auth2fa')->name('user.auth2fa');
    Route::post('tele-2fa', 'UserController@tele2fa')->name('user.tele2fa');

    //Route::get('createcaptcha', 'CaptchaController@create');
    //Route::get('captcha/{config?}', 'CaptchaController@index');
    //Route::get('captcha/api/{config?}', 'CaptchaController@index');
    //Route::get('refreshcaptcha', 'CaptchaController@refreshCaptcha');

});

// List Module
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/user-create', 'UserController@create')->name('user.create');

    Route::post('/user-store', 'UserController@store')->name('user.store');
    Route::put('/user-update/{user}', 'UserController@update')->name('user.update');

    Route::resource('/capacity', 'CapacityController');
    Route::get('/capacity-report', 'CapacityController@report')->name('capacity.report');
    Route::get('/capacity-status', 'CapacityController@status')->name('capacity.status');

    Route::resource('/profillingbcp', 'ProfillingBcpController');
    Route::get('/profillingbcp-sto', 'ProfillingBcpController@showsto')->name('profillingbcp.sto');
    Route::get('/profillingbcp-gpon', 'ProfillingBcpController@showgpon')->name('profillingbcp.gpon');
    Route::get('/profillingbcp-all', 'ProfillingBcpController@showall')->name('profillingbcp.all');

    Route::resource('/sto', 'StoController');

    Route::resource('/module', 'ModuleController');
    Route::resource('/submodule', 'SubmoduleController');

    Route::get('/landing', 'UserController@landing')->name('user.landing');
    Route::get('/menu/{submodule}', 'UserController@showMenu')->name('user.menu');
});