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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('User')->group(function () {
    Route::prefix('blog')->group(function () {
        Route::get('/', 'PostController@index');
        Route::get('/{postSlug}', 'PostController@show');
        Route::get('/categories/{category}', 'CategoryController@show');
    });
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/posts');
    Route::resource('posts', 'PostController')->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('/posts/{post}/publish', 'PostController@publish')->name('posts.publish');
    Route::get('/posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
    Route::resource('categories', 'CategoryController')->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);
});