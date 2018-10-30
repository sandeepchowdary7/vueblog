<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Student::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('male','female','other'));
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->name,
        'last_name' => $faker->lastName,
        'guardian_name' => $faker->name,
        'gender' => $gender,
        'dob' => $faker->date,
        'contact_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'graduated_year' => Carbon::create('2000', '01', '01')
    ];
});
