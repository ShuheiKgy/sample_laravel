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

Route::get('signup', 'SignupController@index')->name('signup.index');

Route::post('signup', 'SignupController@postIndex');

Route::get('signup/confirm', 'SignupController@confirm')->name('signup.confirm');

Route::post('signup/confirm', 'SignupController@postConfirm');

Route::get('signup/thanks', 'SignupController@thanks')->name('signup.thanks');


Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');

    Route::post('admin/login', 'Admin\LoginController@login');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::get('admin', 'Admin\IndexController@index')->name('admin.top');
    
    Route::get('admin/message', 'Admin\MessageController@index')->name('admin.message.index');
    
    Route::get('admin/message/create', 'Admin\MessageController@create')->name('admin.message.create');
    
    Route::post('admin/message/create', 'Admin\MessageController@store');
    
    Route::get('admin/message/edit/{message}', 'Admin\MessageController@edit')->name('admin.message.edit');
    
    Route::post('admin/message/edit/{message}', 'Admin\MessageController@update');
    
    Route::get('admin/user', 'Admin\UserController@index')->name('admin.user.index');
    
    Route::delete('admin/user/destroy/{user}', 'Admin\UserController@destroy')->name('admin.user.destroy');
});

Route::middleware('guest:user')->group(function () {
    Route::get('user/login', 'User\LoginController@showLoginForm')->name('user.login');
    
    Route::post('user/login', 'User\LoginController@login');
});

Route::middleware('auth:user')->group(function () {
    Route::get('user', 'User\IndexController@index')->name('user.top');
    
    Route::get('user/logout', 'User\LoginController@logout')->name('user.logout');
    
    Route::get('user/profile/edit', 'User\ProfileController@edit')->name('user.profile.edit');
    
    Route::post('user/profile/edit', 'User\ProfileController@update');
    
    Route::get('user/message', 'User\MessageController@index')->name('user.message.index');
    
    Route::get('user/message/show/{message}', 'User\MessageController@show')->name('user.message.show');
});
