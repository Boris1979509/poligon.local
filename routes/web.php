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

Route::get('/', "TestController@index");

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function(){
    Route::resource('posts', 'PostController')->names('blog.posts');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/**
 * Админка Блога
 */
$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function (){
    // Resource methods only by CategoryController
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', 'CategoryController')->only($methods)->names('blog.admin.categories');
});
/**
 * end Category
 */