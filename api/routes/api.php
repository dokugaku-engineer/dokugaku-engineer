<?php

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
            'index',
        ]);
        Route::get('courses/lectures', 'CourseController@getAllLectures');
    });

    // These endpoints require a valid id token for user
    Route::middleware(['jwt', 'sentry.context'])->group(function () {
        // User routes
        Route::resource('users', 'UserController')->only([
            'show', 'update', 'destroy',
        ]);

        // Course-related routes
        Route::get('courses/{name}', 'CourseController@show')->name('course');
        Route::resource('parts', 'PartController')->only([
            'index',
        ]);
        Route::resource('lessons', 'LessonController')->only([
            'index',
        ]);
        Route::resource('lectures', 'LectureController')->only([
            'index',
        ]);
        Route::get('lectures/{slug}', 'LectureController@show');

        // Learning history routes
        Route::resource('learning_histories', 'LearningHistoryController')->only([
            'store',
        ]);
        Route::get('learning_histories/{course_name}/lecture_ids', 'LearningHistoryController@getLectureIds');

        // Auth0 routes
        Route::post('auth0/send_verification_email', 'Auth0Controller@sendVerificationEmail');

        // Subscription routes
        Route::resource('subscriptions', 'SubscriptionController')->only([
            'store',
        ]);
        Route::post('subscriptions/create_checkout_sessions', 'SubscriptionController@createCheckoutSession');
        Route::get('subscriptions/customer_portal', 'SubscriptionController@customerPortal');
    });

    // Health routes
    Route::get('health', 'HealthController@index');

    // User routes
    Route::resource('users', 'UserController')->only([
        'store',
    ]);

    // Taking course routes
    Route::resource('taking_courses', 'TakingCourseController')->only([
        'store',
    ]);

    // Post-related routes
    Route::resource('categories', 'CategoryController')->only([
        'index', 'store', 'show', 'update',
    ]);
    Route::resource('posts', 'PostController')->only([
        'index', 'store', 'show', 'update', 'destroy',
    ]);
    Route::get('/posts/{post}/publish', 'PostController@publish')->name('posts.publish');
    Route::get('/posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
});
