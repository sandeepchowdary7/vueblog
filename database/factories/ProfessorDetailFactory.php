<?php

use Faker\Generator as Faker;

$factory->define(App\ProfessorDetail::class, function (Faker $faker) {
    $role = $faker->randomElement($array = array('Techincal', 'Non-Technical', 'Other'));
    $isActive = $faker->randomElement($array = array('0', '1'));
    return [
        'professor_id' => $faker->numberBetween($min = 1, $max = 30),
        'role' => $role,
        'salary' => $faker->numberBetween($min = 15000, $max = 65000),
        'is_active' => $isActive,
        'joined_on' => $faker->dateTime($max = 'now', $timezone = null),
        'resigned_at' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});
