<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Employee::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(1, 2000),
        'ilwu_number' => $faker->randomNumber(),
        'company_number' => $faker->randomNumber(),
        'clock_number' => $faker->randomNumber(),
        'last_name' => $faker->lastName(),
        'first_name' => $faker->firstName(),
        'middle_initial' => '',
        'address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state' => $faker->state(),
        'zip' => $faker->postCode(),
        'phone_number' => $faker->phoneNumber(),
        'birth_date' => $faker->date(),
        'ss' => $faker->randomNumber(),
        'status' => $faker->randomElement(['A', 'B', 'CASUAL']),
        'date_of_hire' => $faker->date(),
        'registration_date' => $faker->date(),
        'transfer_date' => $faker->date(),
        'registration_port' => $faker->city(),
        'profile_picture' => '',
    ];
});
