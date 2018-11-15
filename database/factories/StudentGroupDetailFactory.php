<?php

use Faker\Generator as Faker;

$factory->define(App\StudentGroupDetail::class, function (Faker $faker) {
    return [
        'student_id' => $faker->numberBetween($min = 1, $max = 32),
        'course_year_id' => $faker->numberBetween($min = 1, $max = 3),
        'course_group_id' => $faker->numberBetween($min = 1, $max = 4),
        'course_section_id' => $faker->numberBetween($min = 1, $max = 3),
        'subject_id'    => $faker->numberBetween($min = 1, $max = 5),
        'professor_id' => $faker->numberBetween($min = 1, $max = 30)
    ];
});