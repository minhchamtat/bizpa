<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('admin.logout');
// Route::get('register', 'Auth\RegisterController@showRegistrationForm');
// Route::post('register', 'Auth\RegisterController@register')->name('admin.register');

Route::group([
    'middleware' => ['admin'],
    'as' => 'admin::'
], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'MasterController@index']);

    ##AUTO_INSERT_ROUTE##

    //admin
    Route::resource('admins', 'AdminController');

    //level
    Route::resource('levels', 'LevelController');

//users
    Route::resource('users', 'UserController');

    //routes here
});