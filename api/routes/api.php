<?php

use App\Http\Resources\Lecture\Lecture;
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
    // Health routes
    Route::get('health', 'HealthController@index');

    // Lecture-related routes
    Route::get('lectures/{slug}', 'LectureController@show');
    Route::get('courses/{name}/lectures', 'CourseController@getLectures');

    // Post-related routes
    Route::resource('categories', 'CategoryController')->only([
        'index', 'store', 'show', 'update'
    ]);
    Route::resource('posts', 'PostController')->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
    Route::get('/posts/{post}/publish', 'PostController@publish')->name('posts.publish');
    Route::get('/posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
});
