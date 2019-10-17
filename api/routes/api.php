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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::get('sample', 'SampleController@index');
    Route::resource('categories', 'CategoryController')->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);
    // Route::resource('posts', 'PostController')->only([
    //     'index', 'create', 'store', 'edit', 'update', 'destroy'
    // ]);
    // Route::get('/posts/{post}/publish', 'PostController@publish')->name('posts.publish');
    // Route::get('/posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
});
