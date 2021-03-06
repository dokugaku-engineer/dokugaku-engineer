<?php

use App\Models\Course;
use App\Models\Part;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(Part::class, function (Faker $faker) {
    return [
        'course_id' => factory(Course::class),
        'order' => $faker->randomDigit,
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});
