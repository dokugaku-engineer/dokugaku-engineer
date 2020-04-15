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

Route::group(['namespace' => 'Api'], function () {
    // These endpoints require a valid access token for machine
    Route::middleware(['jwt.m2m'])->group(function () {
        // Course-related routes
        Route::resource('courses', 'CourseController')->only([
            'index'
        ]);
        Route::get('courses/lectures', 'CourseController@getAllLectures');
    });

    // These endpoints require a valid id token for user
    Route::middleware(['jwt', 'sentry.context'])->group(function () {
        // User routes
        Route::resource('users', 'UserController')->only([
            'show', 'update', 'destroy'
        ]);

        // Course-related routes
        Route::get('courses/{name}', 'CourseController@show');
        Route::resource('parts', 'PartController')->only([
            'index'
        ]);
        Route::resource('lessons', 'LessonController')->only([
            'index'
        ]);
        Route::resource('lectures', 'LectureController')->only([
            'index'
        ]);
        Route::get('lectures/{slug}', 'LectureController@show');

        // Learning history routes
        Route::resource('learning_histories', 'LearningHistoryController')->only([
            'store'
        ]);
        Route::get('learning_histories/{course_name}/lecture_ids', 'LearningHistoryController@getLectureIds');

        // Auth0 routes
        Route::post('auth0/send_verification_email', 'Auth0Controller@sendVerificationEmail');
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

    // TODO: デバッグが終わったら削除する
    Route::get('lectures/index/test', 'LectureController@indexTest');
    Route::get('lectures/{slug}/test', 'LectureController@showTest');
    Route::get('courses/{name}/test', 'CourseController@test');
    Route::get('parts/test', 'PartController@test');
    Route::get('lessons/test', 'LessonController@test');
    Route::get('learning_histories/test', 'LearningHistoryController@test');
});
