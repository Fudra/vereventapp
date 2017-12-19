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

/**
 * account routes
 */

/**
 *
 */
Route::group(['middleware' => 'auth:api'], function () {
	Route::post( 'logout', 'Auth\LoginController@logout' );
});

Route::group(['middleware' => 'auth:api', 'prefix' => '/account'], function () {

	/**
	 *
	 */
    Route::get('/user', 'Account\\UserController@index');

	/**
	 *
	 */
    Route::group(['prefix' => '/events'], function () {
	    Route::get('/', 'Account\\EventController@index')->name('account.event.index');
	    Route::get('/create', 'Account\\EventController@create')->name('account.event.create.start');
    	Route::get('/{event}/create', 'Account\\EventController@create')->name('account.event.create');
	    Route::post('/{event}', 'Account\\EventController@store')->name('account.event.store');
	    Route::get('/{event}/edit', 'Account\\EventController@edit')->name('account.event.edit');
	    Route::patch('/{event}', 'Account\\EventController@update')->name('account.event.update');
	    Route::delete('/{event}', 'Account\\EventController@destroy')->name('account.event.destroy');

	    /**
	     *
	     */
	    Route::group(['prefix' => '/{event}/ticket'], function () {
		    Route::post('/', 'Account\\TicketController@store')->name('account.event.ticket.store');
		    Route::get('/{ticket}/edit', 'Account\\TicketController@edit')->name('account.event.ticket.edit');
		    Route::patch('/{ticket}', 'Account\\TicketController@update')->name('account.event.ticket.update');
		    Route::delete('/{ticket}', 'Account\\TicketController@destroy')->name('account.event.ticket.destroy');
	    });
    });

	/**
	 *
	 */
    Route::group(['prefix' => '/settings'], function () {
	    Route::patch('/profile', 'Settings\ProfileController@update');
	    Route::patch('/password', 'Settings\PasswordController@update');
    });
});

/**
 * Guest Routes
 */
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::post('auth/resend','Auth\\ActivationResendController@resend');
});

/**
 * General Event Routes
 */
Route::group(['prefix' => '/events'], function () {
	Route::get('/', 'Events\\EventController@index')->name('event.index');
	Route::get('/{event}', 'Events\\EventController@show')->name('event.show');
	Route::get('/{event}/tickets', 'Events\\TicketController@show')->name('event.ticket.show');
});


