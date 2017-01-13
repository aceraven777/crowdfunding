<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
});

Route::group(['prefix' => 'backend'], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'Admin\DashboardController@index');
    });

    // Authentication Routes...
    $this->get('login', 'Admin\Auth\AuthController@showLoginForm');
    $this->post('login', 'Admin\Auth\AuthController@login');
    $this->get('logout', 'Admin\Auth\AuthController@logout');

    // Registration Routes...
    $this->get('register', 'Admin\Auth\AuthController@showRegistrationForm');
    $this->post('register', 'Admin\Auth\AuthController@register');

    // Password Reset Routes...
    $this->get('password/reset/{token?}', 'Admin\Auth\PasswordController@showResetForm');
    $this->post('password/email', 'Admin\Auth\PasswordController@sendResetLinkEmail');
    $this->post('password/reset', 'Admin\Auth\PasswordController@reset');
});
