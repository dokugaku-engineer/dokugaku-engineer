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
    // These endpoints require a valid id token for user
    Route::middleware(['jwt'])->group(function () {
        // User routes
        Route::resource('users', 'UserController')->only([
            'show', 'update'
        ]);

        // Course-related routes
        Route::get('courses/{name}/lectures', 'CourseController@getLectures');
        Route::get('lectures/{slug}', 'LectureController@show');

        // Learning history routes
        Route::resource('learning_histories', 'LearningHistoryController')->only([
            'store'
        ]);

        // Auth0 routes
        Route::post('auth0/send_verification_email', 'Auth0Controller@sendVerificationEmail');
    });

    // These endpoints require a valid access token for machine
    Route::middleware(['jwt.m2m'])->group(function () {
        // Course-related routes
        Route::resource('courses', 'CourseController')->only([
            'index'
        ]);
        Route::get('courses/lectures', 'CourseController@getAllLectures');
    });


    // Health routes
    Route::get('health', 'HealthController@index');

    // User routes
    Route::resource('users', 'UserController')->only([
        'store'
    ]);

    // Taking course routes
    Route::resource('taking_courses', 'TakingCourseController')->only([
        'store'
    ]);

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
