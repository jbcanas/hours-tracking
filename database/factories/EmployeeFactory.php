<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Employee::class, function (Faker $faker) {
    return [
        'gang_sheet_id' => 1,
        'employee_id' => $faker->randomDigit(),
        'ilwu_number' => 1000,
        'company_number' => 1000,
        'job_position' => 'Longshoreman',
        'registration_status' => 'A',
        'st' => $faker->randomDigit(),
        'st_other' => $faker->randomDigit(),
        'ot' => $faker->randomDigit(),
        'ot_other' => $faker->randomDigit(),
        'pot' => $faker->randomDigit(),
        'pot_other' => $faker->randomDigit(),
        'dt' => $faker->randomDigit(),
        'replacement' => 0
    ];
});
