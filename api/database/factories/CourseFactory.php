<?php

use App\Models\Course;
use Faker\Generator as Faker;

/** @var Faker $faker */
$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});
