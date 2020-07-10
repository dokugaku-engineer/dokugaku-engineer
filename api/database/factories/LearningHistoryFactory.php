<?php

use App\Models\LearningHistory;
use App\Models\Lecture;
use App\Models\User;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(LearningHistory::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'lecture_id' => factory(Lecture::class),
        'course_id' => function (array $learningHistory) {
            return Lecture::find($learningHistory['lecture_id'])->lesson->part->course_id;
        },
    ];
});
