<?php

use App\Models\Course;
use App\Models\TakingCourse;
use App\Models\User;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(TakingCourse::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'course_id' => factory(Course::class),
    ];
});
