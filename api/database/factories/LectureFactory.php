<?php

use App\Models\Lecture;
use App\Models\Lesson;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(Lecture::class, function (Faker $faker) {
    return [
        'lesson_id' => factory(Lesson::class),
        'order' => $faker->randomDigit,
        'name' => $faker->name,
        'video_url' => $faker->url,
        'description' => $faker->sentence,
        'slug' => $faker->slug,
        'prev_lecture_slug' => $faker->slug,
        'next_lecture_slug' => $faker->slug,
        'course_id' => function (array $lecture) {
            return Lesson::find($lecture['lesson_id'])->part->course_id;
        },
    ];
});
