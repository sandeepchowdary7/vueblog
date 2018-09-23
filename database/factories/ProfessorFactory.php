<?php

use Faker\Generator as Faker;

$factory->define(App\Professor::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('male','female','other'));
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->name,
        'last_name' => $faker->lastName,
        'gender' => $gender,
        'dob' => $faker->date,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
		'address' => $faker->address,
    ];
});
