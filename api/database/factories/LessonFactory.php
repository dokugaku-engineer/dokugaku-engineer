<?php

use App\Models\Lesson;
use App\Models\Part;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'part_id' => factory(Part::class),
        'order' => $faker->randomDigit,
        'name' => $faker->name,
        'course_id' => function (array $lesson) {
            return Part::find($lesson['part_id'])->course_id;
        },
    ];
});
