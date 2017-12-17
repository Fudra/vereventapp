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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => '/events'], function () {
    	Route::get('/create', 'Events\\EventController@create')->name('account.event.create.start');
    	Route::get('/{event}/create', 'Events\\EventController@create')->name('account.event.create');
    });

    Route::group(['prefix' => '/settings'], function () {
	    Route::patch('/profile', 'Settings\ProfileController@update');
	    Route::patch('/password', 'Settings\PasswordController@update');
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::post('auth/resend','Auth\\ActivationResendController@resend');
});
