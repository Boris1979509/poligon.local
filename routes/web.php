<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('cabinet', 'Cabinet\HomeController@index')->name('cabinet.home');
Route::get('verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

// Admin
Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'namespace'  => 'Admin',
    'middleware' => 'auth',
], static function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Admin Users
    Route::group([
        'namespace' => 'Users',
    ], static function () {
        Route::resource('users', 'UsersController');
        Route::post('users/{user}/verify', 'UsersController@verify')->name('users.verify');
    });
    // Admin Blog
    Route::group([
        'namespace' => 'Blog',
        'prefix'    => 'blog',
        'as'        => 'blog.',
    ], static function () {
        $methods = ['index', 'edit', 'store', 'update', 'create'];
        Route::resource('categories', 'CategoryController')->only($methods);
        Route::resource('posts', 'PostController')->except('show');
        Route::get('posts/{post}/restore', 'PostController@restore')->name('posts.restore'); // Восстановление статьи
    });
});
